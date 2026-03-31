const form = document.querySelector('.login-form'); 
form.addEventListener('submit', function(e) {
  e.preventDefault(); 

  const email = document.getElementById('email').value.trim();
  const password = document.getElementById('password').value.trim();
  const alert = document.getElementById('loginAlert');


})