<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear nuevo futbolista</title>
    <link href="css.css" rel="stylesheet">
</head>
<body>
    <h1>Crear nuevo futbolista</h1>
    <form action="store.php" method="POST">
        <label for="nom">Nombre:</label>
        <input type="text" id="nom" name="nom" required>
        <label for="cognom">Apellido:</label>
        <input type="text" id="cognom" name="cognom" required>
        <label for="equip">Equipo:</label>
        <input type="text" id="equip" name="equip" required>
        <label for="nacionalitat">Nacionalidad:</label>
        <input type="text" id="nacionalitat" name="nacionalitat" maxlength="3" required>
        <label for="actiu">Activo:</label>
        <input type="checkbox" id="actiu" name="actiu" checked>
        <input type="submit" value="Guardar">
    </form>
</body>
</html>
