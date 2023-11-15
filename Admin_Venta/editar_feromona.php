<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "venta";

// Crear una conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Comprobar si un ID de artículo se proporciona en la URL
if (isset($_GET['id'])) {
    $item_id = $_GET['id'];

    // Obtener los datos del artículo de la base de datos según el ID proporcionado
    $query = "SELECT * FROM feremona WHERE id = $item_id";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Procesar los datos según sea necesario
        $envase = $row['envase'];
        $precio = $row['precio'];
        $cantidad = $row['cantidad'];
        $gramos = $row['gramos']; // Add "gramos" field
        $categoria = $row['categoria'];

        // Comprobar si se ha enviado el formulario para actualizar
        if (isset($_POST['update'])) {
            // Recuperar los datos actualizados del formulario
            $updatedEnvase = $_POST['envase'];
            $updatedPrecio = $_POST['precio'];
            $updatedCantidad = $_POST['cantidad'];
            $updatedGramos = $_POST['gramos']; // Add "gramos" field
            $updatedCategoria = $_POST['categoria'];

            // Crear la consulta SQL para actualizar el registro
            $sql = "UPDATE feremona SET envase = '$updatedEnvase', precio = '$updatedPrecio', cantidad = '$updatedCantidad', gramos = '$updatedGramos', categoria = '$updatedCategoria' WHERE id = $item_id";

            if ($conn->query($sql) === TRUE) {
                // Mostrar un mensaje de éxito
                echo '<div class="success-message">¡Feremona actualizada exitosamente!</div>';
                // Redirigir al usuario a 'crud_feremonas.php' después de mostrar el mensaje de éxito
                header("Location: crud_feremonas.php?message=Registro actualizado exitosamente");
                exit;
            } else {
                // Mostrar un mensaje de error si la actualización falla
                echo "Error al actualizar el registro: " . $conn->error;
            }
        }
    } else {
        // Manejar el caso en el que el ID del artículo no se encuentra
        echo "Feremona no encontrada.";
    }
} else {
    // Manejar el caso en el que no se proporciona un ID de artículo en la URL
    echo "ID de feremona no especificado.";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>

<?php include 'menu.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/editar_gramo.css">
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
    <title>Editar Feromona</title>
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
                                    <h3 class="card-title">Editar Feromona</h3>
                                </div>
                                <div class="card-body">

                                    <form action="editar_feromona.php?id=<?php echo $item_id; ?>" method="POST">
                                        <div class="form-group">
                                            <label for="envase">Envase:</label>
                                            <input type="text" class="form-control" name="envase" value="<?php echo $envase; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="precio">Precio:</label>
                                            <input type="text" class="form-control" name="precio" value="<?php echo $precio; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="cantidad">Cantidad:</label>
                                            <input type="text" class="form-control" name="cantidad" value="<?php echo $cantidad; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="gramos">Gramos:</label>
                                            <input type="text" class="form-control" name="gramos" value="<?php echo $gramos; ?>"> <!-- Add "gramos" field -->
                                        </div>

                                        <div class="form-group">
                                            <label for "categoria">Categoría:</label>
                                            <input type="text" class="form-control" name="categoria" value="<?php echo $categoria; ?>">
                                        </div>

                                        <button type="submit" name="update" class="btn btn-primary">Guardar cambios</button>
                                    </form>
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
