<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de control</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Administrador</h1>
    <table>
        <thead>
            <tr>
                <th>Nombre y Apellido/s</th>
                <th>Email</th>
                <th>Contraseña</th>
                <th>Teléfono</th>
                <th>Curso</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
                <?php 
                include_once("../procesos/conexion.php");
                $sql = "SELECT tbl_alumnos.id as id, tbl_alumnos.nombre as nombre, tbl_alumnos.apellido as apellido, tbl_alumnos.email as email, tbl_alumnos.pass, tbl_alumnos.telefono, tbl_cursos.nombre as curso FROM `tbl_alumnos` INNER JOIN tbl_cursos ON tbl_alumnos.id_curso = tbl_cursos.id;";
                // Preparar la sentencia
                $stmt = mysqli_prepare($conn, $sql);

                // Vincular los parámetros a la sentencia
                // mysqli_stmt_bind_param($stmt, "ss", $user, $pwd);

                // Ejecutar la sentencia
                mysqli_stmt_execute($stmt);

                // Obtener el resultado
                $resultado = mysqli_stmt_get_result($stmt);
                if (mysqli_num_rows($resultado) > 0) {
                    while ($row = mysqli_fetch_assoc($resultado)) {
                        echo "<tr>";
                        echo "<td>" . $row['nombre'] . " " . $row['apellido'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['pass'] . "</td>";
                        echo "<td>" . $row['telefono'] . "</td>";
                        echo "<td>" . $row['curso'] . "</td>";
                        echo "<td><a href='modificar.php'>Modificar'</a></td>";
                        echo "<td><a href='../procesos/eliminar.php'>Eliminar'</a></td>";
                        echo "</tr>";

                    }
                }
                ?>
        </tbody>
    </table>
</body>
</html>