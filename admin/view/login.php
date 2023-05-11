<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="./css/loginRegisterStyle.css" />
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h1>Login</h1>
            <p>
                Inicie sesión ahora para poder acceder a la plataforma y registrar sus
                visitas.
            </p>
            <form action="">
                <div class="icon-placeholder">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="input-field" placeholder="Ej: juan@example.com" required />
                    <i class="fas fa-envelope"></i>
                    <span class="error">El campo email no puede estar vacío</span>
                </div>

                <div class="icon-placeholder">
                    <label for="password">Contraseña </label>
                    <input type="password" id="password" name="password" class="input-field" placeholder="Ej: Contraseña123" required />
                    <i class="fas fa-lock"></i>
                    <span class="error">El campo contraseña no puede estar vacío</span>
                </div>

                <div class="buttons">
                    <button type="submit">Login</button>
                </div>
            </form>
            <hr style="border-top: 1px solid #ccc; width: 100%; margin: 20px 0" />
            <div class="loginReg">
                <p>¿Aún no tienes cuenta?</p>
                <a href="register.php"> Registro</a>
            </div>
        </div>
    </div>
    <script src="./js/login.js"></script>
</body>

</html>