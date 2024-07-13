<?php

namespace App\Http\Controllers;

use App\Models\TechnicalSupportGroup;
use Illuminate\Http\Request;
use App\Models\User;

class TechnicalSupportGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groups = TechnicalSupportGroup::all();

        $groups->each(function ($group) {

            $user_names = [];

            foreach ($group->users as $user) {
                $user_names[] = $user->name;
            }

            $group->user_names = implode(', ', $user_names);

        });

        $users = User::where('rol', 'soporte-tecnico-instalador')
            ->select('id', 'name')
            ->get();

        $data = [
            'groups' => $groups,
            'users' => $users,
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

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'zone' => ['required', 'string', 'max:255'],
            'technical_support_user' => ['required', 'array', 'min:1'],
            'technical_support_user.*' => ['integer', 'exists:users,id'],
        ]);

        $technical_support_group = new TechnicalSupportGroup();
        $technical_support_group->name = $validated['name'];
        $technical_support_group->zone = $validated['zone'];
        $technical_support_group->save();

        $technical_support_group->users()->attach($request->technical_support_user); // validate ***

        return redirect()->route('technical-support-group.index');
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

        $technicalSupportGroup->delete();

        return redirect()->route('technical-support-group.index');

    }
}
