<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Solicitudes;
use Illuminate\Http\Request;

class SolicitudesController extends Controller
{

    public function index()
    {

        $requests = Solicitudes::join('services', 'id_service', '=', 'services.id')
            ->join('users', 'id_cliente', '=', 'users.id')
            ->select(
                'solicitudes.*',
                'services.name as service_name',
                'users.name as user_name'
            )
            ->get();

        return view('admin.solicitudes', ['requests' => $requests]);

    }

    public function show(string $id)
    {

        $request_data = Solicitudes::where('solicitudes.id', $id)
            ->leftJoin('services', 'id_service', '=', 'services.id')
            ->leftJoin('users', 'id_cliente', '=', 'users.id')
            ->leftJoin('technical_support_groups', 'group_id', '=', 'technical_support_groups.id')
            ->select(
                'solicitudes.*',
                'services.name as service_name',
                'users.name as user_name',
                'technical_support_groups.name as group_name'
            )
            ->get();

        return response()->json(['success' => true, 'solicitud' => $request_data]);

    }

}
