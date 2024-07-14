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
                            <th>id_cliente</th>
                            <th>id_service</th>
                            <th>status</th>
                            <th>ip</th>
                            <th>id_group</th>
                        </tr>
                    </thead>
                    <tbody id="users_plans_table_content">

                        @php
                        $index = 1;
                        @endphp

                        @foreach ($requests as $request)

                            <tr>
                                <td class="align-middle">{{ $index }}</td>
                                <td class="align-middle">{{ $request->id_cliente }}</td>
                                <td class="align-middle">{{ $request->id_service }}</td>
                                <td class="align-middle">{{ $request->status }}</td>
                                <td class="align-middle">{{ $request->ip }}</td>
                                <td class="align-middle">{{ $request->id_group }}</td>
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
