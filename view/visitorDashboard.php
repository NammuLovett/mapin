<?php



$places = array_map(function ($place) {
    return $place->toArray();
}, Place::getAllPlaces());
$places_json = json_encode($places);

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
            <!-- Primera fila: Bienvenida y búsqueda -->
            <div class="fila-1">
                <h1>Hola, <?php echo $visitor->getNameVisitor(); ?>!</h1>
                <p>Te damos la bienvenida a la exploración.</p>
            </div>

            <div id="map" style="width: 100%; height: 500px;"></div>



        </section>
        <!-- Tercera columna: Perfil y lugares visitados -->
        <section class="columna-3">
            <!-- c3 :Primera fila: Perfil -->
            <div class="fila-1">
                <div class="avatar">
                    <!--                     <img src="../zimg/avatar/avatar.png" alt="Avatar de usuario" />
 -->
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


            <!-- C3 - Segunda fila: Lugares visitados -->
            <div class="fila-2">
                <div class="estadisticas">
                    <p>
                        Has visitado &lt;number&gt; de &lt;number&gt; lugares de interés
                        de Ceuta.
                    </p>
                    <div class="chart-container">
                        <canvas class="myChart" id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJXT7vkQCPszRpdMfAJO7hMr55J31aZug&callback=initMap&libraries=geometry" type="text/javascript"></script>

    <script>
        // Función para inicializar el mapa
        function initMap() {
            var places = <?php echo $places_json; ?>;

            console.log(places);
            // Comprueba si la geolocalización está habilitada en el navegador del usuario
            if (navigator.geolocation) {
                // Obtén la ubicación actual del usuario
                navigator.geolocation.getCurrentPosition(function(position) {
                    // Define las coordenadas de la ubicación del usuario
                    var userLocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    // Crea una nueva instancia del mapa de Google Maps centrada en la ubicación del usuario
                    var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 15,
                        center: userLocation,
                        styles: [{
                            featureType: 'poi',
                            stylers: [{
                                visibility: 'off'
                            }]
                        }]
                    });

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

                    // Crea un nuevo LatLng para la ubicación del usuario
                    var userLatLng = new google.maps.LatLng(userLocation.lat, userLocation.lng);

                    // Para cada lugar, crea un marcador si está a 1 km o menos de distancia
                    places.forEach(function(place) {
                        var placeLocation = {
                            lat: parseFloat(place.latPlace),
                            lng: parseFloat(place.lonPlace)
                        };

                        // Crea un nuevo LatLng para la ubicación del lugar
                        var placeLatLng = new google.maps.LatLng(placeLocation.lat, placeLocation.lng);

                        // Calcula la distancia entre la ubicación del usuario y el lugar
                        var distance = google.maps.geometry.spherical.computeDistanceBetween(userLatLng, placeLatLng);

                        // Si la distancia es de 1 km o menos, crea un marcador para el lugar
                        if (distance <= 1000) {
                            var placeMarker = new google.maps.Marker({
                                position: placeLocation,
                                map: map,
                                title: place.namePlace
                            });

                            /* Ventana de información */
                            var infoWindowContent = "<h3>" + place.namePlace + "</h3><p>" + place.infoPlace + ".</p><p>Distancia desde tu ubicación: " + (distance / 1000).toFixed(2) + " km</p><a href='https://www.google.com/maps/search/?api=1&query=" + place.latPlace + "," + place.lonPlace + "' target='_blank'>Ir al lugar</a><br><a href='index.php?action=verVisitorPlace&id=" + place.idPlace + "'>Ver detalles del lugar</a>";


                            var infoWindow = new google.maps.InfoWindow({
                                content: infoWindowContent
                            });

                            placeMarker.addListener('click', function() {
                                infoWindow.open(map, placeMarker);
                            });
                        }
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
    <script src="view/js/visitor.js"></script>

</body>

</html>