<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/validacion.js"></script> <!-- Script que valida el formulario -->
    <title>Document</title>
</head>

<body>
    <form action="./procesos/crear.php" method="post" id="formularioCrear">
        <label for="nombre">Nombre:</label>
        <!-- Campo de entrada para el nombre -->
        <input type="text" id="nombre" name="nombre" oninput="validarNombre(this)" value="<?php echo isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : ''; ?>">
        <!-- Mensaje de error para la validación del nombre -->
        <br>
        <span id="nombre_error" class="error"></span>

        <br><br>

        <label for="apellido">Apellido:</label>
        <!-- Campo de entrada para el apellido -->
        <input type="text" id="apellido" name="apellido" oninput="validarApellido(this)" value="<?php echo isset($_POST['apellido']) ? htmlspecialchars($_POST['apellido']) : ''; ?>">
        <!-- Mensaje de error para la validación del apellido -->
        <br>
        <span id="apellido_error" class="error"></span>

        <br><br>

        <label for="email">Email:</label>
        <!-- Campo de entrada para el correo electrónico -->
        <input type="email" id="email" name="email" oninput="validarEmail(this)" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
        <!-- Mensaje de error para la validación del correo electrónico -->
        <br>
        <?php 
            if(isset($_GET['emailExiste'])) 
            {
                ?><span style="color:red;">No se puede repetir el correo electrónico</span><?php
            }
        ?>
        <span id="email_error" class="error"></span>

        <br><br>

        <label for="pwd">Contraseña:</label>
        <!-- Campo de entrada para la contraseña -->
        <input type="password" id="pwd" name="pwd" oninput="validarPwd(this)">
        <!-- Mensaje de error para la validación de la contraseña -->
        <br>
        <span id="pwd_error" class="error"></span>

        <br><br>

        <label for="telefono">Número de Teléfono:</label>
        <!-- Campo de entrada para el número de teléfono -->
        <input type="tel" id="telefono" name="telefono" oninput="validarTelefono(this)" value="<?php echo isset($_POST['telefono']) ? htmlspecialchars($_POST['telefono']) : ''; ?>">
        <!-- Mensaje de error para la validación del número de teléfono -->
        <br>
        <?php 
            if(isset($_GET['telExiste'])) 
            {
                ?><span style="color:red;">No se puede repetir el número de teléfono</span><?php
            }
        ?>
        <span id="telefono_error" class="error"></span>
            
        <br><br>

        <label>Curso:</label><br>
        <?php
            include('../procesos/conexion.php');

            $sqlSelectCurso = "SELECT id, nombre FROM tbl_cursos;";
            $resultadoSelectCurso = mysqli_query($conn, $sqlSelectCurso);

            if (mysqli_num_rows($resultadoSelectCurso) > 0) 
            {
                echo "<select name='curso' id='curso' onchange='validarCurso(this)'>";
                echo "<option value='' selected> -- Escoge una opción -- </option>";

                while ($row = mysqli_fetch_assoc($resultadoSelectCurso)) 
                {
                    $curso = $row['nombre'];
                    $id_curso = $row['id'];
                    echo "<option value='$id_curso'>$curso</option>";
                }
                echo "</select>";
                echo "<br>";
                echo "<span id='curso_error' class='error'></span>";
            } 
            else 
            {
                echo "No se han encontrado cursos";
            }
        ?>
    
        <br><br>

        <input type="submit" value="Enviar" id="enviarButton" disabled>     
        <button><a href="./tabla.php">Volver a la tabla</a></button>   
    </form>

    <script>
        // Función para validar el formulario
        function validarFormulario() 
        {
            var nombre = document.getElementById("nombre").value;
            var apellido = document.getElementById("apellido").value;
            var email = document.getElementById("email").value;
            var pwd = document.getElementById("pwd").value;
            var telefono = document.getElementById("telefono").value;
            var curso = document.getElementById("curso").value;

            // Verificar si todos los campos están llenos
            if (nombre !== "" && apellido !== "" && email !== "" && pwd !== "" && telefono !== "" && curso !== "") 
            {
                document.getElementById("enviarButton").disabled = false; // Habilitar el botón de envío
            } 
            else 
            {
                document.getElementById("enviarButton").disabled = true; // Deshabilitar el botón de envío
            }
        }

        // Agregar eventos 'input' a los campos para llamar a la función de validación
        document.getElementById("nombre").addEventListener("input", validarFormulario);
        document.getElementById("apellido").addEventListener("input", validarFormulario);
        document.getElementById("email").addEventListener("input", validarFormulario);
        document.getElementById("pwd").addEventListener("input", validarFormulario);
        document.getElementById("telefono").addEventListener("input", validarFormulario);
        document.getElementById("curso").addEventListener("change", validarFormulario); // Cambio en el campo de selección

        // Llamar a la función de validación inicialmente
        validarFormulario();
    </script>
</body>
</html>
