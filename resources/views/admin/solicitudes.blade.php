@extends('adminlte::page')

@section('title', 'Solicitudes')

@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop

@section('content')
    <x-paneltitle titleName="Solicitudes de Instalacion"></x-paneltitle>

    <form action="{{ route('admin.requests.index') }}" method="GET">

        <div class="input-group">
            <select name="status" class="custom-select" >
                <option value="">Filtrar por status</option>
                @if (isset($statuses))
                    @foreach ($statuses as $status)
                        <option value="{{ $status }}" {{ (isset($request->status) && $request->status == $status) ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                @endif
            </select>
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
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
                            <td class="align-middle">
                                @if(empty($request->zone_name))
                                    No asignado
                                @else
                                    {{ $request->zone_name }}
                                @endif
                            </td>
                            <td class="align-middle">
                                @if(empty($request->ip))
                                    No asignado
                                @else
                                    {{ $request->ip }}
                                @endif
                            </td>
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
