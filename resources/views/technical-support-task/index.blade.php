@extends('adminlte::page')

@section('title', 'Actividades')

@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop

@section('content')

    <x-paneltitle titleName="Grupo"></x-paneltitle>

    @if(!empty($group))

        <div class="row mb-5">

            <div class="col-12 col-md-6">

                <div class="h5 font-weight-bold">Detalles del grupo</div>

                <h5>Grupo: {{ $group->name }}</h5>
                <h5>Zona: {{ $group->zone_name }}</h5>
                <h5>Disponibilidad: {{ $group->availability }}</h5>

                @if(empty($taskable))

                    <form method="POST" action="{{ route('technical.support.group.update.availability', ['technical_support_group' => $group]) }}">

                        @method('PUT')

                        @csrf

                        <button type="submit" class="btn btn-primary">Cambiar disponibilidad</button>

                    </form>

                @endif

            </div>

            <div class="col-12 col-md-6">

                <div class="h5 font-weight-bold">Integrantes del grupo</div>

                @foreach ($group_users as $group_user)
                    <div>{{ $group_user->name }}</div>
                @endforeach

            </div>



        </div>

    @else

        <h5 class="text-center my-3">No perteneces a ningun grupo.</h5>

    @endif

    <x-paneltitle titleName="Actividad asignada"></x-paneltitle>

    @if (!empty($taskable))

        <div class="row mb-5">

            <div class="col-12 col-md-6">

                <div class="h5 font-weight-bold">{{ $taskable_name }}</div>
                <h5>Direccion: {{ $taskable->adrress }}</h5>
                <h5>Telefono: {{ $phone }}</h5>

                <form
                    method="POST"
                    action="{{ route('technical.support.task.completed', ['task' => $task_id]) }}"
                    enctype="multipart/form-data"
                >

                    @method('PUT')
                    @csrf

                    <label class="form-label">Imágenes de la instalación</label>
                    <div class="position-relative my-2">
                        <input type="file" name="files[]" id="files" class="custom-file-input" lang="es" multiple required>
                        <label class="custom-file-label" for="files">Archivos</label>
                    </div>

                    <button type="submit" class="btn btn-primary">Marcar como completada</button>

                </form>

            </div>

            <div class="col-12 col-md-6">

                @if (!empty($service))

                    <div class="h5 font-weight-bold">Descripcion del servicio</div>
                    <h5>Plan: {{ $service->name }}</h5>
                    <h5>Velocidad de subida: {{ $service->velocity_load }} Mb/s</h5>
                    <h5>Velocidad de bajada: {{ $service->velocity_download }} Mb/s</h5>

                @endif

            </div>

        </div>

    @else

        <h5 class="text-center my-3">No tienes ninguna actividad asignada.</h5>

    @endif

@endsection
