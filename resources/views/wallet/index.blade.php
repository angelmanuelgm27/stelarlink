@extends('adminlte::page')

@section('title', 'Billetera')

@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop

@section('content')

    @if(Session::has('message'))
        <div class="alert {{ Session::get('alert-class', 'alert-primary') }}" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif

    <x-paneltitle titleName="Billetera"></x-paneltitle>

    <div class="row">

        <div class="col-12 col-md-4">
            <div class="small-box bg-light rounded-lg">
                <div class="inner p-4">
                    <h4 class="m-0">Saldo a favor</h4>
                    <h2 class="text-adminlte-success font-weight-bold m-0">$ {{ $wallet_balance }}</h2>
                    <h5 class="text-adminlte-primary m-0">0.00</h5>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="small-box bg-light rounded-lg">
                <div class="inner p-4">
                    <h4 class="m-0">Saldo por aprobar</h4>
                    <h2 class="text-adminlte-info font-weight-bold m-0">$ {{ $wallet_balance_to_be_approved }}</h2>
                    <h5 class="text-adminlte-primary m-0">0.00</h5>
                </div>

            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="small-box bg-light rounded-lg">
                <div class="inner p-4">
                    <h4 class="m-0">Deuda total</h4>
                    <h2 class="text-adminlte-danger font-weight-bold m-0">00</h2>
                    <h5 class="text-adminlte-primary m-0">0.00</h5>
                </div>
            </div>
        </div>

    </div>

    <a href="{{ route('funds.index') }}" class="btn btn-primary my-3">Agregar fondos a la billetera</a>

    <x-paneltitle titleName="Ingresos a la billetera"></x-paneltitle>

    @if($payments->isNotEmpty())

            <div class="container-fluid table-responsive">
                <table id="users_table" class="table text-center">
                    <thead>
                        <tr>
                            <th>Estado</th>
                            <th>Metodo</th>
                            <th>Referencia</th>
                            <th>Fecha</th>
                            <th>Monto</th>
                            <th>Comprobante</th>
                        </tr>
                    </thead>
                    <tbody id="users_plans_table_content">

                        @foreach ($payments as $payment)

                            <tr>
                                <td class="align-middle">{{ $payment->status }}</td>
                                <td class="align-middle">{{ $payment->payment_method_name }}</td>
                                <td class="align-middle">{{ $payment->reference }}</td>
                                <td class="align-middle">{{ $payment->formatted_created_at }}</td>
                                <td class="align-middle">$ {{ $payment->amount_dollar }}</td>
                                <td class="align-middle">
                                    @if(isset($payment->file) && !empty($payment->file) && isset($payment->file->id) && !empty($payment->file->id))
                                        <a href="{{ route('file.show', ['file' => $payment->file->id ]) }}">Descargar</a>
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
