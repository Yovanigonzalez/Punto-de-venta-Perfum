<?php
// Conexión a la base de datos (ajusta los detalles de conexión según tu configuración)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "venta";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario AJAX
$productoId = $_POST['productoId'];
$nuevoStock = $_POST['nuevoStock'];

// Actualizar el stock en la base de datos
$sql = "UPDATE tendencia SET stock = $nuevoStock WHERE id = $productoId";

if ($conn->query($sql) === TRUE) {
    echo "Stock actualizado correctamente";
} else {
    echo "Error al actualizar el stock: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
