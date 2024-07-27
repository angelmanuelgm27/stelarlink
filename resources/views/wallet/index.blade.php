@extends('adminlte::page')

@section('title', 'Billetera')

@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop

@section('content')

    <x-paneltitle titleName="Billetera"></x-paneltitle>

    <div class="row">

        <div class="col-12 col-md-4">
            <div class="small-box bg-light rounded-lg">
                <div class="inner p-4">
                    <h4 class="m-0">Saldo a favor</h4>
                    <h2 class="text-adminlte-success font-weight-bold m-0">{{ $wallet_balance }}</h2>
                    <h5 class="text-adminlte-primary m-0">0.00</h5>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="small-box bg-light rounded-lg">
                <div class="inner p-4">
                    <h4 class="m-0">Saldo por aprobar</h4>
                    <h2 class="text-adminlte-info font-weight-bold m-0">{{ $wallet_balance_to_be_approved }}</h2>
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

    <a href="{{ route('funds.index') }}" class="btn btn-primary">Agregar fondos a la billetera</a>


@stop
