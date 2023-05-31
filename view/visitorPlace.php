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
                <img src="zimg/places/<?php echo $mapin->getImgPlace(); ?>" alt="Imagen del lugar" srcset="" class="place-image-img">
            </div>
            <!-- Comprueba si la variable de sesión $mapin está definida y no es NULL -->
            <?php if ($mapin) : ?>
                <div class="place-details">
                    <div class="icon-links-container">
                        <p id="mensaje"></p>

                        <!-- VISITADO -->
                        <!--  Marcar/desmarcar un lugar como visitado -->
                        <a href="index.php?action=toggleVisited&idPlace=<?php echo $idPlace; ?>" class="icon-link <?php echo $hasVisited ? 'activo' : ''; ?>" id="link-visitado" data-place="<?php echo $idPlace; ?>" onclick="toggleVisited(event)">
                            <div class="circle">
                                <!-- Si el lugar ha sido visitado muestra un icono ✅, de lo contrario, muestra una ❌ -->
                                <i class="fas fa-<?php echo $hasVisited ? 'check' : 'times'; ?>"></i>
                            </div>
                            <!-- Muestra 'Visitado' si el lugar ha sido visitado, sino, muestra 'No visitado' -->
                            <span><?php echo $hasVisited ? 'Visitado' : 'No visitado'; ?></span>
                            <!-- Si se ha visitado, muestra la fecha que visitó el lugar-->
                            <?php if ($hasVisited) : ?>
                                <span data-date style="display: inline;"><?php echo date('d/m/Y', strtotime($visitDate)); ?></span>
                            <?php else : ?>
                                <span data-date style="display: none;"></span>
                            <?php endif; ?>
                        </a>

                        <!-- FAVORITO -->
                        <!--  marcar/desmarcar un lugar como Favorito -->
                        <a href="index.php?action=toggleFavorited&idPlace=<?php echo $idPlace; ?>" class="icon-link <?php echo $isFavorited ? 'activo' : ''; ?>" id="link-favorito" data-place="<?php echo $idPlace; ?>" onclick="toggleFavorited(event)">
                            <div class="circle">
                                <!-- Icono de estrella -->
                                <i class="fas fa-star"></i>
                            </div>
                            <span>Favorito</span>
                        </a>
                    </div><!-- Fin de icon-links-container -->

                    <!-- Bloque de información del lugar -->
                    <div class="place-info">
                        <h1 class="place-title"><?php echo $mapin->getNamePlace(); ?></h1>
                        <p class="place-location"><i class="fa-solid fa-location-dot"></i> Ceuta, España</p>
                        <h2 class="info-title">Información</h2>
                        <p><?php echo $mapin->getInfoPlace(); ?></p>
                        <h2 class="description-title">Descripción</h2>
                        <p><?php echo $mapin->getDescriptionPlace(); ?></p>
                    </div>
                    <!-- DIV Mapa del Lugar -->
                    <div id="map" style="height: 400px; width: 100%;"></div>
                </div>
            <?php endif; ?>
        </section>

        <!-- Tercera columna: Perfil y lugares visitados -->
        <section class="columna-3">
            <!-- c3 :Primera fila -->
            <div class="fila-1">
                <div class="avatar">

                </div>
                <p>Amante de los viajes</p>
            </div>
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

            </div>

            <!-- C3 - Segunda fila: Lugares visitados -->

        </section>
    </main>
    <!-- Api KEY google -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJXT7vkQCPszRpdMfAJO7hMr55J31aZug&libraries=geometry&callback=initMap" async defer></script>

    <!-- Mapa Google mostrando el lugar vista detalle PLACE -->
    <script>
        // Función para inicializar el mapa
        function initMap() {
            var placeLocation = {
                lat: <?php echo $mapin->getLatPlace(); ?>,
                lng: <?php echo $mapin->getLonPlace(); ?>
            };

            // Crea un nuevo mapa centrado en la ubicación del lugar
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: placeLocation,
                gestureHandling: 'cooperative',
                styles: [{
                    featureType: 'poi',
                    stylers: [{
                        visibility: 'off'
                    }]
                }]
            });

            // Crea un marcador para el lugar en el mapa
            var placeMarker = new google.maps.Marker({
                position: placeLocation,
                map: map,
                title: "<?php echo $mapin->getNamePlace(); ?>"
            });

            // Define la ventana de información inicialmente como null
            var infoWindow = null;

            // Comprueba si la geolocalización está habilitada en el navegador del usuario
            if (navigator.geolocation) {
                var visitedLink = document.getElementById('link-visitado');
                var visitedSpan = visitedLink.querySelector('span');

                // Posición del usuario, actualiza el mapa y la ventana de información
                var watchID = navigator.geolocation.watchPosition(function(position) {
                    var userLocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    // Crea un marcador en la ubicación actual del usuario
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

                    // Formato de medida dependiendo de la distancia (si es más o menos de 1 km)
                    var displayDistance = distance < 1000 ? distance.toFixed(2) + " metros" : (distance / 1000).toFixed(2) + " km";

                    // Define el contenido de la ventana de información
                    var infoWindowContent = "<h3>" + "<?php echo $mapin->getNamePlace(); ?>" + "</h3><p>" + "<?php echo $mapin->getInfoPlace(); ?>" + ".</p><p>Distancia desde tu ubicación: " + displayDistance + "</p><a href='https://www.google.com/maps/search/?api=1&query=" + "<?php echo $mapin->getLatPlace(); ?>" + "," + "<?php echo $mapin->getLonPlace(); ?>" + "' target='_blank'>Ir al lugar</a>";
                    infoWindow = new google.maps.InfoWindow({
                        content: infoWindowContent
                    });

                    // Abre la ventana de información cuando se hace clic en el marcador del lugar
                    placeMarker.addListener('click', function() {
                        // Si existe una ventana de información abierta, la cierra antes de abrir la nueva
                        if (infoWindow) {
                            infoWindow.close();
                        }

                        // Abre la ventana de información en el marcador del lugar
                        infoWindow.open(map, placeMarker);
                    });

                    // Actualiza el texto del enlace según la distancia del lugar
                    if (distance > 100) {
                        visitedLink.classList.add('lejos');
                        if (visitedLink.classList.contains('activo')) {
                            visitedSpan.innerText = 'Visitado';
                        } else {
                            visitedSpan.innerText = 'Estás lejos para visitarlo';
                        }
                    } else {
                        visitedLink.classList.remove('lejos');
                        visitedSpan.innerText = visitedLink.classList.contains('activo') ? 'Visitado' : 'No visitado';
                    }
                    // Si ocurre un error al obtener la ubicación del usuario, muestra un mensaje de alerta
                }, function() {
                    alert('Error: El navegador no permite la geolocalización, o esta ha sido desactivada.');
                });

                // Cierra la ventana de información cuando se hace clic en cualquier parte del mapa
                google.maps.event.addListener(map, 'click', function() {
                    if (infoWindow) {
                        infoWindow.close();
                    }
                });
                // Si la geolocalización no está soportada en el navegador del usuario, muestra un mensaje de alerta
            } else {
                alert('Error: Tu navegador no soporta la geolocalización.');
            }
        }
    </script>
    <script src="view/js/visitor.js"></script>
</body>

</html>