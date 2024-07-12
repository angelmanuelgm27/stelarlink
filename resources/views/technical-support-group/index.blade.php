@extends('adminlte::page')

@section('title', 'Mis planes')

@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop

@section('content')
    <x-paneltitle titleName="Mis planes"></x-paneltitle>

    @if($groups->isNotEmpty())

            <div class="container-fluid table-responsive">
                <table id="users_table" class="table text-center">
                    <thead>
                        <<!-- tr>
                            <th>#</th>
                            <th>Plan / Servicio</th>
                            <th>Estado</th>
                            <th>Velocidad de carga</th>
                            <th>Velocidad de bajada</th>
                            <th>Fecha de compra</th>
                            <th>Fecha de Activacion</th>
                            <th>Fecha de Vencimiento</th>
                        </tr> -->
                    </thead>
                    <tbody id="users_plans_table_content">

                        @php
                        $index = 1;
                        @endphp

                        @foreach ($groups as $group)
<!--
                            <tr>
                                <td class="align-middle">{{ $index }}</td>
                                <td class="align-middle">{{ $group->name }}</td>
                                <td class="align-middle">{{ $group->status }}</td>
                                <td class="align-middle">{{ $group->velocity_load }}</td>
                                <td class="align-middle">{{ $group->velocity_download }}</td>
                                <td class="align-middle">{{ $group->formatted_created_at }}</td>
                                <td class="align-middle">{{ $group->date_active }}</td>
                                <td class="align-middle">{{ $group->date_finish }}</td>

                            </tr>
 -->
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

    <x-paneltitle titleName="Comprar nuevos planes"></x-paneltitle>
    <div class="row mt-4" id="services_list">
    </div>
@stop

