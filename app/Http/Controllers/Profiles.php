<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Str;

class Profiles extends Controller
{
    //

    public function updateAvatar(Request $request, $id)
    {

        try {
            if ($request->file('image')) {
                $file = $request->file('image');
                $outputImage = 'images/perfiles/';
                $fileName = 'profile_' . time() . '_' . Str::uuid()->toString();


                $user = User::find($id);
                if (file_exists(public_path($user->avatar)) && $user->avatar != '') {
                    unlink(public_path($user->avatar));
                }

                $avatarUrl = '/storage/' . $outputImage . $fileName . '.' . $file->getClientOriginalExtension();

                $user->avatar = $avatarUrl;
                $user->save();

                $file->storeAs($outputImage, $fileName . '.' . $file->getClientOriginalExtension(), 'public');
                return response()->json(['success' => true, 'message' => 'Imagen de perfil se actualizo correctamente', 'image' => $avatarUrl]);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => true, 'message' => $e, 'image' => '']);
        }
    }

    public function update(Request $request, $id)
    {

        try {
            $user = User::find($id);
            $user->address = $request->address;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->save();
            return response()->json(['success' => true, 'message' => 'Datos del perfil se actualizo correctamente']);
        } catch (\Exception $e) {
            //throw $th;
            return response()->json(['success' => true, 'message' => $e]);
        }
    }
}
