@extends('adminlte::page')

@section('title', 'Mis planes')

@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop

@section('content')

    @if(Session::has('message'))
        <div class="alert {{ Session::get('alert-class', 'alert-primary') }}" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif

    <x-paneltitle titleName="Mis planes"></x-paneltitle>

    @if($user_requests->isNotEmpty())

        <div class="container-fluid table-responsive">
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>Plan / Servicio</th>
                        <th>Estado</th>
                        <th>Fecha de compra</th>
                        <th>Fecha de instalación</th>
                        <th>Factura</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($user_requests as $user_request)

                        <tr>
                            <td class="align-middle">{{ $user_request->service->name }}</td>
                            <td class="align-middle">{{ $user_request->status }}</td>
                            <td class="align-middle">{{ $user_request->formatted_created_at }}</td>
                            <td class="align-middle">
                                @if($user_request->formatted_instalation_date)
                                    {{ $user_request->formatted_instalation_date }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="align-middle">
                                <a href="{{ route('invoice.show', ['invoice' => $user_request->invoice_id ]) }}">Descargar</a>
                            </td>

                        </tr>

                    @endforeach

                </tbody>
            </table>
        </div>

    @else

        <div class="my-5 text-center">No hay informacion para mostrar</div>

    @endif

    <x-paneltitle titleName="Solicitar un nuevo plan"></x-paneltitle>

    <div class="row mt-4">

        @foreach ($services as $service)

            <div class="col-12 col-md-4 my-2">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="position-relative text-center mb-2 border-dark border-bottom">
                            <img class=" w-50 rounded-circle cursor-pointer" id="service_image_icon"
                                src="{{ asset('images/services/' . $service['image'] ) }} ">
                        </div>
                        <h5>Nombre Plan: <span class="font-weight-bold">{{ $service['name'] }}</span></h5>
                        <p>Costo: <span class="font-weight-bold">{{ $service['price'] }}$</span></p>
                        <p>Velocidad de carga: <span class="font-weight-bold">{{ $service['velocity_load'] }} Mbps</span></p>
                        <p>Velocidad de descarga: <span class="font-weight-bold">{{ $service['velocity_download'] }} Mbps</span></p>
                        <div class="text-center">
                            <button type="button" data-id="{{ $service['id'] }}" data-name="{{ $service['name'] }}" data-price="{{ $service['price'] }}" class="btn btn-primary plan-shop-btn">Comprar</button>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach

    </div>

    @include('users.create-request', ['address' => $address])

@stop

@section('js')
    <script type="text/javascript" src="{{ asset('assets/js/requests/user-create.js') }}"></script>
@endsection
