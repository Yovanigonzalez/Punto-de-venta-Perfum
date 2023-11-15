<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "venta";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $envase = $_POST['envase'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $stock = $_POST['stock'];
    $categoria = $_POST['categoria'];

    // SQL query to check if a record with the same values already exists
    $check_query = "SELECT * FROM gramo_extra WHERE envase = '$envase' AND precio = '$precio' AND cantidad = '$cantidad' AND stock = '$stock' AND categoria = '$categoria'";

    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        // Record already exists, you can handle this as a duplicate entry
        header("Location: agregar_gramo.php?success=false&error_message=Ya hay un registro identico");
    } else {
        // Insert the new record
        $insert_query = "INSERT INTO gramo_extra (envase, precio, cantidad, stock, categoria) 
            VALUES ('$envase', '$precio', '$cantidad', '$stock', '$categoria')";

        if ($conn->query($insert_query) === TRUE) {
            // Redirect to the success page with a success parameter
            header("Location: agregar_gramo.php?success=true");
        } else {
            // Redirect to the form page with an error parameter
            header("Location: agregar_gramo.php?success=false&error_message=" . $conn->error);
        }
    }

    // Close the database connection
    $conn->close();
}
?>
