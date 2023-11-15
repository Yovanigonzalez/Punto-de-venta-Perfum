<?php
// Conexión a la base de datos (asegúrate de configurar la conexión a tu base de datos)
$conexion = new mysqli("localhost", "root", "", "venta");
if ($conexion->connect_error) {
    die("La conexión a la base de datos ha fallado: " . $conexion->connect_error);
}

// Consulta SQL para buscar en la tabla 'tendencias'
$query = $_GET['query'];
$sql = "SELECT producto, categoria, stock FROM tendencias WHERE producto LIKE '%$query%' OR categoria LIKE '%$query%'";
$result = $conexion->query($sql);

// Mostrar resultados con botón "Agregar" en tiempo real
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="result-item">';
        echo '<br>';
        echo '' . $row['producto'] . ' - ' . $row['categoria'] . ' - Stock: ' . $row['stock'];
        echo '<br>';
        // Agrega el stock como un atributo de datos en el botón "Agregar"
        echo '<button class="btn btn-primary agregar-btn-tendencia" data-producto="' . $row['producto'] . '" data-stock="' . $row['stock'] . '">Agregar</button><br><br>';
        echo '</div>';
        
    }
} else {
    echo 'No se encontraron resultados';
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
