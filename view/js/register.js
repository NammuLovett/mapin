document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('registro-form');
  const password = document.getElementById('passwordVisitor'); // Corrección aquí
  const confirmPassword = document.getElementById('confirm-password');
  const strengthOutput = document.getElementById('strength-output');
  const passwordStrength = document.getElementById('password-strength');

  const showError = (input) => {
    const errorSpan = input.parentElement.querySelector('.error');
    errorSpan.style.display = 'block';
  };

  const hideError = (input) => {
    const errorSpan = input.parentElement.querySelector('.error');
    errorSpan.style.display = 'none';
  };

  const checkPasswordsMatch = () => {
    if (password.value !== confirmPassword.value) {
      showError(confirmPassword);
    } else {
      hideError(confirmPassword);
    }
  };

  const checkPasswordStrength = () => {
    const regexWeak = /(?=.*[a-zA-Z0-9]).*/;
    const regexMedium = /(?=.*[a-zA-Z])(?=.*[0-9]).*/;
    const regexStrong = /(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!@#$%^&*]).*/;

    if (regexStrong.test(password.value)) {
      strengthOutput.innerText = 'Segura';
    } else if (regexMedium.test(password.value)) {
      strengthOutput.innerText = 'Media';
    } else if (regexWeak.test(password.value)) {
      strengthOutput.innerText = 'Débil';
    } else {
      strengthOutput.innerText = '';
    }

    if (password.value.length > 0) {
      passwordStrength.style.display = 'block';
    } else {
      passwordStrength.style.display = 'none';
    }
  };

  confirmPassword.addEventListener('input', checkPasswordsMatch);
  password.addEventListener('input', checkPasswordStrength);
});
