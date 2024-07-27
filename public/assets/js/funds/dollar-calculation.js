let dollarPrice = 0;

function dollarConversionListener(){

  dollarPrice = parseFloat(document.getElementById('dollar-price').textContent);

  if(dollarPrice){

    const amountDollar = document.getElementById('amount-dollar');
    amountDollar.addEventListener('keyup', calculateBs);

    const amountBs = document.getElementById('amount-bs');
    amountBs.addEventListener('keyup', calculateDollar);

  }

}

function calculateBs(event){

  const ammount_dollar = parseFloat(event.currentTarget.value);
  document.getElementById('amount-bs').value = (ammount_dollar * dollarPrice).toFixed(2);

}

function calculateDollar(event){

  const ammount_bs = parseFloat(event.currentTarget.value);
  document.getElementById('amount-dollar').value = (ammount_bs / dollarPrice).toFixed(2);

}
