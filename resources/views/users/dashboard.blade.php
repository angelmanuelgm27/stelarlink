@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop

@section('content')
    <x-paneltitle titleName="Inicio"></x-paneltitle>
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="small-box bg-adminlte-primary rounded-lg">
                <div class="inner p-4">
                    <h4 class="text-white m-0">Saldo a favor</h4>
                    <h2 class="text-adminlte-success font-weight-bold m-0">150</h2>
                    <h5 class="text-adminlte-primary m-0">0.00</h5>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="small-box bg-adminlte-primary rounded-lg">
                <div class="inner p-4">
                    <h4 class="text-white m-0">Saldo por aprobar</h4>
                    <h2 class="text-adminlte-info font-weight-bold m-0">00</h2>
                    <h5 class="text-adminlte-primary m-0">0.00</h5>
                </div>
              
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="small-box bg-adminlte-primary rounded-lg">
                <div class="inner p-4">
                    <h4 class="text-white m-0">Deuda total</h4>
                    <h2 class="text-adminlte-danger font-weight-bold m-0">00</h2>
                    <h5 class="text-adminlte-primary m-0">0.00</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <img src="{{ asset('images/panel/dashboard.jpg') }}" class="w-100" alt="{{ config('app.name') }}">
        </div>
    </div>
@stop
