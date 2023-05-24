<?php

/* var_dump($places_json); */
/* var_dump($places); */

/* echo $_SESSION['visitor'];
var_dump($_SESSION); */
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MAP!N!</title>
    <!-- Estilos principales -->
    <link rel="stylesheet" href="view/css/visitorStyle.css" />
    <!-- Icono del sitio -->
    <link rel="icon" href="zimg/logo/Logotipo.svg" type="image/svg+xml" />
    <!-- Fuente personalizada Lato -->
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet" />
    <!-- Iconos de Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <!-- Contenedor principal -->
    <main class="grid-container">
        <!-- Primera columna: Navegación -->
        <section class="columna-1">
            <!-- Logo -->
            <div class="logo">
                <a href="index.php?action=verVisitorDashboard"><img src="zimg/logo/logoHOR.svg" alt="Logo MAP!N" /></a>
            </div>
            <!-- Menú de navegación -->
            <nav role="navigation" aria-label="Menú de navegación principal">
                <ul>
                    <li class="activo">
                        <a href="index.php?action=verVisitorDashboard"><i class="fas fa-home"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="index.php?action=verVisitorDescubre"><i class="fas fa-paper-plane"></i> Descubre</a>
                    </li>
                    <li>
                        <a href="index.php?action=verVisitorFavorito"><i class="fas fa-star"></i> Favoritos</a>
                    </li>
                    <li>
                        <a href="index.php?action=verVisitorMapa"><i class="fas fa-map"></i> Categorías</a>
                    </li>
                    <li>
                        <a href="index.php?action=cerrarSesion"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </li>
                </ul>
            </nav>
            <!-- HAMBURGUESA -->
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <nav class="nav-mobile" role="navigation" aria-labelledby="mobile-menu-label">
                <ul>
                    <li class="activo">
                        <a href="index.php?action=verVisitorDashboard"><i class="fas fa-home"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="index.php?action=verVisitorDescubre"><i class="fas fa-paper-plane"></i> Descubre</a>
                    </li>
                    <li>
                        <a href="index.php?action=verVisitorFavorito"><i class="fas fa-star"></i> Favoritos</a>
                    </li>
                    <li>
                        <a href="index.php?action=verVisitorMapa"><i class="fas fa-map"></i> Categorías</a>
                    </li>
                    <li>
                        <a href="index.php?action=cerrarSesion"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </li>
                </ul>
            </nav>
        </section>

        <!-- Segunda columna: Contenido principal -->
        <section class="columna-2">
            <!-- Primera fila: Bienvenida -->
            <div class="fila-1">
                <h1>Hola, <?php echo $visitor->getNameVisitor(); ?>!</h1>
                <p>Mira qué lugares están a un kilómetro a tu alrededor</p>
            </div>
            <!-- Mapa google -->
            <div id="map" style="width: 100%; height: 500px;"></div>
            <div class="fila-2">
                <h3>Tus estadísticas</h3>

                <div class="estadisticas">
                    <div id="percentage">
                        <h2>Progreso del Viajero</h3>
                            <div id="progress-container" class="progress-container">
                                <div id="progress-bar" class="progress-bar"></div>
                            </div>
                            <p>Has visitado el <span><?= $percentageVisited ?>%</span> de los lugares de Ceuta.</p>
                    </div>
                    <h2>Categorías</h3>
                        <div class="chart-container">
                            <canvas id="totalChart"></canvas>
                            <canvas class="myChart" id="myChart"></canvas>
                        </div>

                </div>
            </div>
        </section>
        <!-- Tercera columna: Perfil y lugares visitados -->
        <section class="columna-3">
            <!-- c3 :Primera fila: Perfil -->
            <div class="fila-1">
                <div class="avatar">
                    <!--   <img src="../zimg/avatar/avatar.png" alt="Avatar de usuario" /> -->
                </div>
                <h4><?php echo $visitor->getNameVisitor(); ?></h4>
                <p>Amante de los viajes</p>
            </div>

            <!--  Previsión del tiempo -->
            <div class="fila-2">
                <h3>Previsión del tiempo</h3>
                <div class="previsión">
                    <img id="weather-img" src="" alt="Imagen del clima">
                    <p id="weather-description"></p>
                    <p id="weather-temperature"></p>
                    <p id="weather-wind"></p>
                    <p id="weather-wind-direction"></p>
                    <p id="weather-humidity"></p>
                </div>
            </div>
        </section>
    </main>
    <!-- Api KEY google -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJXT7vkQCPszRpdMfAJO7hMr55J31aZug&callback=initMap&libraries=geometry" type="text/javascript"></script>
    <!-- Mapa Google -->
    <script>
        // Función para inicializar el mapa
        function initMap() {
            var places = <?php echo $places_json; ?>;
            console.log(places);

            // Comprueba si la geolocalización está habilitada en el navegador del usuario
            if (navigator.geolocation) {
                // Obtén la ubicación actual del usuario
                navigator.geolocation.getCurrentPosition(function(position) {
                    var userLocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    // Crea una nueva instancia del mapa de Google Maps centrada en la ubicación del usuario
                    var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 15,
                        center: userLocation,
                        gestureHandling: 'cooperative',
                        styles: [{
                            featureType: 'poi',
                            stylers: [{
                                visibility: 'off'
                            }]
                        }]
                    });

                    var userMarker = new google.maps.Marker({
                        position: userLocation,
                        map: map,
                        title: "Tu ubicación",
                        icon: {
                            url: 'zimg/avatar/avatar.png',
                            scaledSize: new google.maps.Size(40, 40)
                        }
                    });

                    var userLatLng = new google.maps.LatLng(userLocation.lat, userLocation.lng);

                    // Mantén una referencia a la ventana de información abierta actual
                    var currentInfoWindow = null;

                    places.forEach(function(place) {
                        var placeLocation = {
                            lat: parseFloat(place.latPlace),
                            lng: parseFloat(place.lonPlace)
                        };

                        var placeLatLng = new google.maps.LatLng(placeLocation.lat, placeLocation.lng);

                        var distance = google.maps.geometry.spherical.computeDistanceBetween(userLatLng, placeLatLng);

                        // Decide cómo se muestra la distancia dependiendo de si es más o menos de 1 km
                        var displayDistance = distance < 1000 ? distance.toFixed(2) + " metros" : (distance / 1000).toFixed(2) + " km";

                        if (distance <= 1000) {
                            var placeMarker = new google.maps.Marker({
                                position: placeLocation,
                                map: map,
                                title: place.namePlace
                            });

                            var infoWindowContent = "<h3>" + place.namePlace + "</h3><p>" + place.infoPlace + ".</p><p>Distancia desde tu ubicación: " + displayDistance + "</p><a href='https://www.google.com/maps/search/?api=1&query=" + place.latPlace + "," + place.lonPlace + "' target='_blank'>Ir al lugar</a><br><a href='index.php?action=verVisitorPlace&id=" + place.idPlace + "'>Ver detalles del lugar</a>";

                            var infoWindow = new google.maps.InfoWindow({
                                content: infoWindowContent
                            });

                            placeMarker.addListener('click', function() {
                                // Cierra la ventana de información abierta actual
                                if (currentInfoWindow) {
                                    currentInfoWindow.close();
                                }

                                infoWindow.open(map, placeMarker);
                                currentInfoWindow = infoWindow;
                            });
                        }
                    });

                    // Cierra la ventana de información cuando se hace clic en cualquier lugar del mapa
                    google.maps.event.addListener(map, 'click', function() {
                        if (currentInfoWindow) {
                            currentInfoWindow.close();
                        }
                    });

                }, function() {
                    alert('Error: El navegador no permite la geolocalización, o esta ha sido desactivada.');
                });
            } else {
                alert('Error: Tu navegador no soporta la geolocalización.');
            }
        }
    </script>



    <!-- Gráfico totales -->
    <script>
        const totalCtx = document.getElementById('totalChart').getContext('2d');

        const totalChart = new Chart(totalCtx, {
            type: 'pie',
            data: {
                labels: ['Total', 'Visitado'],
                datasets: [{
                    data: [<?= $totalPlaces ?>, <?= $visitedPlacesCount ?>],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(255, 99, 132, 0.5)',
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                    ],
                    borderWidth: 1
                }]
            },
        });
    </script>

    <!-- Gráfico categorías -->
    <script>
        // Obtén el contexto de dibujo en un elemento canvas con id 'myChart'
        const ctx = document.getElementById('myChart').getContext('2d');

        // Crea un nuevo gráfico PolarArea utilizando la biblioteca Chart.js
        const myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode(array_column($visitedCategoriesData, 'nameCategory')); ?>, // Etiquetas de los datos
                datasets: [{
                    data: <?php echo json_encode(array_column($visitedCategoriesData, 'visitedPlaces')); ?>, // Los datos a graficar, // Los datos a graficar
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
                }, ],
            },
            options: {
                // Configuraciones adicionales
            },
        });
    </script>
    <!-- Progress bar -->
    <script>
        var percentageVisited = <?= $percentageVisited ?>;

        document.getElementById('progress-bar').style.width = percentageVisited + '%';
    </script>

    <script src="view/js/visitor.js"></script>

</body>

</html>