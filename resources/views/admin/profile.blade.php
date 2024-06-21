@extends('adminlte::page')

@section('title', 'Perfil')

@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop

@section('content')
    <x-paneltitle titleName="Mi perfil"></x-paneltitle>
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card shadow">
                <div class="row">
                    <div class="col-12 col-md-4 profile-image m-auto text-center">
                        <div class="position-relative">
                            <img class="card-img-profile rounded-circle shadow cursor-pointer" id="profile_user_profile"
                                src="{{ Auth::user()->avatar ? asset(Auth::user()->avatar) : asset('images/avatar_default.png') }}"
                                alt="{{ Auth::user()->name }}">
                            <div class="icon-cambiar-image"><i class="fas fa-sync text-5xl text-adminlte-primary"></i></div>
                            <input type="file" accept="image/png, image/jpeg, image/jpg, image/webp"
                                class="position-absolute rounded-circle top-0 left-0 mx-auto opacity-0 cursor-pointer right-0 input-cambiar-image"
                                id="update_profile_avatar" name="update_profile_avatar">
                        </div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="card-body bg-adminlte-primary">
                            <form name="update_profile" id="update_profile">
                                <div class="mb-3">
                                    <label class="form-label text-white">Correo electronico</label>
                                    <input type="email" class="form-control rounded-pill px-4"
                                        value="{{ Auth::user()->email }}" name="user_email" id="user_email">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-white">Teléfono</label>
                                    <input type="text" class="form-control rounded-pill px-4"
                                        value="{{ Auth::user()->phone }}" name="user_phone" id="user_phone">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-white">Dirección</label>
                                    <input type="text" class="form-control rounded-pill px-4"
                                        value="{{ Auth::user()->address }}" name="user_address" id="user_address">
                                </div>
                                <button type="submit"
                                    class="btn btn-primary w-100 rounded-pill text-lg font-weight-bold">Editar
                                    perfil</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#update_profile_avatar').change(function(e) {

                let formData = new FormData();
                formData.append('image', this.files[0]);
                formData.append('_method', 'PUT')
                formData.append('_token', '{{ csrf_token() }}')

                $.ajax({
                    type: "post",
                    url: "/perfil/imagen-actualizar/{{ Auth::user()->id }}",
                    data: formData,
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response)
                        if (response.success == true) {
                            Swal.fire({
                                title: "Stelarlink informa",
                                text: response.message,
                                type: "success"
                            })
                            //SE ASIGNA LA NUEVA IMAGEN
                            $('#profile_user_profile').attr('src', response.image)
                            $('.user-menu .user-image').attr('src', response.image)
                        }

                        if (response.success == false) {
                            console.log(response.message)
                            Swal.fire({
                                title: "Stelarlink informa",
                                text: "hubo un error al actualizar la imagen",
                                type: "error"
                            })
                        }
                    },
                    failure: function(response) {
                        console.log(response)
                        Swal.fire({
                            title: "Stelarlink informa",
                            text: "Error de envio de informacion",
                            type: "error"
                        })
                    }
                });
            })

            $('#update_profile').submit(function(e) {
                e.preventDefault();
                let formData = new FormData();
                let userAddressUpdate = $('#user_address').val()
                let userPhoneUpadte = $('#user_phone').val()
                let userEmailUpdate = $('#user_email').val()

                formData.append('address', userAddressUpdate);
                formData.append('phone', userPhoneUpadte);
                formData.append('email', userEmailUpdate);

                formData.append('_method', 'PUT')
                formData.append('_token', '{{ csrf_token() }}')

                $.ajax({
                    type: "post",
                    url: "/perfil/actualizar/{{ Auth::user()->id }}",
                    data: formData,
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response)
                        if (response.success == true) {
                            Swal.fire({
                                title: "Stelarlink informa",
                                text: response.message,
                                type: "success"
                            })

                            //SE ASIGNA LOS VALORES
                            $('#user_address').val(userAddressUpdate)
                            $('#user_phone').val(userPhoneUpadte)
                            $('#user_email').val(userEmailUpdate)
                        }

                        if (response.success == false) {
                            console.log(response.message)
                            Swal.fire({
                                title: "Stelarlink informa",
                                text: "hubo un error al actualizar los datos",
                                type: "error"
                            })
                        }
                    },
                    failure: function(response) {
                        console.log(response)
                        Swal.fire({
                            title: "Stelarlink informa",
                            text: "Error de envio de informacion",
                            type: "error"
                        })
                    }
                });
            })
        })
    </script>
@endsection
