@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop

@section('content')
    <x-paneltitle titleName="Usuarios"></x-paneltitle>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="container-fluid table-responsive">
                <table id="users_table" class="table text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Cedula / Usuario</th>
                            <th>Saldo</th>
                            <th>Telefono</th>
                            <th>fecha_creacion</th>
                            <th>Servicios</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody id="users_table_content">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        getUsers();

        function getUsers() {
            if ($.fn.DataTable.isDataTable("#users_table")) {
                $("#users_table").DataTable().destroy();
            }

            $.ajax({
                type: "get",
                url: "/administrador/usuarios/all",
                dataType: "json",
                success: function(response) {
                    var content = "";
                    for (const [index, user] of response.entries()) {
                        content += `
                        <tr>
                            <td class="align-middle">${index + 1}</td>
                            <td class="align-middle">${user["name"]}</td>
                            <td class="align-middle">${user["dni"]}</td>
                            <td class="align-middle">${user["balance"]}</td>
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
                            }" id="btn_show_user_service" class="btn btn-block px-4 py-2 boder-table-element-radius bg-account-view" type="button"><i class="fa fa-eye"></i></button></td>
                            <td class="align-middle"><button type="button" value="${
                                user["id"]
                            }" class="btn bg-close btn-block px-4 py-2 boder-table-element-radius" id="btn_user_delete"><i class="fas fa-trash"></i></button></td>
                        </tr>
                        `;
                    }
                    $("#users_table_content").html(content);
                    $("#users_table").DataTable({
                        drawCallback: function() {
                            buttonsChangeUserStatus();
                            buttonsDeleteUser();
                            modalsShowUSerService();
                        },
                    });
                },
            });
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

        function modalsShowUSerService() {
            for (
                let index = 0; index < $('button[id="btn_show_user_service"]').length; index++
            ) {
                $('button[id="btn_show_user_service"]')[index].onclick = function() {
                    $.ajax({
                        type: "get",
                        url: `/administrador/usuarios/services/${$(this).val()}`,
                        dataType: "json",
                        success: function(response) {
                            let contentServices = "";
                            for (const [index, userServices] of response.entries()) {
                                contentServices += `
                        <tr>
                            <td class="my-auto"><span class="text-sm d-block">${
                                index + 1
                            }</span></td>
                            <td class="my-auto"><span class="text-sm d-block">${
                                userServices["service"]
                            }</span></td>
                            <td class="my-auto"><span class="text-sm d-block">${
                                userServices["plan"]
                            }</span></td>
                            <td class="my-auto">${
                                userServices["account_email"] != ""
                                    ? userServices["account_email"]
                                    : "--"
                            }</td>
                            <td class="my-auto">${
                                userServices["pin"] != ""
                                    ? userServices["pin"][0]["profile"]
                                    : "--"
                            }</td>

                            <td class="my-auto">${
                                userServices["pin"] != ""
                                    ? userServices["pin"][0]["pin"]
                                    : "--"
                            }</td>

                            <td class="my-auto"><span class="text-sm p-2 d-block ${
                                userServices["assigned"] == false
                                    ? "bg-warning"
                                    : "bg-success"
                            } ">${
                                userServices["assigned"] == false
                                    ? "Pendiente de asignacion"
                                    : "asigando"
                            }</span></td>
                            <td class="my-auto"><span class="text-sm d-block">${
                                userServices["date_init"] == null
                                    ? "---"
                                    : userServices["date_init"]
                            }</span></td>
                            <td class="my-auto"><span class="text-sm d-block">${
                                userServices["date_finish"] == null
                                    ? "---"
                                    : userServices["date_finish"]
                            }</span></td>
                            <td class="my-auto"><span class="text-sm d-block">${calculeDaysRemainings(
                                userServices["date_init"],
                                userServices["date_finish"],
                            )}</span></td>
                        </tr>
                        `;
                            }
                            let modalUserServices = `
                    <!-- Modal -->
                    <div class="modal fade text-dark" id="ModalServiceUserData_${
                        index + 1
                    }" tabindex="-1" aria-labelledby="" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title font-weight-bold" id="service_name">Cuenta</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                                <div class="col-12 my-auto table-user-service">
                                    <table id="users_table" class="table text-center">
                                        <thead>
                                            <tr>
                                                <th class="text-sm">#</th>
                                                <th class="text-sm">Servicio</th>
                                                <th class="text-sm">Plan</th>
                                                <th class="text-sm">Cuenta</th>
                                                <th class="text-sm">Perfil</th>
                                                <th class="text-sm">Pin</th>
                                                <th class="text-sm">Status</th>
                                                <th class="text-sm">fecha_activacion</th>
                                                <th class="text-sm">Fecha_vencimiento</th>
                                                <th class="text-sm">Dias restantes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            ${contentServices}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>`;
                            $("#modal_users_service").html(modalUserServices);
                            $(`#ModalServiceUserData_${index + 1}`).modal("show");

                            function calculeDaysRemainings(initDate, finDate) {
                                const dateInit = new Date(initDate);
                                const dateFin = new Date(finDate);
                                const dateNow = new Date();
                                let differenceFirst = dateFin - dateInit;
                                let differenceCurrent = dateFin - dateNow;
                                const remainingDays = Math.floor(
                                    differenceFirst / (1000 * 60 * 60 * 24),
                                );
                                const remainingDaysCurrent = Math.floor(
                                    differenceCurrent / (1000 * 60 * 60 * 24),
                                );
                                return (
                                    remainingDays -
                                    (remainingDays - remainingDaysCurrent)
                                );
                            }
                        },
                    });
                };
            }
        }
    </script>
@stop
