@extends('adminlte::page')

@section('title', 'Metodos de pago')

@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop

@section('content')

    @if(Session::has('message'))
        <div class="alert {{ Session::get('alert-class', 'alert-primary') }}" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif

    <x-paneltitle titleName="Agregar metodo de pago"></x-paneltitle>

    <form method="POST" action="{{ route('admin.payment.methods.store') }}" enctype="multipart/form-data">

        @csrf

        <label for="name" class="form-label">Nombre del metodo de pago</label>
        <input type="text" id="name" name="name" class="form-control" required>

        <label for="details" class="form-label">Detalles</label>
        <textarea name="details" id="details" class="form-control"></textarea>

        <label class="form-label">Metodo de pago</label>
        <div class="position-relative my-2">
            <input type="file" name="image" id="image" class="custom-file-input" lang="es" required>
            <label class="custom-file-label" for="image">Archivos</label>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary mb-5">Crear metodo de pago</button>
        </div>

    </form>


    <x-paneltitle titleName="Metodos de pago"></x-paneltitle>

    @if(!empty($payment_methods))

        @foreach ($payment_methods as $payment_method)

            <div class="row my-3">
                <div class="col-12 col-md-3 p-2">
                    <img src="/storage/{{ $payment_method->image }}" class="img-fluid">
                </div>
                <div class="col-12 col-md-6 p-2">
                    <div class="h6 font-weight-bold">
                        {{ $payment_method->name }}
                    </div>
                    <div>
                        Estado: {{ $payment_method->available ? 'Habilitado' : 'No habilitado' }}
                    </div>
                    <div>
                        {!! nl2br(e($payment_method->details)) !!}
                    </div>
                </div>
                <div class="col-12 col-md-3 p-2">

                    <form
                        method="POST"
                        action="{{ route('admin.payment.methods.destroy', ['payment_method' => $payment_method->id]) }}"
                    >

                        @method('DELETE')
                        @csrf

                        <div class="text-right my-2">
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                        </div>

                    </form>

                    <form
                        method="POST"
                        action="{{ route('admin.payment.methods.availability', ['payment_method' => $payment_method->id]) }}"
                    >

                        @method('PUT')
                        @csrf

                        <div class="text-right my-2">
                            <button type="submit" class="btn btn-info"><i class="fas fa-eye"></i></button>
                        </div>

                    </form>

                </div>
            </div>
        @endforeach


    @else

        <h5 class="text-center my-5">No hay informacion para mostrar.</h5>

    @endif

@stop

@section('js')
    <script></script>
@endsection
