<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "venta";

// Crear una conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los detalles de la transacción del formulario (asegúrate de que coincidan con los nombres de tus campos en el formulario)
$total = $_POST['total'];
$metodoPago = $_POST['metodoPago'];

// Verificar si ya existe algún número de folio en la base de datos
$verificarFolio = "SELECT MAX(numero_folio) AS max_folio FROM transacciones";
$resultado = $conn->query($verificarFolio);

if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
    $numeroDeFolio = $fila["max_folio"] + 1;
} else {
    // Si no se encuentra ningún número de folio, comienza desde 1
    $numeroDeFolio = 1;
}

// Obtener la fecha y hora actual en formato '(GMT-6)'
$fechaHoraActual = new DateTime("now", new DateTimeZone('Etc/GMT+6'));
$fechaHoraFormateada = $fechaHoraActual->format('Y-m-d H:i:s');

// Crear una consulta SQL para insertar datos con el número de folio y la fecha y hora en formato '(GMT-6)'
$sql = "INSERT INTO transacciones (fecha_hora, total, metodo_pago, numero_folio) VALUES ('$fechaHoraFormateada', '$total', '$metodoPago', '$numeroDeFolio')";

if ($conn->query($sql) === TRUE) {
    // La transacción se insertó exitosamente en la base de datos
    echo "La transacción se insertó correctamente. Número de folio: " . $numeroDeFolio;
} else {
    echo "Error al insertar transacción: " . $conn->error;
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
