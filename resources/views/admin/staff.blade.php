@extends('adminlte::page')

@section('title', 'Personal')

@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop

@section('content')
    <x-paneltitle titleName="Crear Personal"></x-paneltitle>
    <div class="row mb-3">
        <div class="col-12 col-md-12">
            <form action="{{ route('admin.staff.create') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Telefono</label>
                            <input type="number" class="form-control" id="phone" name="phone">
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Cedula / DNI</label>
                            <input type="number" class="form-control" id="dni" name="dni">
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Rol</label>
                            <select name="rol" id="rol" class="form-control">
                                <option value="soporte-tecnico">Soporte Tecnico - Instalador</option>
                                <option value="cobranzas">Cobranzas</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-12">
                        <button type="submit" class="btn btn-primary w-100">Crear Personal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <x-paneltitle titleName="Personal Existente"></x-paneltitle>
    <div class="row">
        <div class="col-12">
            <table class="table text-center" id="staff_table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Cedula / Usuario</th>
                        <th>Rol</th>
                        <th>Telefono</th>
                        <th>fecha_creacion</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody id="staff_table_content">
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('js')
    <script>
        getUsers();

        function getUsers() {
            if ($.fn.DataTable.isDataTable("#staff_table")) {
                $("#staff_table").DataTable().destroy();
            }

            $.ajax({
                type: "get",
                url: "/administrador/personal/all",
                dataType: "json",
                success: function(response) {
                    var content = "";
                    for (const [index, user] of response.entries()) {
                        content += `
                        <tr>
                            <td class="align-middle">${index + 1}</td>
                            <td class="align-middle">${user["name"]}</td>
                            <td class="align-middle">${user["dni"]}</td>
                            <td class="align-middle">${user["rol"]}</td>
                            <td class="align-middle"><a href="https://api.whatsapp.com/send?phone=${convertPhoneToInternational(
                                user["phone"],
                            ).replace(
                                "+",
                                "",
                            )}" target="_blank" class="btn bg-adminlte-primary px-4 py-2 text-white rounded" ><span>${convertPhoneToInternational(
                                user["phone"],
                            )}</span></a></td>
                            <td class="align-middle">${
                                user["created_at"] == null
                                    ? "--"
                                    : user["created_at"].split("T")[0]
                            }</td>
                            <td class="align-middle"><button type="button" value="${
                                user["id"]
                            }" class="btn bg-danger btn-block px-4 py-2 boder-table-element-radius" id="btn_user_delete"><i class="fas fa-trash"></i></button></td>
                        </tr>
                        `;
                    }
                    $("#staff_table_content").html(content);
                    $("#staff_table").DataTable({
                        drawCallback: function() {
                            buttonsChangeUserStatus();
                            buttonsDeleteUser();
                        },
                    });
                },
            });
        }

        function buttonsChangeUserStatus() {
            for (
                let index = 0; index < $('button[id="btn_user_status"]').length; index++
            ) {
                $('button[id="btn_user_status"]')[index].onclick = function() {
                    let id = $(this).val();
                    let formData = new FormData();
                    let csrfToken = $('meta[name="csrf-token"]').attr("content");
                    formData.append("_method", "PATCH");

                    Swal.fire({
                        title: "Cambiado estado del usuario!",
                        text: "",
                        type: "info",
                        showCancelButton: false,
                        showConfirmButton: false,
                    });

                    $.ajax({
                        type: "post",
                        url: `/administrador/usuarios/${id}`,
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
                                getUsers();
                            } else {
                                Swal.fire(`Error`, `${response.message}`, "error");
                            }
                        },
                    });
                };
            }
        }

        function buttonsDeleteUser() {
            for (
                let index = 0; index < $('button[id="btn_user_delete"]').length; index++
            ) {
                $('button[id="btn_user_delete"]')[index].onclick = function() {
                    console.log('delte')
                    let id = $(this).val();
                    let formData = new FormData();
                    var csrfToken = $('meta[name="csrf-token"]').attr("content");

                    Swal.fire({
                        title: "Eliminando usuario!",
                        text: "",
                        type: "info",
                        showCancelButton: false,
                        showConfirmButton: false,
                    });

                    $.ajax({
                        type: "delete",
                        url: `/administrador/personal/${id}`,
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
                                getUsers();
                            } else {
                                Swal.fire(`Error`, `${response.message}`, "error");
                            }
                        },
                    });
                };
            }
        }

        function convertPhoneToInternational(phone) {
            if (phone.includes("+")) {
                return phone;
            }

            if (phone.includes("+") == false) {
                let getCodePhone = "";
                if (phone.split("")[0] == 0) {
                    getCodePhone =
                        phone.split("")[0] +
                        phone.split("")[1] +
                        phone.split("")[2] +
                        phone.split("")[3];
                } else {
                    getCodePhone =
                        phone.split("")[0] + phone.split("")[1] + phone.split("")[2];
                }

                let updatePhone = "";
                switch (getCodePhone) {
                    case "0412":
                        updatePhone = phone.replace("0412", "58412");
                        break;
                    case "412":
                        updatePhone = phone.replace("412", "58412");
                        break;
                    case "0414":
                        updatePhone = phone.replace("0414", "58414");
                        break;
                    case "0424":
                        updatePhone = phone.replace("0424", "58424");
                        break;
                    case "424":
                        updatePhone = phone.replace("424", "58424");
                        break;
                    case "0426":
                        updatePhone = phone.replace("0426", "58426");
                        break;
                    case "426":
                        updatePhone = phone.replace("426", "58426");
                        break;
                    case "416":
                        updatePhone = phone.replace("416", "58416");
                        break;
                    case "0416":
                        updatePhone = phone.replace("0416", "58416");
                        break;
                    default:
                        updatePhone = phone;
                        break;
                }
                return "+" + updatePhone;
            }
        }
    </script>
@endsection
