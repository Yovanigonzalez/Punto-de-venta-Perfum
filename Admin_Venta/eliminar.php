<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "venta";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id_to_delete = $_GET['id'];

$sql_delete = "DELETE FROM tendencias WHERE id=$id_to_delete";

if ($conn->query($sql_delete) === TRUE) {
    // Mensaje de éxito
    $message = "Tendencia eliminada con éxito.";
    // Codificar el mensaje para que sea seguro en la URL
    $encoded_message = urlencode($message);
    // Redirigir de vuelta a la página de tendencias con el mensaje en la URL
    header("Location: crud_tendencia.php?message=$encoded_message");
    exit();
} else {
    echo "Error al eliminar la tendencia: " . $conn->error;
}

$conn->close();
?>

