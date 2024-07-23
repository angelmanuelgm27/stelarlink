@extends('adminlte::page')

@section('title', 'Personal')

@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop

@section('content')

    <x-paneltitle titleName="Actividades completadas"></x-paneltitle>

    <form action="{{ route('admin.requests.index') }}" method="GET">

        <div class="input-group">

            <div class="input-group-prepend">
                 <span class="input-group-text">Tipo</span>
            </div>
            <select name="type" class="custom-select" >
                <option value="">Seleccionar...</option>

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

    @if($finisheds->isNotEmpty())

        <div class="container-fluid table-responsive">
            <table id="users_table" class="table text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tipo</th>
                        <th>Fecha</th>
                        <th>Monto</th>
                        <th>Pagado</th>
                    </tr>
                </thead>
                <tbody id="users_plans_table_content">

                    @php
                    $index = 1;
                    @endphp

                    @foreach ($finisheds as $finished)

                        <tr>
                            <td class="align-middle">{{ $index }}</td>
                            <td class="align-middle">{{ $finished->finishedable_name }}</td>
                            <td class="align-middle">{{ $finished->finishedable->formatted_created_at }}</td>
                            <td class="align-middle">{{ $finished->amount }}</td>
                            <td class="align-middle">{{ $finished->paid }}</td>
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

@section('js')
    <script></script>
@endsection
