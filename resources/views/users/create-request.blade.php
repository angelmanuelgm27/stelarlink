<template id="request-data-popup">

    <swal-html>

        <form method="POST" action="/cliente/plan/compra" id="form-create-request">

            @csrf

            <div class="my-2 text-left">
                <span class="font-weight-bold">Plan:</span> <span id="plan-name"></span>
            </div>

            <div class="my-2 text-left">
                <span class="font-weight-bold">Precio:</span> $ <span id="plan-price"></span> mensual
            </div>

            <div class="my-2 text-left">
                <label class="form-label" for="address">Dirección de la instalación:</label>
                <textarea class="form-control" name="address" id="address" required>{{ $address }}</textarea>
            </div>

            <div class="my-2 text-left">
                <label class="form-label" for="address">Ubicación en el mapa para la instalación:</label>
                <div id="map" style="height: 250px;"></div>
            </div>

            <input type="hidden" name="plan_id" id="plan-id" required>
            <input type="hidden" name="latitude" id="latitude" required>
            <input type="hidden" name="longitude" id="longitude" required>

            <button type="submit" class="btn btn-primary">Enviar</button>

        </form>

    </swal-html>

</template>
