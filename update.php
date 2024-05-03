<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar futbolista</title>
    <link href="css.css" rel="stylesheet">
</head>
<body>
    <h1>Editar futbolista</h1>
    <form action="./update_process.php" method="POST">
        <?php
        $id = $_GET['id'];

        include "funciones.php";

        $conexion = conectarBD();

        $consulta = $conexion->query("SELECT * FROM futbolistas WHERE id = $id");
        $fila = $consulta->fetch_assoc();

        ?>
        <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
        <label for="nom">Nombre:</label>
        <input type="text" id="nom" name="nom" value="<?php echo $fila['nom']; ?>" required>
        <label for="cognom">Apellido:</label>
        <input type="text" id="cognom" name="cognom" value="<?php echo $fila['cognom']; ?>" required>
        <label for="equip">Equipo:</label>
        <input type="text" id="equip" name="equip" value="<?php echo $fila['equip']; ?>" required>
        <label for="nacionalitat">Nacionalidad:</label>
        <input type="text" id="nacionalitat" name="nacionalitat" value="<?php echo $fila['nacionalitat']; ?>" maxlength="3" required>
        <label for="actiu">Activo:</label>
        <input type="checkbox" id="actiu" name="actiu" <?php echo $fila['actiu'] ? 'checked' : ''; ?>>
        <input type="submit" value="Guardar cambios">
    </form>
</body>
</html>
