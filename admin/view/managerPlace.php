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
                <img src="../../zimg/logo/typo.svg" alt="Logo de Map!n" />
            </div>

            <ul class="menu">
                <li>
                    <a href="managerDashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                </li>
                <li>
                    <a href="managerPlace.php" class="active"><i class="fas fa-map-marker-alt"></i> Lugares de interés</a>
                </li>
                <li>
                    <a href="managerCategory.php"><i class="fas fa-th-list"></i> Categorías
                    </a>
                </li>


                <li>
                    <a href="#"><i class="fas fa-sign-out-alt"></i> Log out</a>
                </li>
            </ul>
        </nav>
        <main class="content">
            <div class="table-container">
                <h2>Listado de lugares de interés</h2>
                <a href="managerPlaceForm.php"><button class="add-button">+</button></a>

                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Info</th>
                            <th>Dirección</th>
                            <th></th>
                            <!-- Quitar el texto "Acciones" del encabezado de la columna -->
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Parque Central</td>
                            <td>Un hermoso parque en el centro de la ciudad.</td>
                            <td>Calle 1 # 2-3</td>
                            <td class="no-border-top">
                                <div class="dropdown-menu">
                                    <span>&#8942;</span>
                                    <div class="dropdown-content">
                                        <a href="#">Ver</a>
                                        <a href="#">Editar</a>
                                        <a href="#">Borrar</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <!-- Añade las filas restantes de manera similar -->
                    </tbody>
                </table>

                <div class="pagination">
                    <a href="#">&laquo;</a>
                    <a href="#">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#">&raquo;</a>
                </div>
            </div>
        </main>
    </div>
</body>

</html>