<template id="installer-payment-create-popup">

    <swal-html>

        <p>Usuaio instalador: <span id="name"></span></p>
        <p>Monto: $<span id="amount"></span></p>

        <form method="POST" action="" id="form-installer-payment-create" enctype="multipart/form-data">

            @method('PUT')
            @csrf

            <label class="form-label">Comprobante de pago</label>
            <div class="position-relative my-2">
                <input type="file" name="image" id="image" class="custom-file-input" lang="es" required>
                <label class="custom-file-label" for="image">Imagen</label>
            </div>

            <button type="submit" class="btn btn-primary">Notificar</button>

        </form>

    </swal-html>

</template>
