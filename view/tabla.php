<?php
    include_once("./procesos/conexion.php");
    
    /* PAGINACIÓN ----------------------------------------------------------------------------------------------------------------------------------------- */

    // Configuración de la paginación
    $resultadosPorPagina = 10; // Cantidad de resultados por página.

    // Obtener la página actual
    $paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
    $inicio = ($paginaActual - 1) * $resultadosPorPagina;

    // Obtener el término de búsqueda si se ha enviado
    $nombreBusqueda = isset($_GET['nombre']) ? $_GET['nombre'] : '';

    // Consulta para mostrar la tabla de los alumnos con paginación y filtro por nombre
    $sql = "SELECT E.*, D.nombre as 'curso' FROM tbl_alumnos E INNER JOIN tbl_cursos D ON E.id_curso = D.id WHERE E.nombre LIKE ? ORDER BY id ASC LIMIT ?, ?";
    $stmt = mysqli_prepare($conn, $sql);

    // Añadir el signo de porcentaje solo si se ha proporcionado un término de búsqueda
    if (!empty($nombreBusqueda)) 
    {
        $nombreBusqueda =  $nombreBusqueda ;
        mysqli_stmt_bind_param($stmt, "sii", $nombreBusqueda, $inicio, $resultadosPorPagina);
    } 

    else 
    {
        // Si no hay término de búsqueda, usar un LIKE que coincida con todo
        $nombreBusqueda = '%';
        mysqli_stmt_bind_param($stmt, "sii", $nombreBusqueda, $inicio, $resultadosPorPagina);
    }

    mysqli_stmt_execute($stmt);

    // Guardamos los datos de la consulta
    $alumnos = mysqli_stmt_get_result($stmt);

    // Cerramos la consulta
    mysqli_stmt_close($stmt);

    // Calcular el número total de páginas
    $sqlTotal = "SELECT COUNT(*) as total FROM tbl_alumnos E INNER JOIN tbl_cursos D ON E.id_curso = D.id WHERE E.nombre LIKE ?";
    $stmtTotal = mysqli_prepare($conn, $sqlTotal);

    // Añadir el signo de porcentaje solo si se ha proporcionado un término de búsqueda
    if (!empty($nombreBusqueda)) 
    {
        $nombreBusquedaTotal = $nombreBusqueda ;
        mysqli_stmt_bind_param($stmtTotal, "s", $nombreBusquedaTotal);
    } 

    else 
    {
        // Si no hay término de búsqueda, usar un LIKE que coincida con todo
        $nombreBusquedaTotal = '%';
        mysqli_stmt_bind_param($stmtTotal, "s", $nombreBusquedaTotal);
    }

    mysqli_stmt_execute($stmtTotal);
    $totalAlumnos = mysqli_fetch_assoc(mysqli_stmt_get_result($stmtTotal))['total'];
    $totalPaginas = ceil($totalAlumnos / $resultadosPorPagina);
    mysqli_stmt_close($stmtTotal);
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
        <!-- Formulario de búsqueda por nombre -->
        <form action="" method="get">
            <label for="nombre">Buscar por nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $nombreBusqueda; ?>">
            <button type="submit">Buscar</button>
        </form>

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
              <td> {$alumno["nombre"]} {$alumno["apellido1"]} </td>   
              <td> {$alumno["email"]} </td>
              <td> {$alumno["pass"]} </td>
              <td> {$alumno["telefono"]} </td>
              <td> {$alumno["curso"]} </td>
              <td><a href='./notas.php?id={$alumno['id']}&id_curso={$alumno["id_curso"]}'>notas</a>
              <td><a href='./editar_alumno.php?id={$alumno['id']}'>editar</a>
              <td><a href='./procesos/eliminar.php?id={$alumno['id']}'>aliminar</a>
              </tr>";
        }
        ?>
    </table>
</body>

        <table border=1>
            <tr>
                <th>nombre y apellidos</th>
                <th>email</th>
                <th>pass</th>
                <th>telefono</th>
                <th>curso</th>
                <th>Notas</th>
            </tr>

            <?php
                foreach ($alumnos as $alumno) 
                {
                    echo 
                    "
                        <tr>
                            <td> {$alumno["nombre"]} {$alumno["apellido1"]} </td>   
                            <td> {$alumno["email"]} </td>
                            <td> {$alumno["pass"]} </td>
                            <td> {$alumno["telefono"]} </td>
                            <td> {$alumno["curso"]} </td>
                            <td><a href='./notas.php?id={$alumno['id']}'>notas</a></td>
                        </tr>
                    ";
                }
                ?>
        </table>

        <div>
            <!-- Agregar enlaces de paginación -->
            <?php for ($i = 1; $i <= $totalPaginas; $i++) : ?>
                <a href="?pagina=<?php echo $i; ?>&nombre=<?php echo $nombreBusqueda; ?>"><?php echo $i; ?></a>
            <?php endfor; ?>
        </div>
    </body>
</html>
