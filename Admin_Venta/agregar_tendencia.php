<?php
include 'menu.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
/* Define el estilo para el mensaje de éxito */
.success-message {
    text-align: center;
    margin-top: 10px;
    border-radius: 5px;
    padding: 10px;
    background-color: #dff0d8; /* Fondo verde para mensajes de éxito */
    color: #3c763d; /* Texto verde oscuro para mensajes de éxito */
}

/* Define el estilo para el mensaje de error */
.error-message {
    text-align: center;
    margin-top: 10px;
    border-radius: 5px;
    padding: 10px;
    background-color: #f2dede; /* Fondo rojo claro para mensajes de error */
    color: #a94442; /* Texto rojo oscuro para mensajes de error */
}

    </style>

    <!-- Icono de la página -->
    <title>Agregar Tendencia</title>
    <!-- Agrega tus enlaces a hojas de estilo o scripts aquí -->
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
                                    <h3 class="card-title">Agregar Tendencia</h3>
                                </div>
                                <div class="card-body">
                                    <form action="guardar_tendencia_1.php" method="POST">

                                    <?php
                                    // Verifica si hay un mensaje y su clase definida
                                    if (isset($_GET['message']) && isset($_GET['messageClass'])) {
                                        $message = urldecode($_GET['message']);
                                        $messageClass = $_GET['messageClass'];
                                        echo '<p class="' . $messageClass . '">' . $message . '</p>';
                                    }
                                    ?>

                                    <div class="form-group">
                                        <label for="codigo">Código:</label>
                                        <input type="text" id="codigo" name="codigo" class="form-control" required oninput="this.value = this.value.toUpperCase()" maxlength="7">
                                    </div>

                                    <script>
                                        // Función para verificar la longitud del valor del campo y mostrar una alerta si es menor de 7 caracteres
                                        function verificarLongitud() {
                                            var codigoInput = document.getElementById("codigo");
                                            var valor = codigoInput.value;
                                            
                                            if (valor.length < 7) {
                                                alert("El código debe tener al menos 7 caracteres.");
                                            }
                                        }

                                        // Agregar un evento para llamar a la función cuando se cambie el valor del campo
                                        var codigoInput = document.getElementById("codigo");
                                        codigoInput.addEventListener("change", verificarLongitud);
                                    </script>




                                        <div class="form-group">
                                            <label for="producto">Producto:</label>
                                            <input type="text" id="producto" name="producto" class="form-control" required oninput="this.value = this.value.toUpperCase()">
                                        </div>

                                        <!-- Dentro del formulario existente -->
                                        <div class="form-group">
                                            <label for="stock">Stock:</label>
                                            <input type="text" id="stock" name="stock" class="form-control" value="60" readonly>
                                        </div>


                                        <div class="form-group">
                                            <label for="categoria">Categoría:</label>
                                            <select id="categoria" name="categoria" class="form-control" required>
                                                <option value="" selected>Selecciona una categoría</option>
                                                <option value="Hombre">Hombre</option>
                                                <option value="Mujer">Mujer</option>
                                                <option value="Unixes">Unixes</option>
                                                <option value="Feremona">Feremona</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Agregar</button>
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
