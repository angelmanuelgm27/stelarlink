<?php

namespace App\Http\Controllers;

use App\Models\Services;
use App\Models\Solicitudes;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class TechnicalSupportTaskController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user = Auth::user();

        $group = $user->group()->first();

        if($group){

            $task = $group->task()
            ->whereHasMorph(
                'taskable',
                [Solicitudes::class],
                function (Builder $query) {
                    $query->where('status', 'Asignada');
                }
            )
            ->first();

            $task_id = ($task) ? $task->id : null;

            $taskable = ($task) ? $task->taskable : null;

            $service = ($task) ? Services::find($taskable->service_id) : null;

            $class_name = ($task) ? get_class($taskable) : null; //class_basename()?

            $taskable_name = ($task) ? Task::$task_names[$class_name] : null;

            $data = [
                'task_id' => $task_id,
                'group' => $group,
                'taskable' => $taskable,
                'service' => $service,
                'taskable_name' => $taskable_name,
            ];

        }else{
            $data = [];
        }

        return view('technical-support-task.index', $data);

    }

    public function markAsCompleted(Task $task)
    {

        $user = Auth::user();

        $taskable = $task->taskable;

        $taskable->update(['status' => 'Completada']);

        return redirect()->route('technical.support.task.index');

    }

}
