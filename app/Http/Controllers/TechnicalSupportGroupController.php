<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Task;
use App\Models\TechnicalSupportGroup;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class TechnicalSupportGroupController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (! (Gate::allows('administrador') || Gate::allows('soporte-tecnico-administrador'))) {
            abort(403);
        }

        $groups = TechnicalSupportGroup::leftJoin('zones', 'zone_id', '=', 'zones.id')
            ->select(
                'technical_support_groups.*',
                'zones.name as zone_name',
            )->get();

        $groups->each(function ($group) {

            $user_names = [];

            foreach ($group->users as $user) {
                $user_names[] = $user->name;
            }

            $group->user_names = implode(', ', $user_names);

        });

        $zones = Zone::all();

        $users = User::where('rol', 'soporte-tecnico-instalador')
            ->whereDoesntHave('group')
            ->select('id', 'name')
            ->get();

        $data = [
            'groups' => $groups,
            'users' => $users,
            'zones' => $zones,
        ];

        return view('technical-support-group.index', $data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if (! (Gate::allows('administrador') || Gate::allows('soporte-tecnico-administrador'))) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'zone_id' => ['required', 'integer', 'max:255'],
            'technical_support_user' => ['required', 'array', 'min:1'],
            'technical_support_user.*' => ['integer', 'exists:users,id'],
        ]);

        $technical_support_group = new TechnicalSupportGroup();
        $technical_support_group->name = $validated['name'];
        $technical_support_group->zone_id = $validated['zone_id'];
        $technical_support_group->save();

        $technical_support_group->users()->attach($request->technical_support_user); // validate ***

        Session::flash('message', 'Grupo de instalacion creado exitosamente');
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('technical.support.group.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TechnicalSupportGroup $technicalSupportGroup)
    {

        if (! (Gate::allows('administrador') || Gate::allows('soporte-tecnico-administrador'))) {
            abort(403);
        }

        $technicalSupportGroup->delete();

        Session::flash('message', 'Grupo de instalacion eliminado exitosamente');
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('technical.support.group.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function updateAvailability(TechnicalSupportGroup $technical_support_group)
    {

        if (! (Gate::allows('soporte-tecnico-instalador'))) {
            abort(403);
        }

        // check the user is in the group ***

        $old_availability = $technical_support_group->availability;
        $new_availability = 'No disponible';

        if($old_availability == 'No disponible'){

            $plan = Plan::where('status', 'Aprobado')
                ->where('zone_id', $technical_support_group->zone_id)
                ->oldest()
                ->first();

            if(!empty($plan)){

                $task = new Task();

                $task->technical_support_group_id = $technical_support_group->id;

                $plan->task()->save($task);

                $plan->update([
                    'status' => 'Asignado',
                    'technical_support_group_id' => $technical_support_group->id,
                ]);

            }else{

                $new_availability = 'Disponible';

            }

        }

        $technical_support_group->update(['availability' => $new_availability]);

        Session::flash('message', 'Disponibilidad actualizada exitosamente');
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('technical.support.task.index');

    }

}
