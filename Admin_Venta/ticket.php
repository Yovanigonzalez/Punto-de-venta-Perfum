<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = file_get_contents('php://input');
    $data = json_decode($data);

    // Procesa y guarda los datos en un archivo o realiza las acciones necesarias
    // Por ejemplo, puedes guardar los datos en un archivo JSON
    file_put_contents('ticket_data.json', json_encode($data));

    // Responde con una confirmación o cualquier otra respuesta
    echo json_encode(array('message' => 'Datos guardados con éxito'));
}
?>

