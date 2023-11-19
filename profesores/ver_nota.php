<?php
// var_dump($_POST); // Agrega esta línea para depurar
$alumno_id = $_POST['id'];
$curso = $_POST['id_curso'];
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

    // Consulta para mostrar la tabla de los alumnos
    $sql = "SELECT N.*, A.nombre, A.apellido1, A.apellido2, M.nombre as 'asignatura' FROM tbl_notas N 
                INNER JOIN tbl_alumnos A ON N.id_alumno = A.id 
                INNER JOIN tbl_asignaturas M ON N.id_asignatura=M.id 
                WHERE N.id_alumno=?;";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $alumno_id);
    mysqli_stmt_execute($stmt);

    // Verificar si la consulta fue exitosa
    if (!$stmt) {
        die('Error en la consulta SQL: ' . mysqli_error($conn));
    }

    // Guardamos los datos de la consulta
    $result = mysqli_stmt_get_result($stmt);

    // Cerramos la consulta
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    // Imprimir el nombre y apellidos fuera de la tabla
    ?>

    <?php if (mysqli_num_rows($result) > 0) : ?>
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
                    <form action='./editar_nota.php' method='post'>
                        <?php foreach ($result as $nota) : ?>
                            <tr>
                                <input type='hidden' name='id' value='<?php echo $nota['id_alumno']; ?>'>
                                <input type='hidden' name='id_curso' value='<?php echo $curso; ?>'>
                                <td><label><?php echo $nota["asignatura"]; ?></label></td>
                                <input type='hidden' name='asignatura' value='<?php echo $nota['id_asignatura']; ?>'>
                                <td><input type='text' name='nota' value='<?php echo $nota["nota"]; ?>'></td>
                                <td><label><?php echo date("d/m/Y", strtotime($nota["fecha_registro"])); ?></label></td>
                                <td><input type='submit' id='botonEditar' name='enviar' value='Editar'></td>
                            </tr>
                        <?php endforeach; ?>
                    </form>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <p style='font-weight: bolder;'>No hay notas de este alumno.</p>
        <div class="cont-botones">
            <div class="cont-botonAñadir">
                <form action="crear_nota.php" method="post">
                    <input type='hidden' name='alumno' value='<?php echo $alumno_id; ?>'>
                    <input type='hidden' name='curso' value='<?php echo $curso; ?>'>
                    <button class="botonAñadir" type="submit">Añadir nota ahora</button>
                </form>
            </div>

            <div class="cont-botonVolver">
                <button class="botonVolver"><a href='./tabla.php'>Volver</a></button>
            </div>
        </div>
    <?php endif; ?>


</body>

</html>