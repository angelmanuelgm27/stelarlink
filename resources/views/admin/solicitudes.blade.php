@extends('adminlte::page')

@section('title', 'Solicitudes')

@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop

@section('content')
    <x-paneltitle titleName="Solicitudes de Instalacion"></x-paneltitle>

    <form action="{{ route('admin.requests.index') }}" method="GET">

        <div class="input-group">

            <div class="input-group-prepend">
                 <span class="input-group-text">Status</span>
            </div>
            <select name="status" class="custom-select" >
                <option value="">Seleccionar...</option>
                @if (isset($statuses))
                    @foreach ($statuses as $status)
                        <option value="{{ $status }}" {{ (isset($request->status) && $request->status == $status) ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                @endif
            </select>

            <div class="input-group-prepend">
                 <span class="input-group-text">Plan</span>
            </div>
            <select name="service" class="custom-select" >
                <option value="">Seleccionar...</option>
                @if (isset($statuses))
                    @foreach ($statuses as $status)
                        <option value="{{ $status }}" {{ (isset($request->status) && $request->status == $status) ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                @endif
            </select>

            <div class="input-group-prepend">
                 <span class="input-group-text">Zona</span>
            </div>
            <select name="zone" class="custom-select" >
                <option value="">Seleccionar...</option>
                @if (isset($statuses))
                    @foreach ($statuses as $status)
                        <option value="{{ $status }}" {{ (isset($request->status) && $request->status == $status) ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                @endif
            </select>

            <div class="input-group-prepend">
                 <span class="input-group-text">Fecha inicio</span>
            </div>
            <input type="date" class="form-control" name="">
            <div class="input-group-prepend">
                 <span class="input-group-text">Fecha final</span>
            </div>
            <input type="date" class="form-control" name="">
            <div class="input-group-append">

            </div>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </div>

    </form>

    @if($service_requests->isNotEmpty())

        <div class="container-fluid table-responsive">
            <table id="users_table" class="table text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Plan</th>
                        <th>status</th>
                        <th>Zona</th>
                        <th>ip</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="users_plans_table_content">

                    @php
                    $index = 1;
                    @endphp

                    @foreach ($service_requests as $request)

                        <tr>
                            <td class="align-middle">{{ $index }}</td>
                            <td class="align-middle">{{ $request->user_name }}</td>
                            <td class="align-middle">{{ $request->service_name }}</td>
                            <td class="align-middle">{{ $request->status }}</td>
                            <td class="align-middle">{{ $request->zone_name }}</td>
                            <td class="align-middle">{{ $request->ip }}</td>
                            <td class="align-middle">
                                <button class="btn btn-primary view-details" data-id="{{ $request->id }}">Detalles</button>
                            </td>
                        </tr>

                    @php
                    $index++;
                    @endphp

                    @endforeach

                </tbody>
            </table>

        </div>

    @else

        <div class="my-5 text-center">No hay informacion para mostrar</div>

    @endif

    @include('admin.edit-request', ['statuses' => $statuses, 'zones' => $zones])

@stop

@section('js')
    <script type="text/javascript" src="{{ asset('assets/js/requests/view-details.js') }}"></script>
@endsection
