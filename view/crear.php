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
            <input type="text" id="nombre" name="nombre" oninput="validarNombre(this)"> <!-- Llama a la función validarNombre cuando detecta cambios en el input -->
            <!-- Mensaje de error para la validación del nombre -->
            <br>
            <span id="nombre_error" class="error"></span>

            <br><br>

            <label for="apellido">Apellido:</label>
            <!-- Campo de entrada para el apellido -->
            <input type="text" id="apellido" name="apellido" oninput="validarApellido(this)"> <!-- Llama a la función validarApellido cuando detecta cambios en el input -->
            <!-- Mensaje de error para la validación del apellido -->
            <br>
            <span id="apellido_error" class="error"></span>

            <br><br>

            <label for="email">Email:</label>
            <!-- Campo de entrada para el correo electrónico -->
            <input type="email" id="email" name="email" oninput="validarEmail(this)"> <!-- Llama a la función validarEmail cuando detecta cambios en el input -->
            <!-- Mensaje de error para la validación del correo electrónico -->
            <br>
            <span id="email_error" class="error"></span>

            <br><br>

            <label for="nombre">Contraseña:</label>
            <!-- Campo de entrada para la contraseña -->
            <input type="password" id="pwd" name="pwd" oninput="validarPwd(this)"> <!-- Llama a la función validarPwd cuando detecta cambios en el input -->
            <!-- Mensaje de error para la validación de la contraseña -->
            <br>
            <span id="pwd_error" class="error"></span>

            <br><br>

            <label for="nombre">Número de Teléfono:</label>
            <!-- Campo de entrada para el número de teléfono -->
            <input type="tel" id="telefono" name="telefono" oninput="validarTelefono(this)"> <!-- Llama a la función validarTel cuando detecta cambios en el input -->
            <!-- Mensaje de error para la validación del número de teléfono -->
            <br>
            <span id="telefono_error" class="error"></span>
                
            <br><br>

            <label>Curso:</label><br>
                <?php
                    include('../procesos/conexion.php'); /* Incluimos el fichero de conexión a la base de datos */

                    $sqlSelectCurso = "SELECT nombre FROM tbl_cursos;"; /* SQL para seleccionar el nombre de los cursos de la tabla tbl_cursos */
                    $resultadoSelectCurso = mysqli_query($conn, $sqlSelectCurso); /* Resultado del SQL */

                    if (mysqli_num_rows($resultadoSelectCurso) > 0) /* Comprueba si hay resultados */
                    {
                        echo "<select name='curso' id='curso' onchange='validarCurso(this)'>"; /* Selector de opciones */
                            echo "<option value='' selected> -- Escoge una opción -- </option>"; // Opcíon por defecto, Deshabilitada para que no se pueda seleccionar 

                            while ($row = mysqli_fetch_assoc($resultadoSelectCurso)) // Si hay resultados...
                            {
                                $curso = $row['nombre']; /* Almacena en una variable el nombre del curso */
                                $id_curso = $row['id'];
                                echo "<option value='$id_curso'>$curso</option>"; /* Imprime el nombre del curso */
                            }
                        echo "</select>";
                        echo "<br>";
                        echo "<span id='curso_error' class='error'</span>"; /* Mensaje de error */
                    }

                    else 
                    {
                        echo "No se han encontrado cursos"; // Mensaje de error.
                    }
                ?>
            
            <br><br>

            <input type="submit" value="Enviar" id="enviarButton" disabled>        
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

