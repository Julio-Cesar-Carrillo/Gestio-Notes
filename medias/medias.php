<?php
    session_start();
    $user = $_SESSION['nombre'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FONT AWESOME -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Estilos BootStrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <!-- Scripts BootStrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/estilosPrueba.css">
    <!-- TITULO -->
    <title>Notas Medias</title>
    <style>
        .media-alta {
            background-color: lightgreen;
        }
    </style>
</head>

<body>
    <div id="cont-header">
        <h1 id="texto-header">Notas medias</h1>
    </div>
    <?php
    include('../procesos/conexion.php');

    // Número de resultados por página
    $resultadosPorPagina = 7;

    // Página actual (inicializada en 1 por defecto)
    $paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

    // Calcular el offset
    $offset = ($paginaActual - 1) * $resultadosPorPagina;
    $offset = max($offset, 0); // Ajustar el offset si es menor que cero

    // Crear la consulta SQL
    $sql = "SELECT a.nombre, a.apellido1, a.apellido2, COALESCE(ROUND(AVG(n.nota), 2), 0) AS media 
            FROM tbl_alumnos a 
            LEFT JOIN tbl_notas n ON a.id = n.id_alumno 
            GROUP BY a.nombre, a.apellido1, a.apellido2 
            ORDER BY media DESC
            LIMIT $offset, $resultadosPorPagina;";

    // Ejecutar la consulta
    $result = mysqli_query($conn, $sql);

    // Verificar errores en la consulta
    if (!$result) {
        die("Error en la consulta: " . mysqli_error($conn));
    }

    // Contador para las tres notas más altas
    $count = 0;

    // Imprimir la tabla con estilos condicionales para las tres notas más altas
    echo "<div id='cont-tabla'>";
    echo "<table class='mi-tabla'>
                <tr>
                    <th>Nombre del Alumno</th>
                    <th>Media</th>
                </tr>";

    // Mostrar datos en la tabla
    while ($row = mysqli_fetch_assoc($result)) {
        // Aplicar un estilo condicional para las tres notas más altas
        $class = ($count < 3 && $paginaActual == 1) ? 'media-alta' : '';

        echo "<tr class='$class'>";
        echo "<td>{$row['nombre']} {$row['apellido1']} {$row['apellido2']}</td>";
        echo "<td>{$row['media']}</td>";
        echo "</tr>";

        // Incrementar el contador si la nota actual está entre las tres más altas
        if ($count < 3 && $row['media'] >= 8 && $paginaActual == 1) {
            $count++;
        }
    }

    echo "</table>";
    echo "</div>";

    // Número de usuarios por página
    $usuariosPorPagina = 7;

    // Página actual, si no se proporciona, se asume la página 1
    $paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

    // Calcular el índice de inicio para la cláusula LIMIT
    $inicio = ($paginaActual - 1) * $usuariosPorPagina;

    // Búsqueda por nombre
    $nombreBusqueda = isset($_GET['nombre']) ? $_GET['nombre'] : '';
    $condicionNombre = !empty($nombreBusqueda) ? "WHERE a.nombre LIKE '%$nombreBusqueda%'" : '';

    // Consulta para obtener el total de usuarios con el filtro de nombre
    $totalUsuariosQuery = "SELECT COUNT(*) as total FROM tbl_alumnos a $condicionNombre";
    $resultadoTotalUsuarios = mysqli_query($conn, $totalUsuariosQuery);
    $totalUsuarios = mysqli_fetch_assoc($resultadoTotalUsuarios)['total'];

    // Calcular el total de páginas
    $totalPaginas = ceil($totalUsuarios / $usuariosPorPagina);

    // Consulta para obtener los usuarios de la página actual con el filtro de nombre
    $contenidoTabla = "SELECT a.id ,a.nombre, a.apellido1, a.apellido2, a.email, c.nombre as curso FROM tbl_alumnos a LEFT JOIN tbl_cursos c ON a.id_curso = c.id 
    $condicionNombre 
    LIMIT $inicio, $usuariosPorPagina";

    $resultadoContenidoTabla = mysqli_query($conn, $contenidoTabla);
    ?>

    <?php
    $user = $_SESSION['nombre'];

    $sql = "SELECT * FROM tbl_profesores WHERE email = '$user'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
    ?>
        <div class="cont-botonVolver">
            <button class="botonVolver"><a href='../profesores/tabla.php'>Volver</a></button>
        </div>
    <?php
    } else {
        $sql = "SELECT * FROM tbl_administradores WHERE email = '$user'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
    ?>
            <div class="cont-botonVolver">
                <button class="botonVolver"><a href='../view/admin.php'>Volver</a></button>
            </div>
    <?php
        }
    }
    ?>

    <div id="cont-paginacion">
        <ul class="pagination">
            <?php for ($i = 1; $i <= $totalPaginas; $i++) : ?>
                <li <?php if ($i == $paginaActual) echo 'class="active"'; ?>>
                    <a href="?pagina=<?= $i; ?>"><?= $i; ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </div>
</body>

</html>