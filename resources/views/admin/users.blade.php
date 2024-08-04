@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop

@section('content')

    <x-paneltitle titleName="Usuarios"></x-paneltitle>

    <form action="{{ route('admin.users') }}" method="GET">

        <div class="row align-items-end mb-3">

            <div class="col-12 col-md-11">
                <label class="form-label mt-2" for="search">Buscar</label>
                <input type="text" class="form-control" name="search" placeholder="Buscar por nombre, correo, telefono o cedula..." value="{{ (isset($request->search) && !empty($request->search)) ? $request->search : '' }}">
            </div>

            <div class="col-12 col-md-1 text-right">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>

        </div>

    </form>

    @if($users->isNotEmpty())

            <div class="container-fluid table-responsive">
                <table id="users_table" class="table text-center">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Cédula</th>
                            <th>Saldo billetera</th>
                            <th>Saldo por aprobar</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody id="users_plans_table_content">

                        @foreach ($users as $user)

                            <tr>
                                <td class="align-middle">{{ $user->name }}</td>
                                <td class="align-middle">{{ $user->email }}</td>
                                <td class="align-middle">{{ $user->phone }}</td>
                                <td class="align-middle">{{ $user->dni }}</td>
                                <td class="align-middle">$ {{ $user->wallet_balance }}</td>
                                <td class="align-middle">$ {{ $user->wallet_balance_to_be_approved }}</td>
                                <td class="align-middle">
                                    <div class="btn btn-primary add-funds-btn" data-id="{{$user->id}}"  data-name="{{$user->name}}">Agregar fondos</div>
                                    <div class="btn btn-primary withdraw-funds-btn" data-id="{{$user->id}}"  data-name="{{$user->name}}">Retirar fondos</div>
                                </td>
                            </tr>

                        @endforeach

                    </tbody>
                </table>
            </div>

  @else

    <div class="my-5 text-center">No hay informacion para mostrar</div>

  @endif

  @include('admin.user-funds-management', ['payment_methods' => $payment_methods])

@stop

@section('js')
    <script type="text/javascript" src="{{ asset('assets/js/clients/user-funds-management.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/funds/dollar-calculation.js') }}"></script>
@endsection
