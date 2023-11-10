<?php
try {
    // Recogida de datos
    $alumno_id = $_POST["id"];
    $curso = $_POST["curso"];
    $nota = $_POST["nota"];
    include_once("./conexion.php");

    mysqli_autocommit($conn, false);
    mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);
    // Definimos la consulta
    $stmt = mysqli_stmt_init($conn);
    $sql = "INSERT INTO `tbl_notas` (`id`, `id_alumno`, `id_asignatura`, `nota`, `fecha_registro`) VALUES (NULL, ?, ?, ?, CURRENT_DATE)";
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "iis", $alumno_id, $curso, $nota);
    mysqli_stmt_execute($stmt);
    // Confirmamos la consulta y cerramos la conexion
    mysqli_commit($conn);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    header("Location: ../notas.php?id={$alumno_id}");
} catch (Exception $e) {
    // Deshacemos las inserciones en el caso de que se genere alguna excepción
    echo "Error: " . $e->getMessage() . "";
    die();
}
