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
    url: '/administrador/plan/' + requestId,
    dataType: "json",
    processData: false,
    contentType: false,
    headers: {
      "Content-Type": "application/json",
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function(response) {

      detailsPopUp.fire({
        title: "Detalles del plan",
        confirmButtonText: "Actualizar",
        cancelButtonText: "Cancelar",
        allowOutsideClick: true,
        showCancelButton: false,
        showConfirmButton: false,
        width: 800,
        template: "#request-data-popup"
      });

      document.getElementById('form-update-request').setAttribute('action', '/administrador/plan/' + requestId);

      document.getElementById('user_name').textContent = response.user_name;
      document.getElementById('service_name').textContent = response.service_name;
      document.getElementById('formatted_created_at').textContent = response.formatted_created_at;
      document.getElementById('adrress').textContent = response.adrress;
      document.getElementById('group_name').textContent = (response.group_name) ? response.group_name : 'No asignado';
      document.getElementById('plan-data-status').textContent = response.status;
      document.getElementById('invoice').href = '/invoice/' + response.invoice_id;

      document.getElementById('ip').value = response.ip;
      document.getElementById('details-zone_id').value = response.zone_id;

      const formRejectRequest = document.getElementById('form-reject-request');
      formRejectRequest.classList.add('d-none');

      const formSubmitBtn = document.getElementById('form-submit-btn');

      if(response.status == 'Pendiente'){

        formSubmitBtn.textContent = 'Enviar y aceptar solicitud';

        formRejectRequest.setAttribute('action', '/administrador/rechazar-plan/' + requestId);
        formRejectRequest.classList.remove('d-none');

      }else if(response.status == 'Rechazado'){

        document.getElementById('form-update-request').classList.add('d-none');

      }else if(response.status == 'Por suspender'){

        const formsuSpendRequest = document.getElementById('form-suspend-plan');
        formsuSpendRequest.classList.remove('d-none');
        formsuSpendRequest.setAttribute('action', '/administrador/suspender-plan/' + requestId);

      }else if(response.status == 'Suspendido' || response.status == 'Por activar'){

        const formsuSpendRequest = document.getElementById('form-activate-plan');
        formsuSpendRequest.classList.remove('d-none');
        formsuSpendRequest.setAttribute('action', '/administrador/activar-plan/' + requestId);

      }else{

        formSubmitBtn.textContent = 'Enviar';

      }

      const instalationFiles = document.getElementById('instalation-files');
      const instalationFilesLabel = document.getElementById('instalation-files-label');

      if(response.instalation_files.length > 0){
        instalationFiles.classList.remove('d-none');
        instalationFilesLabel.classList.remove('d-none');
        for (var i = 0; i < response.instalation_files.length; i++) {
          instalationFiles.innerHTML += '<a class="d-block" href="/file/' + response.instalation_files[i].id + '">' + response.instalation_files[i].name + '</a>'
        }

      }else{
        instalationFiles.classList.add('d-none');
        instalationFilesLabel.classList.add('d-none');
        while (instalationFiles.lastElementChild) {
          instalationFiles.removeChild(instalationFiles.lastElementChild);
        }
      }



    },
    failure: function(e) {

    }

  });

}
