<?php
$visitorId = $_SESSION['visitor'];
$places = Place::getAllFavoritePlacesBy($visitorId);

/* var_dump($places_json) */
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
                    <li class="activo">
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
                    <li class="activo">
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
            <!-- Primera fila: Bienvenida y búsqueda -->
            <div class="fila-1">
                <h1>Favoritos</h1>
                <p>Busca tus lugares favoritos de la ciudad</p>
            </div>
            <div class="fila-2">
                <div id="map" style="width: 100%; height: 500px;"></div>
            </div>
            <!-- Segunda fila: Lugares destacados -->
            <h3>Lugares favoritos</h3>
            <!-- Card -->
            <div class="cards-container-c3 ">
                <?php foreach ($places as $place) : ?>
                    <a href="index.php?action=verVisitorPlace&id=<?php echo $place->getIdPlace(); ?>">
                        <div class="card-c3">
                            <div class="card-image-c3">
                                <img src="zimg/places/<?php echo $place->getImgPlace(); ?>" alt="Lugar <?php echo $place->getIdPlace(); ?>" />
                            </div>

                            <div class="card-info-c3">
                                <h3 class="card-name-c3"><?php echo $place->getNamePlace(); ?></h3>
                                <div class="card-date-container-c3">
                                    <i class="fas fa-info"></i>

                                    <span class="card-date-c3"><?php echo $place->getInfoPlace(); ?></span>
                                </div>

                                <div class="card-date-container-c3">
                                    <i class="fas fa-map"></i>
                                    <span class="card-date-c3"><?php echo $place->getAddressPlace(); ?></span>

                                </div>
                            </div>
                            <div class="card-date-container-star">
                                <i class="fas fa-star"></i>
                                <span class="card-date-c3">Favorito</span>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
                <!-- card -->

                <!-- -- -->
            </div>

            <!-- paginación -->
            <!--    <div class="pagination-container">
                <ul class="pagination-list">
                    <li class="page-item activo"><a href="#">1</a></li>
                    <li class="page-item"><a href="#">2</a></li>
                    <li class="page-item"><a href="#">3</a></li>
                    <li class="page-item"><a href="#">4</a></li>
                    <li class="page-item"><a href="#">5</a></li>
                </ul>
            </div> -->

            <!-- Tercera fila: Estadísticas -->
            <div class="fila-3">

            </div>

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

                    // Para cada lugar, crea un marcador en el mapa
                    places.forEach(function(place) {
                        var placeLocation = {
                            lat: parseFloat(place.latPlace),
                            lng: parseFloat(place.lonPlace)
                        };

                        var placeMarker = new google.maps.Marker({
                            position: placeLocation,
                            map: map,
                            title: place.namePlace
                        });

                        /* Ventana de información */
                        var infoWindowContent = "<h3>" + place.namePlace + "</h3><p>" + place.infoPlace + ".</p><a href='https://www.google.com/maps/search/?api=1&query=" + place.latPlace + "," + place.lonPlace + "' target='_blank'>Ir al lugar</a><br><a href='index.php?action=verVisitorPlace&id=" + place.idPlace + "'>Ver detalles del lugar</a>";

                        var infoWindow = new google.maps.InfoWindow({
                            content: infoWindowContent
                        });

                        placeMarker.addListener('click', function() {
                            infoWindow.open(map, placeMarker);
                        });
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