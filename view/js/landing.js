document.addEventListener('DOMContentLoaded', function () {
  const hamburger = document.querySelector('.hamburger');
  const navMobile = document.querySelector('.nav-mobile');

  hamburger.addEventListener('click', function () {
    console.log('Hamburger clicked');
    hamburger.classList.toggle('open');
    navMobile.classList.toggle('visible');
  });
});

document.addEventListener('click', function (event) {
  const navMobile = document.querySelector('.nav-mobile');
  const hamburger = document.querySelector('.hamburger');

  if (
    !navMobile.contains(event.target) &&
    !hamburger.contains(event.target) &&
    navMobile.classList.contains('visible')
  ) {
    navMobile.classList.remove('visible');
    hamburger.classList.remove('open');
  }
});
