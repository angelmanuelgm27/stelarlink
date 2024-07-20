<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $zones = Zone::all();

        $data = [
            'zones' => $zones,
        ];

        return view('zone.index', $data);


    }

    public function store(Request $request)
    {

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

        $zone->delete();

        return redirect()->route('zone.index');

    }

}
