//HAMBURGUESITA

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

/* TIEMPO */

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

      // Convierte la temperatura de Kelvin a Celsius
      var tempCelsius = data.main.temp - 273.15;

      // Obtén el elemento de temperatura y establece su texto a la temperatura en grados centígrados
      var tempElement = document.getElementById('weather-temperature');
      tempElement.textContent = tempCelsius.toFixed(2) + ' °C';

      // Añade la velocidad del viento
      var windSpeed = data.wind.speed;

      // Obtén el elemento del viento y establece su texto a la velocidad del viento
      var windElement = document.getElementById('weather-wind');
      windElement.textContent = 'Viento: ' + windSpeed + ' m/s';

      // Añade la humedad
      var humidity = data.main.humidity;

      // Obtén el elemento de humedad y establece su texto a la humedad
      var humidityElement = document.getElementById('weather-humidity');
      humidityElement.textContent = 'Humedad: ' + humidity + ' %';

      // Añade la dirección del viento
      var windDirection = data.wind.deg;
      var cardinalDirections = [
        'N',
        'NE',
        'E',
        'SE',
        'S',
        'SO',
        'O',
        'NO',
        'N',
      ];
      var cardinalDirection =
        cardinalDirections[Math.round(windDirection / 45)];

      // Obtén el elemento de dirección del viento y establece su texto a la dirección del viento
      var windDirectionElement = document.getElementById(
        'weather-wind-direction'
      );
      windDirectionElement.textContent =
        'Dirección del viento: ' + cardinalDirection;
    });
});

/* BOTONES VISTA DETALLE LUGAR */

/* FAVORITO */

// Función que se ejecuta cuando se hace clic en el botón de favorito
function toggleFavorited(event) {
  // Evita que se ejecute la acción por defecto del evento, que sería navegar al href del enlace
  event.preventDefault();

  // Encuentra el enlace que ha sido clicado
  let link = event.target.closest('a');
  // Encuentra el icono dentro del enlace que ha sido clicado
  let icon = link.querySelector('i');
  // Obtiene el id del lugar del atributo 'data-place' del enlace
  let idPlace = link.getAttribute('data-place');

  // Realiza una solicitud GET al servidor para marcar/desmarcar el lugar como favorito
  fetch('index.php?action=toggleFavorited&idPlace=' + idPlace)
    // Una vez que la respuesta ha sido recibida
    .then((response) => {
      // Si la respuesta no es exitosa (el código de estado HTTP no está en el rango 200-299)
      if (!response.ok) {
        // Lanza un error que será capturado por la promesa más cercana con un bloque catch
        throw new Error('HTTP error ' + response.status);
      }
      // Si la respuesta es exitosa, parsea el cuerpo de la respuesta como JSON
      return response.json();
    })
    // Una vez que el cuerpo de la respuesta ha sido parseado
    .then((json) => {
      // Si la respuesta indica que la operación fue exitosa
      if (json.success) {
        // Cambia la clase 'activo' del enlace según si el lugar es favorito o no
        link.classList.toggle('activo', json.favorited);

        // Añade la animación al icono
        icon.animate(
          [
            // Estado inicial de la animación
            { transform: 'scale(1)', opacity: 1 },
            // Estado intermedio de la animación
            { transform: 'scale(1.5)', opacity: 0.5 },
            // Estado final de la animación
            { transform: 'scale(1)', opacity: 1 },
          ],
          {
            // Duración de la animación
            duration: 500,
            // Función de suavizado de la animación
            easing: 'ease-in-out',
          }
        );

        // Si la respuesta indica que hubo un error
      } else {
        // Escribe el mensaje de error en la consola
        console.error(json.error);
      }
    })
    // Si ocurre algún error en alguna de las promesas anteriores
    .catch(function () {
      // Escribe un mensaje genérico de error en la consola
      console.error('Error en la solicitud');
    });
}
/* BOTÓN VISITADO */

// Función que se ejecuta cuando se hace clic en el botón de visitado
function toggleVisited(event) {
  event.preventDefault();

  let link = event.target.closest('a');
  let icon = link.querySelector('i');
  let span = link.querySelector('span');
  let idPlace = link.getAttribute('data-place');

  fetch('index.php?action=toggleVisited&idPlace=' + idPlace)
    .then((response) => {
      if (!response.ok) {
        throw new Error('HTTP error ' + response.status);
      }
      return response.json();
    })
    .then((json) => {
      if (json.success) {
        link.classList.toggle('activo');
        icon.classList.toggle('fa-check');
        icon.classList.toggle('fa-times');
        span.textContent = json.Visitado ? 'Visitado' : 'No visitado';

        icon.animate(
          [
            { transform: 'scale(1)', opacity: 1 },
            { transform: 'scale(1.3)', opacity: 0.5 },
            { transform: 'scale(1)', opacity: 1 },
          ],
          {
            duration: 500,
            easing: 'ease-in-out',
          }
        );
      } else {
        console.error(json.error);
      }
    })
    .catch(function (error) {
      console.error('Error en la solicitud:', error);
    });
}
