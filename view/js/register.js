// Cuando el contenido del documento HTML se ha cargado completamente, se ejecuta la función
document.addEventListener('DOMContentLoaded', () => {
  // Obtiene referencias a los elementos del formulario utilizando sus IDs
  const form = document.getElementById('registro-form');
  const email = document.getElementById('emailVisitor');
  const password = document.getElementById('passwordVisitor');
  const confirmPassword = document.getElementById('confirm-password');
  const strengthOutput = document.getElementById('strength-output'); // Actualiza el ID a 'strength-output'
  const passwordStrength = document.getElementById('password-strength');

  // Función para mostrar un mensaje de error en un campo de entrada
  const showError = (input, message) => {
    const errorSpan = input.parentElement.querySelector('.error');
    errorSpan.textContent = message;
    errorSpan.style.display = 'block';
    input.setCustomValidity('');
  };

  // Función para ocultar el mensaje de error de un campo de entrada
  const hideError = (input) => {
    const errorSpan = input.parentElement.querySelector('.error');
    errorSpan.style.display = 'none';
    input.setCustomValidity('');
  };

  // Función para verificar si las contraseñas coinciden
  const checkPasswordsMatch = () => {
    if (password.value !== confirmPassword.value) {
      showError(confirmPassword, 'Las contraseñas no coinciden');
    } else {
      hideError(confirmPassword);
    }
  };

  // Función para verificar la fortaleza de la contraseña
  const checkPasswordStrength = () => {
    const regexWeak = /(?=.*[a-zA-Z0-9]).*/;
    const regexMedium = /(?=.*[a-zA-Z])(?=.*[0-9]).*/;
    const regexStrong = /(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!@#$%^&*]).*/;

    if (regexStrong.test(password.value)) {
      strengthOutput.innerText = 'Segura';
      strengthOutput.classList.remove('medium', 'weak');
      strengthOutput.classList.add('strong');
    } else if (regexMedium.test(password.value)) {
      strengthOutput.innerText = 'Media';
      strengthOutput.classList.remove('strong', 'weak');
      strengthOutput.classList.add('medium');
    } else if (regexWeak.test(password.value)) {
      strengthOutput.innerText = 'Débil';
      strengthOutput.classList.remove('strong', 'medium');
      strengthOutput.classList.add('weak');
    } else {
      strengthOutput.innerText = '';
      strengthOutput.classList.remove('strong', 'medium', 'weak');
    }

    if (password.value.length > 0) {
      passwordStrength.style.display = 'block';
    } else {
      passwordStrength.style.display = 'none';
    }
  };

  // Función para verificar la validez del correo electrónico
  const checkEmailValidity = () => {
    const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!regexEmail.test(email.value)) {
      showError(
        email,
        'El formato de email no es válido, debe ser name@example.com'
      );
    } else {
      hideError(email);
    }
  };

  // Agrega event listeners a los campos de entrada para realizar las validaciones correspondientes
  confirmPassword.addEventListener('input', checkPasswordsMatch);
  password.addEventListener('input', checkPasswordStrength);
  email.addEventListener('input', checkEmailValidity);
});
