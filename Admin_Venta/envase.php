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
                                <h3 class="card-title">Agregar Envases por partes (Refacciones)</h3>
                            </div>
                            <div class="card-body">
                                <form action="envase_vacio.php" method="POST">
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
                                                <option value="Envase Vacio Cristal 60 ml" data-precio="30.00">Envase Vacio Cristal 60 ml</option>
                                                <option value="Envase Vacio Cristal 30 ml" data-precio="30.00">Envase Vacio Cristal 30 ml</option>
                                                <option value="Envase Vacio Plastico 15 ml" data-precio="20.00">Envase Vacio Plastico 15 ml</option>
                                                <!-- Agregados extra -->
                                                <option value="Envase Vacio Cristal 100 ml" data-precio="30.00">Envase Vacio Cristal 100 ml</option>
                                                <option value="Envase Vacio Cristal 120 ml" data-precio="30.00">Envase Vacio Cristal 120 ml</option>
                                                <option value="Envase Vacio Cristal Desodorante 90 g" data-precio="30.00">Envase Vacio Cristal Desodorante 90 g</option>
                                                <!--<option value="Atomizador c/ Retapa" data-precio="15.00">Atomizador c/ Retapa</option>-->
                                                <option value="Rolletes" data-precio="20.00">Rolletes</option>
                                                <option value="Caja" data-precio="10.00">Caja</option>
                                                <option value="Atomizador global" data-precio="30.00">Atomizador global</option>
                                                <option value="Tapa global" data-precio="30.00">Tapa global</option>
                                                <option value="Tapa de Desodorante 90 g" data-precio="15.00">Tapa de Desodorante 90 g</option>
                                                <option value="Porta Canica de Desodorante de 90 g" data-precio="15.00">Porta Canica de Desodorante de 90 g</option>
                                            </select>
                                        </div>




                                    <!-- "Precio" -->
                                    <div class="form-group">
                                        <label for="precio">Precio:</label>
                                        <input type="text" name="precio" id="precio" class="form-control" readonly>
                                    </div>



                                    <!-- "Cantidad de pieza a vender" -->
                                    <div class="form-group">
                                        <label for="cantidad">Piezas:</label>
                                        <input type="text" name="cantidad" id="cantidad" class="form-control" value="1" readonly>
                                    </div>

                                    <!-- "Stock" -->
                                    <div class="form-group">
                                        <label for="stock">Stock:</label>
                                        <input type="number" name="stock" id="stock" class="form-control" required>
                                    </div>


                                    <div class="form-group">
                                    <label for="categoria">Categoría:</label>
                                    <select name="categoria" id="categoria" class="form-control">
                                        <option value="">Selecciona una opción</option>
                                        <option value="Envase Perfumero 60 ml">Envase Vacio Cristal 60 ml</option>
                                        <option value="Envase Perfumero 30 ml">Envase Vacio Cristal 30 ml</option>
                                        <option value="Envase Perfumero 15 ml">Envase Vacio Plastico 15 ml</option>

                                        <!-- Agregados extra -->
                                        <option value="Envase Perfumero 100 ml">Envase Vacio Cristal 100 ml</option>
                                        <option value="Envase Perfumero 120 ml">Envase Vacio Cristal 120 ml</option>
                                        <option value="Envase Perfumero Desodorante 90 g">Envase Vacio Cristal Desodorante 90 g</option>
                                        <!--<option value="Atomizador c/ Retapa">Atomizador c/ Retapa</option>-->
                                        <option value="Rolletes">Rolletes</option>
                                        <option value="Caja">Caja</option>
                                        <option value="Atomizador global">Atomizador global</option>
                                        <option value="Tapa global">Tapa global</option>
                                        <option value="Tapa de Desodorante 90 g">Tapa de Desodorante 90 g</option>
                                        <option value="Porta Canica de Desodorante de 90 g">Porta Canica de Desodorante de 90 g</option>
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
