<?php
$alumno_id = $_GET['id'];
include_once("./procesos/conexion.php");
// Consulta para mostar la tabla de los alumnos
$sql = "SELECT N.*, A.nombre as 'nombre', A.apellido as 'apellido' , M.nombre as 'asignatura' FROM tbl_notas N 
    INNER JOIN tbl_alumnos A ON N.id_alumno = A.id 
    INNER JOIN tbl_asignaturas M ON N.id_asignatura=M.id 
    WHERE N.id_alumno=?;";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $alumno_id);
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
    <table border=1>
        <tr>
            <th>nombre y apellidos</th>
            <th>asignatura</th>
            <th>nota</th>
            <th>fecha_registro</th>
            <th>editar</th>
        </tr>
        <?php
        foreach ($alumnos as $alumno) {
            echo "<tr>
              
            
              <td> {$alumno["nombre"]} {$alumno["apellido"]} </td>  
              <td> {$alumno["asignatura"]} </td>
              <td> {$alumno["nota"]} </td>
              <td> {$alumno["fecha_registro"]} </td>
              <td><a href='./editar_nota.php?id={$alumno_id}'>editar</a>
              </tr>";
        }
        ?>
    </table>
</body>

</html>