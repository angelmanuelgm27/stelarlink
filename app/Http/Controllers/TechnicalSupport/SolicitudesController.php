<?php

namespace App\Http\Controllers\TechnicalSupport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SolicitudesController extends Controller
{
    //
    public function index()
    {
        return view('technical.solicitudes');
    }
}
