<!-- Modal Pagar-->
<div class="modal fade" id="modalEditService" tabindex="-1" aria-labelledby="modalAgregarNuevoMetodoPagoLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fs-5">Nuevo servicio de internet</h4>
            </div>
            <div class="modal-body">
                <form name="form_service_edit" id="form_service_edit" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group my-2">
                                <label>Nombre del servicio</label>
                                <input type="text" required name="service_name_edit" id="service_name_edit"
                                    class="form-control">
                            </div>
                            <div class="form-group my-2">
                                <label>Precio</label>
                                <input type="text" name="service_price_edit" id="service_price_edit"
                                    class="form-control">
                            </div>
                            <div class="form-group my-2">
                                <label>Velocidad de carga</label>
                                <input type="text" name="service_velocity_load_edit" id="service_velocity_load_edit"
                                    class="form-control">
                            </div>
                            <div class="form-group my-2">
                                <label>Velocidad de descarga</label>
                                <input type="text" name="service_velocity_download_edit"
                                    id="service_velocity_download_edit" class="form-control">
                            </div>
                            <div class="form-group my-2">
                                <label>Imagen del servicio</label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" form="form_service_edit" class="btn btn-primary">Agregar</button>
            </div>
        </div>
    </div>
</div>
