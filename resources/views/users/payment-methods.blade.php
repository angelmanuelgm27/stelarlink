@extends('adminlte::page')

@section('title', 'Metodos de pago')

@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop

@section('content')

    <x-paneltitle titleName="Metodos de pago"></x-paneltitle>

    @if(!empty($payment_methods))

        <div class="row my-3">

            @foreach ($payment_methods as $payment_method)

                <div class="show-payment-method-detail-btn col-12 col-md-3 p-5" data-id="{{ $payment_method->id }}">
                    <img src="/storage/{{ $payment_method->image }}" class="img-fluid">
                </div>

            @endforeach

        </div>

    @else

        <h5 class="text-center my-5">No hay metodos de pago disponibles.</h5>

    @endif

    @include('users.payment-method-details')

@stop


@section('js')
    <script type="text/javascript" src="{{ asset('assets/js/funds/show-payment-methods.js') }}"></script>
@endsection
