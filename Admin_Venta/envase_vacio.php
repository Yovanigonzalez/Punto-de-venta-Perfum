<?php
// Conexión a la base de datos (ajusta estos valores según tu configuración)
$servername = "localhost";
$username = "root";
$password = "";
$database = "venta";

$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión a la base de datos
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Recuperar los valores del formulario
$envase = $_POST['envase'];
$precio = $_POST['precio'];
$cantidad = $_POST['cantidad'];
$categoria = $_POST['categoria'];
$stock = $_POST['stock']; // Nuevo campo para el stock

// Consulta SQL para verificar si el envase ya existe
$checkDuplicateSql = "SELECT * FROM tabla_envases WHERE envase = ?";
$checkDuplicateStmt = $conn->prepare($checkDuplicateSql);
$checkDuplicateStmt->bind_param("s", $envase);
$checkDuplicateStmt->execute();
$checkDuplicateResult = $checkDuplicateStmt->get_result();

if ($checkDuplicateResult->num_rows > 0) {
    // El envase ya existe en la base de datos, muestra un mensaje de error
    header("Location: envase.php?success=false&error_message=El envase ya existe en la base de datos");
} else {
    // El envase no existe, procede a insertar los datos
    $checkDuplicateStmt->close();

    // Consulta SQL para insertar los datos en la base de datos
    $insertSql = "INSERT INTO tabla_envases (envase, precio, cantidad, categoria, stock) VALUES (?, ?, ?, ?, ?)";
    $insertStmt = $conn->prepare($insertSql);

    if ($insertStmt) {
        $insertStmt->bind_param("ssisi", $envase, $precio, $cantidad, $categoria, $stock);

        if ($insertStmt->execute()) {
            // Los datos se han guardado correctamente, redirigir de vuelta al formulario
            header("Location: envase.php?success=true");
        } else {
            // Error al guardar los datos
            header("Location: envase.php?success=false&error_message=" . $insertStmt->error);
        }

        $insertStmt->close();
    } else {
        // Error en la consulta SQL
        header("Location: envase.php?success=false&error_message=Error en la consulta SQL");
    }
}

$conn->close();
?>

