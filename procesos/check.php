<?php
    session_start(); // Iniciamos la sesión.

    // Verifica si las variables de sesión 'user' y 'pass' están definidas
    if (!isset($_SESSION['user']) || !isset($_SESSION['pass'])) 
    {
        header('Location: ../index.php?error=Debes rellenar el formulario para acceder a check.php');
        exit();
    }

    include('conexion.php'); // Incluimos el archivo de conexión a la base de datos.

    // Preparamos una consulta SQL para buscar un profesor por nombre
    $consulta = "SELECT * FROM tbl_profesores WHERE nombre_profe = ?";
    if ($stmt = $conn->prepare($consulta))
    {
        $stmt->bind_param('s', $_SESSION['user']);
        $stmt->execute();
        $result = $stmt->get_result();

        // Si se encuentra un resultado (1 fila), verificamos la contraseña
        if ($result->num_rows === 1) 
        {
            $fila = $result->fetch_assoc();
            $contra_profe = $fila['contra_profe'];
            $pass = $_SESSION['pass'];
            $contra_encriptada = hash("sha256", $pass);

            // Comparamos la contraseña almacenada con la contraseña proporcionada
            if (hash_equals($contra_encriptada, $contra_profe)) 
            {
                ?>
                    <!DOCTYPE html>
                    <html lang="en">
                        <head>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <title>Cerrar sesión</title>
                            <link rel="stylesheet" href="../css/style.css">
                        </head>
                        
                        <body>
                            <div class="c-cerrar">
                                <h2>¡Bienvenido <?php echo $_SESSION['user']; ?>! La contraseña es CORRECTA</h2> <!-- Se despide del usuario cogiendo la variable de sesión -->
                                <img src='../img/iker.png' style="border-radius: 15px;">
                                <form action="./cerrar_sesion.php" method="post">
                                    <input type="submit" name="enviar" value="Cerrar Sesión">
                                </form>
                            </div>
                        </body>
                    </html>
                <?php
            } 
            
            else 
            {
                // Redirige de vuelta a la página de inicio en caso de usuario o contraseña incorrectas
                header('Location: ../index.php?error=Usuario o contraseña INCORRECTAS');
            }
        }

        $stmt->close();
    }

    $conn->close(); // Cierra la conexión a la base de datos
?>