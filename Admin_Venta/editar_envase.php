<?php
// Verificar si se ha enviado un ID válido a través de la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $envase_id = $_GET['id'];

    // Conectar a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "venta";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Obtener los datos del envase con el ID proporcionado
    $sql = "SELECT * FROM envase WHERE id = $envase_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $envase = $result->fetch_assoc();
    } else {
        echo "No se encontró ningún envase con el ID proporcionado.";
        exit;
    }

    // Procesar el formulario si se envió
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nuevo_envase = $_POST["envase"];
        $nuevo_precio = $_POST["precio"];
        $nuevo_stock = $_POST["stock"];
        $nuevos_gramos = $_POST["gramos"];
        $nueva_categoria = $_POST["categoria"];

        // Actualizar el envase en la base de datos
        $sql = "UPDATE envase SET envase = '$nuevo_envase', precio = '$nuevo_precio', stock = '$nuevo_stock', gramos = '$nuevos_gramos', categoria = '$nueva_categoria' WHERE id = $envase_id";

        if ($conn->query($sql) === TRUE) {
            // Redirect to 'crud_envase.php' with a success message in the URL
            header("Location: crud_envase.php?message=El envase se actualizó correctamente");
            exit; // Ensure no further processing on this page
        } else {
            echo "Error al actualizar el envase: " . $conn->error;
        }
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    echo "ID de envase no válido.";
}
?>

<?php include 'menu.php' ?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/exito.css">
    <link rel="stylesheet" href="../css/acciones.css">
    <!-- Agrega la referencia al ícono FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!-- Agrega la referencia a Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
            cursor: pointer;
        }
        
        .search-container button:hover {
            background-color: #0056b3;
        }
        
        .result-message {
            margin-top: 10px;
        }

        /* Estilo para el mensaje de error y el ícono */
        .mensaje-error {
            display: none;
            color: red;
            margin-top: 5px;
        }

        /* Define el estilo para el mensaje de éxito */
        .success-message {
            text-align: center;
            margin-top: 10px;
            border-radius: 5px;
            padding: 10px;
            background-color: #dff0d8; /* Fondo verde para mensajes de éxito */
            color: #3c763d; /* Texto verde oscuro para mensajes de éxito */
        }
    </style>
    <title>Editar Tendencia</title>
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
                                    <h3 class="card-title">Editar Tendencia</h3>
                                </div>
                                <div class="card-body">
                                    <?php
                                    // Verificar si se ha enviado un ID válido a través de la URL
                                    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                                        $envase_id = $_GET['id'];

                                        // Conectar a la base de datos
                                        $servername = "localhost";
                                        $username = "root";
                                        $password = "";
                                        $dbname = "venta";

                                        $conn = new mysqli($servername, $username, $password, $dbname);

                                        if ($conn->connect_error) {
                                            die("Conexión fallida: " . $conn->connect_error);
                                        }

                                        // Obtener los datos del envase con el ID proporcionado
                                        $sql = "SELECT * FROM envase WHERE id = $envase_id";
                                        $result = $conn->query($sql);

                                        if ($result->num_rows == 1) {
                                            $envase = $result->fetch_assoc();
                                        } else {
                                            echo "No se encontró ningún envase con el ID proporcionado.";
                                            exit;
                                        }

                                        // Procesar el formulario si se envió
                                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                            $nuevo_envase = $_POST["envase"];
                                            $nuevo_precio = $_POST["precio"];
                                            $nuevo_stock = $_POST["stock"];
                                            $nuevos_gramos = $_POST["gramos"];
                                            $nueva_categoria = $_POST["categoria"];

                                            // Actualizar el envase en la base de datos
                                            $sql = "UPDATE envase SET envase = '$nuevo_envase', precio = '$nuevo_precio', stock = '$nuevo_stock', gramos = '$nuevos_gramos', categoria = '$nueva_categoria' WHERE id = $envase_id";

                                            if ($conn->query($sql) === TRUE) {
                                                echo '<div class="success-message">El envase se actualizó correctamente.</div>';
                                            } else {
                                                echo "Error al actualizar el envase: " . $conn->error;
                                            }
                                        }

                                        // Cerrar la conexión a la base de datos
                                        $conn->close();
                                    } else {
                                        echo "ID de envase no válido.";
                                    }
                                    ?>
                                    <!-- Formulario Bootstrap -->
                                    <form method="POST" action="">
                                        <div class="form-group">
                                            <label for="envase">Envase:</label>
                                            <input type="text" class="form-control" id="envase" name="envase" value="<?php echo $envase['envase']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="precio">Precio:</label>
                                            <input type="text" class="form-control" id="precio" name="precio" value="<?php echo $envase['precio']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="stock">Stock:</label>
                                            <input type="text" class="form-control" id="stock" name="stock" value="<?php echo $envase['stock']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="gramos">Gramos:</label>
                                            <input type="text" class="form-control" id="gramos" name="gramos" value="<?php echo $envase['gramos']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="categoria">Categoría:</label>
                                            <input type="text" class="form-control" id="categoria" name="categoria" value="<?php echo $envase['categoria']; ?>">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- Agrega la referencia a Bootstrap JS y jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
