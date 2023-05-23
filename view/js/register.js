// Si el documento HTML se ha cargado completamente, se ejecuta la función
document.addEventListener('DOMContentLoaded', () => {
  try {
    // Referencias a los elementos del formulario utilizando sus IDs
    const form = document.getElementById('registro-form');
    const email = document.getElementById('emailVisitor');
    const password = document.getElementById('passwordVisitor');
    const confirmPassword = document.getElementById('confirm-password');
    const strengthOutput = document.getElementById('strength-output'); // Actualiza el ID a 'strength-output'
    const passwordStrength = document.getElementById('password-strength');

    // Mensaje de error en input
    const showError = (input, message) => {
      const errorSpan = input.parentElement.querySelector('.error');
      errorSpan.textContent = message;
      errorSpan.style.display = 'block';
      input.setCustomValidity('');
    };

    // Ocultar el mensaje de error de los inpts
    const hideError = (input) => {
      const errorSpan = input.parentElement.querySelector('.error');
      errorSpan.style.display = 'none';
      input.setCustomValidity('');
    };

    // Verifica si las contraseñas coinciden
    const checkPasswordsMatch = () => {
      if (password.value !== confirmPassword.value) {
        showError(confirmPassword, 'Las contraseñas no coinciden');
      } else {
        hideError(confirmPassword);
      }
    };

    // Verificar la fortaleza de la contraseña
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

    // Agrega event listeners a los inputs para realizar las validaciones
    confirmPassword.addEventListener('input', () => {
      try {
        checkPasswordsMatch();
      } catch (error) {
        console.error(
          'Ocurrió un error al verificar la coincidencia de las contraseñas:',
          error
        );
      }
    });

    password.addEventListener('input', () => {
      try {
        checkPasswordStrength();
      } catch (error) {
        console.error(
          'Ha habido un error al verificar la fortaleza de la contraseña:',
          error
        );
      }
    });

    email.addEventListener('input', () => {
      try {
        checkEmailValidity();
      } catch (error) {
        console.error(
          'Ha habido un error al verificar la validez del correo electrónico:',
          error
        );
      }
    });
  } catch (error) {
    console.error('Ha habido  error:', error);
  }
});
