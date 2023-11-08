<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos Usuarios</title>
</head>

<body>
    <?php
    include_once("./conexion.php");
    $sql = "SELECT * FROM tbl_alumnos";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_execute($stmt);
    $alumnos = mysqli_stmt_get_result($stmt);
    echo "<table border=1>";
    echo "<tr>
          <th>nombre</th>
          <th>apellido</th>
          <th>email</th>
          <th>pass</th>
          <th>telefono</th>
          <th>curso</th>
          <th>editar</th>
          <th>eliminar</th>
          </tr>";
    foreach ($alumnos as $alumno) {
        echo "<tr>";
        echo "<td>" . $alumno["nombre"] . "</td>";
        echo "<td>" . $alumno["apellido"] . "</td>";
        echo "<td>" . $alumno["email"] . "</td>";
        echo "<td>" . $alumno["pass"] . "</td>";
        echo "<td>" . $alumno["telefono"] . "</td>";
        echo "<td>" . $alumno["id_curso"] . "</td>";
        echo "<td><a href='procesos/editar.php?id=" . $alumno['id'] . "'>editar</a>";
        echo "<td><a href='procesos/eliminar.php?id=" . $alumno['id'] . "'>aliminar</a>";
        echo "</tr>";
    }
    echo "</table>";
    ?>
</body>

</html>