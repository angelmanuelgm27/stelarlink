<?php

namespace App\Http\Controllers;

use App\Models\Services;
use App\Models\Solicitudes;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\FileTrait;

class TechnicalSupportTaskController extends Controller
{

    use FileTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user = Auth::user();

        $group = $user->group()
            ->leftJoin('zones', 'zone_id', '=', 'zones.id')
            ->select(
                'technical_support_groups.*',
                'zones.name as zone_name',
            )
            ->first();

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

            $class_name = ($task) ? get_class($taskable) : null;

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

    public function markAsCompleted(Request $request, Task $task)
    {

        // $user = Auth::user();

        $validated = $request->validate([
            'files' => ['nullable', 'max:20'],
            'files.*' => ['nullable', 'file', 'mimes:bmp,gif,jpeg,jpg,pdf,png,zip', 'max:12800'],
        ]);

        // $group = $user->group()->first();

        $taskable = $task->taskable;

        $taskable->update(['status' => 'Completada']);

        $this->instalationFiles($request->file('files'), $taskable);

        return redirect()->route('technical.support.task.index');

    }

}
