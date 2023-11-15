<?php
// Datos de conexión a la base de datos
$servername = "localhost"; // Nombre o dirección del servidor de la base de datos
$username = "root"; // Nombre de usuario de la base de datos
$password = ""; // Contraseña del usuario de la base de datos
$dbname = "venta"; // Nombre de la base de datos a la que te conectarás

// Crear una conexión
$conexion = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
} else {
    echo "Conexión exitosa a la base de datos";
}

// Puedes utilizar la variable $conexion para realizar consultas a la base de datos.

// Cuando hayas terminado de usar la conexión, ciérrala
$conexion->close();
?>
