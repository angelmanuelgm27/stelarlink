window.addEventListener('load', function() {

  const installerPaymentPopupTrigger = document.querySelectorAll('.installer-payment-popup-trigger');
  for (var i = 0; i < installerPaymentPopupTrigger.length; i++) {
    installerPaymentPopupTrigger[i].addEventListener('click', installerPaymentPopup);
  }

});

function installerPaymentPopup(event){

  event.preventDefault();
  const obj = event.currentTarget;
  const id = obj.dataset.id;
  const name = obj.dataset.name;
  const amount = obj.dataset.amount;

  Swal.mixin().fire({
    title: 'Notificar pago a instalador',
    allowOutsideClick: true,
    showCancelButton: false,
    showConfirmButton: false,
    width: 500,
    template: "#installer-payment-create-popup"
  });

  document.getElementById('name').textContent = name;
  document.getElementById('amount').textContent = amount;
  document.getElementById('form-installer-payment-create').action = '/administrador/actividades-completadas/' + id + '/pagar';

}
