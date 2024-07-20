window.addEventListener('load', function() {

  const viewDetailsBtn = document.querySelectorAll('.view-details');
  for (var i = 0; i < viewDetailsBtn.length; i++) {
    viewDetailsBtn[i].addEventListener('click', viewDetails);
  }

});

function viewDetails(event){

  event.preventDefault;
  const obj = event.currentTarget;
  const requestId = obj.dataset.id;

  const detailsPopUp = Swal.mixin({
      customClass: {
          confirmButton: "btn btn-primary mx-2 px-4 py-3 rounded-pill",
          cancelButton: "btn btn-danger mx-2 px-4 py-3 rounded-pill",
      },
      buttonsStyling: false
  });

  $.ajax({
    type: "GET",
    url: '/administrador/solicitudes-instlacion/' + requestId,
    dataType: "json",
    processData: false,
    contentType: false,
    headers: {
      "Content-Type": "application/json",
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function(response) {

      detailsPopUp.fire({
        title: "Detalles de la solicitud",
        confirmButtonText: "Actualizar",
        cancelButtonText: "Cancelar",
        allowOutsideClick: true,
        showCancelButton: true,
        width: 800,
        template: "#request-data-popup"
      });

      document.getElementById('form-update-request').setAttribute('action', '/administrador/solicitudes-instlacion/' + requestId);

      document.getElementById('user_name').textContent = response.user_name;
      document.getElementById('service_name').textContent = response.service_name;
      document.getElementById('formatted_created_at').textContent = response.formatted_created_at;
      document.getElementById('adrress').textContent = response.adrress;
      document.getElementById('group_name').textContent = (response.group_name) ? response.group_name : 'No asignado';
      document.getElementById('status').textContent = response.status;
      document.getElementById('invoice').href = '/invoice/' + response.invoice_id;

      document.getElementById('ip').value = response.ip;
      document.getElementById('zone_id').value = response.zone_id;

      const formAcceptRequest = document.getElementById('form-accept-request');
      const formRejectRequest = document.getElementById('form-reject-request');
      formAcceptRequest.classList.add('d-none');
      formRejectRequest.classList.add('d-none');

      if(response.status == 'Pendiente'){

        formAcceptRequest.setAttribute('action', '/administrador/aceptar-solicitud/' + requestId);
        formAcceptRequest.classList.remove('d-none');

        formRejectRequest.setAttribute('action', '/administrador/rechazar-solicitud/' + requestId);
        formRejectRequest.classList.remove('d-none');

      }

    },
    failure: function(e) {
        console.log('Error: ' + e)
        console.log('Error: ' + e.getMessage())
    }

  });

}
