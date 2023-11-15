<?php
// Inicializa la sesión
session_start();

// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "venta";

// Crea una conexión
$conexion = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if (isset($_POST['addToCart'])) {
    $envase = $_POST['envase'];
    $precio = $_POST['precio'];

    // Verifica si el carrito ya existe en la sesión
    if (isset($_SESSION['carrito'])) {
        // Si el carrito ya existe, agrega el nuevo elemento
        $_SESSION['carrito'][] = array('envase' => $envase, 'precio' => $precio);
    } else {
        // Si el carrito no existe, crea un carrito nuevo con el elemento
        $_SESSION['carrito'] = array(array('envase' => $envase, 'precio' => $precio));
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Tienda de Compras</title>
</head>
<body>
    <label>Productos Disponibles</label>

    <?php
    // Realiza una consulta preparada
    $query = "SELECT * FROM gramo_extra WHERE envase LIKE ?";
    $stmt = $conexion->prepare($query);

    if ($stmt) {
        $searchTerm = "%" . $_POST['searchTerm'] . "%";
        $stmt->bind_param("s", $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div>";
                echo "Envase: " . $row['envase'] . "<br>";
                echo "Precio: " . $row['precio'] . "<br>";

                // Agrega un formulario para añadir al carrito
                echo "<input type='hidden' name='envase' value='" . $row['envase'] . "'>";
                echo "<input type='hidden' name='precio' value='" . $row['precio'] . "'>";
                echo "<button type='submit' name='addToCart' class='btn btn-primary agregar-btn'>Añadir al Carrito</button>";
                echo "</form>";

                echo "</div>";
            }
        } else {
            echo "No se encontraron resultados.";
        }

        $stmt->close();
    } else {
        echo "Error en la consulta preparada: " . $conexion->error;
    }
    ?>

    <h2>Carrito de Compras</h2>
    <ul id="carrito-lista">
        <!-- Aquí se mostrarán los elementos del carrito -->
    </ul>

    <script>
        // Función para actualizar el carrito en la página
        function actualizarCarrito(envase, precio) {
            var carrito = document.getElementById("carrito-lista");
            var nuevoItem = document.createElement("li");
            nuevoItem.textContent = "Envase: " + envase + ", Precio: $" + precio;
            carrito.appendChild(nuevoItem);
        }
    </script>
</body>
</html>

