@extends('adminlte::page')

@section('title', 'Actividades')

@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop

@section('content')

    <x-paneltitle titleName="Grupo"></x-paneltitle>

    @if(!empty($group))

        <div class="mb-5">
            <h5>Grupo: {{ $group->name }}</h5>
            <h5>Zona: {{ $group->zone }}</h5>
            <h5>Disponibilidad: {{ $group->availability }}</h5>

            @if(empty($taskable))

                <form method="POST" action="{{ route('technical.support.group.update.availability', ['technicalSupportGroup' => $group]) }}">

                    @method('PUT')

                    @csrf

                    <button type="submit" class="btn btn-primary">Cambiar disponibilidad</button>

                </form>

            @endif

        </div>

    @else

        <h5 class="text-center my-3">No perteneces a ningun grupo.</h5>

    @endif



    <x-paneltitle titleName="Actividad asignada"></x-paneltitle>

    @if (!empty($taskable))

        <div class="row">

            <div class="col-12 col-md-6">

                <h4>{{ $taskable_name }}</h4>
                <h5>Direccion: {{ $taskable->adrress }}</h5>
                <h5>Zona: {{ $taskable->zone_id }}</h5>

                <form method="POST" action="{{ route('technical.support.task.completed', ['task' => $task_id]) }}">
                    @method('PUT')
                    @csrf
                    <button type="submit" class="btn btn-primary">Marcar como completada</button>
                </form>

            </div>

            <div class="col-12 col-md-6">

                @if (!empty($service))

                    <h4>Descripcion del servicio</h4>
                    <h5>Plan: {{ $service->name }}</h5>
                    <h5>Velocidad de subina: {{ $service->velocity_load }} Mb/s</h5>
                    <h5>Velocidad de bajada: {{ $service->velocity_download }} Mb/s</h5>

                @endif

            </div>

        </div>

    @else

        <h5 class="text-center my-3">No tienes ninguna actividad asignada.</h5>

    @endif

@endsection

