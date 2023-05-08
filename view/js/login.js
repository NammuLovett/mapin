document.addEventListener('DOMContentLoaded', () => {
  const form = document.querySelector('form');

  const showError = (input) => {
    const errorSpan = input.parentElement.querySelector('.error');
    errorSpan.style.display = 'block';
  };

  const hideError = (input) => {
    const errorSpan = input.parentElement.querySelector('.error');
    errorSpan.style.display = 'none';
  };

  form.addEventListener('submit', (e) => {
    e.preventDefault();

    let hasErrors = false;
    const inputs = form.querySelectorAll('input');

    for (const input of inputs) {
      if (!input.checkValidity()) {
        hasErrors = true;
        showError(input);
      } else {
        hideError(input);
      }
    }

    if (!hasErrors) {
      alert('Inicio de sesión exitoso');
      form.reset();
    }
  });
});
