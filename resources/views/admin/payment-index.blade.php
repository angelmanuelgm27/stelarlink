@extends('adminlte::page')

@section('title', 'Pagos')

@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop

@section('content')

    <x-paneltitle titleName="Pagos"></x-paneltitle>

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

