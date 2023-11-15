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

// Comprobar si se proporciona un ID de feromona válido
if (isset($_GET['id'])) {
    $feromona_id = $_GET['id'];

    // Eliminar la feromona de la base de datos
    $deleteQuery = "DELETE FROM feremona WHERE id = $feromona_id";

    if ($conn->query($deleteQuery) === TRUE) {
        // Opcionalmente, puedes redirigir a una página diferente después de la eliminación.
        header('Location: crud_feremonas.php?message=Feremona eliminada exitosamente');
        exit();
    } else {
        echo "Error al eliminar la feremona: " . $conn->error;
    }
} else {
    echo "ID de feremona no especificado.";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
