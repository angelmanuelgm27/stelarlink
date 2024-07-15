@extends('adminlte::page')

@section('title', 'Solicitudes')

@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop

@section('content')
    <x-paneltitle titleName="Solicitudes de Instalacion"></x-paneltitle>

    @if($requests->isNotEmpty())

            <div class="container-fluid table-responsive">
                <table id="users_table" class="table text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Cliente</th>
                            <th>Plan</th>
                            <th>status</th>
                            <th>ip</th>
                            <th>Grupo instalador</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="users_plans_table_content">

                        @php
                        $index = 1;
                        @endphp

                        @foreach ($requests as $request)

                            <tr>
                                <td class="align-middle">{{ $index }}</td>
                                <td class="align-middle">{{ $request->user_name }}</td>
                                <td class="align-middle">{{ $request->service_name }}</td>
                                <td class="align-middle">{{ $request->status }}</td>
                                <td class="align-middle">
                                    @if(empty($request->ip))
                                        No asignado
                                    @else
                                        {{ $request->ip }}
                                    @endif
                                </td>
                                <td class="align-middle">
                                    @if(empty($request->group_id))
                                        No asignado
                                    @else
                                        {{ $request->group_id }}
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

<template id="request-data-popup">
    <swal-html>
        <h3>Detalles de la solicitud</h3>
        <div class="text-left">
            <div class="mb-1"><span class="font-weight-bold">Cliente:</span> <span id="user_name"></span></div>
            <div class="mb-1"><span class="font-weight-bold">Plan:</span> <span id="service_name"></span></div>
            <div class="mb-1"><span class="font-weight-bold">Creacion:</span> <span id="created_at"></span></div>
            <div class="mb-1"><span class="font-weight-bold">Direccion:</span> <span id="adrress"></span></div>
            <div class="mb-1"><span class="font-weight-bold">Estado:</span> <span id="status"></span></div>
            <div class="mb-1"><span class="font-weight-bold">IP:</span> <span id="ip"></span></div>
            <div class="mb-1"><span class="font-weight-bold">Zona:</span> <span id="zone"></span></div>
            <div class="mb-1"><span class="font-weight-bold">Grupo:</span> <span id="group_name"></span></div>
        </div>

    </swal-html>
</template>

@stop

@section('js')
    <script type="text/javascript" src="{{ asset('assets/js/requests/view-details.js') }}"></script>
@endsection
