<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="view/css/managerStyle.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" crossorigin="anonymous" />

    <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet" />
    <title>MAP!N</title>
</head>

<body>
    <div class="container">
        <nav class="sidebar">
            <div class="logo">
                <img src="../zimg/logo/typo.svg" alt="Logo de Map!n" />

            </div>

            <ul class="menu">
                <li>
                    <a href="index.php?action=verManagerDashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                </li>
                <li>
                    <a href="index.php?action=verManagerPlace"><i class="fas fa-map-marker-alt"></i> Lugares de interés</a>
                </li>
                <li>
                    <a href="index.php?action=verManagerCategory" class="active"><i class="fas fa-th-list"></i> Categorías
                    </a>
                </li>
                <li>
                    <a href="index.php?action=cerrarSesion"><i class="fas fa-sign-out-alt"></i> Log out</a>
                </li>
            </ul>
        </nav>
        <main class="content">
            <div class="outer-container">
                <div class="form-container">
                    <h2>Formulario de Categorías</h2>
                    <form id="registro-form" action="index.php?action=editCategory&id=<?php echo $category->getIdCategory(); ?>" method="POST">
                        <div class="icon-placeholder">
                            <label for="nombre">Nombre de la categoría <span>*</span></label>
                            <input type="text" id="nameCategory" name="nameCategory" class="input-field" placeholder="Ej: Parque Central" value="<?php echo $category->getNameCategory(); ?> " required />

                            <i class=" fas fa-map-marker-alt"></i>
                            <span class="error">El campo nombre no puede estar vacío</span>
                        </div>
                        <div class="icon-placeholder">
                            <label for="info">Descripción <span>*</span></label>
                            <input type="text" id="descriptionCategory" name="descriptionCategory" class="input-field" placeholder="Ej: Un hermoso parque en el centro de la ciudad." value="<?php echo $category->getDescriptionCategory(); ?> " required />
                        </div>

                        <div class=" buttons">
                            <button type="reset">Reset</button>
                            <button type="submit">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>

</html>