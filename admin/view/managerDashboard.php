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
    <div class="layout">
        <nav class="sidebar">
            <div class="logo">
                <img src="../zimg/logo/typo.svg" alt="Logo de Map!n" />

            </div>

            <ul class="menu">
                <li>
                    <a href="index.php?action=verManagerDashboard" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                </li>
                <li>
                    <a href="index.php?action=verManagerPlace"><i class="fas fa-map-marker-alt"></i> Lugares de interés</a>
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
        <main class="content">

            <section class="dashboard">
                <h2>Te damos la bienvenida a la plataforma de gestión del perfil manager de Mapin</h2>

                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Total Visitas</th>
                            <th>Total Favoritos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Murallas Reales</td>
                            <td>23</td>
                            <td>54</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Plaza de África</td>
                            <td>12</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Parque Marítimo</td>
                            <td>80</td>
                            <td>183</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Museo de la Legión</td>
                            <td>45</td>
                            <td>30</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Casa de los Dragones</td>
                            <td>37</td>
                            <td>58</td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Teatro Auditorio Revellín</td>
                            <td>120</td>
                            <td>95</td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>Catedral de Santa María de la Asunción</td>
                            <td>100</td>
                            <td>120</td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>Playa de la Ribera</td>
                            <td>78</td>
                            <td>65</td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>Paseo de las Palmeras</td>
                            <td>60</td>
                            <td>72</td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>Monte Hacho</td>
                            <td>96</td>
                            <td>85</td>
                        </tr>
                        <tr>
                            <td>11</td>
                            <td>Parque San Amaro</td>
                            <td>52</td>
                            <td>48</td>
                        </tr>
                        <tr>
                            <td>12</td>
                            <td>Plaza de los Reyes</td>
                            <td>35</td>
                            <td>28</td>
                        </tr>
                        <tr>
                            <td>13</td>
                            <td>Faros de Ceuta</td>
                            <td>112</td>
                            <td>98</td>
                        </tr>
                        <tr>
                            <td>14</td>
                            <td>El Conjunto Monumental de las Murallas Reales</td>
                            <td>130</td>
                            <td>145</td>
                        </tr>
                        <tr>
                            <td>15</td>
                            <td>Santuario de Nuestra Señora de África</td>
                            <td>140</td>
                            <td>120</td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</body>

</html>