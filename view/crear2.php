<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear alumno</title>
</head>
<body>
    <form action="./procesos/crear.php" method="post">
        <label for="nombre">Nombre</label>
        <p><input type="text" name="nombre" id="nombre"></p>
        
        <label for="apellido">apellido</label>
        <p><input type="text" name="apellido" id="apellido"></p>

        <label for="email">email</label>
        <p><input type="email" name="email" id="email"></p>

        <label for="nombre">password</label>
        <p><input type="text" name="pwd" id="pwd"></p>

        <label for="nombre">telefono</label>
        <p><input type="text" name="telefono" id="telefono"></p>

        <label for="nombre">curso</label>
        <p><input type="text" name="curso" id="curso"></p>

        <p><input type="submit" value="enviar"></p>
    </form>
</body>
</html>