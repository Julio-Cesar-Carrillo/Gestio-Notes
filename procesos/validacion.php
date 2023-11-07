<?php
    session_start(); // Iniciamos la sesión.

    // Verifica si el formulario se ha enviado
    if (!isset($_POST['enviar'])) {
        header('Location: ../index.php?error=Debes rellenar el formulario para acceder a validacion.php');
        exit();
    }

    // Si se ha enviado un valor para 'user', lo almacenamos en una variable de sesión llamada 'user'
    if (isset($_POST['user'])) {
        $_SESSION['user'] = $_POST['user'];
    }

    // Si se ha enviado un valor para 'pass', lo almacenamos en una variable de sesión llamada 'pass'
    if (isset($_POST['pass'])) {
        $pass = $_POST['pass'];
        $_SESSION['pass'] = $pass;
    }

    // Redirige al usuario a la página 'check.php'
    header("Location: check.php");
    exit();
?>
