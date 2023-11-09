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
                    <?php if (isset($_GET['error'])) { ?>
                    <h6><?php echo $_GET['error']; }?></h6>
                    <div class="mb-3">
<<<<<<< HEAD
                        <label for="nombre">Nombre:</label>
                        <br>
                        <input type="text" id="nombre" name="nombre" oninput="validarNombre(this)" style="width:20vw; border: radius 5px;">
                        <br>
                        <span id="nombre_error" class="error" style="color: white; font-weight: bolder;"></span>
=======
                        <label for="exampleInputUser1" class="form-label">Email:</label>
                        <input type="text" name="user" class="form-control" id="user" aria-describedby="userHelp">
                        <p style="display: none; color: red;" id="alertauser">¡El formato de correo que intenta introducir no es valido!</p> <!-- El mensaje de error permanece oculto hasta que el script detecta un error en el formato del texto introducido -->
>>>>>>> 705e812321be3495e6f9221a14a9ab0615d59756
                    </div>

                    <div class="mb-3">
                        <label for="nombre">Contraseña:</label>
                        <br>
                        <input type="password" id="pwd" name="pwd" oninput="validarPwd(this)" style="width:20vw; border: radius 5px;">
                        <br>
                        <span id="pwd_error" class="error" style="color: white; font-weight: bolder;"></span>
                    </div>

                    <button type="submit" class="btn btn-primary" style="background-color: #034b66; border-color: #023b56;" name="enviar" id="enviarButton" disabled>Enviar</button>

                    <script src="./js/validacion.js"></script> <!-- Este script valida el formato y si los campos están vacíos -->
                </form>
            </div>
        </div>

        <script>
            // Función para validar el formulario
            function validarFormulario() {
                var nombre = document.getElementById("nombre").value;
                var pwd = document.getElementById("pwd").value;
            
                // Verificar si todos los campos están llenos
                if (nombre !== "" && pwd !== "" ) 
                {
                    document.getElementById("enviarButton").disabled = false; // Habilitar el botón de envío
                } 
                
                else 
                {
                    document.getElementById("enviarButton").disabled = true; // Deshabilitar el botón de envío
                }
            }
            
            // Agregar eventos 'input' a los campos para llamar a la función de validación
            document.getElementById("nombre").addEventListener("input", validarFormulario);
            document.getElementById("pwd").addEventListener("input", validarFormulario);

            // Llamar a la función de validación inicialmente
            validarFormulario();
        </script>

    </body>
</html>