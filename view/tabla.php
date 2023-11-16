<?php
include_once("./procesos/conexion.php");
// Consulta para mostar la tabla de los alumnos
$sql = "SELECT E.*, D.nombre as 'curso' FROM tbl_alumnos E 
        INNER JOIN tbl_cursos D ON E.id_curso = D.id ORDER BY id ASC;";
$stmt = mysqli_prepare($conn, $sql);
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
    <title>Datos Usuarios</title>
</head>

<body>
    <a href="./crear.php">Crear alumno</a>
    <table border=1>
        <tr>
            <th>nombre y apellidos</th>
            <th>email</th>
            <th>pass</th>
            <th>telefono</th>
            <th>curso</th>
            <th>Notas</th>
            <th>editar</th>
            <th>eliminar</th>
        </tr>
        <?php
        foreach ($alumnos as $alumno) {
            echo "<tr>
              <td> {$alumno["nombre"]} {$alumno["apellido"]} </td>   
              <td> {$alumno["email"]} </td>
              <td> {$alumno["pass"]} </td>
              <td> {$alumno["telefono"]} </td>
              <td> {$alumno["curso"]} </td>
              <td><a href='./notas.php?id={$alumno['id']}&id_asignatura={$alumno["id_curso"]}'>notas</a>
              <td><a href='./editar_alumno.php?id={$alumno['id']}'>editar</a>
              <td><a href='./procesos/eliminar.php?id={$alumno['id']}'>aliminar</a>
              </tr>";
        }
        ?>
    </table>
</body>

</html>