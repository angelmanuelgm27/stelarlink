@extends('adminlte::page')

@section('title', 'Pagos')

@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop

@section('content')

    @if(Session::has('message'))
        <div class="alert {{ Session::get('alert-class', 'alert-primary') }}" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif

    <x-paneltitle titleName="Pagos"></x-paneltitle>

    <form action="{{ route('admin.payment.index') }}" method="GET">

        <div class="row">
            <div class="col-12 col-md-8">
                <label class="form-label mt-2" for="search">Buscar</label>
                <input type="text" class="form-control" id="search" name="search" placeholder="Buscar por referencia" value="{{ (isset($request->search) && !empty($request->search)) ? $request->search : '' }}">
            </div>
            <div class="col-12 col-md-4">
                <label class="form-label mt-2" for="status">Status</label>
                <select name="status" id="status" class="custom-select" >
                    <option value="">Seleccionar...</option>
                    @if (isset($statuses))
                        @foreach ($statuses as $status)
                            <option value="{{ $status }}" {{ (isset($request->status) && $request->status == $status) ? 'selected' : '' }}>{{ $status }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-6">
                <label class="form-label mt-2" for="start-date">Fecha inicio</label>
                <input type="date" class="form-control" id="start-date" name="start_date" value="{{ (isset($request->start_date) && !empty($request->start_date)) ? $request->start_date : '' }}">
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label mt-2" for="end-date">Fecha final</label>
                <input type="date" class="form-control" id="end-date" name="end_date" value="{{ (isset($request->end_date) && !empty($request->end_date)) ? $request->end_date : '' }}">
            </div>
        </div>

        <div class="text-right my-3">
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </div>

    </form>

    @if($payments->isNotEmpty())

            <div class="container-fluid table-responsive">
                <table id="users_table" class="table text-center">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Metodo</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th>Referencia</th>
                            <th>Precio (Bs./$)</th>
                            <th>Monto (bs)</th>
                            <th>Monto ($)</th>
                            <th>Comprobante</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="users_plans_table_content">

                        @foreach ($payments as $payment)

                            <tr>
                                <td class="align-middle">{{ $payment->user_name }}</td>
                                <td class="align-middle">{{ $payment->payment_method_name }}</td>
                                <td class="align-middle">{{ $payment->status }}</td>
                                <td class="align-middle">{{ $payment->formatted_created_at }}</td>
                                <td class="align-middle">{{ $payment->reference }}</td>
                                <td class="align-middle">Bs./$ {{ $payment->dollar_price }}</td>
                                <td class="align-middle">Bs. {{ $payment->amount_bs }}</td>
                                <td class="align-middle">$ {{ $payment->amount_dollar }}</td>
                                <td class="align-middle">
                                    @if(isset($payment->file) && !empty($payment->file) && isset($payment->file->id) && !empty($payment->file->id))
                                        <a href="{{ route('file.show', ['file' => $payment->file->id ]) }}">Descargar</a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="align-middle">

                                    @if($payment->status == 'Pendiente')

                                        <form
                                        method="POST"
                                        action="{{ route('admin.payment.approve', ['payment' => $payment->id]) }}"
                                        >
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-primary">Aprobar</button>
                                        </form>

                                        <form
                                        method="POST"
                                        action="{{ route('admin.payment.reject', ['payment' => $payment->id]) }}"
                                        >
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-primary">Rechazar</button>
                                        </form>

                                    @else
                                        -
                                    @endif

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

