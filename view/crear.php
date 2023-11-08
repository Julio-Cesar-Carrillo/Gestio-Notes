<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="../js/validarCrear.js"></script>
        <title>Document</title>
    </head>

    <body>
            <form action="./procesos/crear.php" method="post" id="formularioCrear">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" oninput="validarNombre(this)">
            <span id="nombre_error" class="error"></span>
            
            <br><br>
            
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" oninput="validarApellido(this)">
            <span id="apellido_error" class="error"></span>
            
            <br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" oninput="validarEmail(this)">
            <span id="email_error" class="error"></span>
            
            <br><br>

            <label for="nombre">Contraseña:</label>
            <input type="tel" id="pwd" name="pwd" oninput="validarPwd(this)">
            <span id="pwd_error" class="error"></span>
            
            <br><br>

            <label for="nombre">Número de Teléfono:</label>
            <input type="tel" id="telefono" name="telefono" oninput="validarTelefono(this)">
            <span id="telefono_error" class="error"></span
                
            ><br><br>

            <label>Curso:</label><br>
            <select name="curso" id="curso">
                <option value="" disabled selected>-- Escoge una opción --</option>
                <?php
                    include('./conexion.php');
                    $sqlSelectCurso = "SELECT nombre FROM tbl_cursos;";
                    $resultadoSelectCurso = mysqli_query($conn, $sqlSelectCurso);

                    if (mysqli_num_rows($resultadoSelectCurso) > 0) 
                    {
                        while ($row = mysqli_fetch_assoc($resultadoSelectCurso)) 
                        {
                            $curso = $row['nombre'];
                            echo "<option value='$curso'>$curso</option>";
                        }
                    }
                ?>
            </select>
            <span id="curso_error" class="error"></span>
            
            <br><br>

            <input type="submit" value="Enviar" id="enviarButton" disabled>        
        </form>

        <script>
            // Función para validar el formulario
            function validarFormulario() {
                var nombre = document.getElementById("nombre").value;
                var apellido = document.getElementById("apellido").value;
                var email = document.getElementById("email").value;
                var pwd = document.getElementById("pwd").value;
                var telefono = document.getElementById("telefono").value;
                var curso = document.getElementById("curso").value;
            
                // Verificar si todos los campos están llenos
                if (nombre !== "" && apellido !== "" && email !== "" && pwd !== "" && telefono !== "" && curso !== "") {
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

