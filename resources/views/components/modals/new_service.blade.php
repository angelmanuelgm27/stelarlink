<!-- Modal Pagar-->
<div class="modal fade" id="modalAddNewService" tabindex="-1" aria-labelledby="modalAgregarNuevoMetodoPagoLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fs-5">Nuevo servicio de internet</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.services.create') }}" name="form_new_service"
                    id="form_new_service" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group my-2">
                                <label>Nombre del servicio</label>
                                <input type="text" required name="service_name" id="service_name"
                                    class="form-control">
                            </div>
                            <div class="form-group my-2">
                                <label>Precio</label>
                                <input type="text" name="service_price" id="service_price" class="form-control">
                            </div>
                            <div class="form-group my-2">
                                <label>Velocidad de carga</label>
                                <input type="text" name="service_velocity_load" id="service_velocity_load"
                                    class="form-control">
                            </div>
                            <div class="form-group my-2">
                                <label>Velocidad de descarga</label>
                                <input type="text" name="service_velocity_download" id="service_velocity_download"
                                    class="form-control">
                            </div>
                            <div class="form-group my-2">
                                <label>Imagen del servicio</label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>
                            <div class="form-group my-2">
                                <label>El servicios estara</label>
                                <select name="service_status" id="service_status" class="form-control">
                                    <option value="1">Habilitado</option>
                                    <option value="0">Desactivado</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" form="form_new_service" class="btn btn-primary">Agregar</button>
            </div>
        </div>
    </div>
</div>
