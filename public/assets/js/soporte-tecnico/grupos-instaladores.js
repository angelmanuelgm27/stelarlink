let removeUserHandlers = [];

window.addEventListener('load', function() {

  const addNewUserBtn = document.getElementById('add-new-user-btn');
  addNewUserBtn.addEventListener('click', addNewUser);

  setRemoveUserListener();

});

function addNewUser(event){

  event.preventDefault();

  const technicalUsersContainer = document.getElementById('technical-users-container');
  const clonedUserElement = document.querySelector('.user-element').cloneNode(true);
  technicalUsersContainer.appendChild(clonedUserElement);

  setRemoveUserListener();

}

function setRemoveUserListener(){
  let removeUserBtn = document.querySelectorAll('.remove-user');

  if(removeUserHandlers.length !== 0){
    removeUserBtn.forEach((element, index) => {
      element.removeEventListener('click', removeUserHandlers[index]);
    });
    removeUserHandlers = [];
  }

  removeUserBtn.forEach(function(element) {

    const handler = () => {

      event.preventDefault();

      const obj = event.currentTarget;

      obj.closest('.user-element').remove();

    };

  removeUserHandlers.push(handler); // Save the reference to the handler

  element.addEventListener('click', handler);

});
}
