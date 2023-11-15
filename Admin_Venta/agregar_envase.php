<?php
include 'menu.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
    <!-- Icono de la página -->
    <title>Agregar Envase</title>
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
                                <h3 class="card-title">Agregar Envase Nuevo o Rellenado</h3>
                            </div>
                            <div class="card-body">
                                <form action="guardar_envase.php" method="POST">
                                        <!-- Mensaje de éxito -->
                                        <?php
                                            // Verificar si se debe mostrar un mensaje de éxito o error
                                            if (isset($_GET['success']) && $_GET['success'] === 'true') {
                                                echo '<div class="alert alert-success" role="alert">Los datos se han guardado correctamente.</div>';
                                            } elseif (isset($_GET['success']) && $_GET['success'] === 'false') {
                                                echo '<div class="alert alert-danger" role="alert">Error al guardar los datos: ' . $_GET['error_message'] . '</div>';
                                            }
                                        ?>
                                        <!-- Mensaje de error -->

                                    <!-- "Envase" -->
                                    <div class="form-group">
                                        <label for="envase">Envase:</label>
                                        <select name="envase" id="envase" class="form-control">
                                            <option value="">Selecciona una opción</option>
                                            <option value="Rollete 10 ml" data-precio="90.00">Rollete 10 ml</option>
                                            <option value="Envase Perfumero 15 ml" data-precio="95.00">Envase Perfumero 15 ml</option>
                                            <option value="Envase Perfumero 30 ml" data-precio="130.00">Envase Perfumero 30 ml</option>
                                            <option value="Envase Perfumero 60 ml" data-precio="240.00">Envase Perfumero 60 ml</option>
                                            <option value="Envase Perfumero 100 ml" data-precio="350.00">Envase Perfumero 100 ml</option>
                                            <option value="Envase Perfumero 120 ml" data-precio="430.00">Envase Perfumero 120 ml</option>
                                            <option value="Desodorante 90 g" data-precio="90.00">Desodorante 90 g</option>
                                            <option value="Relleno Rollete 10 ml" data-precio="85.00">Relleno Rollete 10 ml</option>
                                            <option value="Relleno Perfumero 15 ml" data-precio="90.00">Relleno Perfumero 15 ml</option>
                                            <option value="Relleno Perfumero 30 ml" data-precio="110.00">Relleno Perfumero 30 ml</option>
                                            <option value="Relleno Perfumero 60 ml" data-precio="215.00">Relleno Perfumero 60 ml</option>
                                            <option value="Relleno Perfumero 100 ml" data-precio="335.00">Relleno Perfumero 100 ml</option>
                                            <option value="Relleno Perfumero 120 ml" data-precio="400.00">Relleno Perfumero 120 ml</option>
                                            <option value="Relleno Desodorante 90 g" data-precio="75.00">Relleno Desodorante 90 g</option>
                                            <option value="Feremona" data-precio="10">Feremona</option>
                                            <option value="Gramo Extra" data-precio="8">Gramo Extra</option>
                                        </select>
                                    </div>

                                    <!-- "Precio" -->
                                    <div class="form-group">
                                        <label for="precio">Precio:</label>
                                        <input type="text" name="precio" id="precio" class="form-control" readonly>
                                    </div>


                                    <!-- "Gramos" -->
                                    <div class="form-group">
                                        <label for="gramos">Gramos:</label>
                                        <input type="text" name="gramos" id="gramos" class="form-control" placeholder="Ingrese los gramos" oninput="validateGramosInput(this)">
                                        <small>Solo acepta números</small>
                                    </div>

                                    <script>
                                        function validateGramosInput(input) {
                                            // Reemplaza cualquier carácter no numérico con una cadena vacía
                                            input.value = input.value.replace(/[^0-9]/g, '');
                                        }
                                    </script>

                                    <!-- Field for "Cantidad" -->
                                    <div class="form-group">
                                        <label for="cantidad">Cantidad:</label>
                                        <input type="text" name="cantidad" id="cantidad" class="form-control" placeholder="Ingrese un número 1 o 0" oninput="validateCantidadInput(this)">
                                        <small>Solo se permite escribir 1 o 0</small>
                                    </div>

                                    <script>
                                        function validateCantidadInput(input) {
                                            // Remove all non-digit characters
                                            input.value = input.value.replace(/[^0-9]/g, '');
                                            // Ensure the input has a length of at most 1
                                            if (input.value.length > 1) {
                                                input.value = input.value.substring(0, 1);
                                            }
                                        }
                                    </script>



                                        <!-- "Categoría"-->
                                        <div class="form-group">
                                            <label for="categoria">Categoría:</label>
                                            <select name="categoria" id="categoria" class="form-control">
                                                <option value="">Selecciona una opción</option>
                                                <option value="Rollete 10 ml">Rollete 10 ml</option>
                                                <option value="Envase Perfumero 15 ml">Envase Perfumero 15 ml</option>
                                                <option value="Envase Perfumero 30 ml">Envase Perfumero 30 ml</option>
                                                <option value="Envase Perfumero 60 ml">Envase Perfumero 60 ml</option>
                                                <option value="Envase Perfumero 100 ml">Envase Perfumero 100 ml</option>
                                                <option value="Envase Perfumero 120 ml">Envase Perfumero 120 ml</option>
                                                <option value="Desodorante 90 g">Desodorante 90 g</option>
                                                <option value="Relleno Rollete 10 ml">Relleno Rollete 10 ml</option>
                                                <option value="Relleno Perfumero 15 ml">Relleno Perfumero 15 ml</option>
                                                <option value="Relleno Perfumero 30 ml">Relleno Perfumero 30 ml</option>
                                                <option value="Relleno Perfumero 60 ml">Relleno Perfumero 60 ml</option>
                                                <option value="Relleno Perfumero 100 ml">Relleno Perfumero 100 ml</option>
                                                <option value="Relleno Perfumero 120 ml">Relleno Perfumero 120 ml</option>
                                                <option value="Relleno Desodorante 90 g">Relleno Desodorante 90 g</option>
                                                <option value="Feremona">Feremona</option>
                                                <option value="Gramo Extra" data-precio="8">Gramo Extra</option>

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

<script>
    // Obtener referencias a los elementos del DOM
    var envaseSelect = document.getElementById("envase");
    var precioInput = document.getElementById("precio");

    // Agregar un evento para detectar cambios en la selección
    envaseSelect.addEventListener("change", function () {
        // Obtener la opción seleccionada
        var selectedOption = envaseSelect.options[envaseSelect.selectedIndex];

        // Obtener el precio de la opción seleccionada
        var precio = selectedOption.getAttribute("data-precio");

        // Actualizar el campo de precio con el valor numérico del precio
        precioInput.value = precio;
    });
</script>

</body>
</html>
