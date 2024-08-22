<?php
// db_connection_capacitaciones.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "libro";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
