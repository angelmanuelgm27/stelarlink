<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Service;
use App\Models\TechnicalSupportGroup;
use App\Models\Zone;
use App\Traits\RequestTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class PlanController extends Controller
{

    use RequestTrait;

    public function index(Request $request)
    {

        if (! (Gate::allows('administrador') || Gate::allows('soporte-tecnico-administrador'))) {
            abort(403);
        }

        $plans = Plan::leftJoin('services', 'service_id', '=', 'services.id')
            ->leftJoin('users', 'user_id', '=', 'users.id')
            ->leftJoin('zones', 'zone_id', '=', 'zones.id')
            ->leftJoin('technical_support_groups', 'technical_support_group_id', '=', 'technical_support_groups.id')
            ->select(
                'plans.*',
                'services.name as service_name',
                'users.name as user_name',
                'zones.name as zone_name',
                'technical_support_groups.name as group_name',
            );

        if ($request->has('status') && !empty($request->status)) {
            $plans = $plans->where('plans.status', $request->status);
        }

        if ($request->has('zone_id') && !empty($request->zone_id)) {
            $plans = $plans->where('plans.zone_id', $request->zone_id);
        }

        if ($request->has('service_id') && !empty($request->service_id)) {
            $plans = $plans->where('plans.service_id', $request->service_id);
        }

        if ($request->has('start_date') && !empty($request->start_date)) {
            $plans = $plans->whereDate('plans.created_at', '>=', $request->start_date);
        }

        if ($request->has('end_date') && !empty($request->end_date)) {
            $plans = $plans->whereDate('plans.created_at', '<=', $request->end_date);
        }

        $plans = $plans->paginate(20);

        $plans->each(function ($service_request) {

            if(!$service_request->zone_name){
                $service_request->zone_name = 'No asignado';
            }

            if(!$service_request->ip){
                $service_request->ip = 'No asignado';
            }

        });

        $zones = Zone::select('id', 'name')->get();

        $services = Service::select('id', 'name')->get();

        $data = [
            'zones' => $zones,
            'services' => $services,
            'plans' => $plans,
            'statuses' => Plan::$statuses,
            'request' => $request,
        ];

        return view('admin.plan', $data);

    }

    public function show(string $id)
    {

        if (! (Gate::allows('administrador') || Gate::allows('soporte-tecnico-administrador'))) {
            abort(403);
        }

        $plan_data = Plan::where('plans.id', $id)
            ->leftJoin('services', 'service_id', '=', 'services.id')
            ->leftJoin('users', 'user_id', '=', 'users.id')
            ->leftJoin('technical_support_groups', 'technical_support_group_id', '=', 'technical_support_groups.id')
            ->select(
                'plans.*',
                'services.name as service_name',
                'users.name as user_name',
                'technical_support_groups.name as group_name',
            )
            ->first();

        $date = Carbon::createFromFormat('Y-m-d H:i:s', $plan_data->created_at);
        Carbon::setLocale('es');
        $formatted_created_at = $date->isoFormat('D \d\e MMMM, YYYY');

        $plan_data->formatted_created_at = $formatted_created_at;

        $plan_data->instalation_files = $plan_data
            ->files()
            ->select('id', 'name')
            ->get();

        return response()->json($plan_data);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plan $plan): RedirectResponse
    {

        if (! (Gate::allows('administrador') || Gate::allows('soporte-tecnico-administrador'))) {
            abort(403);
        }

        $validated = $request->validate([
            'ip' => ['nullable', 'string', 'max:255'],
            'zone_id' => ['nullable', 'integer'],
            'group_id' => ['nullable', 'string'],
        ]);

        $plan->update($validated);

        if($plan->status == 'Pendiente'){
            $this->asign($plan);
        }

        if($plan->status == 'Pendiente'){
            $plan->update(['status' => 'Aprobado']);
        }

        Session::flash('message', 'Plan actualizado correctamente');
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.requests.index');

    }

    /**
     *
     */
    public function reject(Plan $plan): RedirectResponse
    {

        if (! (Gate::allows('administrador') || Gate::allows('soporte-tecnico-administrador'))) {
            abort(403);
        }

        // check plan status ***

        $plan->update(['status' => 'Rechazado']);

        Session::flash('message', 'Solicitud rechazada');
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.requests.index');

    }

    /**
     *
     */
    public function suspend(Plan $plan): RedirectResponse
    {

        if (! (Gate::allows('administrador') || Gate::allows('soporte-tecnico-administrador'))) {
            abort(403);
        }

        // check plan status ***

        $plan->update(['status' => 'Suspendido']);

        Session::flash('message', 'Plan suspendido.');
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.requests.index');

    }

    /**
     *
     */
    public function activate(Plan $plan): RedirectResponse
    {

        if (! (Gate::allows('administrador') || Gate::allows('soporte-tecnico-administrador'))) {
            abort(403);
        }

        // check plan status ***

        $plan->update([
            'status' => 'Activo',
            'renovation_date' => Carbon::now()->addMonthsNoOverflow(1),
        ]);

        Session::flash('message', 'Plan activo');
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.requests.index');

    }

}
