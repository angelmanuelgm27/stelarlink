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
                            <th>Zona</th>
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
                                    @if(empty($request->group_id))
                                        No asignado
                                    @else
                                        {{ $request->group_name }}
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
