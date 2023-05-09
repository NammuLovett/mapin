<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/managerStyle.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" crossorigin="anonymous" />

    <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet" />
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
                    <a href="managerDashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                </li>
                <li>
                    <a href="managerPlace.php"><i class="fas fa-map-marker-alt"></i> Lugares de interés</a>
                </li>
                <li>
                    <a href="managerCategory.php" class="active"><i class="fas fa-th-list"></i> Categorías
                    </a>
                </li>
                <li>
                    <a href="#"><i class="fas fa-sign-out-alt"></i> Log out</a>
                </li>
            </ul>
        </nav>
        <main class="content">
            <div class="outer-container">
                <div class="form-container">
                    <h2>Formulario de Categorías</h2>
                    <form id="registro-form">
                        <div class="icon-placeholder">
                            <label for="nombre">Nombre de la categoría <span>*</span></label>
                            <input type="text" id="nombre" name="nombre" class="input-field" placeholder="Ej: Parque Central" required />
                            <i class="fas fa-map-marker-alt"></i>
                            <span class="error">El campo nombre no puede estar vacío</span>
                        </div>
                        <div class="icon-placeholder">
                            <label for="info">Descripción <span>*</span></label>
                            <input type="text" id="info" name="info" class="input-field" placeholder="Ej: Un hermoso parque en el centro de la ciudad." required />
                        </div>
                        <div class="buttons">
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