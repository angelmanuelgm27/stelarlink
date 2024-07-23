<?php

namespace App\Http\Controllers;

use App\Models\Finished;
use App\Models\Services;
use App\Models\Solicitudes;
use App\Models\Task;
use App\Traits\FileTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

            $class_name = ($task) ? $task->taskable_type : null;

            $taskable_name = ($task) ? Task::$task_names[$class_name] : null;

            $group_users = $group->users()
                ->select('name')
                ->get();

            $data = [
                'task_id' => $task_id,
                'group' => $group,
                'taskable' => $taskable,
                'service' => $service,
                'taskable_name' => $taskable_name,
                'group_users' => $group_users,
            ];

        }else{
            $data = [];
        }

        return view('technical-support-task.index', $data);

    }

    public function markAsCompleted(Request $request, Task $task)
    {

        $validated = $request->validate([
            'files' => ['nullable', 'max:20'],
            'files.*' => ['nullable', 'file', 'mimes:bmp,gif,jpeg,jpg,pdf,png,zip', 'max:12800'],
        ]);

        $taskable = $task->taskable;

        $taskable->update(['status' => 'Completada']);

        $this->instalationFiles($request->file('files'), $taskable);

        $user = Auth::user();

        $group = $user->group()->first();

        $users = $group->users;

        // $users->each(function ($user) {
        foreach ($users as $user) {

            $finished = new Finished();
            $finished->user_id = $user->id;
            $taskable->finisheds()->save($finished);

        };

        return redirect()->route('technical.support.task.index');

    }

}
