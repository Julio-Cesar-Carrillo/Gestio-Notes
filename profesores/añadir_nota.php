<?php
try {
    // Recogida de datos
    $alumno_id = $_POST["id"];
    $asignatura = $_POST["id_asignatura"];
    $id_curso = $_POST["id_curso"];
    $nota = $_POST["nota"];
    
    include_once("../procesos/conexion.php");
    mysqli_autocommit($conn, false);
    mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);

    // Definimos la consulta
    $stmt = mysqli_stmt_init($conn);
    $sql = "INSERT INTO `tbl_notas` (`id`, `id_alumno`, `id_asignatura`, `nota`, `fecha_registro`) VALUES (NULL, ?, ?, ?, CURRENT_DATE)";
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "iis", $alumno_id, $asignatura, $nota);
    mysqli_stmt_execute($stmt);

    // Confirmamos la consulta y cerramos la conexion
    mysqli_commit($conn);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    echo '<form id="redirectForm" action="./ver_nota.php" method="post">';
    echo '<input type="hidden" name="id" value="' . htmlspecialchars($alumno_id) . '">';
    echo '<input type="hidden" name="id_curso" value="' . htmlspecialchars($id_curso) . '">';
    echo '</form>';

    // Script para enviar automáticamente el formulario al cargar la página
    echo '<script>';
    echo 'document.getElementById("redirectForm").submit();';
    echo '</script>';
} catch (Exception $e) {
    // Deshacemos las inserciones en el caso de que se genere alguna excepción
    echo "Error: " . $e->getMessage() . "";
    die();
}
