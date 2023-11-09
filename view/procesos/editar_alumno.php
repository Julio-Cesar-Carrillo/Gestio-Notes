<?php
// Conexión a la base de datos (igual que antes)

include_once('./conexion.php');

if (!isset($_POST['editar'])) {
    header('Location: ' . '../tabla.php');
    exit();
} else {

    $alumno_id = $_POST['id'];
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $apellido = mysqli_real_escape_string($conn, $_POST['apellido']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
    $telefono =  mysqli_real_escape_string($conn, $_POST['telefono']);
    $curso =  mysqli_real_escape_string($conn, $_POST['curso']);
    echo $curso."<br>";
    try {
        // En primer lugar, se desactiva la autoejecución de las consultas
        mysqli_autocommit($conn, false);

        mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);
        $sql_pedido = "UPDATE tbl_alumnos
                        SET nombre = ?, apellido = ?, email = ?, pass = ?, telefono = ? id_curso=?
                        WHERE id = ?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql_pedido);
        mysqli_stmt_bind_param($stmt, "ssssssi", $nombre, $apellido, $email, $pwd, $telefono, $curso ,$alumno_id);

        // Se ejecuta la primera consulta
        mysqli_stmt_execute($stmt);

        // Se hace el commit y por lo tanto se confirma la consulta
        mysqli_commit($conn);

        // Se cierra la conexión
        mysqli_stmt_close($stmt);


        // Redirigimos a la página de listado del CRUD
        header('Location: ../tabla.php');
    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo 'Error: ' . $e->getMessage() . '';
    }
}
