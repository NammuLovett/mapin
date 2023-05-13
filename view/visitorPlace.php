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
            <nav>
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

                        <a href="#" class="icon-link" id="link-visitado" onclick="">
                            <div class="circle">
                                <i class="fas fa-check"></i>
                            </div>
                            <span>No Visitado</span>
                        </a>
                        <a href="#" class="icon-link" id="link-favorito">
                            <div class="circle">
                                <i class="fas fa-star"></i>
                            </div>
                            <span>No Favorito</span>
                        </a>

                    </div>


                    <!-- --- -->
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
            <!-- c3 :Primera fila: Perfil -->
            <div class="fila-1">
                <h3>Tus estadísticas</h3>
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
            <!-- C3 - Segunda fila: Lugares visitados -->
            <div class="fila-2">
                <h3>Previsión del tiempo</h3>
                <div class="previsión">
                    <img id="weather-img" src="" alt="Imagen del clima">
                    <p id="weather-description"></p>
                </div>
            </div>
        </section>
    </main>

    <script src="view/js/visitor.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJXT7vkQCPszRpdMfAJO7hMr55J31aZug"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJXT7vkQCPszRpdMfAJO7hMr55J31aZug&callback=initMap" async defer></script>
    <script>
        function initMap() {
            var placeLocation = {
                lat: <?php echo $mapin->getLatPlace(); ?>,
                lng: <?php echo $mapin->getLonPlace(); ?>
            };

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


            var placeMarker = new google.maps.Marker({
                position: placeLocation,
                map: map,
                title: "<?php echo $mapin->getNamePlace(); ?>"
            });

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var userLocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };


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
                    var placeLatLng = new google.maps.LatLng(<?php echo $mapin->getLatPlace(); ?>, <?php echo $mapin->getLonPlace(); ?>);
                    var distance = google.maps.geometry.spherical.computeDistanceBetween(userLatLng, placeLatLng);
                    var distanceText = (distance / 1000).toFixed(2) + " km";

                    var infoWindowContent = "<h3><?php echo $mapin->getNamePlace(); ?></h3><p><?php echo $mapin->getInfoPlace(); ?>.</p><p>Distancia desde tu ubicación: " + distanceText + "</p><a href='https://www.google.com/maps/search/?api=1&query=<?php echo $mapin->getLatPlace(); ?>,<?php echo $mapin->getLonPlace(); ?>' target='_blank'>Ir al lugar</a>";

                    var infoWindow = new google.maps.InfoWindow({
                        content: infoWindowContent
                    });

                    placeMarker.addListener('click', function() {
                        infoWindow.open(map, placeMarker);
                    });

                }, function() {
                    alert('Error: El navegador no permite la geolocalización, o esta ha sido desactivada.');
                });
            } else {
                alert('Error: Tu navegador no soporta la geolocalización.');
            }


            var infoWindow = new google.maps.InfoWindow({
                content: "<h3><?php echo $mapin->getNamePlace(); ?></h3><p><?php echo $mapin->getInfoPlace(); ?>.</p><a href='https://www.google.com/maps/search/?api=1&query=" + placeLocation.lat + "," + placeLocation.lng + "' target='_blank'>Ir al lugar</a>"
            });

            // Asocia la infoventana al marcador del lugar
            placeMarker.addListener('click', function() {
                infoWindow.open(map, placeMarker);
            });


            // Calcula la distancia entre el usuario y el lugar
            var userLocation = new google.maps.LatLng(userLocation.lat, userLocation.lng);
            var placePosition = new google.maps.LatLng(placeLocation.lat, placeLocation.lng);
            var distance = google.maps.geometry.spherical.computeDistanceBetween(userLocation, placePosition);

            // Convierte la distancia a un formato legible
            var distanceText = (distance / 1000).toFixed(2) + " km";

            // Crea una instancia de infoventana
            var infoWindowContent = "<h3>Información del lugar</h3><p>Aquí puedes agregar detalles sobre el lugar.</p><p>Distancia desde tu ubicación: " + distanceText + "</p><a href='https://www.google.com/maps/search/?api=1&query=" + placeLocation.lat + "," + placeLocation.lng + "' target='_blank'>Abrir en Google Maps</a>";

            var infoWindow = new google.maps.InfoWindow();

            // Asigna el contenido a la infoventana
            infoWindow.setContent(infoWindowContent);

            // Agrega un listener de clic al marcador
            placeMarker.addListener('click', function() {
                // Abre la infoventana al hacer clic en el marcador
                infoWindow.open(map, placeMarker);
            });

        }
    </script>
</body>

</html>