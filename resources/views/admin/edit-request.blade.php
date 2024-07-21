<template id="request-data-popup">

    <swal-html>

        <div class="row">

            <div class="col-12 col-md-6 text-left">

                <div class="mb-1"><span class="font-weight-bold">Cliente:</span> <span id="user_name"></span></div>
                <div class="mb-1"><span class="font-weight-bold">Plan:</span> <span id="service_name"></span></div>
                <div class="mb-1"><span class="font-weight-bold">Creacion:</span> <span id="formatted_created_at"></span></div>
                <div class="mb-1"><span class="font-weight-bold">Direccion:</span> <span id="adrress"></span></div>
                <!-- <div class="mb-1"><span class="font-weight-bold">Grupo:</span> <span id="group_name"></span></div> -->
                <div class="mb-1"><span class="font-weight-bold">Estado:</span> <span id="status"></span></div>
                <div class="mb-1"><span class="font-weight-bold"><a href="" id="invoice">Factura</a></span></div>

                <div class="row">

                    <div class="col-12 col-md-6">

                        <form method="POST" action="" id="form-accept-request" class="text-center d-none">
                            @method('PUT')
                            @csrf
                            <button type="submit" class="btn btn-primary">Aceptar</button>
                        </form>

                    </div>

                    <div class="col-12 col-md-6">

                        <form method="POST" action="" id="form-reject-request" class="text-center d-none">
                            @method('PUT')
                            @csrf
                            <button type="submit" class="btn btn-danger">Rechazar</button>
                        </form>

                    </div>

                </div>

                <div class="mb-1" id="instalation-files-label"><span class="font-weight-bold">Imágenes de la instalación:</span></div>
                <div id="instalation-files" class="d-none"></div>

            </div>

            <div class="col-12 col-md-6 text-left">

                <form method="POST" action="" id="form-update-request">

                    @csrf

                    <div class="mb-1"><span class="font-weight-bold">IP:</span>
                        <input type="text" name="ip" id="ip" class="form-control">
                    </div>

                    <div class="mb-1">
                        <span class="font-weight-bold">Zona:</span>
                        <select class="form-control" name="zone_id" id="zone_id">
                            <option value="">Seleccionar</option>
                            @foreach($zones as $zone)
                                <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Enviar</button>

                </form>

            </div>

        </div>

    </swal-html>

</template>
