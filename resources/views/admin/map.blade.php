@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop

@section('content')
    <x-paneltitle titleName="Añadir nuevo punto de coordenadas"></x-paneltitle>
    <div class="row">
        <div class="col-12 col-md-12">
            <form action="{{ route('admin.map.create') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-2">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="map_name" id="map_name">
                        </div>
                    </div>
                    <div class="col-12 col-md-2">
                        <div class="form-group">
                            <label>Latitud</label>
                            <input type="text" class="form-control" name="map_latitude" id="map_latitude">
                        </div>
                    </div>
                    <div class="col-12 col-md-2">
                        <div class="form-group">
                            <label>Longuitud</label>
                            <input type="text" class="form-control" name="map_longitude" id="map_longitude">
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label>Iframe google maps</label>
                            <input type="text" class="form-control" name="map_iframe" id="map_longitude">
                        </div>
                    </div>
                    <div class="col-12 col-md-3 my-auto">
                        <button type="submit" class="btn btn-primary w-100">Añadir punto de coordenada</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <x-paneltitle titleName="Lista de coordenadas"></x-paneltitle>
    <div class="row">
        <div class="col-12">
            <table class="table" id="map_coords_table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Latitud</th>
                        <th scope="col">Longitud</th>
                        <th scope="col">Iframe url</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($coordinates as $key => $coordinate)
                        <tr>
                            <th><p>{{$key + 1}}</p></th>
                            <td><p>{{$coordinate->name}}</p></td>
                            <td><p>{{$coordinate->latitude}}</p></td>
                            <td><p>{{$coordinate->longitude}}</p></td>
                            <td><p>{{$coordinate->iframe}}</p></td>
                            <td>
                                <a href="{{ route('admin.map.delete', $coordinate->id) }}" class="btn btn-danger">
                                    <div>
                                        <i class="fas fa-trash-alt"></i>
                                    </div>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <x-paneltitle titleName="Mapa de coordenadas actuales"></x-paneltitle>
    <div class="row">
        <div class="col-12 col-md-12">
            <x-map :coords="$coordinates"></x-map>
        </div>
    </div>
@stop

@section('js')
    <script>
        $('#map_coords_table').DataTable({
            select: false,
            pageLength: 4,
        });
    </script>
@endsection
