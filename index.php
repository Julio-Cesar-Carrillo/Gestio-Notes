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
                        <label for="nombre">Email:</label>
                        <br>
                        <input type="text" id="email" name="nombre" oninput="validarEmail(this)" style="width:20vw; border: radius 5px;">
                        <br>
                        <span id="email_error" class="error" style="color: white; font-weight: bolder;"></span>
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
                var email = document.getElementById("email").value;
                var pwd = document.getElementById("pwd").value;
            
                // Verificar si todos los campos están llenos
                if (email !== "" && pwd !== "" ) 
                {
                    document.getElementById("enviarButton").disabled = false; // Habilitar el botón de envío
                } 
                
                else 
                {
                    document.getElementById("enviarButton").disabled = true; // Deshabilitar el botón de envío
                }
            }
            
            // Agregar eventos 'input' a los campos para llamar a la función de validación
            document.getElementById("email").addEventListener("input", validarFormulario);
            document.getElementById("pwd").addEventListener("input", validarFormulario);

            // Llamar a la función de validación inicialmente
            validarFormulario();
        </script>

    </body>
</html>