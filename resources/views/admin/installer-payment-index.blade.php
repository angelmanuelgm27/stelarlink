@extends('adminlte::page')

@section('title', 'Actividades completadas')

@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop

@section('content')

    @if(Session::has('message'))
        <div class="alert {{ Session::get('alert-class', 'alert-primary') }}" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif

    <x-paneltitle titleName="Actividades completadas"></x-paneltitle>

    <form action="{{ route('admin.requests.index') }}" method="GET">

        <div class="input-group">

            <div class="input-group-prepend">
                 <span class="input-group-text">Fecha inicio</span>
            </div>
            <input type="date" class="form-control" name="">
            <div class="input-group-prepend">
                 <span class="input-group-text">Fecha final</span>
            </div>
            <input type="date" class="form-control" name="">

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
                        <th>Instalador</th>
                        <th>Tipo</th>
                        <th>Fecha</th>
                        <th>Monto</th>
                        <th>Pagado</th>
                        <th>Comprobante</th>
                    </tr>
                </thead>
                <tbody id="users_plans_table_content">

                    @foreach ($finisheds as $finished)

                        <tr>
                            <td class="align-middle">{{ $finished->user->name }}</td>
                            <td class="align-middle">{{ $finished->finishedable_name }}</td>
                            <td class="align-middle">{{ $finished->formatted_created_at }}</td>
                            <td class="align-middle">$ {{ $finished->payment_amount }}</td>
                            <td class="align-middle">
                                @if($finished->paid == 'Pagar')
                                    <button class="btn btn-primary installer-payment-popup-trigger" data-id="{{ $finished->id}}" data-name="{{ $finished->user->name }}" data-amount="{{ $finished->payment_amount }}">
                                        Pagar
                                    </button>
                                @else
                                    {{ $finished->formatted_paid }}
                                @endif
                            </td>
                            <td class="align-middle">
                                @if(isset($finished->file) && !empty($finished->file) && isset($finished->file->id) && !empty($finished->file->id))
                                    <a href="{{ route('file.show', ['file' => $finished->file->id ]) }}">Descargar</a>
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

    @include('admin.installer-payment-create')

@stop

@section('js')
    <script type="text/javascript" src="{{ asset('assets/js/installer-payment/create-popup.js') }}"></script>
@endsection
