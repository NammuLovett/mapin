<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" />
    <link rel="stylesheet" href="view/css/loginRegisterStyle.css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet" />

</head>

<body>
    <main class="container">
        <div class="form-container">
            <div class="logo">
                <img src="zimg/logo/typo.svg" alt="" srcset="">
            </div>
            <h1>Registro</h1>
            <p>
                Crea una cuenta para acceder a todas las funcionalidades de Mapin!
            </p>
            <form id="registro-form" action="index.php?action=insertVisitor" method="POST">
                <div class="icon-placeholder">
                    <label for="nombre">Nombre <span>*</span></label>
                    <input type="text" id="nameVisitor" name="nameVisitor" class="input-field" placeholder="Ej: Juan" required />
                    <i class="fas fa-user"></i>
                    <span class="error">El campo nombre no puede estar vacío</span>
                </div>
                <div class="icon-placeholder">
                    <label for="apellidos">Apellidos <span>*</span></label>
                    <input type="text" id="surnameVisitor" name="surnameVisitor" class="input-field" placeholder="Ej: Pérez López" required />
                    <i class="fas fa-user"></i>
                    <span class="error">El campo apellidos no puede estar vacío</span>
                </div>

                <div class="icon-placeholder">
                    <label for="email">Email <span>*</span></label>
                    <input type="email" id="emailVisitor" name="emailVisitor" class="input-field" placeholder="Ej: juan@example.com" required />
                    <i class="fas fa-envelope"></i>
                    <span class="error">El campo email no puede estar vacío</span>
                </div>
                <div class="icon-placeholder">
                    <label for="password">Contraseña <span>*</span></label>
                    <input type="password" id="passwordVisitor" name="passwordVisitor" class="input-field" placeholder="Ej: Contraseña123" required />
                    <i class="fas fa-lock"></i>

                    <span class="error">El campo contraseña no puede estar vacío</span>
                </div>

                <div class="icon-placeholder">
                    <label for="confirm-password">Confirmar contraseña <span>*</span></label>
                    <input type="password" id="confirm-password" name="confirm-password" class="input-field" placeholder="Ej: Contraseña123" required />
                    <i class="fas fa-lock"></i>

                    <span class="error">Las contraseñas no coinciden</span>
                </div>
                <div id="password-strength" class="password-strength">
                    <p>Fuerza de la contraseña: <span id="strength-output"></span></p>
                </div>
                <div class="icon-placeholder">
                    <label for="fecha-nacimiento">Fecha de nacimiento <span>*</span></label>
                    <input type="date" id="datebirthVisitor" name="datebirthVisitor" class="input-field" required />
                    <i class="fas fa-calendar"></i>
                    <span class="error">El campo fecha de nacimiento no puede estar vacío</span>
                </div>

                <label for="genero">Género <span>*</span></label>
                <select id="genderVisitor" name="genderVisitor" required>
                    <option value="">Seleccione una opción</option>
                    <option value="hombre">Hombre</option>
                    <option value="mujer">Mujer</option>
                </select>
                <span class="error">El campo género no puede estar vacío</span>
                <label for="codigo-postal">Código postal </label>
                <input type="text" id="cityVisitor" name="cityVisitor" class="input-field" pattern="^(?:0[1-9]|[1-4]\d|5[0-2])\d{3}$" maxlength="5" placeholder="Ej: 28012" required />
                <span class="error">El campo código postal no puede estar vacío</span>
                <div class="buttons">
                    <button type="reset">Reset</button>
                    <button type="submit">Guardar</button>
                </div>
            </form>
            <hr style="border-top: 1px solid #ccc; width: 100%; margin: 20px 0" />
            <div class="loginReg">
                <p>¿Ya tienes una cuenta?</p>
                <a href="index.php?action=login">Haz Login</a>
            </div>
        </div>
    </main>
    <script src="view/js/register.js"></script>
</body>

</html>