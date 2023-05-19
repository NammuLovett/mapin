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
    <div class="layout">
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

                        <form id="registro-form" action="index.php?action=editPlace&id=<?php echo $place->getIdPlace(); ?>" method="POST">
                            <div class="icon-placeholder">
                                <label for="nombre">Nombre del lugar <span>*</span></label>
                                <input type="text" id="namePlace" name="namePlace" class="input-field" placeholder="Ej: Parque Central" value="<?php echo $place->getNamePlace(); ?> " required />
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="icon-placeholder">
                                <label for="info">Información <span>*</span></label>
                                <input type="text" id="infoPlace" name="infoPlace" class="input-field" placeholder="Ej: Un hermoso parque en el centro de la ciudad." value="<?php echo $place->getInfoPlace(); ?> " required />
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <div class="icon-placeholder">
                                <label for="descripcion">Descripción <span>*</span></label>
                                <textarea id="descriptionPlace" name="descriptionPlace" class="input-field" placeholder="Ej: El parque central es un lugar icónico de la ciudad..." required><?php echo $place->getDescriptionPlace(); ?></textarea>

                                <i class="fas fa-pencil-alt"></i>
                            </div>
                            <div class="icon-placeholder">
                                <label for="direccion">Dirección <span>*</span></label>
                                <input type="text" id="addressPlace" name="addressPlace" class="input-field" placeholder="Ej: Calle 1 # 2-3" value="<?php echo $place->getAddressPlace(); ?> " required />
                                <i class="fas fa-map"></i>
                            </div>
                            <div class="icon-placeholder">
                                <label for="categorias">Categorías</label>
                                <div class="checkbox-container">
                                    <?php
                                    $categories = Category::getAllCategories();
                                    $placeCategories = Place::getCategoriesByPlaceId($place->getIdPlace());
                                    foreach ($categories as $category) {
                                        echo '<div class="checkbox-form">';
                                        echo '<label class="category-label" for="category' . $category->getIdCategory() . '">';
                                        echo '<input class="category-checkbox" type="checkbox" id="category' . $category->getIdCategory() . '" name="category[]" value="' . $category->getIdCategory() . '"';
                                        if (in_array($category->getIdCategory(), $placeCategories)) {
                                            echo ' checked';
                                        }
                                        echo '/>';
                                        echo $category->getNameCategory();
                                        echo '</label>';
                                        echo '</div>';
                                    }
                                    ?>
                                </div>
                            </div>


                            <div class="icon-placeholder">
                                <label for="imagen">Subir imagen</label>
                                <input type="file" id="imagen" name="imagen" class="input-field" accept="image/*" />
                                <i class="fas fa-image"></i>
                            </div>
                            <div class="icon-placeholder">
                                <label for="mapa">Mapa google para poner latitud y longitud</label>
                                <i class="fas fa-map-marker-alt"></i>
                                <input class="input-field" type="text" id="lat" name="latPlace" value="<?php echo $place->getLatPlace(); ?> " readonly />
                                <input class="input-field" type="text" id="lng" name="lonPlace" value="<?php echo $place->getLonPlace(); ?> " readonly />
                                <div id="map" class="map-container"></div>
                            </div>


                            <div class="buttons">
                                <button type="submit">Actualizar</button>
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