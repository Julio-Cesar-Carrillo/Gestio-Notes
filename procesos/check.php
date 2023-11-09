<?php
session_start(); // Iniciamos la sesión.

<<<<<<< HEAD
    include('conexion.php'); // Incluimos el archivo de conexión a la base de datos.
=======
// Verifica si las variables de sesión 'user' y 'pass' están definidas
if (!isset($_SESSION['user']) || !isset($_SESSION['pass'])) 
{
    session_destroy();
    header('Location: ../index.php?error=Debes rellenar el formulario para acceder a check.php');
    exit();
}

include('conexion.php'); // Incluimos el archivo de conexión a la base de datos.
>>>>>>> 705e812321be3495e6f9221a14a9ab0615d59756

// Preparamos una consulta SQL para buscar un profesor por nombre
$sql = "SELECT * FROM tbl_alumnos WHERE email = ? and pass = ?";
// Preparar la sentencia
$stmt = mysqli_prepare($conn, $sql);

// Vincular los parámetros a la sentencia
mysqli_stmt_bind_param($stmt, "ss", $_SESSION['user'], $_SESSION['pass']);

// Ejecutar la sentencia
mysqli_stmt_execute($stmt);

// Obtener el resultado
$resultado = mysqli_stmt_get_result($stmt);


if (mysqli_num_rows($resultado) > 0) {
    header('Location: ../view/alumnos.php');
}else {
    $sql = "SELECT * FROM tbl_profesores WHERE email = ? and pass = ?";
    // Preparar la sentencia
    $stmt = mysqli_prepare($conn, $sql);

    // Vincular los parámetros a la sentencia
    mysqli_stmt_bind_param($stmt, "ss", $_SESSION['user'], $_SESSION['pass']);

    // Ejecutar la sentencia
    mysqli_stmt_execute($stmt);

    // Obtener el resultado
    $resultado = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($resultado) > 0) {
        header('Location: ../view/profesores.php');
    }else{
        $sql = "SELECT * FROM tbl_administradores WHERE email = ? and pass = ?";
        // Preparar la sentencia
        $stmt = mysqli_prepare($conn, $sql);
    
        // Vincular los parámetros a la sentencia
        mysqli_stmt_bind_param($stmt, "ss", $_SESSION['user'], $_SESSION['pass']);
    
        // Ejecutar la sentencia
        mysqli_stmt_execute($stmt);
    
        // Obtener el resultado
        $resultado = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($resultado) > 0) {
            header('Location: ../view/admin.php');
        }else{
            session_destroy();
            header('Location: ../index.php?error=Credenciales incorrectas, por favor, vuelva a intentarlo');
        }
    }
}
session_destroy();
header('Location: ../index.php?error=Credenciales incorrectas, por favor, vuelva a intentarlo');