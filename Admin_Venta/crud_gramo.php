<?php
include 'menu.php';
?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "venta";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$registros_por_pagina = 8;
$pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$offset = ($pagina_actual - 1) * $registros_por_pagina;

$search_query = isset($_GET['search']) ? $_GET['search'] : '';

// Modificar las consultas SQL para incluir las columnas de la tabla 'gramo_extra'
if ($search_query) {
    $sql_count = "SELECT COUNT(*) as total FROM gramo_extra WHERE envase LIKE '%$search_query%' OR categoria LIKE '%$search_query%'";
    $sql = "SELECT * FROM gramo_extra WHERE envase LIKE '%$search_query%' OR categoria LIKE '%$search_query%' LIMIT $offset, $registros_por_pagina";
} else {
    $sql_count = "SELECT COUNT(*) as total FROM gramo_extra";
    $sql = "SELECT * FROM gramo_extra LIMIT $offset, $registros_por_pagina";
}

$result_count = $conn->query($sql_count);
$total_registros = $result_count->fetch_assoc()['total'];

$total_paginas = ceil($total_registros / $registros_por_pagina);

$result = $conn->query($sql);

$gramo_extra = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $gramo_extra[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/exito.css">
    <link rel="stylesheet" href="../css/acciones.css">

    <!-- Agrega la referencia al ícono FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <style>
        .search-container {
            margin-bottom: 20px;
        }
        
        .search-container form {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .search-container input[type="text"] {
            flex: 1;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        
        .search-container button {
            padding: 8px 15px;
            background-color: #007bff;
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer.
        }
        
        .search-container button:hover {
            background-color: #0056b3;
        }
        
        .result-message {
            margin-top: 10px;
        }
    </style>

    <title>Gramo Extra</title>
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
                                    <h3 class="card-title">Gramo Extra</h3>
                                </div>
                                <div class="card-body">
                                    <?php
                                    // Obtener el mensaje de la URL si está presente
                                    if (isset($_GET['message'])) {
                                        $message = urldecode($_GET['message']);
                                        echo '<p class="result">' . $message . '</p>';
                                    }
                                    ?>

                                    <div class="search-container">
                                        <form method="GET" action="">
                                            <input type="text" name="search" placeholder="Buscar por envase o categoría" value="<?php echo $search_query; ?>">
                                            <button type="submit">Buscar</button>
                                        </form>
                                    </div>

                                    <?php if ($gramo_extra) { ?>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Envase</th>
                                                    <th>Precio</th>
                                                    <th>Cantidad</th>
                                                    <th>Categoría</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($gramo_extra as $extra) { ?>
                                                    <tr>
                                                        <td><?php echo $extra['envase']; ?></td>
                                                        <td><?php echo $extra['precio']; ?></td>
                                                        <td><?php echo $extra['cantidad']; ?></td>
                                                        <td><?php echo $extra['categoria']; ?></td>
                                                        <td>
                                                            <!-- Botón para abrir el modal de confirmación -->
                                                            <button class="btn btn-danger" data-toggle="modal" data-target="#confirm-delete-<?php echo $extra['id']; ?>">Eliminar</button>
                                                            <a class="btn btn-primary" href="editar_gramo.php?id=<?php echo $extra['id']; ?>">Editar</a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    <?php } else { ?>
                                        <p>No se encontraron resultados.</p>
                                    <?php } ?>
                                </div>
                            </div>
                            
                            <div class="pagination-container">
                                <?php
                                // Define cuántos botones de paginación deseas mostrar a la vez
                                $paginas_a_mostrar = 5;

                                // Calcula el rango de páginas a mostrar
                                $rango_inicio = max(1, $pagina_actual - floor($paginas_a_mostrar / 2));
                                $rango_fin = min($total_paginas, $rango_inicio + $paginas_a_mostrar - 1);

                                // Muestra botones de páginas anteriores si no está en la primera página
                                if ($pagina_actual > 1) {
                                    echo '<a class="page-link" href="?pagina=1&search=' . $search_query . '">Primera</a>';
                                    echo '<a class="page-link" href="?pagina=' . ($pagina_actual - 1) . '&search=' . $search_query . '">Anterior</a>';
                                }

                                // Muestra botones de páginas en el rango
                                for ($i = $rango_inicio; $i <= $rango_fin; $i++) {
                                    echo '<a class="page-link ' . ($i == $pagina_actual ? 'active' : '') . '" href="?pagina=' . $i . '&search=' . $search_query . '">' . $i . '</a>';
                                }

                                // Muestra botones de páginas siguientes si no está en la última página
                                if ($pagina_actual < $total_paginas) {
                                    echo '<a class="page-link" href="?pagina=' . ($pagina_actual + 1) . '&search=' . $search_query . '">Siguiente</a>';
                                    echo '<a class="page-link" href="?pagina=' . $total_paginas . '&search=' . $search_query . '">Última</a>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php foreach ($gramo_extra as $extra) { ?>
            <!-- Modal de confirmación para cada elemento -->
            <div class="modal fade" id="confirm-delete-<?php echo $extra['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirmar Eliminación</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>¿Estás seguro de que deseas eliminar este envase?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <!-- Botón para confirmar la eliminación -->
                            <button type="button" class="btn btn-danger" onclick="eliminarEnvase(<?php echo $extra['id']; ?>)">Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Función para eliminar un envase
        function eliminarEnvase(id) {
            // Redirigir para eliminar el envase
            window.location.href = `eliminar_gramos.php?id=${id}`;
        }
    </script>
</body>
</html>
