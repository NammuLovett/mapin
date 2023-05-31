//HAMBURGUESITA
//idem landing
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

      // Obtiene el elemento de descripción y establece su texto en el clima
      var descriptionElement = document.getElementById('weather-description');
      descriptionElement.textContent = data.weather[0].description;

      // Convierte la temperatura de Kelvin a Celsius
      var tempCelsius = data.main.temp - 273.15;

      // Obtiene el elemento de temperatura y establece el texto para la temperatura en grados centígrados
      var tempElement = document.getElementById('weather-temperature');
      tempElement.textContent = tempCelsius.toFixed(2) + ' °C';

      // Añade la velocidad del viento
      var windSpeed = data.wind.speed;

      // Obtiene el elemento del viento y establece el texto con la velocidad
      var windElement = document.getElementById('weather-wind');
      windElement.textContent = 'Viento: ' + windSpeed + ' m/s';

      // Añade la humedad
      var humidity = data.main.humidity;

      // Obtiene el elemento de humedad y establece el texto
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

      // Obtiene el elemento de dirección del viento y establece el texto
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

  // Realiza una solicitud GET al controlador para marcar/desmarcar el lugar como favorito
  fetch('index.php?action=toggleFavorited&idPlace=' + idPlace)
    // Una vez que la respuesta ha sido recibida
    .then((response) => {
      // Si la respuesta no es exitosa
      if (!response.ok) {
        // Lanza un error
        throw new Error('HTTP error ' + response.status);
      }
      // Si la respuesta es exitosa, respuesta como JSON
      return response.json();
    })
    .then((json) => {
      // Si la respuesta indica que la operación fue exitosa
      if (json.success) {
        // Cambia la clase 'activo' del enlace dependiendo de si el lugar es favorito o no
        link.classList.toggle('activo', json.favorited);

        // Añade la animación al icono
        icon.animate(
          [
            { transform: 'scale(1)', opacity: 1 },

            { transform: 'scale(1.8)', opacity: 0.5 },

            { transform: 'scale(1)', opacity: 1 },
          ],
          {
            // Duración de la animación
            duration: 500,
            // Función de movimiento de la animación
            easing: 'ease-in-out',
          }
        );

        // Si en la respuesta  hubo un error
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
// Se ejecuta cuando se hace clic en el botón de visitado
function toggleVisited(event) {
  // Evita que se ejecute la acción por defecto del evento, que sería navegar al href del enlace
  event.preventDefault();

  //idem fav
  let link = event.target.closest('a');
  let icon = link.querySelector('i');
  let span = link.querySelector('span');
  let dateSpan = link.querySelector('span[data-date]');
  let idPlace = link.getAttribute('data-place');

  // Verificar si el enlace tiene la clase 'lejos' y si el lugar no ha sido visitado
  if (link.classList.contains('lejos') && !link.classList.contains('activo')) {
    return; // Si está lejos y el lugar no ha sido visitado, regresar y no hacer nada
  }

  // Realiza una solicitud GET al controlador para marcar/desmarcar el lugar como Visitado
  fetch('index.php?action=toggleVisited&idPlace=' + idPlace)
    .then((response) => {
      //si la respuesta es KO, muestra error
      if (!response.ok) {
        throw new Error('HTTP error ' + response.status);
      }
      //respuesta es OK, convierte la respuesta en JSON
      return response.json();
    })
    .then((json) => {
      if (json.success) {
        //Cambia la clase 'activo' del enlace, cambia elicono
        link.classList.toggle('activo');
        icon.classList.toggle('fa-check');
        icon.classList.toggle('fa-times');

        // Actualizar el texto cuando está lejos y se ha desmarcado como visitado
        if (!json.Visitado && link.classList.contains('lejos')) {
          span.textContent = 'Estás lejos';
        } else {
          span.textContent = json.Visitado ? 'Visitado' : 'No visitado';
        }

        if (json.Visitado) {
          if (!dateSpan) {
            // Si no existe un span para la fecha, se añade.
            dateSpan = document.createElement('span');
            link.appendChild(dateSpan);
          }
          // Asigna la fecha de visita al elemento 'span' y se muestra
          dateSpan.textContent = json.fecha;
          dateSpan.style.display = 'inline';
        } else {
          // Si no se ha visitado, oculta el elemento 'span' de la fecha
          if (dateSpan) {
            dateSpan.style.display = 'none';
          }
        }

        // Añade la animación al icono

        icon.animate(
          [
            { transform: 'scale(1)', opacity: 1 },
            { transform: 'scale(1.8)', opacity: 0.5 },
            { transform: 'scale(1)', opacity: 1 },
          ],
          {
            duration: 500,
            easing: 'ease-in-out',
          }
        );
      } else {
        //imprime errores por consola
        console.error(json.error);
      }
    })
    .catch(function (error) {
      //imprime errores por consola
      console.error('Error en la solicitud:', error);
    });
}
