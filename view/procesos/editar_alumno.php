<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar </title>
    <!-- BOOSTRAP -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    
</body>
</html>
<?php
// Conexión a la base de datos (igual que antes)

include_once('./conexion.php');

    $id = $_GET['id'];

    try {
        mysqli_autocommit($conn, false);
        mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);
        $sql = "SELECT tbl_alumnos.id as id, tbl_alumnos.nombre as nombre, tbl_alumnos.apellido as apellido, tbl_alumnos.email as email, tbl_alumnos.pass, tbl_alumnos.telefono, tbl_cursos.nombre as curso FROM `tbl_alumnos` INNER JOIN tbl_cursos ON tbl_alumnos.id_curso = tbl_cursos.id WHERE tbl_alumnos.id = ?";
    
        $stmt = mysqli_prepare($conn, $sql);
    
        // Vincular los parámetros a la sentencia
        mysqli_stmt_bind_param($stmt, "i", $id);
        
        // Ejecutar la sentencia
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($resultado) > 0) {
            while ($row = mysqli_fetch_assoc($resultado)) {
                ?>
                <div class="form-m">
                <form action="../../procesos/update.php" method="post">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="inputEmail4">Nombre</label>
                        <input type="text" class="form-control" placeholder="Nombre" value="<?php echo $row['nombre']; ?>">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputEmail4">Apellido</label>
                        <input type="text" class="form-control" placeholder="Apellido" value="<?php echo $row['apellido']; ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputEmail4">Email</label>
                        <input type="text" class="form-control" placeholder="Email" value="<?php echo $row['email']; ?>">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputEmail4">Teléfono</label>
                        <input type="text" class="form-control" placeholder="Teléfono" value="<?php echo $row['telefono']; ?>">
                    </div>
                </div>
                    <th><input type="text" name="pass" value="<?php echo $row['pass']; ?>"></th>
                    <select name="lenguajes" id="lang">
                        <?php 
                        $id = $row['id'];
                        $curso = $row['curso'];
                        $sql = "SELECT * FROM `tbl_cursos`;";
        
                        $stmt = mysqli_prepare($conn, $sql);

                        // Vincular los parámetros a la sentencia
                        // mysqli_stmt_bind_param($stmt, "s", $row['curso']);
                        
                        // Ejecutar la sentencia
                        mysqli_stmt_execute($stmt);
                        $resultado = mysqli_stmt_get_result($stmt);
                        if (mysqli_num_rows($resultado) > 0) {
                        while ($row = mysqli_fetch_assoc($resultado)) {
                            if ($row["nombre"] === $curso) {
                                echo "<option value='" . $row['id'] . "' selected>" . $row['nombre'] . "</option>";     
                            }else {
                                echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";     
                            }
                        }
                        }?>
                    </select>
                    <th><input type="submit" value="Modificar"></th>
                    <th><input type="text" style="visibility: hidden; width: 0;" name="id" value="<?php echo $id; ?>"></th>
                </form>
                </div>
    <?php
                
            }
        }

        // Redirigimos a la página de listado del CRUD
        // header('Location: ../tabla.php');
    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo 'Error: ' . $e->getMessage() . '';
    }

