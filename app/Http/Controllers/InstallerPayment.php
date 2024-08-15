<?php

namespace App\Http\Controllers;

use App\Models\Finished;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Task;
use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class InstallerPayment extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (! (Gate::allows('administrador') || Gate::allows('cobranzas'))) {
            abort(403);
        }

        $finisheds = Finished::with('user')->with('file');
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

                $finished->paid = 'Pagar';

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

        });

        $data = [
            'finisheds' => $finisheds,
        ];

        return view('admin.installer-payment-index', $data);

    }

    /**
     * Display the specified resource.
     */
    public function store(Request $request, Finished $finished)
    {

        if (! (Gate::allows('administrador') || Gate::allows('cobranzas'))) {
            abort(403);
        }

        $validated = $request->validate([
            'image' => ['required', 'file', 'mimes:bmp,gif,jpeg,jpg,png,zip', 'max:12800'],
        ]);

        $file_request = $request->file('image');
        $path = Storage::disk('local')->put('/installer-payments', $file_request);

        $file = new File();
        $file->path = $path;
        $file->name = $file_request->getClientOriginalName();

        $finished->file()->save($file);

        $finished->update([
            'paid' => Carbon::now(),
        ]);

        return redirect()->back();

    }

}
