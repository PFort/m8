<?php
    include "funcionesequipos.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear nuevo futbolista</title>
    <link href="css.css" rel="stylesheet">
</head>
<body>
    <h1>Crear nuevo entrenador</h1>
    <form action="storeentrenadores.php" method="POST">
        <label for="nom">Nombre:</label>
        <input type="text" id="nom" name="nom" required>
        <label for="cognom">Apellido:</label>
        <input type="text" id="cognom" name="cognom" required>
        <label for="equip">Equipo:</label>


        <select name="equip">
            <option>Tria equip...</option>
        <?php
        $resul = mostrar();
        while ($fila = $resul->fetch_assoc()) {
            echo "<option value=".$fila["nombre"].">".$fila["nombre"]."</option>\n";
        }
        ?>
        </select>
        <input type="submit" value="Guardar">
    </form>
</body>
</html>
