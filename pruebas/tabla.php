<?php
    session_start();

    include('../procesos/conexion.php');

    // Número de usuarios por página
    $usuariosPorPagina = 10;

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
    
    $condicionNombre;
    $resultadoContenidoTabla = mysqli_query($conn, $contenidoTabla);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- FONT AWESOME -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
        <!-- CSS -->
        <link rel="stylesheet" href="../css/estilosPrueba.css">
        <!-- TITULO -->
        <title>Página de pruebas estilos tabla.php</title>
    </head>

    <body>
        <div id="encabezado">
            <div id="cont-logo">
                <img src="../img/logo.png" id="logo">
            </div>

            <div id="cont-filtro">
                <form action="" method="get">
                    <label for="nombre">Buscar por nombre:</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombreBusqueda); ?>">
                    <button type="submit" id="boton">Buscar</button>
                    <?php if (!empty($nombreBusqueda)) : ?>
                        <button class="eliminar-filtro"><a href="?pagina=1" class="eliminar-filtro">Eliminar Filtros</a></button>
                    <?php endif; ?>
                </form>
            </div>

            <div id="cont-texto">
                <p>Hola</p>
            </div>
        </div>
        
        <div id="cont-tabla">
            <table class="mi-tabla">
                <thead>
                    <tr>
                        <th>Nº de lista</th>
                        <th>Nombre</th>
                        <th>1r Apellido</th>
                        <th>2o Apellido</th>
                        <th>Email</th>
                        <th>Clase</th>
                        <th>Notas</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                        if ($resultadoContenidoTabla) 
                        {
                            while ($fila = mysqli_fetch_assoc($resultadoContenidoTabla)) {    
                                $id = $fila['id'];     
                                echo "<tr>";
                                    foreach ($fila as $valor) 
                                    {
                                        echo "<td>$valor</td>";
                                    }
                                    ?>
                                        <td>
                                            <form action="mostrarNotas.php" method="post">
                                                <input type="hidden" name="id" value="<?php echo $fila['id'] ?>">
                                                <input type="hidden" name="id_curso" value="<?php echo $fila['curso'] ?>">
                                                <input type="submit" name="envar" value="Mostrar" id="botonEditar">
                                            </form>
                                        </td>
                                    <?php
                                echo "</tr>";
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>

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
