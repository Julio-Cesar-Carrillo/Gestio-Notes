<?php
try {
    // Recogida de datos
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $telefono = $_POST["telefono"];
    $curso = $_POST["curso"];

    include_once("../conexion.php");

    mysqli_autocommit($conn, false);
    mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);
    // Definimos la consulta
    $stmt = mysqli_stmt_init($conn);
    $sql = "INSERT INTO `tbl_alumnos` (`id`, `nombre`, `apellido`, `email`, `pass`, `telefono`, `id_curso`) VALUES (NULL, ?, ?, ?, ?, ?, ?)";
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "ssssss", $nombre, $apellido, $email, $pwd, $telefono, $curso);
    mysqli_stmt_execute($stmt);
    // Confirmamos la consulta y cerramos la conexion
    mysqli_commit($conn);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    header('Location: ../tabla.php');
} catch (Exception $e) {
    // Deshacemos las inserciones en el caso de que se genere alguna excepción
    echo "Error: " . $e->getMessage() . "";
    die();
}
