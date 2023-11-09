<?php
try {
    include_once("./conexion.php");
    $alumno = $_GET['id'];

    mysqli_autocommit($conn, false);
    mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);
    // Se define la primera consulta
    $stmt = mysqli_stmt_init($conn);
    $sql_notas="DELETE FROM tbl_notas WHERE id_alumno=?";
    mysqli_stmt_prepare($stmt, $sql_notas);
    mysqli_stmt_bind_param($stmt, "i", $alumno);
    mysqli_stmt_execute($stmt);

    // Se define la primera consulta
    $stmt = mysqli_stmt_init($conn);
    $sql_alumono="DELETE FROM tbl_alumnos WHERE id=?";
    mysqli_stmt_prepare($stmt, $sql_alumono);
    mysqli_stmt_bind_param($stmt, "i", $alumno);
    mysqli_stmt_execute($stmt);

    // Confirmamos la consultas y cerramos las conexiones
    mysqli_commit($conn);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    header('Location: ../tabla.php');
} catch (Exception $e) {
    // Deshacemos las inserciones en el caso de que se genere alguna excepción
    echo "Error: no se encuentra ". $e->getMessage() ."";
    die();
}