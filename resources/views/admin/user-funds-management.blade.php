<template id="user-funds-management-popup">

    <swal-html>

        <form method="POST" action="" id="user-funds-management-form">

            @method('PUT')
            @csrf

            <div class="row">

                <div class="col-12 col-md-6">

                    <label class="form-label" for="amount-bs">Monto Bs</label>
                    <input type="number" class="form-control" id="amount-bs" name="amount_bs" step="0.01">

                </div>

                <div class="col-12 col-md-6">

                    <label class="form-label" for="amount-dollar">Monto $</label>
                    <input type="number" class="form-control" id="amount-dollar" name="amount_dollar" step="0.01">
                    <p style="font-size: 12px;">Tasa BCV: <span id="dollar-price" >{{ $dollar_price }}</span> bs/$</p>

                </div>

                <div class="col-12 col-md-6">

                    <label class="form-label" for="reference">Referencia</label>
                    <input type="text" class="form-control" id="reference" name="reference" required>

                </div>

                <div class="col-12 col-md-6">

                    <label class="form-label">Metodo de pago</label>
                    <select class="form-control" name="payment_method_id">
                        <option value="">Seleccionar...</option>
                        @foreach ($payment_methods as $payment_method)
                            <option value="{{$payment_method->id}}">{{$payment_method->name}}</option>
                        @endforeach
                    </select>

                </div>

            </div>

            <button type="submit" class="btn btn-primary my-3">Agregar fondos</button>

        </form>


    </swal-html>

</template>
