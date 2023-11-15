<?php
if (isset($_GET['generate_pdf'])) {
    require('../tcpdf/tcpdf.php');

    $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);

    $pdf->SetCreator('Your Name');
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle('Inventario PDF');
    $pdf->SetSubject('Inventario PDF');
    $pdf->SetKeywords('Inventario, PDF, Download');

    $pdf->AddPage();

    // Set the time zone to (GMT-6)
    date_default_timezone_set('America/Mexico_City');
    
    $currentDateTime = date('Y-m-d h:i a', time());

    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 10, 'Fecha y Hora: ' . $currentDateTime, 0, 1, 'C');

    $pdf->SetFont('helvetica', 'B', 16);
    $pdf->Cell(0, 10, 'Inventario de la sucursal 1 de Tecamachalco', 0, 1, 'C');

    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'venta';
    $conn = new mysqli($hostname, $username, $password, $database);

    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    $query = "SELECT codigo, producto, stock, categoria FROM tendencias"; // Changed column order
    $result = $conn->query($query);

    $header = array('Codigo', 'Producto', 'Stock', 'Categoria'); // Changed column order
    $data = array();

    while ($row = $result->fetch_assoc()) {
        $data[] = array($row['codigo'], $row['producto'], $row['stock'], $row['categoria']); // Changed column order
    }

    $pdf->SetFont('helvetica', '', 12);
    $tableWidth = $pdf->getPageWidth() - 20;
    $cellWidth = $tableWidth / count($header);

    $pdf->SetFillColor(248, 91, 255);
    $pdf->SetTextColor(255);
    $pdf->SetDrawColor(0);
    $pdf->SetFont('helvetica', 'B', 12);

    foreach ($header as $col) {
        $pdf->Cell($cellWidth, 10, $col, 1, 0, 'C', 1);
    }
    $pdf->Ln();

    $pdf->SetFillColor(255);
    $pdf->SetTextColor(0);
    $pdf->SetFont('helvetica', '', 12);

    $yellow = [255, 255, 102]; // Amarillo
    $red = [255, 102, 102];    // Rojo
    $lightBlue = [173, 216, 230]; // Azul cielo

    foreach ($data as $row) {
        $bgColor = null; // Inicialmente, no se establece un fondo especial

        // Check the 'stock' column value and set background color accordingly
        if ($row[2] >= 11 && $row[2] <= 20) {
            $bgColor = $yellow; // Amarillo
        } elseif ($row[2] <= 10) {
            $bgColor = $red; // Rojo
        } elseif ($row[2] >= 21 && $row[2] <= 30) {
            $bgColor = $lightBlue; // Azul cielo
        }

        // Set background color for the entire row
        if ($bgColor) {
            $pdf->SetFillColor($bgColor[0], $bgColor[1], $bgColor[2]);
        }

        // Output the entire row
        foreach ($row as $col) {
            $pdf->Cell($cellWidth, 10, $col, 1, 0, 'C', 1);
        }

        // Reset background color
        $pdf->SetFillColor(255); // Reset to white background
        $pdf->Ln();
    }

    // Output the PDF
    $pdf->Output('inventario.pdf', 'D');

    $conn->close();
    exit;
}
?>



<?php include 'menu.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/exito.css">
    <!-- Incluye el CSS de Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Inventario</title>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Barra de navegación y sidebar aquí -->
        <!-- Contenido principal -->
        <div class="content-wrapper">
            <section class="content">
                <br>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Inventario</h3>
                                </div>
                                <div class="card-body">
                                    <a class="btn btn-primary" href="?generate_pdf=1" target="_blank">Descargar Inventario</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>
</html>


