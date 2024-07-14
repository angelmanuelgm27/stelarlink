<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Solicitudes;
use Illuminate\Http\Request;

class SolicitudesController extends Controller
{

    public function index()
    {

        $requests = Solicitudes::all();

        return view('admin.solicitudes', ['requests' => $requests]);

    }
}
