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
                lat: <?php echo $mapin->getLatitud(); ?>,
                lng: <?php echo $mapin->getLongitud(); ?>
            };

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: placeLocation
            });

            var marker = new google.maps.Marker({
                position: placeLocation,
                map: map
            });
        }
    </script>
</body>

</html>