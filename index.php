<?php
    session_start();
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>IES Contreras</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="./css/style.css">

        <!-- FUENTE -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@300&family=Lora&display=swap" rel="stylesheet">

        <script src="./js/boton.js"></script> <!-- Script que bloquea el botón hasta que no han llenado todos los campos -->
    </head>

    <body>
        <div class="f-login">
            <div class="logo">
                <img src="img/logo.png" alt="Error al cargar el logo" srcset="">
            </div>
            
            <div class="formulario">
                <form id="login" action="./procesos/validacion.php" method="post">
                    <h2>Iniciar Sesión</h2>
                    <div class="mb-3">
                        <label for="exampleInputUser1" class="form-label">Nombre de usuario:</label>
                        <input type="text" name="user" class="form-control" id="user" aria-describedby="userHelp">
                        <p style="display: none; color: red;" id="alertauser">¡El formato de usuario que intenta introducir no es valido!</p> <!-- El mensaje de error permanece oculto hasta que el script detecta un error en el formato del texto introducido -->
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                        <input type="password" name="pass" class="form-control" id="pass">
                        <p style="display: none; color: red;" id="alertapass">¡La contraseña debe de tener almenos 9 caracteres!</p> <!-- El mensaje de error permanece oculto hasta que detecta que la contraseña es lo suficientemente larga. -->
                    </div>

                    <button type="submit" class="btn btn-primary" style="background-color: #034b66; border-color: #023b56;" name="enviar" id="btnEnviar" disabled>Enviar</button>

                    <script src="./js/validacion.js"></script> <!-- Este script valida el formato y si los campos están vacíos -->
                </form>
            </div>
        </div>
    </body>
</html>