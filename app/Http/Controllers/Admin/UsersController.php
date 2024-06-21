<?php

namespace App\Http\Controllers\Admin;

use App\Events\NotificationBroadcast;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UsersPasswordsRenews;
use App\Notifications\Users\AsignNewPasswordEmailNotification;
use App\Notifications\Users\AsignNewPasswordDatabaselNotification;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use stdClass;

class UsersController extends Controller
{
    //

    public function index(){
        return view('admin.users');
    }

    public function list(){
        $users = User::where('rol', '=', 'default')->get();
        return response()->json($users, 200);
    }


    public function update(Request $request, $id){
        try {
             $user = User::find($id);
             $user->enabled = !$user->enabled;
             $user->save();
             return response()->json(["success" => true, "message" => "Cambio exitoso"], 200);
        } catch (\Exception $e) {
             return response()->json(["success" => false, "message" => $e], 422);
        }
     }

     public function delete($id){
        try {
            $user = User::find($id);
            $user->delete();
            return response()->json(["success" => true, "message" => "Usuario eliminado "], 200);
        } catch (\Exception $e) {
            return response()->json(["success" => false, "message" => $e], 422);
        }
    }
}
