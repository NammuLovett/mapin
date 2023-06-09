<!DOCTYPE html>
<!--  dir indica la direccionalidad del texto - ltr, significa izquierda a derecha. -->
<html lang="es" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Meta descripción y palabras clave para SEO -->
    <meta name="description" content="MAP!N - Registra y descubre nuevos lugares de interés, monumentos y museos en tu ciudad." />
    <meta name="keywords" content="mapin, monumentos, museos, lugares de interés, turismo, explorar, ciudad" />

    <!-- Enlace a la hoja de estilos CSS -->
    <link rel="stylesheet" href="view/css/landingStyle.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="icon" href="../zimg/logo/Logotipo.svg" type="image/svg+xml" />

    <title>MAP!N</title>

    <!-- Marcado estructurado (datos estructurados de Schema.org) para SEO -->
    <script type="application/ld+json">
        {
            "@context": 'https://schema.org',
            "@type": 'WebSite',
            "name": 'MAP!N',
            "description": 'Registra y descubre nuevos lugares de interés, monumentos y museos en tu ciudad.'
            ',
            "url": 'https://www.mapin.es'
        }
    </script>
    <!-- importar fuentes -->
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet" />
</head>
<!-- Cabecera de la página con logo, menú de navegación y botones de login/registro -->

<body>
    <header>
        <!-- Logo -->
        <div class="logo">
            <img src="zimg/logo/logoHOR.svg" alt="Logo MAP!N" />
        </div>
        <!-- Menú de navegación -->
        <nav role="navigation" aria-label="Menú de navegación principal">
            <ul class="nav-desktop">
                <li>
                    <a href="#inicio" aria-label="Ir a la sección Inicio">Inicio</a>
                </li>
                <li>
                    <a href="#explorar" aria-label="Ir a la sección Explorar">Explorar</a>
                </li>
                <li>
                    <a href="#nosotros" aria-label="Ir a la sección Sobre Nosotros">Nosotros</a>
                </li>

                <a class="boton botonSec" aria-label="Registrarse en MAP!N" href="index.php?action=register">Registrarse</a>
                <a class="boton" aria-label="Iniciar sesión" href="index.php?action=login">Login</a>
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
                    <a href="#inicio" aria-label="Ir a la sección Inicio">Inicio</a>
                </li>
                <li>
                    <a href="#explorar" aria-label="Ir a la sección Explorar">Explorar</a>
                </li>
                <li>
                    <a href="#nosotros" aria-label="Ir a la sección Sobre Nosotros">Sobre Nosotros</a>
                </li>
                <li class="botones">
                    <a class="boton botonSec" aria-label="Registrarse en MAP!N" href="index.php?action=register">Registrarse</a>
                    <a class="boton" aria-label="Iniciar sesión" href="index.php?action=login">Login</a>
                </li>
            </ul>
        </nav>
    </header>
    <!-- seccion 1 -->
    <section class="contenido">
        <div class="texto">
            <h1>Explora tu ciudad, Descubre tu Mundo</h1>
            <p>
                Con MAP!N, puedes registrar fácilmente los monumentos, museos y
                lugares de interés que hayas visitado y ver los que te quedan por
                visitar. Así descubrirás nuevos lugares.
            </p>
            <a class="boton" aria-label="Iniciar sesión" href="index.php?action=login">¡A viajar!</a>

        </div>
        <div class="imagen">
            <img src="zimg/illustration/landing1.svg " alt="Una persona explorando un lugar de interés con la aplicación MAP!N" />
        </div>
    </section>
    <!-- sección 2 -->
    <section class="sitios-populares" id="explorar">
        <div class="contenedor">
            <h2>Sitios populares</h2>
            <div class="carrusel">
                <div class="card">
                    <img src="zimg/places/image1.png" alt="Lugar de interés 1" />
                    <div class="card-info">
                        <h3>Murallas Reales</h3>
                        <div class="rating">
                            <span>4.5</span>
                            <span class="star">★</span>

                        </div>
                    </div>
                </div>

                <div class="card">
                    <img src="zimg/places/image4.png" alt="Lugar de interés 1" />
                    <div class="card-info">
                        <h3>Puerta Califal</h3>
                        <div class="rating">
                            <span>4.5</span>
                            <span class="star">★</span>

                        </div>
                    </div>
                </div>
                <!-- asd -->
                <div class="card">
                    <img src="zimg/places/image2.png" alt="Lugar de interés 1" />
                    <div class="card-info">
                        <h3>Casa de los dragones</h3>
                        <div class="rating">
                            <span>4.5</span>
                            <span class="star">★</span>

                        </div>
                    </div>
                </div>
                <!-- asd -->
            </div>
        </div>
    </section>

    <!-- Sección 3 -->
    <section class="sobre-nosotros" id="nosotros">
        <div class="contenedor">
            <h2>Sobre nosotros</h2>
            <div class="contenido">
                <div class="texto">
                    <h3>Descubre nuevos lugares</h3>
                    <p>
                        MAP!N te ayudará a encontrar nuevos lugares que te faltaban por
                        explorar y te permitirá hacer un seguimiento de los sitios en los
                        que has estado.
                    </p>
                    <h3>Fácil de usar e intuitivo</h3>
                    <p>
                        Te facilita el registro de tus viajes y visitas turísticas. Con un
                        registro sencillo y una navegación intuitiva, puedes disfrutar
                        descubriendo la ciudad.
                    </p>
                    <h3>Crea un perfil y mira tu progreso</h3>
                    <p>
                        Crea un perfil y visita todos los lugares increíbles de tu ciudad.
                        Puedes hacer un seguimiento de tu progreso y ver qué monumentos,
                        museos y atracciones has visitado.
                    </p>
                </div>
                <div class="imagen">
                    <img src="zimg/illustration/landing2.svg" alt="Una persona explorando un lugar de interés con la aplicación MAP!N" />
                </div>
            </div>
        </div>
    </section>
    <!-- Sección de opiniones -->
    <section class="opiniones">
        <h2>Lo que otros viajeros dicen</h2>
        <div class="opiniones-contenedor">
            <div class="opinion">
                <div class="foto-opinion">
                    <img src="zimg/avatar/avatar.png" alt="avatar" />
                </div>
                <p class="texto-opinion">"La APP me ha facilitado mucho el encontrar los lugares de interés" </p>
                <p class="autor">Lucía Ramos</p>
                <p class="ciudad">Sevilla</p>
                <div class="estrellas">
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                </div>
            </div>

            <!-- opinion -->
            <div class="opinion">
                <div class="foto-opinion">
                    <img src="zimg/avatar/avatar2.png" alt="avatar" />
                </div>
                <p class="texto-opinion">"Encontrar lugares especiales nunca ha sido tan divertido" </p>
                <p class="autor">Juan Benítez</p>
                <p class="ciudad">Ciudad del usuario</p>
                <div class="estrellas">
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                </div>
            </div>
            <!-- opinion -->
            <div class="opinion">
                <div class="foto-opinion">
                    <img src="zimg/avatar/john.jpg" alt="avatar" />
                </div>
                <p class="texto-opinion">yippy yay hey!</p>
                <p class="autor">John McClane</p>
                <p class="ciudad">NY City</p>
                <div class="estrellas">
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="contenido">
            <div class="footer-logo">
                <img src="zimg/logo/typo.svg" alt="Logo" />
                <div class="footer-socials">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
            <div class="footer-right">
                <div class="column">
                    <h4>MENÚ</h4>
                    <a href="#inicio">Inicio</a>
                    <a href="#explorar">Explorar</a>
                    <a href="#nosotros">Nosotros</a>
                </div>
                <div class="column">
                    <h4>COMPAÑÍA</h4>
                    <a href="#">Términos y condiciones</a>
                    <a href="#">Privacidad</a>
                </div>
                <div class="column">
                    <h4>SOPORTE</h4>
                    <a href="#">FAQ</a>
                    <a href="admin/index.php">Manager</a>
                </div>
                <div class="column">
                    <h4>CONTACTO</h4>
                    <p><i class="fas fa-mobile-alt"></i> 0000121212</p>
                    <p><i class="fas fa-envelope"></i> hola@mapin.es</p>
                </div>
            </div>
        </div>
        <div class="footer-divider"></div>
        <div class="footer-credits">
            <p>Diseñado y programado por MGLORA with ❤️</p>
        </div>
    </footer>

    <!-- Botón para ir arriba -->
    <button class="scroll-top" onclick="window.scrollTo({top: 0, behavior: 'smooth'})">
        ↑
    </button>

    <script src="view/js/landing.js"></script>
</body>

</html>