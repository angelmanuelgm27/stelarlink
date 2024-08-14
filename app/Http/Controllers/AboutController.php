<?php

namespace App\Http\Controllers;

use App\Mail\Contact;
use App\Models\Coordinates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AboutController extends Controller
{
    public function index()
    {
        return view('about');
    }

    public function contact(Request $request)
    {
        try {
            $clientMessage = $request->client_description;
            $clientPhone = $request->client_phone;
            $clientName = $request->client_full_name;

            Mail::to('stelarlinkcorp@gmail.com')->send(new Contact($clientName, $clientPhone, $clientMessage));
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            //throw $th;
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
