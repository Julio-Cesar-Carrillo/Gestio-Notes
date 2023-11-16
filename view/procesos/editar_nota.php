<?php

if (!isset($_POST['editar'])) {
    header('Location: ' . '../tabla.php');
    exit();
} else {
    // Conexión a la base de datos (igual que antes)
    include_once('./conexion.php');

    $alumno_id = $_POST['id'];
    $id_curso=$_GET['asig_id'];
    $asignatura_id = mysqli_real_escape_string($conn, $_POST['asignatura']);
    $nota = mysqli_real_escape_string($conn, $_POST['nota']);
    echo $alumno_id . "<br>";
    echo $asignatura_id . "<br>";
    echo $nota . "<br>";
    try {
        // En primer lugar, se desactiva la autoejecución de las consultas
        mysqli_autocommit($conn, false);

        mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);
        $sql_pedido = "UPDATE tbl_notas
                       SET nota = ?, fecha_registro = CURRENT_DATE
                       WHERE id_alumno = ? AND id_asignatura = ?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql_pedido);
        mysqli_stmt_bind_param($stmt, "sii", $nota, $alumno_id, $asignatura_id);

        // Se ejecuta la primera consulta
        mysqli_stmt_execute($stmt);

        // Se hace el commit y por lo tanto se confirma la consulta
        mysqli_commit($conn);

        // Se cierra la conexión
        mysqli_stmt_close($stmt);


        // Redirigimos a la página de listado del CRUD
        header("Location: ../notas.php?id={$alumno_id}&id_asignatura={$id_curso}");
    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo 'Error: ' . $e->getMessage() . '';
    }
}
