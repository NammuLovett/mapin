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
                <img src="zimg/places/<?php echo $mapin->getImgPlace(); ?>" alt="" srcset="" class="place-image-img">
            </div>

            <?php if ($mapin) : ?>
                <div class="place-details">
                    <div class="icon-links-container">
                        <p id="mensaje"></p>

                        <!-- VISITADO -->
                        <a href="index.php?action=toggleVisited&idPlace=<?php echo $idPlace; ?>" class="icon-link <?php echo $hasVisited ? 'activo' : ''; ?>" id="link-visitado" data-place="<?php echo $idPlace; ?>" onclick="toggleVisited(event)">
                            <div class="circle">
                                <i class="fas fa-<?php echo $hasVisited ? 'check' : 'times'; ?>"></i>
                            </div>
                            <span><?php echo $hasVisited ? 'Visitado' : 'No visitado'; ?></span>
                            <?php if ($hasVisited) : ?>
                                <span data-date style="display: inline;"><?php echo date('m/d/Y', strtotime($visitDate)); ?></span>
                            <?php else : ?>
                                <span data-date style="display: none;"></span>
                            <?php endif; ?>
                        </a>




                        <!-- FAVORITO -->
                        <a href="index.php?action=toggleFavorited&idPlace=<?php echo $idPlace; ?>" class="icon-link <?php echo $isFavorited ? 'activo' : ''; ?>" id="link-favorito" data-place="<?php echo $idPlace; ?>" onclick="toggleFavorited(event)">
                            <div class="circle">
                                <i class="fas fa-star"></i>
                            </div>
                            <span>Favorito</span>
                        </a>

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

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJXT7vkQCPszRpdMfAJO7hMr55J31aZug&libraries=geometry&callback=initMap" async defer></script>
    <!-- Mapita -->
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
                var visitedLink = document.getElementById('link-visitado');
                var visitedSpan = visitedLink.querySelector('span');

                var watchID = navigator.geolocation.watchPosition(function(position) {
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
                    var placeLatLng = new google.maps.LatLng(placeLocation.lat, placeLocation.lng);
                    var distance = google.maps.geometry.spherical.computeDistanceBetween(userLatLng, placeLatLng);

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
                }, function() {
                    alert('Error: El navegador no permite la geolocalización, o esta ha sido desactivada.');
                });
            } else {
                alert('Error: Tu navegador no soporta la geolocalización.');
            }
        }
    </script>






    <script src="view/js/visitor.js"></script>


</body>

</html>