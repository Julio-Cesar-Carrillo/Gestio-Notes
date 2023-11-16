<?php
$alumno_id = $_POST['id'];
include_once("../procesos/conexion.php");
// Consulta para mostar la tabla de los alumnos
$sql = "SELECT N.*, A.nombre as 'nombre', A.apellido1 as 'apellido', A.apellido2 AS 'apellido2' , M.nombre as 'asignatura' FROM tbl_notas N 
    INNER JOIN tbl_alumnos A ON N.id_alumno = A.id 
    INNER JOIN tbl_asignaturas M ON N.id_asignatura=M.id 
    WHERE N.id_alumno=?;";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $alumno_id);
mysqli_stmt_execute($stmt);
// Guardamos los datos de la consulta
$nota = mysqli_stmt_get_result($stmt);
// Cerramos la consulta
mysqli_stmt_close($stmt);
mysqli_close($conn);

if (mysqli_num_rows($nota) == 0) {
    echo "<p>No hay notas de este alumno.<p>
          <p><button><a href='./crear_nota.php?id={$alumno_id}'>Añadir nota ahora</a></button></p>";
    exit();
} elseif (mysqli_num_rows($nota) == 1) {
    echo "<p>Aun faltan añadir 2 notas.<p>
          <p><button><a href='./crear_nota.php?id={$alumno_id}'>Añadir notas restantes</a></button></p>";
    exit();
} elseif (mysqli_num_rows($nota) == 2) {
    echo "<p>Aun falta añadir 1 nota.<p>
          <p><button><a href='./crear_nota.php?id={$alumno_id}'>Añadir nota ahora</a></button></p>";
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table border=1>
        <tr>
            <th>Nombre y apellidos</th>
            <th>Asignatura</th>
            <th>Nota</th>
            <th>Fecha registro</th>
            <th>Editar</th>
            <th>Tabla</th>
        </tr>
        <?php

        foreach ($nota as $alumno) {
            $fecha = date("d/m/Y", strtotime($alumno["fecha_registro"]));
            echo "<tr>
              <td> {$alumno["nombre"]} {$alumno["apellido"]} {$alumno["apellido2"]} </td>  
              <td> {$alumno["asignatura"]} </td>
              <td> {$alumno["nota"]} </td>
              <td> {$fecha} </td>
              <td><a href='./editar_nota.php?id={$alumno_id}'>editar</a>
              <td><a href='./tabla.php'>Volver</a>
              </tr>";
        }
        ?>
    </table>
</body>

</html>