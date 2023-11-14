<?php
try 
{
    // Establecemos una cadena vacía para almacenar los mensajes de error.
    $errores = "";
    // Recogida de datos
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $pwdEncript = hash("sha256", $pwd);
    $telefono = $_POST["telefono"];
    $curso = $_POST["curso"];
    include_once("./conexion.php");

    mysqli_autocommit($conn, false);
    mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);

    // Verificar si el email ya existe
    $stmtEmailCheck = mysqli_stmt_init($conn);
    $sqlEmailCheck = "SELECT id FROM tbl_alumnos WHERE email = ?";
    mysqli_stmt_prepare($stmtEmailCheck, $sqlEmailCheck);
    mysqli_stmt_bind_param($stmtEmailCheck, "s", $email);
    mysqli_stmt_execute($stmtEmailCheck);
    mysqli_stmt_store_result($stmtEmailCheck);

    if (mysqli_stmt_num_rows($stmtEmailCheck) > 0) {
        // Si ya existe un registro con el mismo email, manejar la situación aquí (por ejemplo, mostrar un mensaje de error).
        $errores .= "?emailExiste=true";
    }

    mysqli_stmt_close($stmtEmailCheck);

    // Verificar si el teléfono ya existe
    $stmtPhoneCheck = mysqli_stmt_init($conn);
    $sqlPhoneCheck = "SELECT id FROM tbl_alumnos WHERE telefono = ?";
    mysqli_stmt_prepare($stmtPhoneCheck, $sqlPhoneCheck);
    mysqli_stmt_bind_param($stmtPhoneCheck, "s", $telefono);
    mysqli_stmt_execute($stmtPhoneCheck);
    mysqli_stmt_store_result($stmtPhoneCheck);

    if (mysqli_stmt_num_rows($stmtPhoneCheck) > 0) {
        // Si ya existe un registro con el mismo teléfono, manejar la situación aquí (por ejemplo, mostrar un mensaje de error).
        $errores .= "&telExiste=true";
    }

    mysqli_stmt_close($stmtPhoneCheck);

    if ($errores != "") 
    {
        $datosRecibidos = array('email' => $email, 'telefono' => $telefono);

        $datosDevueltos = http_build_query(array_map('urlencode', $datosRecibidos));

        header('Location: ../crear.php'.$errores.'&'.$datosDevueltos);
        die();
    }

    else 
    {        
        // Inserción de datos
        $stmtInsert = mysqli_stmt_init($conn);
        $sqlInsert = "INSERT INTO `tbl_alumnos` (`id`, `nombre`, `apellido`, `email`, `pass`, `telefono`, `id_curso`) VALUES (NULL, ?, ?, ?, ?, ?, ?)";
        mysqli_stmt_prepare($stmtInsert, $sqlInsert);
        mysqli_stmt_bind_param($stmtInsert, "sssssi", $nombre, $apellido, $email, $pwdEncript, $telefono, $curso);
        mysqli_stmt_execute($stmtInsert);

        // Confirmamos la inserción y cerramos la conexión
        mysqli_commit($conn);
        mysqli_stmt_close($stmtInsert);
        mysqli_close($conn);

        header('Location: ../tabla.php');
    } 

}

catch (Exception $e) 
{
    // Deshacemos las inserciones en el caso de que se genere alguna excepción
    echo "Error: " . $e->getMessage() . "";
    die();
}
?>
