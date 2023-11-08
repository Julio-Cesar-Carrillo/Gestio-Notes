<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="../js/validarCrear.js"></script>
        <title>Crear alumno</title>
    </head>

    <body>
        <form action="./procesos/crear.php" method="post">
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
            <select name="selelectCurso" id="selelectCurso">
                <option value="" disabled selected>-- Escoge una opción --</option>
                <?php
                    include('./conexion.php');
                    $sql
                ?>
            </select>
            <span id="curso_error" class="error"></span>
            
            <br><br>
    
            <p><input type="submit" value="enviar"></p>
        </form>
    </body>
</html>