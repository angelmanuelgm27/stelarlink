<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Solicitudes;
use App\Models\TechnicalSupportGroup;
use App\Models\Zone;
use App\Traits\RequestTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SolicitudesController extends Controller
{

    use RequestTrait;

    public function index(Request $request)
    {

        $service_requests = Solicitudes::leftJoin('services', 'service_id', '=', 'services.id')
            ->leftJoin('users', 'user_id', '=', 'users.id')
            ->leftJoin('zones', 'zone_id', '=', 'zones.id')
            ->select(
                'solicitudes.*',
                'services.name as service_name',
                'users.name as user_name',
                'zones.name as zone_name',
            );

        if ($request->has('status') && !empty($request->status)) {
            $service_requests = $service_requests->where('solicitudes.status', $request->status);
        }

        $service_requests = $service_requests->get();

        $service_requests->each(function ($service_request) {

            if(!$service_request->zone_name){
                $service_request->zone_name = 'No asignado';
            }

            if(!$service_request->ip){
                $service_request->ip = 'No asignado';
            }

        });

        $zones = Zone::all();

        $data = [
            'zones' => $zones,
            'service_requests' => $service_requests,
            'statuses' => Solicitudes::$statuses,
            'request' => $request,
        ];

        return view('admin.solicitudes', $data);

    }

    public function show(string $id)
    {

        $service_request = Solicitudes::where('solicitudes.id', $id)
            ->leftJoin('services', 'service_id', '=', 'services.id')
            ->leftJoin('users', 'user_id', '=', 'users.id')
            ->select(
                'solicitudes.*',
                'services.name as service_name',
                'users.name as user_name',
            )
            ->first();

        $date = Carbon::createFromFormat('Y-m-d H:i:s', $service_request->created_at);
        Carbon::setLocale('es');
        $formatted_created_at = $date->isoFormat('D \d\e MMMM, YYYY');

        $service_request->formatted_created_at = $formatted_created_at;

        $service_request->instalation_files = $service_request
            ->files()
            ->select('id', 'name')
            ->get();

        return response()->json($service_request);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Solicitudes $solicitudes): RedirectResponse
    {

        // if(!(Gate::allows('isEditor') || Gate::allows('isAdmin'))){
        //     abort(403); // use policies ***
        // }

        $validated = $request->validate([
            'ip' => ['nullable', 'string', 'max:255'],
            'zone_id' => ['nullable', 'integer'],
            'group_id' => ['nullable', 'string'],
        ]);

        $solicitudes->update($validated);

        return redirect()->route('admin.requests.index');

    }

    /**
     *
     */
    public function accept(Solicitudes $solicitudes): RedirectResponse
    {

        // if(!(Gate::allows('isEditor') || Gate::allows('isAdmin'))){
        //     abort(403);
        // }

        if(empty($solicitudes->zone_id)){
            return redirect()->back(); // with error ***
        }

        $solicitudes->update(['status' => 'Aprobada']);

        $this->asign($solicitudes);

        return redirect()->back(); // with success ***

    }

    /**
     *
     */
    public function reject(Solicitudes $solicitudes): RedirectResponse
    {

        // if(!(Gate::allows('isEditor') || Gate::allows('isAdmin'))){
        //     abort(403); // use policies ***
        // }

        $solicitudes->update(['status' => 'Rehazada']);

        return redirect()->route('admin.requests.index');

    }

}
