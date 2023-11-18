<?php
    // Iniciamos sesion para poder trabajar con las variables $_SESSION
    session_start();

    $user = $_SESSION['nombre'];

    include('../procesos/conexion.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cerrar sesión</title>
        <link rel="stylesheet" href="../css/estilosCerrarSesion.css">
    </head>
    
    <body>
        <div class="c-cerrar">
            <h2>Adiós <?php echo $user; ?>, ¡Hasta la próxima!</h2> <!-- Se despide del usuario cogiendo la variable de sesión -->
            <img src='../img/danieh.jpeg' style="border-radius: 15px;">
            <form action="../index.php" method="post">
                <input type="submit" name="enviar" value="Salir" class="botonCerrar">
            </form>
        </div>
    </body>
</html>

<?php
    // Destruir todas las variables de sesion
    session_unset();

    // Destruir la sesión
    session_destroy();
?>