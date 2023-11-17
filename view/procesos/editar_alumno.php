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

    try 
    {
        mysqli_autocommit($conn, false);
        mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);
        $sql = "SELECT tbl_alumnos.id as id, tbl_alumnos.nombre as nombre, tbl_alumnos.apellido1 as apellido1, tbl_alumnos.apellido2 as apellido2, SUBSTRING_INDEX(tbl_alumnos.email, '@', 1) AS email, tbl_alumnos.pass, tbl_alumnos.telefono, tbl_cursos.nombre as curso FROM `tbl_alumnos` INNER JOIN tbl_cursos ON tbl_alumnos.id_curso = tbl_cursos.id WHERE tbl_alumnos.id = ?";
    
        $stmt = mysqli_prepare($conn, $sql);
    
        // Vincular los parámetros a la sentencia
        mysqli_stmt_bind_param($stmt, "i", $id);
        
        // Ejecutar la sentencia
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($resultado) > 0) {
            while ($row = mysqli_fetch_assoc($resultado)) 
            {
                ?>
                <div class="form-m">
                <form action="../../procesos/update.php" method="post">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <?php
                        if (isset($_GET['errorN'])) {
                            echo "<p style='color: red;'>" . $_GET['errorN'] . "</p>";
                        } ?>
                        <label for="inputEmail4">Nombre</label>
                        <input type="text" class="form-control" name="nombre" placeholder="Nombre" value="<?php echo $row['nombre']; ?>">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputEmail4">Primer Apellido</label>
                        <input type="text" class="form-control" name="apellido1" placeholder="Primer Apellido" value="<?php echo $row['apellido1']; ?>">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputEmail4">Segundo Apellido</label>
                        <input type="text" class="form-control" name="apellido2" placeholder="Segundo Apellido" value="<?php echo $row['apellido2']; ?>">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputEmail4">Curso</label>
                        <select name="lenguajes" id="lang" class="form-control">
                        <?php 
                        $id = $row['id'];
                        $curso = $row['curso'];
                        $sql2 = "SELECT * FROM `tbl_cursos`;";
        
                        $stmt2 = mysqli_prepare($conn, $sql2);

                        // Vincular los parámetros a la sentencia
                        // mysqli_stmt_bind_param($stmt, "s", $row['curso']);
                        
                        // Ejecutar la sentencia
                        mysqli_stmt_execute($stmt2);
                        $resultado2 = mysqli_stmt_get_result($stmt2);
                        if (mysqli_num_rows($resultado2) > 0) {
                        while ($row2 = mysqli_fetch_assoc($resultado2)) {
                            if ($row2["nombre"] === $curso) {
                                echo "<option value='" . $row2['id'] . "' selected>" . $row2['nombre'] . "</option>";     
                            }else {
                                echo "<option value='" . $row2['id'] . "'>" . $row2['nombre'] . "</option>";     
                            }
                        }
                        }?>
                    </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="inputEmail4">Contraseña</label>
                        <input type="text" class="form-control" name="pass" placeholder="Contraseña" value="<?php echo $row['pass']; ?>">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputEmail4">Teléfono</label>
                        <input type="text" class="form-control" name="telf" placeholder="Teléfono" value="<?php echo $row['telefono']; ?>">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="inputEmail4">Email</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <input type="text" class="form-control" name="email" placeholder="Email" value="<?php echo $row['email']; ?>">
                            </div>
                            <div class="input-group-text">@contreras.com</div>
                        </div>
                        <?php
                            if (isset($_GET['error'])) {
                                echo "<p style='color: red;'>" . $_GET['error'] . "</p>";
                            } ?>
                    </div>
                </div>
                

                    <th><input type="submit" class="btn btn-primary mb-2" value="Modificar" style="float: right;"></th>
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

