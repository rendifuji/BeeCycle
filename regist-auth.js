const registerForm = document.querySelector('.register-form');
if (registerForm) {
  registerForm.addEventListener('submit', function(e) {
    e.preventDefault();

    const email = document.querySelector('input[type="email"]').value.trim();
    const alert = document.getElementById('registerAlert');


    if (!email.endsWith('@binus.ac.id') && !email.endsWith('@binus.edu')) {
      alert.textContent = 'Access denied - Only binus.ac.id or binus.edu emails are allowed';
      alert.classList.remove('hidden');
      setTimeout(() => {
        alert.classList.add('hidden');
      }, 3000);
      return;
    }
        if(password.length < 6) {
        alert.textContent = 'Password must be at least 6 characters long';
        alert.classList.remove('hidden');
        setTimeout(() => {
          alert.classList.add('hidden');
        }, 3000);
        return
    }


    alert.textContent = 'Registration test successful!';
    alert.classList.remove('alert-error');
    alert.classList.add('alert-success');
    alert.classList.remove('hidden');

    setTimeout(() => {
      alert.classList.add('hidden');
      alert.classList.remove('alert-success');
      alert.classList.add('alert-error');
    }, 3000);
  });
}