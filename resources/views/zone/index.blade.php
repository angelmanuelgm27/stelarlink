@extends('adminlte::page')

@section('title', 'Grupos')

@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop

@section('content')

    <x-paneltitle titleName="Crear nueva zona"></x-paneltitle>

    <form method="POST" action="{{ route('zone.store') }}" >

        @csrf

        <div class="row">
            <div class="col-12 col-md-6">
                <label for="name" class="form-label">Nombre de la zona</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="col-12 col-md-6">
                <label for="description" class="form-label">Descripción</label>
                <input type="text" id="description" name="description" class="form-control" required>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary my-5">Crear Zona</button>
        </div>

    </form>

    <x-paneltitle titleName="Zonas"></x-paneltitle>

    @if($zones->isNotEmpty())

            <div class="container-fluid table-responsive">
                <table id="users_table" class="table text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="users_plans_table_content">

                        @php
                        $index = 1;
                        @endphp

                        @foreach ($zones as $zone)

                            <tr>
                                <td class="align-middle">{{ $index }}</td>
                                <td class="align-middle">{{ $zone->name }}</td>
                                <td class="align-middle">{{ $zone->description }}</td>
                                <td class="align-middle">

                                    <form
                                    method="POST"
                                    action="{{ route('zone.destroy', ['zone' => $zone]) }}"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-primary">Eliminar</button>
                                    </form>

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

@stop
