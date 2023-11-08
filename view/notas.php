<?php
$alumno = $_GET['id'];
include_once("./procesos/conexion.php");
// Consulta para mostar la tabla de los alumnos
$sql = "SELECT E.*, D.nombre as 'nombre', D.apellido as 'apellido' FROM tbl_notas E JOIN tbl_alumnos D ON E.id_alumno = ? WHERE E.id_alumno=?;";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ii", $alumno, $alumno);
mysqli_stmt_execute($stmt);
// Guardamos los datos de la consulta
$alumnos = mysqli_stmt_get_result($stmt);
// Cerramos la consulta
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <a href="./crear.php">Crear alumno</a>
    <table border=1>
        <tr>
            <th>nombre y apellidos</th>
            <th>asignatura</th>
            <th>nota</th>
            <th>fecha_registro</th>
            <th>Notas</th>
            <th>editar</th>
        </tr>
        <?php
        foreach ($alumnos as $alumno) {
            echo "<tr>
              <td> {$alumno["nombre"]} {$alumno["apellido"]} </td>  
              <td> {$alumno["id_asignatura"]} </td>
              <td> {$alumno["nota"]} </td>
              <td> {$alumno["fecha_registro"]} </td>
              <td><a href='./notas.php?id={$alumno['id']}'>notas</a>
              <td><a href='./editar.php?id={$alumno['id']}'>editar</a>
              </tr>";
        }
        ?>
    </table>
</body>

</html>