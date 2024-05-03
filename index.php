<?php
include "funciones.php";

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
    <title>CRUD de Futbolistas</title>
    <link href="css.css" rel="stylesheet">
    <script>
        function confirmarEliminacion(id) {
            if(confirm("¿Estás seguro de que quieres eliminar este registro?")) {
                window.location.href = 'delete.php?id=' + id;
            }
        }
    </script>
</head>
<body>
    <h1>CRUD de Futbolistas</h1>
    <a href="create.php" class="btn">Crear nuevo futbolista</a>
    <br><br>
    <form action="index.php" method="GET">
        <label for="busqueda">Buscar:</label>
        <input type="text" id="busqueda" name="busqueda" value="<?php echo $busqueda; ?>">
        <input type="submit" value="Buscar">
    </form>
    <br>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Equipo</th>
            <th>Nacionalidad</th>
            <th>Activo</th>
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
