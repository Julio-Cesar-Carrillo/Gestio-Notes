<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de control</title>
    <link rel="stylesheet" href="../css/style.css">
    <!-- BOOSTRAP -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body id="admin">
<div class="panel">
    <h1>Hola Admin!</h1>
    <input type="text" name="filtro" id="filtro">
    <table class="table" border="1">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Nombre y Apellido/s</th>
                <th scope="col">Email</th>
                <th scope="col">Contraseña</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Curso</th>
                <th scope="col">Editar</th>
                <th scope="col">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include_once("../procesos/conexion.php");
            $sql = "SELECT tbl_alumnos.id as id, tbl_alumnos.nombre as nombre, tbl_alumnos.apellido1 as apellido1, tbl_alumnos.apellido2 as apellido2, tbl_alumnos.email as email, tbl_alumnos.pass, tbl_alumnos.telefono, tbl_cursos.nombre as curso FROM `tbl_alumnos` INNER JOIN tbl_cursos ON tbl_alumnos.id_curso = tbl_cursos.id";

            // Obtener el número total de filas
            $result = mysqli_query($conn, $sql);
            $totalRows = mysqli_num_rows($result);

            // Número de filas a mostrar por página
            $rowsPerPage = 8;

            // Número total de páginas
            $totalPages = ceil($totalRows / $rowsPerPage);

            // Página actual (si no se especifica, se establece en la primera página)
            $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

            // Calcular el punto de inicio para la consulta
            $startRow = ($currentPage - 1) * $rowsPerPage;

            // Consulta SQL con LIMIT para la paginación
            $sql .= " LIMIT $startRow, $rowsPerPage";

            $result = mysqli_query($conn, $sql);


            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['nombre'] . " " . $row['apellido1'] . " " . $row['apellido2'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['pass'] . "</td>";
                    echo "<td>" . $row['telefono'] . "</td>";
                    echo "<td>" . $row['curso'] . "</td>";
                    echo "<td><a href='./procesos/editar_alumno.php?id=" . $row['id'] . "'>Modificar</a></td>";
                    echo "<td><a href='./procesos/eliminar.php?id=" . $row['id'] . "'>Eliminar</a></td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>

    <!-- Paginación -->
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php
            for ($i = 1; $i <= $totalPages; $i++) {
                echo "<li class='page-item " . ($i == $currentPage ? 'active' : '') . "'>";
                echo "<a class='page-link' href='?page=$i'>$i</a>";
                echo "</li>";
            }
            ?>
        </ul>
    </nav>
</div>
</body>
</html>
