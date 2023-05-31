// Escucha el evento de carga del documento.
document.addEventListener('DOMContentLoaded', function () {
  // Referencia al botón hamburguesa.
  const hamburger = document.querySelector('.hamburger');
  // Referencia al menú móvil.
  const navMobile = document.querySelector('.nav-mobile');

  // Escucha el evento del botón hamburguesa.
  hamburger.addEventListener('click', function () {
    console.log('Hamburger clicked');
    // Cambia la clase 'open' en el botón hamburguesa.
    hamburger.classList.toggle('open');
    // Cambia la clase 'visible' en el menú móvil.
    navMobile.classList.toggle('visible');
  });
});

//Escucha clic en el documento.
document.addEventListener('click', function (event) {
  const navMobile = document.querySelector('.nav-mobile');
  const hamburger = document.querySelector('.hamburger');

  // Si el clic ocurrió fuera del menú móvil y del botón hamburguesa, y el menú móvil está visible
  if (
    !navMobile.contains(event.target) &&
    !hamburger.contains(event.target) &&
    navMobile.classList.contains('visible')
  ) {
    //quita la clase 'visible' de navMobile
    navMobile.classList.remove('visible');
    //quita la clase 'open' de Hamburguer
    hamburger.classList.remove('open');
  }
});
