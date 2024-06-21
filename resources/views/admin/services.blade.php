@extends('adminlte::page')

@section('title', 'Servicios')

@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop

@section('content')
    <x-paneltitle titleName="Servicios de internet"></x-paneltitle>
    <div class="row">
        <div class="col-12 col-md-4">
            <button type="button" id="btn_new_service" class="btn btn-primary">Agregar nuevo metodo de pago</button>
        </div>
    </div>
    @if (session('error'))
        <div class="row">
            <div class="col-12 mt-4">
                <div class="alert alert-danger">
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        </div>
    @endif

    @if (session('success'))
        <div class="row">
            <div class="col-12 mt-4">
                <div class="alert alert-success">
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        </div>
    @endif
    <div class="row mt-4" id="services_list">
    </div>
    @include('components.modals.edit_service')
    @include('components.modals.new_service')
@stop

@section('js')
    <script>
        $(document).ready(function() {
            getServices();

            function getServices() {
                let services = []
                $.ajax({
                    type: "get",
                    url: "/administrador/servicios/all",
                    dataType: "json",
                    success: function(response) {
                        services = response
                        var content = "";
                        for (const [index, service] of response.entries()) {
                            content += `
                            <div class="col-12 col-md-4 my-2" id="service_${index}">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="position-relative text-center mb-2 border-dark border-bottom">
                                            <img class=" w-50 rounded-circle cursor-pointer" id="service_image_icon"
                                                src="{{ asset('images/services/${ service.image } ') }} ">
                                            <div class="icon-cambiar-image"><i class="fas fa-sync text-5xl text-adminlte-primary"></i></div>
                                            <input type="file" accept="image/png, image/jpeg, image/jpg, image/webp"
                                                class="position-absolute rounded-circle top-0 left-0 mx-auto opacity-0 cursor-pointer right-0 input-cambiar-image"
                                                id="update_service_icon" name="update_service_icon">
                                        </div>
                                        <h5>Nombre Plan: <span class="font-weight-bold">${ service.name }</span></h5>
                                        <p>Costo: <span class="font-weight-bold">${ service.price }</span></p>
                                        <p>Velocidad de carga: <span class="font-weight-bold">${ service.velocity_load != '' ? service.velocity_load : '' } Mbps</span></p>
                                        <p>Velocidad de descarga: <span class="font-weight-bold">${ service.velocity_download } Mbps</span></p>
                                        <button type="button" id="btn_service_change_status" value="${ service.id }"
                                            class="btn ${ service.status == 1 ? 'btn-danger' : 'btn-success' } w-100">${ service.status == 1 ? 'Desactivar' : 'Habilitar' }</button>
                                        <button type="button" id="btn_service_edit" value="${index}"
                                            class="btn btn-warning w-100 mt-2">Editar</button>
                                        <button type="button" id="btn_service_delete" value="${ service.id }"
                                            class="btn btn-danger w-100 mt-2">Eliminar</button>
                                    </div>
                                </div>
                            </div>
                                `;
                        }
                        $('#services_list').html(content)
                        buttonsDelete()
                        changeStatus()
                        buttonsEdit(services)
                        //buttonsChangeUserStatus();
                        //buttonsDeleteUser();
                        //modalsShowUSerService();
                    },
                });
            }

            $('#btn_new_service').on('click', function() {
                $('#modalAddNewService').modal('show')
            })

            function buttonsDelete() {
                $('button[id="btn_service_delete"]').each(function(index, button) {
                    $(button).on('click', function() {
                        console.log('eliminando')
                        let id = $(this).val()
                        let formData = new FormData()

                        $.ajax({
                            type: "DELETE",
                            url: `/administrador/servicios/eliminar/${id}`,
                            dataType: "json",
                            processData: false,
                            contentType: false,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                console.log(response)
                                if (response.success == true) {
                                    Swal.fire(`${response.message}`, ``, "success");
                                    $('#service_' + index).remove();
                                } else {
                                    Swal.fire(`${response.message}`, ``, "error");
                                }
                            },
                            failure: function(response) {
                                console.log(response)
                                Swal.fire(`Error al hacer esta solicitud`, ``, "error");
                            }
                        });
                    })
                })
            }

            function buttonsEdit(service) { 

                $('button[id="btn_service_edit"]').off('click');

                $('button[id="btn_service_edit"]').each(function(index, button) {
                    $(button).on('click', function() {
                        let index = $(this).val()
                        console.log(index)
                        $('#service_name_edit').val(service[index].name)
                        $('#service_price_edit').val(service[index].price)
                        $('#service_velocity_load_edit').val(service[index].velocity_load)
                        $('#service_velocity_download_edit').val(service[index].velocity_download)

                        $('#modalEditService').modal('show')
                        $('#form_service_edit').off('submit');
                        $('#form_service_edit').on('submit', function(e) {
                            e.preventDefault();
                            $('#modalEditService').modal('hide')
                            let formData = new FormData();
                            formData.append('_method', 'PATCH')
                            formData.append('service_name_edit', $('#service_name_edit').val())
                            formData.append('service_price_edit', $('#service_price_edit').val())
                            formData.append('service_velocity_load_edit', $('#service_velocity_load_edit').val())
                            formData.append('service_velocity_download_edit', $('#service_velocity_download_edit').val())
                            formData.append('image', $('#image')[0].files[0])
                            
                            $.ajax({
                                type: "post",
                                url: `/administrador/servicios/editar/${service[index].id}`,
                                data: formData,
                                dataType: "json",
                                contentType: false,
                                processData: false,
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {
                                    if (response.success == true) {
                                        Swal.fire(`${response.message}`, ``, "success");
                                        getServices();                                        
                                    }  
                                },
                                failure: function(response) {
                                    console.log(response)
                                    Swal.fire(`Error al hacer esta solicitud`, ``, "error");
                                }
                            })
                        })
                    })
                })
            }

            function changeStatus() {
                $('button[id="btn_service_change_status"]').each(function(index, button) {
                    $(button).on('click', function() {
                        let id = $(this).val();
                        let formData = new FormData();
                        let csrfToken = $('meta[name="csrf-token"]').attr("content");
                        formData.append("_method", "PATCH");

                        Swal.fire({
                            title: "Cambiado estado del servicio!",
                            text: "",
                            type: "info",
                            showCancelButton: false,
                            showConfirmButton: false,
                        });

                        $.ajax({
                            type: "post",
                            url: `/administrador/servicios/estado/${id}`,
                            data: formData,
                            dataType: "json",
                            contentType: false,
                            processData: false,
                            headers: {
                                "X-CSRF-TOKEN": csrfToken,
                            },
                            success: function(response) {
                                if (response.success == true) {
                                    Swal.fire(`${response.message}`, ``, "success");
                                    getServices()
                                } else {
                                    Swal.fire(`Error`, `${response.message}`, "error");
                                }
                            },

                        });
                    })
                });
            }
        })
    </script>
@endsection
