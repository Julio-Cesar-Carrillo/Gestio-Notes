<?php
$alumno_id = $_POST['id'];
include_once("../procesos/conexion.php");

// Consulta para obtener el nombre y apellidos del alumno
$alumno_info_sql = "SELECT nombre, apellido1, apellido2 FROM tbl_alumnos WHERE id=?";
$alumno_info_stmt = mysqli_prepare($conn, $alumno_info_sql);
mysqli_stmt_bind_param($alumno_info_stmt, "i", $alumno_id);
mysqli_stmt_execute($alumno_info_stmt);
$alumno_info_result = mysqli_stmt_get_result($alumno_info_stmt);
$alumno_info = mysqli_fetch_assoc($alumno_info_result);
mysqli_stmt_close($alumno_info_stmt);

// Imprimir el nombre y apellidos en el encabezado
$nombre_apellidos = $alumno_info['nombre'] . ' ' . $alumno_info['apellido1'] . ' ' . $alumno_info['apellido2'];
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
    <title>Notas del Alumno</title>
</head>

<body>
    <div id="cont-header">
        <h1 id="texto-header"><?php echo $nombre_apellidos; ?></h1>
    </div>

    <?php
    // Consulta para contar la cantidad de asignaturas
    $count_sql = "SELECT COUNT(DISTINCT id_asignatura) as asignaturas_count FROM tbl_notas WHERE id_alumno = ?";
    $count_stmt = mysqli_prepare($conn, $count_sql);
    mysqli_stmt_bind_param($count_stmt, "i", $alumno_id);
    mysqli_stmt_execute($count_stmt);
    $count_result = mysqli_stmt_get_result($count_stmt);
    $asignaturas_count = mysqli_fetch_assoc($count_result)['asignaturas_count'];
    mysqli_stmt_close($count_stmt);

    // Consulta para mostrar la tabla de los alumnos
    $sql = "SELECT N.*, A.nombre, A.apellido1, A.apellido2, M.nombre as 'asignatura' FROM tbl_notas N 
                INNER JOIN tbl_alumnos A ON N.id_alumno = A.id 
                INNER JOIN tbl_asignaturas M ON N.id_asignatura=M.id 
                WHERE N.id_alumno=?;";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $alumno_id);
    mysqli_stmt_execute($stmt);
    // Guardamos los datos de la consulta
    $result = mysqli_stmt_get_result($stmt);
    // Cerramos la consulta
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    // Imprimir el nombre y apellidos fuera de la tabla
    ?>

    <div class="cont-tabla">
        <table class="mi-tabla">
            <thead>
                <tr>
                    <th>Asignatura</th>
                    <th>Nota</th>
                    <th>Fecha registro</th>
                    <th>Editar</th>
                </tr>
            </thead>

            <tbody>
                <form action="editar_nota.php" method="post">
                    <?php
                    // Resto del código sin cambios
                    while ($nota = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                    <input type='hidden' name='id' value='{$nota['id']}'>
                                    <td><label>{$nota["asignatura"]}</label></td>
                                    <td><input type='text' value='{$nota["nota"]}'></td>
                                    <td><label>" . date("d/m/Y", strtotime($nota["fecha_registro"])) . "</label></td>
                                    <td><input type='submit' id='botonEditar' name='enviar' value='Editar'></td>
                                </tr>";
                    }
                    ?>
                </form>
            </tbody>
        </table>
    </div>

    <?php
    // Verificar si hay menos de 3 asignaturas para mostrar el botón de "Añadir nota ahora"
    if (mysqli_num_rows($result) == 0) {
        echo "<p style='font-weight: bolder;'>No hay notas de este alumno.<p>";
            ?>  
            <div class="cont-botones">
                <div class="cont-botonAñadir">
                    <button class="botonAñadir"><a href='./crear_nota.php?id={$alumno_id}'>Añadir nota ahora</a></button>
                </div>

                <div class="cont-botonVolver">
                    <button class="botonVolver"><a href='./tabla.php'>Volver</a></button>
                </div>
            </div>

            <?php
        exit();
    } elseif (mysqli_num_rows($result) == 1) {
        echo "<p>Aun faltan añadir 2 notas.<p>";
        ?>  
        <div class="cont-botonAñadir">
            <button class="botonAñadir"><a href='./crear_nota.php?id={$alumno_id}'>Añadir nota ahora</a></button>
        </div>

        <div class="cont-botonVolver">
            <button class="botonVolver"><a href='./tabla.php'>Volver</a></button>
        </div>
        <?php
    exit();
    } elseif (mysqli_num_rows($result) == 2) {
        echo "<p>Aun falta añadir 1 nota.<p>";
        ?>  
        <div class="cont-botonAñadir">
            <button class="botonAñadir"><a href='./crear_nota.php?id={$alumno_id}'>Añadir nota ahora</a></button>
        </div>

        <div class="cont-botonVolver">
            <button class="botonVolver"><a href='./tabla.php'>Volver</a></button>
        </div>

        <?php
    exit();
    }

    elseif (mysqli_num_rows($result) == 3) {
        ?>  
        <div class="cont-botonVolver">
            <button class="botonVolver"><a href='./tabla.php'>Volver</a></button>
        </div>

        <?php
    exit();
    }
    ?>
</body>

</html>