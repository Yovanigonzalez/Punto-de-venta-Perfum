<?php
// Establece la conexión con la base de datos (modifica los valores según tu configuración)
$servername = "localhost";
$username = "root";
$password = "";
$database = "venta";

$conn = new mysqli($servername, $username, $password, $database);

$message = ""; // Inicializa la variable del mensaje
$messageClass = ""; // Inicializa la clase del mensaje

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $producto = $_POST["producto"];
    $codigo = $_POST["codigo"];
    $stock = $_POST["stock"];
    $categoria = $_POST["categoria"];

    // Validar que los campos no estén vacíos
    if (empty($producto) || empty($codigo) || empty($stock) || empty($categoria)) {
        $message = "Todos los campos son obligatorios.";
        $messageClass = "error-message"; // Use la clase de mensaje de error
    } else {
        // Verificar si ya existe un registro con los mismos valores
        $check_sql = "SELECT * FROM tendencias WHERE producto = ? AND codigo = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("ss", $producto, $codigo);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows > 0) {
            $message = "Ya existe un registro con el mismo producto y código.";
            $messageClass = "error-message"; // Use la clase de mensaje de error
        } else {
            // Preparar la consulta SQL para insertar los datos usando una sentencia preparada
            $insert_sql = "INSERT INTO tendencias (producto, codigo, stock, categoria) VALUES (?, ?, ?, ?)";
            $insert_stmt = $conn->prepare($insert_sql);
            $insert_stmt->bind_param("ssis", $producto, $codigo, $stock, $categoria);

            if ($insert_stmt->execute()) {
                $message = "Tendencias agregadas exitosamente.";
                $messageClass = "success-message"; // Use la clase de mensaje de éxito
            } else {
                $message = "Error al agregar tendencia: " . $insert_stmt->error;
                $messageClass = "error-message"; // Use la clase de mensaje de error
            }

            $insert_stmt->close(); // Cierra la sentencia preparada de inserción
        }

        $check_stmt->close(); // Cierra la sentencia preparada de verificación
        $conn->close();

        // Redirige solo después de procesar el formulario
        header("Location: agregar_tendencia.php?message=" . urlencode($message) . "&messageClass=" . urlencode($messageClass));
        exit();
    }
}
?>
