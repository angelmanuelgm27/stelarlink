@extends('adminlte::page')

@section('title', 'Notificaciones')

@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop

@section('content')

    <x-paneltitle titleName="Notificaciones"></x-paneltitle>

    @if(!empty($notifications))

        <div class="container-fluid table-responsive">
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Tipo</th>
                        <th>Descripcion</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($notifications as $notification)

                        <tr>
                            <td class="align-middle">{{ $notification->formatted_created_at }}</td>
                            <td class="align-middle">{{ $notification->type_label }}</td>
                            <td class="text-left">{!! $notification->description !!}</td>
                            <td class="align-middle">
                                @if($notification->read_at == null)
                                    <form method="POST"
                                    action="{{ route('notificacion.visto', ['notification' => $notification->id]) }}"
                                    >
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-primary">ver</button>
                                    </form>
                                @else
                                    <a href="{{route($notification->route, $notification->params)}}" class="btn btn-primary">Ver</a>
                                @endif
                            </td>


                            <td class="align-middle">
                                    <form method="POST"
                                    action="{{ route('notificacion.borrar', ['notification' => $notification->id]) }}"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Borrar</button>
                                    </form>
                            </td>

                        </tr>

                    @endforeach

                </tbody>
            </table>
        </div>

    @else

        <div class="my-5 text-center">No hay informacion para mostrar</div>

    @endif


@stop
