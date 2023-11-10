<?php

if (!isset($_GET['id'])) {
    header('location: ./tabla.php');
    exit();
} else {

    $alumno = $_GET['id'];

    include_once("./procesos/conexion.php");

    $sql = "SELECT E.*, D.nombre as 'curso' FROM tbl_alumnos E 
    INNER JOIN tbl_cursos D ON E.id_curso = D.id WHERE E.id=?;";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $alumno);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($resultado) == 0) {
        header('location: ./tabla.php');
        exit();
    }
    // Almacenamos el resultado de la consulta en un array asociativo
    $datos_alumno = mysqli_fetch_assoc($resultado);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar pedido</title>
    </head>

    <body>
        <h2>Editar alumno</h2>
        <form action="./procesos/editar_alumno.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $datos_alumno['id']; ?>">

            <label for="nombre">Nombre:</label>
            <!-- Campo de entrada para el nombre -->
            <input type="text" id="nombre" name="nombre" oninput="validarNombre(this)" value= "<?php echo $datos_alumno['nombre']; ?>" > <!-- Llama a la función validarNombre cuando detecta cambios en el input -->
            <!-- Mensaje de error para la validación del nombre -->
            <br>
            <span id="nombre_error" class="error"></span>

            <br><br>

            <label for="apellido">Apellido:</label>
            <!-- Campo de entrada para el apellido -->
            <input type="text" id="apellido" name="apellido" oninput="validarApellido(this)" value= "<?php echo $datos_alumno['apellido']; ?>"> <!-- Llama a la función validarApellido cuando detecta cambios en el input -->
            <!-- Mensaje de error para la validación del apellido -->
            <br>
            <span id="apellido_error" class="error"></span>

            <br><br>

            <label for="email">Email:</label>
            <!-- Campo de entrada para el correo electrónico -->
            <input type="email" id="email" name="email" oninput="validarEmail(this)" value= "<?php echo $datos_alumno['email']; ?>"> <!-- Llama a la función validarEmail cuando detecta cambios en el input -->
            <!-- Mensaje de error para la validación del correo electrónico -->
            <br>
            <span id="email_error" class="error"></span>

            <br><br>

            <label for="nombre">Contraseña:</label>
            <!-- Campo de entrada para la contraseña -->
            <input type="password" id="pwd" name="pwd" oninput="validarPwd(this)" value= "<?php echo $datos_alumno['pass']; ?>"> <!-- Llama a la función validarPwd cuando detecta cambios en el input -->
            <!-- Mensaje de error para la validación de la contraseña -->
            <br>
            <span id="pwd_error" class="error"></span>

            <br><br>

            <label for="nombre">Número de Teléfono:</label>
            <!-- Campo de entrada para el número de teléfono -->
            <input type="tel" id="telefono" name="telefono" oninput="validarTelefono(this)" value= "<?php echo $datos_alumno['telefono']; ?>"> <!-- Llama a la función validarTel cuando detecta cambios en el input -->
            <!-- Mensaje de error para la validación del número de teléfono -->
            <br>
            <span id="telefono_error" class="error"></span>

            <br><br>

            <label for="curso">Curso:</label>
            <p><?php echo $datos_alumno['curso'] ?></p>

            <br><br>

            <button type="submit" class="btn btn-primary" name="enviar" id="enviarButton" disabled>Enviar</button>
            
            <button type="submit"><a href="./tabla.php">Volver a la tabla</a></button>

            <script src="../js/validacion.js"></script> <!-- Este script valida el formato y si los campos están vacíos -->
        </form>

        <script>
            // Función para validar el formulario
            function validarFormulario() {
                var email = document.getElementById("email").value;
                var pwd = document.getElementById("pwd").value;
                var nombre = document.getElementById("nombre").value;
                var apellido = document.getElementById("apellido").value;
                var telefono = document.getElementById("telefono").value;

                // Verificar si todos los campos están llenos y realizar otras validaciones si es necesario
                if (email !== "" && pwd !== "" && nombre !== "" && apellido !== "" && telefono !== "") {
                    // Puedes agregar más validaciones aquí si es necesario
                    document.getElementById("enviarButton").disabled = false; // Habilitar el botón de envío
                } else {
                    document.getElementById("enviarButton").disabled = true; // Deshabilitar el botón de envío
                }
            }

            // Agregar eventos 'input' a los campos para llamar a la función de validación
            document.getElementById("email").addEventListener("input", validarFormulario);
            document.getElementById("pwd").addEventListener("input", validarFormulario);
            document.getElementById("nombre").addEventListener("input", validarFormulario);
            document.getElementById("apellido").addEventListener("input", validarFormulario);
            document.getElementById("telefono").addEventListener("input", validarFormulario);

            // Llamar a la función de validación inicialmente
            validarFormulario();
        </script>
    </body>

    </html>

<?php
}
