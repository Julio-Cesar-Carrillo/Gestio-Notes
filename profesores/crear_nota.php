<?php
if (!isset($_POST['id'])) {
    header('location: ./tabla.php');
    exit();
} else {
    include_once("./procesos/conexion.php");

    $alumno_id = $_POST['id'];
    $id_curso=$_POST['id_asignatura'];
    echo $id_curso;

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
        <form action="./procesos/crear_nota.php" method="post">
            <input type="hidden" name="id" value="<?php echo $alumno_id; ?>">
            <input type="hidden" name="id_asignatura" value="<?php echo $id_curso; ?>">
            <p>Asignatura</p>
            <?php
            $sqlSelectCurso = "SELECT * FROM tbl_asignaturas WHERE id_curso=$id_curso;";
            $resultadoSelectCurso = mysqli_query($conn, $sqlSelectCurso);
            echo "<select name='curso' id='curso' onchange='validarCurso(this)'>";
            echo "<option value='' selected> -- Escoge una opción -- </option>";
            foreach ($resultadoSelectCurso as $asignatura){
                        $curso = $asignatura['nombre'];
                        $id_curso = $asignatura['id'];
                        echo "<option value='$id_curso'>$curso</option>";
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
