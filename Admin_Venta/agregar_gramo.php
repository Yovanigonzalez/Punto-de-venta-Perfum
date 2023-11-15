<?php include 'menu.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Icono de la página -->
    <title>Agregar Gramo Extra</title>
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
                                <h3 class="card-title">Agregar Gramo Extra</h3>
                            </div>
                            <div class="card-body">
                                <form action="guardar_gramo.php" method="POST">
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

                                    <!-- "Envase" Field -->
                                    <div class="form-group">
                                        <label for="envase">Envase:</label>
                                        <select name="envase" id="envase" class="form-control">
                                            <option value="" selected>Seleccionar el envase</option>
                                            <option value="Gramo extra">Gramo extra</option>
                                        </select>
                                    </div>


                                    <!-- "Precio" Field (Decimal) -->
                                    <div class="form-group">
                                        <label for="precio">Precio:</label>
                                        <input type="number" name="precio" id="precio" class="form-control" step="0.01" min="0.01" placeholder="Ingrese el precio">
                                        <small>Solo se permite números</small>
                                    </div>

                                    <!-- "Cantidad" Field -->
                                    <div class="form-group">
                                        <label for="cantidad">Cantidad:</label>
                                        <input type="number" name="cantidad" id="cantidad" class="form-control" min="1" value="1" readonly>
                                    </div>


                                    <!-- "Stock" Field -->
                                    <div class="form-group">
                                        <label for="stock">Stock:</label>
                                        <input type="number" name="stock" id="stock" class="form-control" min="0" value="0" readonly>
                                    </div>



                                    <!-- "Categoria" -->
                                    <div class="form-group">
                                        <label for="categoria">Categoria:</label>
                                        <select name="categoria" id="categoria" class="form-control">
                                            <option value="" selected>Seleccionar la categoria</option>
                                            <option value="Gramo extra">Gramo extra</option>
                                            <!-- Aquí puedes agregar otras opciones si es necesario -->
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
