<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="view/css/managerStyle.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" crossorigin="anonymous" />

    <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet" />
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJXT7vkQCPszRpdMfAJO7hMr55J31aZug&callback=initMap" async defer></script>

    <title>MAP!N</title>
</head>

<body>
    <div class="wrapper">
        <nav class="sidebar">
            <div class="logo">
                <img src="../zimg/logo/typo.svg" alt="Logo de Map!n" />

            </div>

            <ul class="menu">
                <li>
                    <a href="index.php?action=verManagerDashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                </li>
                <li>
                    <a href="index.php?action=verManagerPlace" class="active"><i class="fas fa-map-marker-alt"></i> Lugares de interés</a>
                </li>
                <li>
                    <a href="index.php?action=verManagerCategory"><i class="fas fa-th-list"></i> Categorías
                    </a>
                </li>
                <li>
                    <a href="index.php?action=cerrarSesion"><i class="fas fa-sign-out-alt"></i> Log out</a>
                </li>
            </ul>
        </nav>
        <!-- main -->
        <main class="content">
            <div class="outer-container">
                <div class="form-container">
                    <title>Formulario de lugares</title>

                    <div class="container">
                        <h2>Formulario de lugares</h2>
                        <!--    <div class="toggle-container">
                            <label class="switch">
                                <input type="checkbox" id="theme-toggle" />
                                <span class="slider round"></span>
                            </label>
                            <span class="toggle-text">Activar/Desactivar</span>
                        </div> -->

                        <form id="registro-form" action="index.php?action=insertPlace" method="POST">
                            <div class="icon-placeholder">
                                <label for="nombre">Nombre del lugar <span>*</span></label>
                                <input type="text" id="namePlace" name="namePlace" class="input-field" placeholder="Ej: Parque Central" required />
                                <i class="fas fa-map-marker-alt"></i>
                                <span class="error">El campo nombre no puede estar vacío</span>
                            </div>
                            <div class="icon-placeholder">
                                <label for="info">Información <span>*</span></label>
                                <input type="text" id="infoPlace" name="infoPlace" class="input-field" placeholder="Ej: Un hermoso parque en el centro de la ciudad." required />
                                <i class="fas fa-info-circle"></i>
                                <span class="error">El campo información no puede estar vacío</span>
                            </div>
                            <div class="icon-placeholder">
                                <label for="descripcion">Descripción <span>*</span></label>
                                <textarea id="descriptionPlace" name="descriptionPlace" class="input-field" placeholder="Ej: El parque central es un lugar icónico de la ciudad..." required></textarea>
                                <i class="fas fa-pencil-alt"></i>
                                <span class="error">El campo descripción no puede estar vacío</span>
                            </div>
                            <div class="icon-placeholder">
                                <label for="direccion">Dirección <span>*</span></label>
                                <input type="text" id="addressPlace" name="addressPlace" class="input-field" placeholder="Ej: Calle 1 # 2-3" required />
                                <i class="fas fa-map"></i>
                                <span class="error">El campo dirección no puede estar vacío</span>
                            </div>
                            <div class="icon-placeholder">
                                <label for="imagen">Subir imagen</label>
                                <input type="file" id="imagen" name="imagen" class="input-field" accept="image/*" />
                                <i class="fas fa-image"></i>
                            </div>
                            <div class="icon-placeholder">
                                <label for="mapa">Mapa google para poner latitud y longitud</label>
                                <i class="fas fa-map-marker-alt"></i>
                                <input class="input-field" type="text" id="lat" name="latPlace" readonly />
                                <input class="input-field" type="text" id="lng" name="lonPlace" readonly />
                                <div id="map" class="map-container"></div>
                            </div>

                            <div>
                                <label for="mapa">Categoría</label>
                                <input type="text" id="mapa" name="mapa" class="input-field" />
                            </div>
                            <div class="buttons">
                                <button type="reset">Reset</button>
                                <button type="submit">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </main>
    </div>
</body>
<script>
    var map;
    var marker;

    function initMap() {
        // Inicializa el mapa centrado en Ceuta
        var ceuta = {
            lat: 35.889387,
            lng: -5.321346
        };
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 14,
            center: ceuta
        });

        // Permite al usuario colocar un pin y almacena las coordenadas
        map.addListener('click', function(event) {
            placeMarker(event.latLng);
        });
    }

    function placeMarker(location) {
        // Elimina el marcador anterior si existe
        if (marker) {
            marker.setMap(null);
        }

        // Crea y coloca un nuevo marcador
        marker = new google.maps.Marker({
            position: location,
            map: map
        });

        // Almacena la latitud y longitud en los campos ocultos
        document.getElementById('lat').value = location.lat();
        document.getElementById('lng').value = location.lng();
    }
</script>

</html>