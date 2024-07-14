@extends('adminlte::page')

@section('title', 'Mis planes')

@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop

@section('content')
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

    <x-paneltitle titleName="Mis planes"></x-paneltitle>

    @if($services->isNotEmpty())

            <div class="container-fluid table-responsive">
                <table id="users_table" class="table text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Plan / Servicio</th>
                            <th>Estado</th>
                            <th>Velocidad de carga</th>
                            <th>Velocidad de bajada</th>
                            <th>Fecha de compra</th>
                            <th>Fecha de Activacion</th>
                            <th>Fecha de Vencimiento</th>
                            <th>Factura</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody id="users_plans_table_content">

                        @php
                        $index = 1;
                        @endphp

                        @foreach ($services as $service)

                            <tr>
                                <td class="align-middle">{{ $index }}</td>
                                <td class="align-middle">{{ $service->name }}</td>
                                <td class="align-middle">{{ $service->status }}</td>
                                <td class="align-middle">{{ $service->velocity_load }}</td>
                                <td class="align-middle">{{ $service->velocity_download }}</td>
                                <td class="align-middle">{{ $service->formatted_created_at }}</td>
                                <td class="align-middle">{{ $service->date_active }}</td>
                                <td class="align-middle">{{ $service->date_finish }}</td>
                                <td class="align-middle">
                                    <a href="{{ $service->invoice_url }}" target="_blank">Ver</a>
                                </td>
                                <td class="align-middle">
                                    @if($service->action == 'Cancelar')
                                        <button class="btn btn-primary">{{ $service->action }}</button>
                                    @endif
                                </td>

                            </tr>

                        @php
                        $index++;
                        @endphp

                        @endforeach

                    </tbody>
                </table>
            </div>


  @else

    <div class="my-5 text-center">No hay informacion para mostrar</div>

  @endif

    <x-paneltitle titleName="Comprar nuevos planes"></x-paneltitle>
    <div class="row mt-4" id="services_list">
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            getServices();

            getServicesByClient()

            function getServicesByClient() {
                $.ajax({
                    type: "get",
                    url: "{{ route('client.plans.user') }}",
                    dataType: "json",
                    success: function(response) {
                        console.log(response)
                    },
                });
            }

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
                                        </div>
                                        <h5>Nombre Plan: <span class="font-weight-bold">${ service.name }</span></h5>
                                        <p>Costo: <span class="font-weight-bold">${ service.price }$</span></p>
                                        <p>Velocidad de carga: <span class="font-weight-bold">${ service.velocity_load != '' ? service.velocity_load : '' } Mbps</span></p>
                                        <p>Velocidad de descarga: <span class="font-weight-bold">${ service.velocity_download } Mbps</span></p>
                                        <div class="text-center">
                                            <button type="button" value="${ service.id }_${ service.name }_${ service.price }" id="btn_plan_shop" class="btn btn-adminlte-secondary px-4 py-3 w-75 anta-regular rounded-pill text-3xl text-primary">Conectar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                `;
                        }
                        $('#services_list').html(content)
                        shopPlan()
                    },
                });
            }


            function shopPlan() {
                $('button[id="btn_plan_shop"]').each((index, btn) => {
                    $(btn).on("click", function(e) {
                        console.log(e)
                        console.log()
                        let planId = e.target.value.split('_')[0]
                        let planName = e.target.value.split('_')[1]
                        let planCost = e.target.value.split('_')[2]

                        const shopMessage = Swal.mixin({
                            customClass: {
                                confirmButton: "btn btn-adminlte-secondary mx-2 px-4 py-3 anta-regular rounded-pill",
                                cancelButton: "btn btn-danger mx-2 px-4 py-3 anta-regular rounded-pill",
                            },
                            buttonsStyling: false
                        })
                        shopMessage.fire({
                            title: "Stelarlink informa",
                            text: "Desea comprar este plan",
                            confirmButtonText: "Confirmar",
                            cancelButtonText: "Cancelar",
                            allowOutsideClick: false,
                            showCancelButton: true,
                        }).then((result) => {
                            if (result.value == true) {
                                console.log('generar pago')

                                shopMessage.fire({
                                    confirmButtonText: "Generar pago",
                                    cancelButtonText: "Cancelar",
                                    showCancelButton: true,
                                    allowOutsideClick: false,
                                    title: "Complete la informacion de pago",
                                    html: `
                                                    <div class="mb-3 row">
                                                           <div class="col-12 col-md-5 my-auto">
                                                                 <label class="form-label m-0">Plan</label>
                                                             </div>
                                                             <div class="col-12 col-md-7">
                                                                  <input type="text" value="${planName}" disabled class="form-control border border-adminlte-primary" id="">
                                                             </div>
                                                         </div>
                                                         <div class="mb-3 row">
                                                           <div class="col-12 col-md-5 my-auto">
                                                                 <label class="form-label m-0">Costo</label>
                                                             </div>
                                                             <div class="col-12 col-md-7">
                                                                  <input type="text" value="${planCost}" disabled class="form-control border border-adminlte-primary" id="">
                                                             </div>
                                                         </div>
                                                        <div class="mb-3 row">
                                                           <div class="col-12 col-md-5 my-auto">
                                                                 <label class="form-label m-0">N° referencia</label>
                                                             </div>
                                                             <div class="col-12 col-md-7">
                                                                  <input type="text" class="form-control border border-adminlte-primary" id="shop_payment_ref">
                                                             </div>
                                                         </div>
                                                         <div class="mb-3 row">
                                                           <div class="col-12 col-md-5 my-auto">
                                                                 <label class="form-label m-0">Imagen Comprobante de pago</label>
                                                             </div>
                                                             <div class="col-12 col-md-7">
                                                                 <div>
                                                                     <div class="position-relative text-center mb-2">
                                                                         <div class="bg-adminlte-primary text-white p-3">
                                                                            <i class="fas fa-cloud-upload-alt text-4xl" id="icon_upload_payment"></i>
                                                                            <input type="file" accept="image/png, image/jpeg, image/jpg, image/webp"
                                                                             class="position-absolute h-100 top-0 left-0 mx-auto opacity-0 cursor-pointer right-0"
                                                                             id="shop_image_payment" name="shop_image_payment">
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                         `
                                }).then((result) => {
                                    let formData = new FormData()
                                    formData.append('plan_id', planId)
                                    formData.append('payment_ref', $(
                                        '#shop_payment_ref').val())
                                    formData.append('image', $(
                                        '#shop_image_payment')[0].files[0])
                                    formData.append('_token', '{{ csrf_token() }}')
                                    if (result.value == true) {
                                        $.ajax({
                                            type: "POST",
                                            url: "{{ route('client.plans.shop') }}",
                                            data: formData,
                                            dataType: "json",
                                            processData: false,
                                            contentType: false,
                                            headers: {
                                                'X-CSRF-TOKEN': $(
                                                    'meta[name="csrf-token"]'
                                                ).attr('content')
                                            },
                                            success: function(response) {
                                                console.log(response)
                                                if (response.success ==
                                                    true) {
                                                    Swal.fire({
                                                        type: "success",
                                                        title: "Compra exitosa !",
                                                        text: `${response.message}`

                                                    })
                                                    $('#shop_payment_ref')
                                                        .val('')
                                                    $('#shop_image_payment')
                                                        .val('')
                                                }
                                            },
                                            failure: function(e) {
                                                console.log(e)
                                                console.log(e
                                                    .getMessage())
                                                Swal.fire({
                                                    type: "error",
                                                    title: "Error de base de datos",
                                                    text: `error: ${e.getMessage()}`
                                                })
                                            }

                                        });
                                        Swal.fire({
                                            title: "Enviando pago...",
                                            text: "por favor espere",
                                            showConfirmButton: false,
                                            allowOutsideClick: false,
                                            type: "info"
                                        })

                                    }
                                })

                                $('#shop_image_payment').on("change", function() {
                                    $('#icon_upload_payment').removeClass(
                                        "fa-cloud-upload-alt")
                                    $('#icon_upload_payment').addClass(
                                        "fa-check-circle")
                                })
                            }

                        })
                    })
                })

            }
        })
    </script>
@endsection
