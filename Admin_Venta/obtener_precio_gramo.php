<?php
// Conecta a la base de datos (debes configurar la conexión)
$conexion = mysqli_connect("localhost", "root", "", "venta");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Realiza una consulta para obtener el precio desde la base de datos
$query = "SELECT precio FROM gramo_extra";
$resultado = mysqli_query($conexion, $query);

if ($resultado) {
    $fila = mysqli_fetch_assoc($resultado);
    $precioPorGramo = $fila['precio'];

    // Devuelve el precio como respuesta JSON
    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'precio' => $precioPorGramo]);
} else {
    echo json_encode(['success' => false, 'error' => 'No se pudo obtener el precio desde la base de datos']);
}

// Cierra la conexión a la base de datos
mysqli_close($conexion);
?>
