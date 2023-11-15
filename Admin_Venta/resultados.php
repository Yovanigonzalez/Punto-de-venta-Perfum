    <?php
    // Conectar a la base de datos (asegúrate de cambiar estos valores por los de tu base de datos)
    $host = "localhost";
    $usuario = "root";
    $contrasena = "";
    $base_de_datos = "venta";

    $conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error de conexión a la base de datos: " . $conexion->connect_error);
    }

    // Obtener la consulta de búsqueda desde el formulario
    if (isset($_GET['query'])) {
        $consulta = $conexion->real_escape_string($_GET['query']);

        // Consulta SQL para buscar en la tabla 'envase' por 'envase'
        $sql = "SELECT id, envase, precio, gramos, cantidad FROM envase WHERE envase LIKE '%$consulta%'";

        $resultado = $conexion->query($sql);

        if ($resultado) {
            echo "<br>";

            // Mostrar los resultados de la búsqueda
            echo "<h4>Resultados de la búsqueda:</h4>";

            while ($fila = $resultado->fetch_assoc()) {
                echo '<div class="result-item" data-id="' . $fila['id'] . '" data-gramos="' . $fila['gramos'] . '">';
                echo $fila['envase'] . ' - $' . $fila['precio'];
                echo ' - Gramos: ' . $fila['gramos'] . ' - Cantidad: ' . $fila['cantidad'];
                echo ' <button class="btn btn-primary agregar-btn">Agregar</button>';
                echo '</div><br><br>';
                
            }
                } else {
            echo "No se encontraron resultados.";
        }

        // Cerrar la conexión
        $conexion->close();
    } else {
        echo "No se proporcionó una consulta.";
    }
    ?>
