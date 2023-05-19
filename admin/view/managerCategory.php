<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="view/css/managerStyle.css" />



    <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet" />
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
            <div class="table-container">
                <h2>Listado de Categorías</h2>
                <a href="index.php?action=verManagerCategoryForm"><button class="add-button">+</button></a>

                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Info</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categories as $category) : ?>
                            <tr>
                                <td><?php echo $category->getIdCategory(); ?></td>
                                <td><?php echo $category->getNameCategory(); ?></td>
                                <td><?php echo $category->getDescriptionCategory(); ?></td>
                                <td class="no-border-top">
                                    <div class="dropdown-menu">
                                        <span>&#8942;</span>
                                        <div class="dropdown-content">
                                            <a href="index.php?action=verEditCategory&id=<?php echo $category->getIdCategory(); ?>">Editar</a>
                                            <a href="index.php?action=deleteCategory&id=<?php echo $category->getIdCategory(); ?>">Borrar</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </main>
    </div>
</body>

</html>