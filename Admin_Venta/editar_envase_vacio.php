<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "venta";
$tableName = "tabla_envases";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Procesar el formulario de edición
    $id = $_POST["id"];
    $nuevoEnvase = $_POST["nuevoEnvase"];
    $nuevoPrecio = $_POST["nuevoPrecio"];
    $nuevaCantidad = $_POST["nuevaCantidad"];
    $nuevaCategoria = $_POST["nuevaCategoria"];

    // Actualizar el registro en la base de datos
    $sql = "UPDATE $tableName SET envase='$nuevoEnvase', precio='$nuevoPrecio', cantidad='$nuevaCantidad', categoria='$nuevaCategoria' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: crud_envase_vacio.php?message=Registro actualizado exitosamente");
        exit();
    } else {
        echo "Error al actualizar el registro: " . $conn->error;
    }
}

// Obtener el ID del registro a editar
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Consultar la base de datos para obtener el registro a editar
    $sql = "SELECT id, envase, precio, cantidad, categoria FROM $tableName WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        echo "Registro no encontrado";
        exit();
    }
}
?>

<?php include 'menu.php' ?>


<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Encabezado y estilos -->
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">

<!-- Contenido principal -->
<div class="content-wrapper">
    <section class="content">
        <br>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Editar envace o caja</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="">
                                <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
                                <div class="form-group">
                                    <label for="nuevoEnvase">Envase:</label>
                                    <input type="text" class="form-control" name="nuevoEnvase" value="<?php echo $row["envase"]; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="nuevoPrecio">Precio:</label>
                                    <input type="text" class="form-control" name="nuevoPrecio" value="<?php echo $row["precio"]; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="nuevaCantidad">Cantidad:</label>
                                    <input type="text" class="form-control" name="nuevaCantidad" value="<?php echo $row["cantidad"]; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="nuevaCategoria">Categoría:</label>
                                    <input type="text" class="form-control" name="nuevaCategoria" value="<?php echo $row["categoria"]; ?>">
                                </div>
                                <button type="submit" name="guardarCambios" class="btn btn-primary">Guardar Cambios</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


</html>

<?php
// Cerrar la conexión a la base de datos
$conn->close();
?>
