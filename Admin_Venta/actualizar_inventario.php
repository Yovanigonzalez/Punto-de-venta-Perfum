<?php

// Obtener datos de la solicitud AJAX
$producto = $_POST['producto'];
$cantidad = $_POST['cantidad'];

// Consulta SQL para obtener el valor de $gramos del producto en la tabla 'envase'
$queryEnvase = "SELECT gramos FROM envase WHERE producto = '$producto'";
$resultEnvase = $conexion->query($queryEnvase);

if ($resultEnvase->num_rows > 0) {
    $rowEnvase = $resultEnvase->fetch_assoc();
    $gramos = $rowEnvase['gramos'];

    // Calcular el valor a restar al stock de la tabla 'tendencias'
    $valorRestar = $cantidad * $gramos;

    // Actualizar el stock en la tabla 'tendencias'
    $sqlTendencias = "UPDATE tendencias SET stock = stock - $valorRestar WHERE producto = '$producto'";

    if ($conexion->query($sqlTendencias) === TRUE) {
        // La actualización fue exitosa
        echo "Actualización exitosa";
    } else {
        // Ocurrió un error al actualizar
        echo "Error al actualizar: " . $conexion->error;
    }
} else {
    // No se encontró el producto en la tabla 'envase'
    echo "Producto no encontrado en la tabla 'envase'";
}


?>
