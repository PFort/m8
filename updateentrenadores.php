<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar entrenador</title>
    <link href="css.css" rel="stylesheet">
</head>
<body>
    <h1>Editar entrenador</h1>
    <form action="./update_processentrenadores.php" method="POST">
        <?php
        $id = $_GET['id'];

        include "funcionesentrenador.php";

        $conexion = conectarBD();

        $consulta = $conexion->query("SELECT * FROM entrenadores WHERE identificador = $id");
        $fila = $consulta->fetch_assoc();

        ?>
        <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
        <label for="nom">Nombre:</label>
        <input type="text" id="nom" name="nom" value="<?php echo $fila['nom']; ?>" required>
        <label for="cognom">Apellido:</label>
        <input type="text" id="cognom" name="cognom" value="<?php echo $fila['cognom']; ?>" required>
        <label for="equip">Equipo:</label>
        <input type="text" id="equip" name="equip" value="<?php echo $fila['equip']; ?>" required>
        <input type="submit" value="Guardar cambios">
    </form>
</body>
</html>
