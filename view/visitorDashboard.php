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

            <!-- Segunda fila: Lugares destacados -->

            <!-- Tercera fila: Estadísticas -->
            <h3>Tus estadísticas</h3>
            <div class="fila-3">
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
                </div>
            </div>

            <!-- C3 - Segunda fila: Lugares visitados -->
            <div class="fila-2">
                <h3>Lugares visitados</h3>
                <div class="cards-container-c3">
                    <!-- Card -->
                    <a href="vistalugar.html">
                        <div class="card-c3">
                            <div class="card-image-c3">
                                <img src="../zimg/places/image1.png" alt="Lugar 1" />
                            </div>
                            <div class="card-info-c3">
                                <p class="card-name-c3">Murallas Reales</p>
                                <div class="card-date-container-c3">
                                    <i class="fas fa-calendar"></i>
                                    <span class="card-date-c3">10-05-2023</span>
                                </div>
                            </div>
                        </div>
                    </a>
                    <!-- Card -->
                    <a href="vistalugar.html">
                        <div class="card-c3">
                            <div class="card-image-c3">
                                <img src="../zimg/places/image2.png" alt="Lugar 2" />
                            </div>
                            <div class="card-info-c3">
                                <p class="card-name-c3">Parque Marítimo del Mediterráneo</p>
                                <div class="card-date-container-c3">
                                    <i class="fas fa-calendar"></i>
                                    <span class="card-date-c3">12-05-2023</span>
                                </div>
                            </div>
                        </div>
                    </a>
                    <!-- Card -->
                    <a href="vistalugar.html">
                        <div class="card-c3">
                            <div class="card-image-c3">
                                <img src="../zimg/places/image3.png" alt="Lugar 3" />
                            </div>
                            <div class="card-info-c3">
                                <p class="card-name-c3">Casa de los Dragones</p>
                                <div class="card-date-container-c3">
                                    <i class="fas fa-calendar"></i>
                                    <span class="card-date-c3">15-05-2023</span>
                                </div>
                            </div>
                        </div>
                    </a>
                    <!-- card -->
                </div>
                <!-- Aquí terminan las cards -->
            </div>
        </section>
    </main>
    <script src="view/js/visitor.js"></script>
</body>

</html>