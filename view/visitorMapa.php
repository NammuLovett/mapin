<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MAP!N!</title>
    <!-- Estilos principales -->
    <link rel="stylesheet" href="./css/visitorStyle.css" />
    <!-- Icono del sitio -->
    <link rel="icon" href="../zimg/logo/Logotipo.svg" type="image/svg+xml" />
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
                <a href="visitorDashboard.html"><img src="../zimg/logo/logo HOR.svg" alt="Logo MAP!N" /></a>
            </div>
            <!-- Menú de navegación -->
            <nav>
                <ul>
                    <li>
                        <a href="visitorDashboard.php"><i class="fas fa-home"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="visitorDescubre.php"><i class="fas fa-paper-plane"></i> Descubre</a>
                    </li>
                    <li>
                        <a href="visitorFavorito.php"><i class="fas fa-star"></i> Favoritos</a>
                    </li>
                    <li class="activo">
                        <a href="visitorMapa.php"><i class="fas fa-map"></i> Mapa</a>
                    </li>
                    <li>
                        <a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </li>
                </ul>
            </nav>
        </section>

        <!-- Segunda columna: Contenido principal -->
        <section class="columna-2">
            <!-- Primera fila: Bienvenida y búsqueda -->
            <div class="fila-1">
                <h1>Mapa</h1>
                <p>Selecciona que quieres ver en el mapa</p>
            </div>
            <!-- Segunda fila: mapa -->
            <div class="fila-2 f2mapa">
                <h3>Categorías</h3>


                <div class="category-cards-container">
                    <a href="visitorMapaCategory.php" class="category-card">
                        <i class="fas fa-landmark"></i>
                        <p>Categoría 1</p>
                    </a>
                    <!-- ... -->
                    <a href="visitorMapaCategory.php" class="category-card">
                        <i class="fas fa-landmark"></i>
                        <p>Categoría 1</p>
                    </a>
                    <!-- ... -->
                    <a href="visitorMapaCategory.php" class="category-card">
                        <i class="fas fa-landmark"></i>
                        <p>Categoría 1</p>
                    </a>
                    <!-- ... -->
                    <a href="visitorMapaCategory.php" class="category-card">
                        <i class="fas fa-landmark"></i>
                        <p>Categoría 1</p>
                    </a>
                    <!-- ... -->
                    <a href="visitorMapaCategory.php" class="category-card">
                        <i class="fas fa-landmark"></i>
                        <p>Categoría 1</p>
                    </a>
                    <!-- ... -->
                    <a href="visitorMapaCategory.php" class="category-card">
                        <i class="fas fa-landmark"></i>
                        <p>Categoría 1</p>
                    </a>
                    <!-- ... -->
                    <a href="visitorMapaCategory.php" class="category-card">
                        <i class="fas fa-landmark"></i>
                        <p>Categoría 1</p>
                    </a>
                    <!-- ... -->
                    <a href="visitorMapaCategory.php" class="category-card">
                        <i class="fas fa-landmark"></i>
                        <p>Categoría 1</p>
                    </a>
                    <!-- ... -->
                    <a href="visitorMapaCategory.php" class="category-card">
                        <i class="fas fa-landmark"></i>
                        <p>Categoría 1</p>
                    </a>
                    <!-- ... -->
                </div>
            </div>

            <!-- Tercera fila: Estadísticas -->
            <div class="fila-3">

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
                    <h3>Previsión del tiempo</h3>
                    <p>&lt;Tipo de tiempo&gt;</p>
                </div>
        </section>
    </main>

    <script src="./js/visitor.js"></script>
</body>

</html>