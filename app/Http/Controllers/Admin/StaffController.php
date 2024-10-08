<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Gate;

class StaffController extends Controller
{
    //
    public function index()
    {

        if (! (Gate::allows('administrador'))) {
            abort(403);
        }

        return view('admin.staff');
    }

    public function list()
    {

        if (! (Gate::allows('administrador'))) {
            abort(403);
        }

        $staffs = User::whereIn('rol', ['soporte-tecnico-administrador', 'soporte-tecnico-instalador', 'cobranzas'])->get();
        return response()->json($staffs, 200);
    }

    public function store(Request $request)
    {

        if (! (Gate::allows('administrador'))) {
            abort(403);
        }

        try {

            $existsUser = User::where('dni', $request->input('dni'))->first();

            if ($existsUser !== null) {
                Alert::error('Ya existe un personal con este DNI', '');
                return redirect()->back();
            }

            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->address = $request->input('address') ?? 'Ninguna';
            $user->phone = $request->input('phone');
            $user->dni = $request->input('dni');
            $user->rol = $request->input('rol');
            $user->avatar = '';
            $user->password = Hash::make($request->input('password'));
            $user->remember_token = '';
            $user->save();

            Alert::success('Personal ha sido creado', '');
            return redirect()->back();

        } catch (\Exception $e) {
            Alert::error('Error al crear el personal', '');
            return redirect()->back();
        }
    }

    public function delete($id)
    {

        if (! (Gate::allows('administrador'))) {
            abort(403);
        }

        try {
            $user = User::find($id);
            $user->delete();
            return response()->json(["success" => true, "message" => "Personal eliminado "], 200);
        } catch (\Exception $e) {
            return response()->json(["success" => false, "message" => $e], 422);
        }
    }
}
