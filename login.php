<?php
session_start();


$mysqli = new mysqli("localhost", "root", "Password#9231", "futbolistas"); 

if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM usuaris WHERE nom = '$username'";
$result = $mysqli->query($query);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $query = "SELECT * FROM usuaris WHERE contrasenya = '$password'";
    $result = $mysqli->query($query);
    if ($result->num_rows == 1) {
        $_SESSION['username'] = $username;
        header("Location: indexfutbolistas.php");
    } else {
        echo "Contraseña incorrecta. <a href='index.php'>Volver</a>";
    }
} else {
    echo "Usuario no encontrado. <a href='index.php'>Volver</a>";
}

$mysqli->close();
?>
