<?php
if (isset($_POST['ticketContent'])) {
    $ticketContent = $_POST['ticketContent'];

    // Crear una conexión con la impresora
    $connector = new WindowsPrintConnector("XP-58"); // Reemplaza "XP-58" con el nombre de tu impresora

    try {
        $printer = new Printer($connector);

        // Imprimir el contenido del ticket
        $printer->text($ticketContent);

        // Cortar el papel (si es compatible con tu impresora)
        $printer->cut();

        // Finalizar la impresión
        $printer->close();
        
        echo 'Impresión exitosa'; // Respuesta para el cliente JavaScript
    } catch (Exception $e) {
        echo 'Error al imprimir el ticket: ' . $e->getMessage(); // Respuesta para el cliente JavaScript
    }
}
?>
