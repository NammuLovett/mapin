//HAMB

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

// Obtén el contexto de dibujo en un elemento canvas con id 'myChart'
const ctx = document.getElementById('myChart').getContext('2d');

// Crea un nuevo gráfico PolarArea utilizando la biblioteca Chart.js
const myChart = new Chart(ctx, {
  type: 'polarArea', // Especifica el tipo de gráfico
  data: {
    labels: ['Red', 'Green', 'Yellow', 'Grey', 'Blue'], // Etiquetas de los datos
    datasets: [
      {
        data: [12, 19, 3, 17, 28], // Los datos a graficar
        // Colores de fondo para cada dato
        backgroundColor: [
          'rgba(255, 99, 132, 0.5)',
          'rgba(75, 192, 192, 0.5)',
          'rgba(255, 205, 86, 0.5)',
          'rgba(201, 203, 207, 0.5)',
          'rgba(54, 162, 235, 0.5)',
        ],
        // Colores de los bordes para cada dato
        borderColor: [
          'rgba(255, 99, 132, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(255, 205, 86, 1)',
          'rgba(201, 203, 207, 1)',
          'rgba(54, 162, 235, 1)',
        ],
        borderWidth: 2, // Ancho del borde
      },
    ],
  },
  options: {
    // Configuraciones adicionales
  },
});

// Selecciona todos los elementos con la clase 'icon-link'
const iconLinks = document.querySelectorAll('.icon-link');

// Define un objeto que mapea los textos actuales de los botones a sus estados activo e inactivo
const buttonTexts = {
  // Contenido aquí...
};

// Recorre todos los elementos 'icon-link'
iconLinks.forEach((iconLink) => {
  // Añade un escuchador de eventos 'click' a cada elemento 'icon-link'
  iconLink.addEventListener('click', (event) => {
    // Código para manejar el evento click aquí...
  });
});

// Añade un escuchador de eventos 'DOMContentLoaded' al documento
document.addEventListener('DOMContentLoaded', function () {
  var ciudad = 'Ceuta';
  var clave_api = '8f9c4b755a41340f153993b24855c8fd';

  // Realiza una solicitud a la API de OpenWeatherMap
  fetch(
    `https://api.openweathermap.org/data/2.5/weather?q=${ciudad}&appid=${clave_api}&lang=es`
  )
    .then((response) => response.json()) // Convierte la respuesta en JSON
    .then((data) => {
      var iconCode = data.weather[0].icon;
      var iconUrl = 'https://openweathermap.org/img/w/' + iconCode + '.png';

      // Obtiene el elemento de imagen con id 'weather-img' y establece su atributo 'src' a la URL del icono
      var imgElement = document.getElementById('weather-img');
      imgElement.src = iconUrl;

      // Obtén el elemento de descripción y establece su texto a la descripción del clima
      var descriptionElement = document.getElementById('weather-description');
      descriptionElement.textContent = data.weather[0].description;
    });
});
