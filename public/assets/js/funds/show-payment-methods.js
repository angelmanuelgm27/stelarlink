window.addEventListener('load', function() {

  const showPaymentMethodDetailBtn = document.querySelectorAll('.show-payment-method-detail-btn');
  for (var i = 0; i < showPaymentMethodDetailBtn.length; i++) {
    showPaymentMethodDetailBtn[i].addEventListener('click', showPaymentMethodDetail);
  }

});

function showPaymentMethodDetail(event){
  event.preventDefault();
  const obj = event.currentTarget;
  const paymentMethodId = obj.dataset.id;






  const detailsPopUp = Swal.mixin({
      customClass: {
          confirmButton: "btn btn-primary mx-2 px-4 py-3 rounded-pill",
          cancelButton: "btn btn-danger mx-2 px-4 py-3 rounded-pill",
      },
      buttonsStyling: false
  });

  $.ajax({
    type: "GET",
    url: '/cliente/metodo-de-pago/' + paymentMethodId,
    dataType: "json",
    processData: false,
    contentType: false,
    headers: {
      "Content-Type": "application/json",
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function(response) {

      detailsPopUp.fire({
        title: response.name,
        confirmButtonText: "Enviar",
        cancelButtonText: "Cancelar",
        allowOutsideClick: true,
        showCancelButton: true,
        width: 800,
        template: "#payment-method-data-popup"
      });

      document.getElementById('payment-method-img').src = '/storage/' + response.image;
      document.getElementById('payment-method-details').innerHTML = response.details.replace(/\r\n/g , "<br>");;

      dollarConversionListener();

    },
    failure: function(e) {
        console.log('Error: ' + e)
        console.log('Error: ' + e.getMessage())
    }

  });





}
