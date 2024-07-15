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
      title: "Detalles",
      confirmButtonText: "Actualizar",
      cancelButtonText: "Cancelar",
      allowOutsideClick: true,
      showCancelButton: true,
      width: 800,
      template: "#request-data-popup"
  });


        console.log(response)

        document.getElementById('user_name').textContent = response.solicitud[0].user_name;
        document.getElementById('service_name').textContent = response.solicitud[0].service_name;
        document.getElementById('created_at').textContent = response.solicitud[0].created_at;
        document.getElementById('adrress').textContent = response.solicitud[0].adrress;
        document.getElementById('status').textContent = response.solicitud[0].status;
        document.getElementById('ip').textContent = response.solicitud[0].ip;
        document.getElementById('zone').textContent = response.solicitud[0].zone;
        document.getElementById('group_name').textContent = response.solicitud[0].group_name;

    },
    failure: function(e) {
        console.log('Error: ' + e)
        console.log('Error: ' + e.getMessage())
    }

  });

}
