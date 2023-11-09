<?php
session_start(); // Iniciamos la sesión.

// Verifica si las variables de sesión 'user' y 'pass' están definidas
if (!isset($_SESSION['nombre']) || !isset($_SESSION['pwd'])) 
{
    session_destroy();
    // header('Location: ../index.php?error=Debes rellenar el formulario para acceder a check.php');
    header('Location: ../index.php?error=Debes rellenar el formulario para acceder a check.php');
    exit();
}
$user = $_SESSION['nombre'];
$pwd = $_SESSION['pwd'];
include('conexion.php'); // Incluimos el archivo de conexión a la base de datos.

// Preparamos una consulta SQL para buscar un profesor por nombre
$sql = "SELECT * FROM tbl_alumnos WHERE email = ? and pass = ?";
// Preparar la sentencia
$stmt = mysqli_prepare($conn, $sql);

// Vincular los parámetros a la sentencia
mysqli_stmt_bind_param($stmt, "ss", $user, $pwd);

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
    mysqli_stmt_bind_param($stmt, "ss", $user, $pwd);

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
        mysqli_stmt_bind_param($stmt, "ss", $user, $pwd);
    
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