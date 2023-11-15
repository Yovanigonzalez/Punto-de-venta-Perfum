<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "venta";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se ha enviado un ID válido a través de la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $envase_id = $_GET['id'];

    // SQL para eliminar el envase con el ID proporcionado
    $sql_delete = "DELETE FROM envase WHERE id = $envase_id";

    if ($conn->query($sql_delete) === TRUE) {
        // Mensaje de éxito
        $message = "Envase eliminado con éxito.";
        // Codificar el mensaje para que sea seguro en la URL
        $encoded_message = urlencode($message);
        // Redirigir de vuelta a la página de envases con el mensaje en la URL
        header("Location: crud_envase.php?message=$encoded_message");
        exit();
    } else {
        echo "Error al eliminar el envase: " . $conn->error;
    }
} else {
    echo "ID de envase no válido.";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
