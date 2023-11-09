<?php

if (!isset($_GET['id'])) {
    header('location: ./listado.php');
    exit();
} else {

    $alumno = $_GET['id'];

    include_once("./procesos/conexion.php");

    $sql = "SELECT E.*, D.nombre as 'curso' FROM tbl_alumnos E 
    INNER JOIN tbl_cursos D ON E.id_curso = D.id WHERE E.id=?;";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $alumno);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($resultado) == 0) {
        echo "no hay ningún alumnos con ese ID";
        exit();
    }
    // Almacenamos el resultado de la consulta en un array asociativo
    $datos_alumno = mysqli_fetch_assoc($resultado);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar pedido</title>
    </head>

    <body>
        <h2>Editar alumno</h2>
        <form action="./procesos/editar_alumno.php" method="post">
            <input type="hidden" name="id" value="<?php echo $datos_alumno['id']; ?>">

            <label for="nombre">nombre</label>
            <p><input type="text" name="nombre" value="<?php echo $datos_alumno['nombre']; ?>"></p>

            <label for="apellido">apellido</label>
            <p><input type="text" name="apellido" value="<?php echo $datos_alumno['apellido']; ?>"></p>
            <label for="email">email</label>
            <p><input type="text" name="email" value="<?php echo $datos_alumno['email']; ?>"></p>

            <label for="contraseña">contraseña</label>
            <p><input type="text" name="pwd" value="<?php echo $datos_alumno['pass']; ?>"></p>

            <label for="telefono">telefono</label>
            <p><input type="text" name="telefono" value="<?php echo $datos_alumno['telefono']; ?>"></p>
            <label>Curso:</label><br>
            <select name="curso" id="curso">
                <option value="" disabled selected>-- Escoge una opción --</option> <?php
                include('./procesos/conexion.php');
                $sqlSelectCurso = "SELECT * FROM tbl_cursos;";
                $resultadoSelectCurso = mysqli_query($conn, $sqlSelectCurso);

                if (mysqli_num_rows($resultadoSelectCurso) > 0) {
                    while ($row = mysqli_fetch_assoc($resultadoSelectCurso)) {
                        $curso = $row['nombre'];
                        $curso_id = $row['id'];
                        echo "<option value='$curso_id'>$curso</option>";
                    }
                }
                ?>
            </select>
            <span id="curso_error" class="error" style="color: red;"></span>

            <input type="submit" name="editar" value="Guardar Cambios">
        </form>


    </body>

    </html>

<?php
}
