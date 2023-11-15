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
    $pdf->Cell(0, 10, 'Salidas de la sucursal 1 de Tecamachalco', 0, 1, 'C');

    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'venta';
    $conn = new mysqli($hostname, $username, $password, $database);

    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Modify the SQL query to filter inventory items with stock < 60 and order by Codigo
    $query = "SELECT codigo, producto, stock, categoria FROM tendencias WHERE stock < 60 ORDER BY codigo";
    $result = $conn->query($query);

    $header = array('Código', 'Producto', 'Stock', 'Categoría', 'Reingreso');
    $data = array();

    while ($row = $result->fetch_assoc()) {
        $reingreso = 60 - $row['stock']; // Calculate Reingreso as 60 - Stock
        $data[] = array($row['codigo'], $row['producto'], $row['stock'], $row['categoria'], $reingreso);
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

    foreach ($data as $row) {
        // Output the entire row
        foreach ($row as $col) {
            $pdf->Cell($cellWidth, 10, $col, 1, 0, 'C', 1);
        }
        $pdf->Ln();
    }

    // Add some separation
    $pdf->Ln(10);

    // Add 'Encargado' and 'Supervisor' rows with signature lines
    $pdf->Cell($cellWidth, 10, 'Encargado:', 0);
    $pdf->Ln(); // Add line break
    $pdf->Cell($cellWidth, 10, '', 'T'); // Add a little space
    $pdf->Ln(10); // Add more space
    $pdf->Cell($cellWidth, 10, 'Supervisor:', 0);
    $pdf->Ln(); // Add line break
    $pdf->Cell($cellWidth, 10, '', 'T'); // Add a little space

    // Output the PDF
    $pdf->Output('inventario.pdf', 'D');

    $conn->close();
    exit;
}
?>

<?php include 'menu.php'?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/exito.css">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Salidas</title>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navigation bar and sidebar go here -->
        <!-- Main content -->
        <div class="content-wrapper">
            <section class="content">
                <br>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Salidas</h3>
                                </div>
                                <div class="card-body">
                                    <a class="btn btn-primary" href="?generate_pdf=1" target="_blank">Descargar Salidas</a>
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


