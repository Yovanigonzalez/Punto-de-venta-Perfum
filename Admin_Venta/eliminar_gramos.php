<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "venta";

// Crear una conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $item_id = $_GET['id'];

    // Consulta para eliminar el "gramo extra" con el ID proporcionado
    $deleteQuery = "DELETE FROM gramo_extra WHERE id = $item_id";

    if ($conn->query($deleteQuery) === TRUE) {
        // Redirigir a la página de "gramos extra" después de la eliminación
        header("Location: crud_gramo.php?message=" . urlencode("¡Gramo extra eliminado exitosamente!"));
        exit();
    } else {
        echo "Error al eliminar el gramo extra: " . $conn->error;
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
