window.addEventListener('load', function() {

  const planShopBtn = document.querySelectorAll('.plan-shop-btn');
  for (var i = 0; i < planShopBtn.length; i++) {
    planShopBtn[i].addEventListener('click', planShop);
  }

});

function planShop(event){

  event.preventDefault();
  const obj = event.currentTarget;
  const requestId = obj.dataset.id;
  const requestName = obj.dataset.name;
  const requestPrice = obj.dataset.price;

  const shopPopUp = Swal.mixin({
      customClass: {
          confirmButton: "btn btn-primary mx-2 px-4 py-3 rounded-pill",
          cancelButton: "btn btn-danger mx-2 px-4 py-3 rounded-pill",
      },
      buttonsStyling: false
  });

  shopPopUp.fire({
    title: "Solicitar instalación",
    confirmButtonText: "Comprar",
    cancelButtonText: "Cancelar",
    allowOutsideClick: true,
    showCancelButton: false,
    showConfirmButton: false,
    width: 800,
    template: "#request-data-popup"
  });

  document.getElementById('plan-id').value = requestId;
  document.getElementById('plan-name').textContent = requestName;
  document.getElementById('plan-price').textContent = requestPrice;

}

// $(document).ready(function() {

//     $('.plan-shop-btn').each((index, btn) => {
//         $(btn).on("click", function(e) {

//             const shopMessage = Swal.mixin({
//                 customClass: {
//                     confirmButton: "btn btn-primary mx-2 px-4 py-3 rounded-pill",
//                     cancelButton: "btn btn-danger mx-2 px-4 py-3 anta-regular rounded-pill",
//                 },
//                 buttonsStyling: false
//             })
//             shopMessage.fire({
//                 title: "Stelarlink informa",
//                 text: "Desea comprar este plan",
//                 confirmButtonText: "Confirmar",
//                 cancelButtonText: "Cancelar",
//                 allowOutsideClick: false,
//                 showCancelButton: true,
//             }).then((result) => {

//                 if (result.value == true) {

//                     let planId = e.target.value

//                     let formData = new FormData()
//                     formData.append('plan_id', planId)
//                     formData.append('_token', '{{ csrf_token() }}')

//                     $.ajax({
//                         type: "POST",
//                         url: "{{ route('client.plans.shop') }}",
//                         data: formData,
//                         dataType: "json",
//                         processData: false,
//                         contentType: false,
//                         headers: {
//                             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                         },
//                         success: function(response) {
//                             if (response.success == true) {
//                                 Swal.fire({
//                                     type: "success",
//                                     title: "Compra exitosa !",
//                                     text: `${response.message}`

//                                 })
//                             }
//                         },
//                         failure: function(e) {
//                             Swal.fire({
//                                 type: "error",
//                                 title: "Error de base de datos",
//                                 text: `error: ${e.getMessage()}`
//                             })
//                         }

//                     });

//                 }

//                 $('#shop_image_payment').on("change", function() {
//                     $('#icon_upload_payment').removeClass("fa-cloud-upload-alt")
//                     $('#icon_upload_payment').addClass("fa-check-circle")
//                 })

//             })

//         })

//     })

// })
