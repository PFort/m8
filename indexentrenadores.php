<?php
include "funcionesentrenador.php";

$busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';
$conexion = conectarBD();
$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$por_pagina = 5;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Entrenadores</title>
    <link href="css.css" rel="stylesheet">
    <script>
        function confirmarEliminacion(id) {
            if(confirm("¿Estás seguro de que quieres eliminar este registro?")) {
                window.location.href = 'deleteentrenadores.php?id=' + id;
            }
        }
    </script>
</head>
<body>
    <h1>CRUD de Entrenadores</h1>
    <a href="indexfutbolistas.php" class="btn">Futbolistas</a>
    <a href="indexentrenadores.php" class="btn">Entrenadores</a>
    <a href="indexequipos.php" class="btn">Equipos</a>
    <br><br>
    <form action="indexentrenadores.php" method="GET">
        <label for="busqueda">Buscar:</label>
        <input type="text" id="busqueda" name="busqueda" value="<?php echo $busqueda; ?>">
        <input type="submit" value="Buscar">
    </form>
    <br>
    <a href="createentrenadores.php" class="btn">Crear nuevo Entrenador</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Equipo</th>
            <th>Acciones</th>
        </tr>
        
        <?php
        global $conexion, $pagina, $por_pagina, $busqueda;
        $query = buscador($conexion, $pagina, $por_pagina, $busqueda);
        
        tabla($conexion, $query);
        ?>
    </table>
    <?php
    paginacion();
    ?>
</body>
</html>
