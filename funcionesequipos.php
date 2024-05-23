<?php
function conectarBD() {
    $conexion = new mysqli("localhost", "root", "Password#9231", "futbolistas");
    return $conexion;
}

function buscador($conexion, $pagina = 1, $por_pagina = 5, $busqueda = '') {
    $por_pagina = 5; 
    $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
    $inicio = ($pagina - 1) * $por_pagina;
    
    $query = "SELECT * FROM equipos";
    if (isset($_GET['busqueda']) && !empty($_GET['busqueda'])) {
        $busqueda = $_GET['busqueda'];
        $query .= " WHERE nom LIKE '%$busqueda%' OR cognom LIKE '%$busqueda%' OR equip LIKE '%$busqueda%'";
    }
    $query .= " LIMIT $inicio, $por_pagina";
    
    return $query;
}

function tabla($conexion, $query) {
    global $busqueda, $por_pagina; 
    
    $consulta = $conexion->query($query); 
    
    while ($fila = $consulta->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$fila['nombre']."</td>";
        echo "<td>".$fila['entrenador']."</td>";
        echo "<td>".$fila['nacionalidad']."</td>";
        echo "<td><a href='updateentrenadores.php?id=".$fila['nombre']."' class='btn'>Editar</a> <td><a href='#' onclick='confirmarEliminacion(".$fila['identificador'].")' class='btn'>Eliminar</a></td>";
        echo "</tr>";
    }
}



function mostrar() {
    $conexion = conectarBD();
    $query = "SELECT * FROM equipos";
    $consulta = $conexion->query($query); 
    return $consulta;
}


function paginacion() {
    global $busqueda, $por_pagina; 

    $conexion = conectarBD();

    $query_paginacion = "SELECT COUNT(*) AS total FROM entrenadores";
    if (!empty($busqueda)) {
        $busqueda = $conexion->real_escape_string($busqueda);
        $query_paginacion .= " WHERE nom LIKE '%$busqueda%' OR cognom LIKE '%$busqueda%' OR equip LIKE '%$busqueda%'";
    }
    $resultado_paginacion = $conexion->query($query_paginacion);
    $fila_paginacion = $resultado_paginacion->fetch_assoc();
    $total_registros = $fila_paginacion['total'];
    $total_paginas = ceil($total_registros / $por_pagina);

    echo "<div class='pagination'>";
    for ($i = 1; $i <= $total_paginas; $i++) {
        echo "<a href='index.php?pagina=$i";
        if (!empty($busqueda)) {
            echo "&busqueda=".$busqueda;
        }
        echo "' class='btn'>$i</a>";
    }
    echo "</div>";
    $conexion->close();
}

function delete(){
    $id = $_GET['id'];

    $conexion = conectarBD();

    $conexion->query("DELETE FROM entrenadores WHERE identificador = $id");

    header("Location: indexentrenadores.php");
}

function store(){
    $nom = $_POST['nom'];
    $cognom = $_POST['cognom'];
    $equip = $_POST['equip'];

    $conexion = conectarBD();

    $conexion->query("INSERT INTO entrenadores (nom, cognom, equip) VALUES ('$nom', '$cognom', '$equip')");

    header("Location: indexentrenadores.php");
}

function update(){
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $cognom = $_POST['cognom'];
    $equip = $_POST['equip'];

    $conexion = conectarBD();

    $conexion->query("UPDATE entrenadores SET nom = '$nom', cognom = '$cognom', equip = '$equip' WHERE identificador = $id");

    header("Location: indexentrenadores.php");
}
?>
