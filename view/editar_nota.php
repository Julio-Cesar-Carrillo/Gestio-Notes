<?php

if (!isset($_GET['id'])) {
    header('location: ./tabla.php');
    exit();
} else {
    include_once("./procesos/conexion.php");

    $alumno_id = $_GET['id'];
    $asignatura_id = $_GET['id_asignatura'];;

    $sql = "SELECT N.*, A.nombre as 'nombre', A.apellido as 'apellido' , M.nombre as 'asignatura' 
    FROM tbl_notas N 
    INNER JOIN tbl_alumnos A ON N.id_alumno = A.id 
    INNER JOIN tbl_asignaturas M ON N.id_asignatura=M.id 
    WHERE N.id_alumno=? AND N.id_asignatura= ?;";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $alumno_id,$asignatura_id);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($resultado) == 0) {
        echo $alumno_id;
        echo "no hay ningún alumnos con ese ID";
        exit();
    }
    // Almacenamos el resultado de la consulta en un array asociativo
    $datos_alumno = mysqli_fetch_assoc($resultado);
    $fecha = date("d/m/Y", strtotime($datos_alumno["fecha_registro"]));
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
        <form action="./procesos/editar_nota.php" method="post">
            <input type="hidden" name="id" value="<?php echo $alumno_id; ?>">
            
            <p>nombre</p>
            <p><?php echo $datos_alumno['nombre']; ?></p>
            <label for="apellido">Asignatura</label>

            <input type="hidden" name="asignatura" value="<?php echo $datos_alumno['id_asignatura']; ?>">
            <p><?php echo $datos_alumno['asignatura']; ?></p>

            <label for="email">Nota</label>
            <p><input type="text" name="nota" value="<?php echo $datos_alumno['nota']; ?>"></p>

            <p for="contraseña"><?php echo $fecha; ?></p>

            <input type="submit" name="editar" value="Guardar Cambios">
        </form>


    </body>

    </html>

<?php
}
