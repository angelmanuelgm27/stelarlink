@extends('adminlte::page')

@section('title', 'Plan')

@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop

@section('content')
    <x-paneltitle titleName="Plan de Instalacion"></x-paneltitle>

    <form action="{{ route('admin.requests.index') }}" method="GET">

        <div class="row">
            <div class="col-12 col-md-4">
                <label class="form-label mt-2" for="status">Status</label>
                <select name="status" id="status" class="custom-select" >
                    <option value="">Seleccionar...</option>
                    @if (isset($statuses))
                        @foreach ($statuses as $status)
                            <option value="{{ $status }}" {{ (isset($request->status) && $request->status == $status) ? 'selected' : '' }}>{{ $status }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="col-12 col-md-4">
                <label class="form-label mt-2" for="service_id">Servicio</label>
                <select name="service_id" id="service_id" class="custom-select" >
                    <option value="">Seleccionar...</option>
                    @if (isset($services))
                        @foreach ($services as $service)
                            <option value="{{ $service->id }}" {{ (isset($request->service_id) && $request->service_id == $service->id) ? 'selected' : '' }}>{{ $service->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="col-12 col-md-4">
                <label class="form-label mt-2" for="zone_id">Zona</label>
                <select name="zone_id"  id="zone_id" class="custom-select" >
                    <option value="">Seleccionar...</option>
                    @if (isset($zones))
                        @foreach ($zones as $zone)
                            <option value="{{ $zone->id }}" {{ (isset($request->zone_id) && $request->zone_id == $zone->id) ? 'selected' : '' }}>{{ $zone->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-6">
                <label class="form-label mt-2" for="start-date">Fecha inicio</label>
                <input type="date" class="form-control" id="start-date" name="start_date" value="{{ (isset($request->start_date) && !empty($request->start_date)) ? $request->start_date : '' }}">
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label mt-2" for="end-date">Fecha final</label>
                <input type="date" class="form-control" id="end-date" name="end_date" value="{{ (isset($request->end_date) && !empty($request->end_date)) ? $request->end_date : '' }}">
            </div>
        </div>

        <div class="text-right my-3">
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </div>

    </form>

    @if($plans->isNotEmpty())

        <div class="container-fluid table-responsive">
            <table id="users_table" class="table text-center">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Plan</th>
                        <th>Estado</th>
                        <th>Grupo</th>
                        <th>Zona</th>
                        <th>ip</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="users_plans_table_content">

                    @foreach ($plans as $plan)

                        <tr>
                            <td class="align-middle">{{ $plan->user_name }}</td>
                            <td class="align-middle">{{ $plan->service_name }}</td>
                            <td class="align-middle">{{ $plan->status }}</td>
                            <td class="align-middle">
                                @if($plan->group_name)
                                    {{ $plan->group_name }}
                                @else
                                    No asignado
                                @endif
                            </td>
                            <td class="align-middle">{{ $plan->zone_name }}</td>
                            <td class="align-middle">{{ $plan->ip }}</td>
                            <td class="align-middle">
                                <button class="btn btn-primary view-details" data-id="{{ $plan->id }}">Detalles</button>
                            </td>
                        </tr>

                    @endforeach

                </tbody>
            </table>

        </div>

        {{$plans->links()}}

    @else

        <div class="my-5 text-center">No hay informacion para mostrar</div>

    @endif

    @include('admin.edit-request', ['statuses' => $statuses, 'zones' => $zones])

@stop

@section('js')
    <script type="text/javascript" src="{{ asset('assets/js/requests/view-details.js') }}"></script>
@endsection
