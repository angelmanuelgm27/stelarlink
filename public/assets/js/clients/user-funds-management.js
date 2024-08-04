let popUpTitle = '';


window.addEventListener('load', function() {

  const addFundsBtn = document.querySelectorAll('.add-funds-btn');
  for (var i = 0; i < addFundsBtn.length; i++) {
    addFundsBtn[i].addEventListener('click', addFunds);
  }

  const withdrawFundsBtn = document.querySelectorAll('.withdraw-funds-btn');
  for (var i = 0; i < withdrawFundsBtn.length; i++) {
    withdrawFundsBtn[i].addEventListener('click', withdrawFunds);
  }

});

function addFunds(event){

  event.preventDefault();
  const obj = event.currentTarget;
  const userId = obj.dataset.id;
  const userName = obj.dataset.name;

  popUpTitle = 'Agregar fondos';

  ShowFundsManagementPopUp();

  document.getElementById('user-funds-management-form').setAttribute('action', '/administrador/usuario/' + userId + '/add-funds');

}

function withdrawFunds(event){

  event.preventDefault();
  const obj = event.currentTarget;
  const userId = obj.dataset.id;
  const userName = obj.dataset.name;

  popUpTitle = 'Retirar fondos';

  ShowFundsManagementPopUp();

  document.getElementById('user-funds-management-form').setAttribute('action', '/administrador/usuario/' + userId + '/withdraw-funds');

}


function ShowFundsManagementPopUp(){

  Swal.mixin().fire({
    title: popUpTitle,
    allowOutsideClick: true,
    showCancelButton: false,
    showConfirmButton: false,
    width: 800,
    template: "#user-funds-management-popup"
  });

  dollarConversionListener();


}
