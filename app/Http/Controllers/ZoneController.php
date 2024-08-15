<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ZoneController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (! (Gate::allows('administrador') || Gate::allows('soporte-tecnico-administrador'))) {
            abort(403);
        }

        $zones = Zone::all();

        $data = [
            'zones' => $zones,
        ];

        return view('zone.index', $data);


    }

    public function store(Request $request)
    {

        if (! (Gate::allows('administrador') || Gate::allows('soporte-tecnico-administrador'))) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
        ]);

        $technical_support_group = new Zone();
        $technical_support_group->name = $validated['name'];
        $technical_support_group->description = $validated['description'];
        $technical_support_group->save();

        return redirect()->route('zone.index');

    }

    public function destroy(Zone $zone)
    {

        if (! (Gate::allows('administrador') || Gate::allows('soporte-tecnico-administrador'))) {
            abort(403);
        }

        $zone->delete();

        return redirect()->route('zone.index');

    }

}
