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

/* MAPA */

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
