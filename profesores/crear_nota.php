<?php
if (!isset($_POST['alumno'])) {
    header('location: ./tabla.php');
    exit();
} else {
    include_once("../procesos/conexion.php");

    $alumno_id = $_POST['alumno'];
    $id_curso = $_POST['curso'];
    $curso = $_POST['curso'];
    echo $curso;

    $sql = "SELECT * FROM tbl_alumnos WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $alumno_id);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    // Almacenamos el resultado de la consulta en un array asociativo
    $datos_alumno = mysqli_fetch_assoc($resultado);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Crear nota</title>
    </head>

    <body>
        <h2>Creando nota para: <?php echo $datos_alumno['nombre']; ?></h2>
        <form action="./añadir_nota.php" method="post">
            <input type="hidden" name="id" value="<?php echo $alumno_id; ?>">
            <input type="hidden" name="id_curso" value="<?php echo $id_curso; ?>">
            <p>curso</p>
            <?php
           $sqlSelectCurso = "SELECT * FROM tbl_asignaturas WHERE id_curso=?";
           $stmtSelectCurso = mysqli_prepare($conn, $sqlSelectCurso);
           mysqli_stmt_bind_param($stmtSelectCurso, "i", $curso);
           mysqli_stmt_execute($stmtSelectCurso);

           $resultadoSelectCurso = mysqli_stmt_get_result($stmtSelectCurso);
            
            echo "<select name='id_asignatura' onchange='validarCurso(this)'>";
            echo "<option value='' selected> -- Escoge una opción -- </option>";
            foreach ($resultadoSelectCurso as $curso) {
                $cursoId = $curso['id']; 
                $cursoNombre = $curso['nombre'];
                echo "<option value='$cursoId'>$cursoNombre</option>";
            }
            
            echo "</select>";
            ?>

            <p>Nota</p>
            <p><input type="text" name="nota" id="nota"></p>

            <input type="submit" name="editar" value="Guardar Cambios">
        </form>


    </body>

    </html>

<?php
}
