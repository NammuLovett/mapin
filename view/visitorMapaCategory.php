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
                    <li class="activo">
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
                <h1>Mapa</h1>
                <p>Lugares de interés de cada categoría</p>
            </div>
            <!-- Segunda fila: mapa -->
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

            <!-- Tercera fila: Estadísticas -->
            <div class="fila-3">
                <!-- Card -->
                <div class="cards-container-c3 ">
                    <a href="visitorPlace.php">
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
                    <a href="visitorPlace.php">
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
                    <a href="visitorPlace.php">
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
                    <a href="visitorPlace.php">
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
                    <!-- termina -->
                </div>

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

        </section>
    </main>

    <script src="view/js/visitor.js"></script>

</body>

</html>