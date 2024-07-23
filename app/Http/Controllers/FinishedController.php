<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class FinishedController extends Controller
{

    function index(Request $request){

        $user = Auth::user();

        $finisheds = $user->finisheds();
        // ->with([
        //     'finishedable' => function ($query) {
        //         $query->with(['files', 'task']);
        //     }
        // ]);

        $finisheds = $finisheds->get();

        $finisheds->each(function ($finished) {

            $date = Carbon::createFromFormat('Y-m-d H:i:s', $finished->finishedable->created_at);
            Carbon::setLocale('es');
            $formatted_created_at = $date->isoFormat('D \d\e MMMM, YYYY');
            $finished->finishedable->formatted_created_at = $formatted_created_at;
            $finished->finishedable_name = Task::$task_names[$finished->finishedable_type]; // use $task_names outside tasks ***

            if(!$finished->paid){
                $finished->paid = 'Pendiente';
            }

            // if ($finished->finishedable_type == 'App\Models\Solicitudes') {
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

        return view('technical.solicitudes', $data);

    }

}
