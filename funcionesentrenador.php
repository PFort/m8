<?php
/**
 * Fitxer per guardar les funcions
 */
/**
 * Funcio per conectar a la base de dades 
 * @return torn
*/
function conectarBD() {
        $conexion = new mysqli("localhost", "root", "Password#9231", "futbolistas"); 
        return $conexion;
    }


    /**
     * Funcio per poder buscar dades
     */
    function buscador($conexion, $pagina = 1, $por_pagina = 5, $busqueda = '') {
    $por_pagina = 5; 
    $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
    $inicio = ($pagina - 1) * $por_pagina;
    
    $query = "SELECT * FROM entrenadores";
    if (isset($_GET['busqueda']) && !empty($_GET['busqueda'])) {
        $busqueda = $_GET['busqueda'];
        $query .= " WHERE nom LIKE '%$busqueda%' OR cognom LIKE '%$busqueda%' OR equip LIKE '%$busqueda%' OR nacionalitat LIKE '%$busqueda%'";
    }
    $query .= " LIMIT $inicio, $por_pagina";
    
    return $query;
    
    }

    /**
     * funcio per mostrar taula 
     * @param $conexion conecta a la base de dades
     * @param $query consulta sql
     * @author Pau
     */
    function tabla($conexion, $query) {
        global $busqueda, $por_pagina; 
    
        $consulta = $conexion->query($query); 
    
        while ($fila = $consulta->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$fila['identificador']."</td>";
            echo "<td>".$fila['nom']."</td>";
            echo "<td>".$fila['cognom']."</td>";
            echo "<td>".$fila['equip']."</td>";
            echo "<td><a href='updateentrenadores.php?id=".$fila['identificador']."' class='btn'>Editar</a> <td><a href='#' onclick='confirmarEliminacion(".$fila['id'].")' class='btn'>Eliminar</a></td>";
            echo "</tr>";
        }
    }
    
/**
 * Funcio per fer la paginacio 
 */
function paginacion() {
    global $busqueda, $por_pagina; 

    $conexion = conectarBD();

    $query_paginacion = "SELECT COUNT(*) AS total FROM entrenadores";
    if (!empty($busqueda)) {
        $busqueda = $conexion->real_escape_string($busqueda);
        $query_paginacion .= " WHERE nom LIKE '%$busqueda%' OR cognom LIKE '%$busqueda%' OR equip LIKE '%$busqueda%' OR nacionalitat LIKE '%$busqueda%'";
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


/**
 * Funcio per borrar dades de la taula 
 */
function delete(){
    $id = $_GET['identificador'];

    $conexion = conectarBD();

    $conexion->query("DELETE FROM entrenadores WHERE identificador = $id");

    header("Location: indexentrenadores.php");
}

/**
 * Funcio per guardar les dades a la taula 
 */

function store(){
    $nom = $_POST['nom'];
    $cognom = $_POST['cognom'];
    $equip = $_POST['equip'];

    $conexion = conectarBD();

    $sql = "INSERT INTO entrenadores (nom, cognom, equip) VALUES ('$nom', '$cognom', '$equip')";
    echo $sql;

    //$conexion->query($sql);

    //header("Location: indexentrenadores.php");

    
}



/**
 * Funcio per modificar les dades de la taula 
 */
function update(){
    $id = $_POST['identificador'];
    $nom = $_POST['nom'];
    $cognom = $_POST['cognom'];
    $equip = $_POST['equip'];

    $conexion = conectarBD();

    $conexion->query("UPDATE entrenadores SET nom = '$nom', cognom = '$cognom', equip = '$equip' WHERE id = $id");

    header("Location: indexentrenadores.php");
}


?>