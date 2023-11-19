<?php
if (!isset($_POST['enviar'])) 
{
    header('Location: ' . './tabla.php');
    exit();
} 

else 
{
    // Conexión a la base de datos (igual que antes)
    include_once('../procesos/conexion.php');

    $alumno = $_POST['id'];
    $id_curso = $_POST['id_curso'];
    $nota = $_POST['nota'];

    var_dump($_POST);

    die();

    try 
    {
        // En primer lugar, se desactiva la autoejecución de las consultas
        mysqli_autocommit($conn, false);

        mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);
        $sql_pedido = "UPDATE tbl_notas SET nota = ?, fecha_registro = CURRENT_DATE WHERE id_alumno = ? AND id = ?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql_pedido);
        mysqli_stmt_bind_param($stmt, "sii", $nota, $alumno, $id_curso);

        // Se ejecuta la primera consulta
        mysqli_stmt_execute($stmt);

        // Se hace el commit y por lo tanto se confirma la consulta
        mysqli_commit($conn);

        // Se cierra la conexión
        mysqli_stmt_close($stmt);

        echo '<form id="redirectForm" action="./ver_nota.php" method="post">';
            echo '<input type="hidden" name="id" value="' . htmlspecialchars($alumno) . '">';
            echo '<input type="hidden" name="id_curso" value="' . htmlspecialchars($id_curso) . '">';
        echo '</form>';

        // Script para enviar automáticamente el formulario al cargar la página
        echo '<script>';
            echo 'document.getElementById("redirectForm").submit();';
        echo '</script>';
    } 
    
    catch (Exception $e) 
    {
        mysqli_rollback($conn);
        echo 'Error: ' . $e->getMessage() . '';
    }
}
