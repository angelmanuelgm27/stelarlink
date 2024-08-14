<?php

namespace App\Http\Controllers;

use App\Mail\Contact;
use App\Models\Coordinates;
use App\Models\InstallationServices;
use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function home()
    {

        $data = [
            'title' => 'StelarLink - Home',
            'description' => 'Home',
            'copyright' => 'StelarLink'
        ];
        $services = Services::where('status', true)->get();
        $installation_services = InstallationServices::where('status', true)->get();
        $coordinates = Coordinates::all();
        return view('home', compact('data', 'services', 'installation_services', 'coordinates'));
    }

    public function about()
    {
        $data = [
            'title' => 'StelarLink - Nosotros',
            'description' => 'Home',
            'copyright' => 'StelarLink'
        ];
        $coordinates = Coordinates::all();
        return view('about', compact('data', 'coordinates'));
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

    public function panel()
    {
        $date = date('Y-m-d');
        if (Auth::user()->rol == 'default') {
            return view('users.dashboard', compact('date'));
        }
        if (Auth::user()->rol == 'soporte tecnico') {
            return view('technical.dashboard', compact('date'));
        }
        if (Auth::user()->rol == 'cobranzas') {
            return view('collection.dashboard', compact('date'));
        }
        return view('admin.dashboard', compact('date'));
    }

    public function profile()
    {
        $date = date('Y-m-d');
        if (Auth::user()->rol == 'default') {
            return view('users.profile', compact('date'));
        }
        return view('admin.profile', compact('date'));
    }
}
