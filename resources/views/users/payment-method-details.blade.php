<template id="payment-method-data-popup">

    <swal-html>

        <div class="row my-3">

            <div class="col-12 col-md-3 p-2">
                <img src="" class="img-fluid" id="payment-method-img">
            </div>

            <div class="col-12 col-md-9 p-2 text-left" id="payment-method-details"></div>

        </div>

        <div class="h4 font-weight-bold">Datos del pago</div>

        <form
            method="POST"
            action="{{ route('payment.store') }}"
            enctype="multipart/form-data"
        >

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

                    <label class="form-label">Comprobante del pago</label>
                    <div class="position-relative">
                        <input type="file" name="image" id="image" class="custom-file-input" lang="es" required>
                        <label class="custom-file-label" for="image">Archivo</label>
                    </div>

                </div>

            </div>

            <input type="hidden" name="payment_method_id" id="payment-method-id">

            <button type="submit" class="btn btn-primary">Notificar pago</button>

        </form>

    </swal-html>

</template>
