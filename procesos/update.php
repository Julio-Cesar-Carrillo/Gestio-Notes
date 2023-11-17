<?php
include_once ('conexion.php');
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$apellido1 = $_POST['apellido1'];
$apellido2 = $_POST['apellido2'];
$curso = $_POST['lenguajes'];
$telf = $_POST['telf'];
$email = $_POST['email'];
$pass2 = $_POST['pass'];
$pass = hash("sha256", $pass2);

$sql = "SELECT * FROM tbl_alumnos where email = ? and id <> ?;";

$stmt = mysqli_prepare($conn, $sql);

// Vincular los parámetros a la sentencia
mysqli_stmt_bind_param($stmt, "si", $email, $id);

// Ejecutar la sentencia
mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($resultado) > 0) {
    header("Location: ../view/procesos/editar_alumno.php?id=$id&error=El username ya existe");
} else {
    try {
        $sql = "UPDATE `tbl_alumnos` SET `nombre` = ?, `apellido1` = ?, `apellido2` = ?, `email` = ?, `pass` = ?, `telefono` = ?, `id_curso` = ? WHERE `tbl_alumnos`.`id` = ?;";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssii", $nombre, $apellido1, $apellido2, $email, $pass, $telf, $curso, $id);
        mysqli_stmt_execute($stmt);
        header("Location: ../view/admin.php?res=Los cambios se han guardado correctamente");
    }catch (PDOException $e){
        echo "" . $e->getMessage() . "";
    }
}


