<?php
include 'menu.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Agrega referencia a Font Awesome para los iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!--Logo-->
    <link rel="shortcut icon" type="image/x-icon" href="../log/log.png">

    <!-- Agrega enlaces a las bibliotecas de Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <title>Punto de Venta</title>

    <style>
        .dashboard-container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .dashboard-card {
            flex-basis: calc(33.33% - 20px);
            margin: 10px;
            transition: transform 0.3s;
        }

        .dashboard-card .info-box {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
        }

        .dashboard-icon {
            font-size: 48px;
            margin-bottom: 10px;
            color: #007bff; /* Color azul para los íconos */
        }

        .dashboard-title {
            font-size: 18px;
            margin-bottom: 10px;
            color: #333; /* Color de título */
        }

        .dashboard-value {
            font-size: 24px;
            font-weight: bold;
            color: #333; /* Color de valor */
        }

        /* Agrega estilos para los elementos canvas de las gráficas */
        canvas {
            max-width: 100%;
        }

        /* Agrega estilos para los cuadros de las gráficas */
        .chart-card {
            flex-basis: calc(50% - 20px);
            margin: 10px;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content">
                <br>
                <div class="container-fluid">
                    <!-- Tarjetas de resumen -->
                    <div class="dashboard-container">
                        <!-- Tarjeta de Ganancias -->
                        <div class="dashboard-card col-md-6">
                            <div class="info-box">
                                <span class="info-box-icon bg-secondary"><i class="fas fa-dollar-sign"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Ganancias</span>
                                    <span class="info-box-number">$10,000</span>
                                </div>
                            </div>
                        </div>

                        <!-- Tarjeta de Ventas -->
                        <div class="dashboard-card col-md-6">
                            <div class="info-box">
                                <span class="info-box-icon bg-info"><i class="fas fa-shopping-cart"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Ventas</span>
                                    <span class="info-box-number">500</span>
                                </div>
                            </div>
                        </div>

                        
                        <!-- Tarjeta de Pedidos -->
                        <div class="dashboard-card col-md-6">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="fas fa-clipboard-list"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Pedidos</span>
                                    <span class="info-box-number">200</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Gráficos -->
                    <div class="dashboard-container">
                        <!-- Gráfico de Sucursal 1 -->
                        <div class="chart-card col-md-6">
                            <div class="info-box">
                                <span class="info-box-icon bg-success"><i class="fas fa-chart-bar"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Sucursal 1</span>
                                    <canvas id="sucursal1Chart" width="400" height="200"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Gráfico de Sucursal 2 -->
                        <div class="chart-card col-md-6">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary"><i class="fas fa-chart-bar"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Sucursal 2</span>
                                    <canvas id="sucursal2Chart" width="400" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- Agrega el enlace a Bootstrap.js si no lo has hecho ya -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
// Definir un array de meses
        var meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

        // Datos de ejemplo para las gráficas
        var dataSucursal1 = {
            labels: meses,
            datasets: [{
                label: 'Ventas Sucursal 1',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                data: [50, 60, 70, 80, 90, 0, 0, 0, 0, 0, 0, 0] // Aquí debes insertar tus datos de ventas para cada mes
            }]
        };


        var dataSucursal2 = {
            labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo"],
            datasets: [{
                label: 'Ventas Sucursal 2',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1,
                data: [40, 55, 65, 75, 85]
            }]
        };

        // Configuración de las gráficas
        var chartOptions = {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };

        // Crear y renderizar las gráficas
        var ctx1 = document.getElementById('sucursal1Chart').getContext('2d');
        new Chart(ctx1, {
            type: 'bar',
            data: dataSucursal1,
            options: chartOptions
        });

        var ctx2 = document.getElementById('sucursal2Chart').getContext('2d');
        new Chart(ctx2, {
            type: 'bar',
            data: dataSucursal2,
            options: chartOptions
        });
    </script>
</body>
</html>
