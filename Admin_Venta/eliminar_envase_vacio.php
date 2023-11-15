<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "venta";
$tableName = "tabla_envases";

// Crear una nueva conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión a la base de datos
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el ID del registro a eliminar desde la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Preparar y ejecutar la consulta SQL para eliminar el registro
    $sql = "DELETE FROM $tableName WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        // Redirigir de nuevo a la página principal con un mensaje de éxito
        header("Location: crud_envase_vacio.php?message=Registro eliminado con éxito");
        exit();
    } else {
        // Si hay un error en la consulta SQL, mostrar un mensaje de error
        echo "Error al eliminar el registro: " . $conn->error;
    }
} else {
    // Si no se proporciona un ID válido en la URL, mostrar un mensaje de error
    echo "ID de registro no válido";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
