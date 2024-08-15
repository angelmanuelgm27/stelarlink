<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class FinishedController extends Controller
{

    function index(Request $request){

        if (! (Gate::allows('soporte-tecnico-instalador'))) {
            abort(403);
        }

        $user = Auth::user();

        $finisheds = $user->finisheds()->with('file');
        // ->with([
        //     'finishedable' => function ($query) {
        //         $query->with(['files', 'task']);
        //     }
        // ]);

        $finisheds = $finisheds->get();

        $finisheds->each(function ($finished) {

            $date = Carbon::createFromFormat('Y-m-d H:i:s', $finished->created_at);
            Carbon::setLocale('es');
            $formatted_created_at = $date->isoFormat('D \d\e MMMM, YYYY');
            $finished->formatted_created_at = $formatted_created_at;
            $finished->finishedable_name = Task::$task_names[$finished->finishedable_type]; // use $task_names outside tasks ***

            if(!$finished->paid){

                $finished->paid = 'Pendiente';

            }else{

                $date = Carbon::createFromFormat('Y-m-d H:i:s', $finished->paid);
                Carbon::setLocale('es');
                $formatted_paid = $date->isoFormat('D \d\e MMMM, YYYY');
                $finished->formatted_paid = $formatted_paid;

            }

            // if ($finished->finishedable_type == 'App\Models\Plan') {
                // $finished->service_adrress = $finished->finishedable->adrress;
                // $finished->service_ip = $finished->finishedable->ip;
            // } elseif ($finished->finishedable_type == 'App\Models\Reparations') {
            //     $finished->description = $finished->finishedable->description;
            // }

            return $finished;

        });

        $data = [
            'finisheds' => $finisheds,
        ];

        return view('technical.plan', $data);

    }

}
