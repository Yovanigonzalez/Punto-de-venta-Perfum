<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "venta";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener la clave secreta de la base de datos
$sql_secret = "SELECT password FROM secret WHERE id = 1"; // Suponiendo que el id de la clave secreta es 1
$result_secret = $conn->query($sql_secret);

if ($result_secret->num_rows > 0) {
    $row = $result_secret->fetch_assoc();
    $claveSecretaReal = $row["password"];
} else {
    die("No se pudo obtener la clave secreta.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $producto = $_POST['producto'];
    $categoria = $_POST['categoria'];
    $stock = $_POST['stock'];
    $codigo = $_POST['codigo'];
    $claveSecreta = $_POST['clave_secreta'];

    // Verifica la clave secreta obtenida de la base de datos antes de actualizar
    if ($claveSecreta === $claveSecretaReal) {
        // Realiza la actualización en la base de datos
        $sql = "UPDATE tendencias SET producto='$producto', categoria='$categoria', stock='$stock', codigo='$codigo' WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            $message = "Tendencia actualizada exitosamente.";
        } else {
            $message = "Error al actualizar la tendencia: " . $conn->error;
        }
    } else {
        $message = "Clave secreta incorrecta. No se permitió la actualización.";
    }
    
    $conn->close();
    
    header("Location: crud_tendencia.php?message=" . urlencode($message));
    exit();
}

$id_to_edit = $_GET['id'];

$sql_edit = "SELECT * FROM tendencias WHERE id=$id_to_edit";
$result_edit = $conn->query($sql_edit);
$tendencia_edit = $result_edit->fetch_assoc();

$conn->close();
?>

<?php
include 'menu.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/exito.css">
    <!-- Incluye el CSS de Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
                                    <form method="post" action="editar.php">
                                        <input type="hidden" name="id" value="<?php echo $tendencia_edit['id']; ?>">
                                        <div class="form-group">
                                            <label for="codigo">Código</label>
                                            <input type="text" class="form-control" id="codigo" name="codigo" value="<?php echo $tendencia_edit['codigo']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="producto">Producto</label>
                                            <input type="text" class="form-control" id="producto" name="producto" value="<?php echo $tendencia_edit['producto']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="categoria">Categoría</label>
                                            <input type="text" class="form-control" id="categoria" name="categoria" value="<?php echo $tendencia_edit['categoria']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="stock">Stock</label>
                                            <input type="number" class="form-control" id="stock" name="stock" value="<?php echo $tendencia_edit['stock']; ?>">
                                        </div>
                                        <button type="button" class="btn btn-primary" id="mostrarVentanaEmergente">Guardar cambios</button>
                                        <input type="hidden" name="clave_secreta" value=""> <!-- Campo oculto para la clave secreta -->
                                    </form>
                                    <!-- Modal de acceso denegado -->
                                    <div class="modal fade" id="ventanaEmergente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Verificación de Clave Secreta</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Ingresa la clave secreta para guardar los cambios:</p>
                                                    <input type="password" class="form-control" id="claveSecretaModal">
                                                    <div id="mensajeError" style="display: none;">
                                                        <img src="../error/error.png" alt="Acceso Denegado" width="100" style="display: block; margin: 0 auto;">
                                                        <p style="color: red; text-align: center;">Acceso Denegado</p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                    <button type="button" class="btn btn-primary" id="verificarClaveSecreta">Verificar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- Incluye los scripts de Bootstrap y jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const mostrarVentanaEmergente = document.getElementById("mostrarVentanaEmergente");
        const verificarClaveSecreta = document.getElementById("verificarClaveSecreta");
        const claveSecretaModal = document.getElementById("claveSecretaModal");
        const mensajeError = document.getElementById("mensajeError");

        // Mostrar la ventana emergente al hacer clic en "Guardar cambios"
        mostrarVentanaEmergente.addEventListener("click", function () {
            $('#ventanaEmergente').modal('show'); // Muestra la ventana emergente Bootstrap
            mensajeError.style.display = "none"; // Oculta el mensaje de error
        });

        // Verificar la clave secreta al hacer clic en "Verificar"
        verificarClaveSecreta.addEventListener("click", function () {
            const claveSecreta = claveSecretaModal.value;
            const claveSecretaReal = "<?php echo $claveSecretaReal; ?>"; // Obtener la clave secreta real de PHP

            if (claveSecreta === claveSecretaReal) {
                // Si la clave es correcta, asigna la clave secreta al campo oculto y envía el formulario
                document.querySelector("input[name='clave_secreta']").value = claveSecreta;
                document.querySelector("form").submit();
            } else {
                // Si la clave es incorrecta, muestra el mensaje de error y oculta el campo de clave secreta
                mensajeError.style.display = "block";
                claveSecretaModal.style.display = "none";
                verificarClaveSecreta.style.display = "none";
            }
        });
    });
</script>

</body>
</html>



