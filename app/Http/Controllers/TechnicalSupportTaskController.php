<?php

namespace App\Http\Controllers;

use App\Models\Finished;
use App\Models\Plan;
use App\Models\Service;
use App\Models\Task;
use App\Models\User;
use App\Traits\FileTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TechnicalSupportTaskController extends Controller
{

    use FileTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (! (Gate::allows('soporte-tecnico-instalador'))) {
            abort(403);
        }

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
                [Plan::class],
                function (Builder $query) {
                    $query->where('status', 'Asignado');
                }
            )

            ->first();

            $task_id = ($task) ? $task->id : null;

            $taskable = ($task) ? $task->taskable : null;

            $service = ($task) ? Service::find($taskable->service_id) : null;

            $class_name = ($task) ? $task->taskable_type : null;

            $taskable_name = ($task) ? Task::$task_names[$class_name] : null;

            $client = ($task) ? User::find($taskable->user_id) : null;

            $phone = ($client) ? $client->phone : null;

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
                'phone' => $phone,
            ];

        }else{
            $data = [];
        }

        return view('technical-support-task.index', $data);

    }

    public function markAsCompleted(Request $request, Task $task)
    {

        if (! (Gate::allows('soporte-tecnico-instalador'))) {
            abort(403);
        }

        $validated = $request->validate([
            'files' => ['nullable', 'max:20'],
            'files.*' => ['nullable', 'file', 'mimes:bmp,gif,jpeg,jpg,pdf,png,zip', 'max:12800'],
        ]);

        $taskable = $task->taskable;

        $taskable->update([
            'status' => 'Activo',
            'instalation_date' => Carbon::now(),
            'renovation_date' => Carbon::now()->addMonthsNoOverflow(1),
        ]);

        $user = Auth::user();

        $this->instalationFiles($request->file('files'), $taskable);

        $user = Auth::user();

        $group = $user->group()->first();

        $group->update([
            'last_instalation' => Carbon::now(),
        ]);

        $users = $group->users;

        $instalation_amount = 100; // ***
        $users_count = count($users);

        foreach ($users as $user) {

            $finished = new Finished();
            $finished->user_id = $user->id;
            $finished->payment_amount = $instalation_amount / $users_count;
            $taskable->finisheds()->save($finished);

        };

        return redirect()->route('technical.support.task.index');

    }

}
