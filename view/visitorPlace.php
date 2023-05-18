<?php
$mapin = $_SESSION['mapin'];
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
                    <li>
                        <a href="index.php?action=verVisitorDashboard"><i class="fas fa-home"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="index.php?action=verVisitorDescubre"><i class="fas fa-paper-plane"></i> Descubre</a>
                    </li>
                    <li>
                        <a href="index.php?action=verVisitorFavorito"><i class="fas fa-star"></i> Favoritos</a>
                    </li>
                    <li>
                        <a href="index.php?action=verVisitorMapa"><i class="fas fa-map"></i> Mapa</a>
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
                    <li>
                        <a href="index.php?action=verVisitorDashboard"><i class="fas fa-home"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="index.php?action=verVisitorDescubre"><i class="fas fa-paper-plane"></i> Descubre</a>
                    </li>
                    <li>
                        <a href="index.php?action=verVisitorFavorito"><i class="fas fa-star"></i> Favoritos</a>
                    </li>
                    <li>
                        <a href="index.php?action=verVisitorMapa"><i class="fas fa-map"></i> Mapa</a>
                    </li>
                    <li>
                        <a href="index.php?action=cerrarSesion"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </li>
                </ul>
            </nav>
        </section>

        <!-- Segunda columna: Contenido principal -->
        <section class="columna-2">

            <div class="place-image">
                <img src="zimg/places/image4.jpg" alt="" srcset="" class="place-image-img">
            </div>
            <?php if ($mapin) : ?>
                <div class="place-details">
                    <div class="icon-links-container">
                        <?php if ($hasVisited) : ?>
                            <a href="#" class="icon-link activo" id="link-visitado" onclick="/* llamar a funcion */">
                                <div class="circle">
                                    <i class="fas fa-check"></i>
                                </div>
                                <span>Visitado</span>
                                <span> <?php echo $visitDate; ?></span>
                            </a>
                        <?php else : ?>
                            <a href="#" class="icon-link" id="link-no-visitado" onclick="/* llamar a funcion */">
                                <div class="circle">
                                    <i class="fas fa-times"></i>
                                </div>
                                <span>No visitado</span>
                            </a>
                        <?php endif; ?>

                        <?php if ($isFavorited) : ?>
                            <a href="#" class="icon-link activo" id="link-favorito">
                                <div class=" circle">
                                    <i class="fas fa-star"></i>
                                </div>
                                <span>Favorito</span>
                            </a>
                        <?php else : ?>
                            <a href="#" class="icon-link" id="link-favorito">
                                <div class="circle">
                                    <i class="fas fa-star"></i>
                                </div>
                                <span>Favorito</span>
                            </a>
                        <?php endif; ?>
                    </div>

                    <div class="place-info">
                        <h1 class="place-title"><?php echo $mapin->getNamePlace(); ?></h1>
                        <p class="place-location"><i class="fa-solid fa-location-dot"></i> Ceuta, España</p>
                        <h2 class="info-title">Información</h2>
                        <p><?php echo $mapin->getInfoPlace(); ?></p>
                        <h2 class="description-title">Descripción</h2>
                        <p><?php echo $mapin->getDescriptionPlace(); ?></p>
                    </div>
                    <div id="map" style="height: 400px; width: 100%;"></div>
                </div>
            <?php endif; ?>


        </section>
        <!-- Tercera columna: Perfil y lugares visitados -->
        <section class="columna-3">
            <!-- c3 :Primera fila -->
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
            <div class="fila-2">


                <h3>Tus estadísticas</h3>
                <div class="fila-2">

                    <div class="estadisticas">

                        <div id="percentage">
                            <p>Has visitado el <?= $percentageVisited ?>% de los lugares disponibles.</p>
                        </div>
                        <div>
                            <canvas id="totalChart"></canvas>
                        </div>

                        <div class="chart-container">
                            <h2>Categorías</h2>
                            <canvas class="myChart" id="myChart"></canvas>
                        </div>

                    </div>
                </div>
                <!-- C3 - Segunda fila: Lugares visitados -->

        </section>
    </main>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJXT7vkQCPszRpdMfAJO7hMr55J31aZug&libraries=geometry&callback=initMap" async defer></script>

    <script>
        // Función para inicializar el mapa
        function initMap() {
            // Define las coordenadas del lugar
            var placeLocation = {
                lat: <?php echo $mapin->getLatPlace(); ?>,
                lng: <?php echo $mapin->getLonPlace(); ?>
            };

            // Crea una nueva instancia del mapa de Google Maps
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: placeLocation,
                styles: [{
                    featureType: 'poi',
                    stylers: [{
                        visibility: 'off'
                    }]
                }]
            });

            // Crea un nuevo marcador en el mapa para el lugar
            var placeMarker = new google.maps.Marker({
                position: placeLocation,
                map: map,
                title: "<?php echo $mapin->getNamePlace(); ?>"
            });

            // Comprueba si la geolocalización está habilitada en el navegador del usuario
            if (navigator.geolocation) {
                // Obtén la ubicación actual del usuario
                navigator.geolocation.getCurrentPosition(function(position) {
                    // Define las coordenadas de la ubicación del usuario
                    var userLocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    // Crea un nuevo marcador en el mapa para la ubicación del usuario
                    var userMarker = new google.maps.Marker({
                        position: userLocation,
                        map: map,
                        title: "Tu ubicación",
                        icon: {
                            url: 'zimg/avatar/avatar.png',
                            scaledSize: new google.maps.Size(40, 40)
                        }
                    });

                    // Calcula la distancia entre la ubicación del usuario y el lugar
                    var userLatLng = new google.maps.LatLng(userLocation.lat, userLocation.lng);
                    var placeLatLng = new google.maps.LatLng(placeLocation.lat, placeLocation.lng);
                    var distance = google.maps.geometry.spherical.computeDistanceBetween(userLatLng, placeLatLng);
                    var distanceText = (distance / 1000).toFixed(2) + " km";

                    // Crea una ventana de información para el marcador del lugar
                    var infoWindowContent = "<h3><?php echo $mapin->getNamePlace(); ?></h3><p><?php echo $mapin->getInfoPlace(); ?>.</p><p>Distancia desde tu ubicación: " + distanceText + "</p><a href='https://www.google.com/maps/search/?api=1&query=<?php echo $mapin->getLatPlace(); ?>,<?php echo $mapin->getLonPlace(); ?>' target='_blank'>Ir al lugar</a>";

                    // Crea una instancia de la ventana de información
                    var infoWindow = new google.maps.InfoWindow({
                        content: infoWindowContent
                    });

                    // Asocia un evento de clic al marcador del lugar para abrir la ventana de información
                    placeMarker.addListener('click', function() {
                        infoWindow.open(map, placeMarker);
                    });

                }, function() {
                    // Muestra una alerta si la geolocalización no está habilitada o ha sido desactivada
                    alert('Error: El navegador no permite la geolocalización, o esta ha sido desactivada.');
                });
            } else {
                // Muestra una alerta si el navegador no soporta la geolocalización
                alert('Error: Tu navegador no soporta la geolocalización.');
            }
        }
    </script>


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

    <script src="view/js/visitor.js"></script>




</body>

</html>