<?php
// Include your database connection code or use PDO
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "venta";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the form
$envase = $_POST['envase'];
$precio = $_POST['precio'];
$gramos = $_POST['gramos'];
$cantidad = $_POST['cantidad'];
$categoria = $_POST['categoria'];

// Check if the record already exists in the database
$checkDuplicateSQL = "SELECT * FROM envase WHERE envase = '$envase'";
$duplicateResult = $conn->query($checkDuplicateSQL);

if ($duplicateResult->num_rows > 0) {
    // A record with the same 'envase' value already exists; handle the error
    header('Location: agregar_envase.php?success=false&error_message=' . urlencode("Ya hay un registro igual"));
    exit();
} else {
    // The record does not exist; proceed with the insertion
    $sql = "INSERT INTO envase (envase, precio, gramos, cantidad, categoria) VALUES ('$envase', '$precio', '$gramos', '$cantidad', '$categoria')";

    if ($conn->query($sql) === TRUE) {
        // The record was inserted successfully; redirect with a success message
        header('Location: agregar_envase.php?success=true');
        exit();
    } else {
        // There was an error inserting the record; redirect with an error message
        header('Location: agregar_envase.php?success=false&error_message=' . urlencode("Error al guardar los datos en la base de datos: " . $conn->error));
        exit();
    }
}

// Close the database connection
$conn->close();
?>
