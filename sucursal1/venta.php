<?php include 'menu.php' ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/exito.css">
    <!-- Incluye el CSS de Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Venta a socios</title>
    
    <style>

    /* Estilos para centrar el botón horizontalmente */
    .text-center {
        text-align: center;
    }

    /* Estilos CSS para centrar la imagen horizontal y verticalmente */
    .ticket {
        display: flex;
        justify-content: center; /* Centrar horizontalmente */
        align-items: center; /* Centrar verticalmente */
    }

    /* Estilo para el contenedor de la imagen */
    .image-container {
        text-align: center; /* Alineación horizontal */
    }

    /* Cambiar el color de fondo del card-header a azul O PARA ROSA ES: #F85BFF; */
    .card-header {
        background-color: #007bff;
        display: flex; /* Utilizamos flexbox para centrar el contenido */
        justify-content: center; /* Centrar horizontalmente */
        align-items: center; /* Centrar verticalmente */
    }

    /* Cambiar el color del texto (letra) en el card-header a blanco */
    .card-header h3.card-title {
        color: #FFFFFF;
    }

    </style>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Barra de navegación y barra lateral aquí -->
        <!-- Contenido principal -->
        <div class="content-wrapper">
            <section class="content">
                <br>
                <!-- Contenido de la página 'Ventas' desde menu.php -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Venta</h3>
                                </div>

                                <div class="card-body">                                    
                                    <label>Buscar envase:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="busqueda" name="query" placeholder="Buscar..." onkeyup="realizarBusquedaEnvase()">
                                        </div>

                                        
                                    <!-- Los resultados en tiempo real se mostrarán aquí -->
                                    <div id="resultados"></div>
                                    <!-- Aquí puedes agregar más contenido relacionado con 'Ventas' -->

                                    <br>

                                    <!-- Input field for quantity and "Agregar" button in the same form group -->
                                    <div class="form-gr">
                                        <label for="cantidad">Cantidad a vender:</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="cantidad" name="cantidad" min="1" step="1" pattern="\d*" required>
                                            <div class="input-group-append">
                                                <button type="button" id="agregar-carrito" class="btn btn-primary">Añadir</button>
                                            </div>
                                        </div>
                                    </div>

                                    <br>
                                   <!-- Input field for the 'Tendencia' search -->
                                    <label>Buscar Tendencia:</label>
                                        <div class="input-group">
                                        <input type="text" class="form-control" id="busqueda_tendencia" name="query" placeholder="Buscar..." onkeyup="convertirAMayusculas()">
                                        </div>

                                        <script>
                                        function convertirAMayusculas() {
                                            var inputElement = document.getElementById("busqueda_tendencia");
                                            if (inputElement) {
                                                inputElement.value = inputElement.value.toUpperCase();
                                            }
                                        }
                                        </script>

                                    <!-- Results for 'Tendencia' -->
                                    <div id="resultados_tendencia"></div>

                                    <br>

                                    <!-- Carrito de compras -->
                                    <div id="carrito">
                                    <i class="fas fa-shopping-cart"></i> <!-- Icono de carrito de compras (FontAwesome) -->
                                        <label>Tendencia + Envase a vender</label>
                                        <ul id="carrito-lista">
                                            <!-- Los elementos seleccionados se mostrarán aquí -->
                                        </ul>
                                    </div>


                                    <!-- Agregar campo 'Método de Pago' con Bootstrap -->
                                    <div id="metodo-pago" class="form-group">
                                        <label for="metodoPago">Método de Pago:</label>
                                        <select class="form-control" id="metodoPago" name="metodoPago">
                                            <option value="" disabled selected>Selecciona el método de pago</option>
                                            <option value="efectivo">Efectivo</option>
                                            <option value="tarjeta">Tarjeta de Crédito</option>
                                        </select>
                                    </div>

                                    <!-- Nuevo campo 'Total' -->
                                    <div class="form-group">
                                        <label for="subtotal">Total de Productos:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="text" class="form-control" id="subtotal" name="subtotal" readonly>
                                        </div>
                                    </div>

                                    <!-- Campo 'Dinero recibido' con estilo de Bootstrap -->
                                    <div class="form-group" id="campoDineroRecibido">
                                        <label for="dineroRecibido">Dinero recibido:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="number" class="form-control" id="dineroRecibido" name="dineroRecibido" min="0" step="0.01" required>
                                        </div>
                                    </div>

                                    <!-- Campo 'Cambio a dar' con estilo de Bootstrap -->
                                    <div class="form-group" id="campoCambioADar">
                                        <label for "cambioADar">Cambio a dar:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="text" class="form-control" id="cambioADar" name="cambioADar" readonly>
                                        </div>
                                    </div>

                                    <!-- Botón 'Cobrar' con estilo de Bootstrap -->
                                    <button type="button" id="cobrar" class="btn btn-primary" onclick="copiarAlTicket()">Cobrar</button>                                </div>
                            </div>
                        </div>



                        <!-- Sección de Ticket (en el centro) -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Ticket</h3>
                                </div>
                                <div class="card-body" id="ticket-content">
                                    <div class="ticket">
                                        <img src="../ico/log.svg" alt="Imagen del producto" width="200" height="150">
                                        <!-- Resto de contenido del ticket -->

                                    </div>

                                    <!-- Contenido de la sección de Ticket -->
                                                    <!-- Información de la Sucursal -->
                                                                                        <!-- Captura de la hora y fecha actual -->
                                    <label><span id="fecha-hora"></span></label>
                                    <br>
                                    <label>Sucursal 1</label>
                                    <br>
                                    <label>Dirección: Dirección de la Sucursal</label>
                                    <br>
                                    <label>Teléfono: 249 163 0992</label>
                                    <!-- Centro el texto "Perfumería 'Perfum'" -->
                                    <p align="center"><label>Perfumería 'Perfum'</label></p>                                    
                                    <!-- Agradecimiento -->
                                    <p>Agradecemos tu compra.</p>
                                    
                                    <!-- Leyenda sobre el cuidado del medio ambiente -->
                                    <p>Cuidamos el medio ambiente. Nuestros perfumes se envasan en vidrio reciclable.</p>
                                    
                                    <!-- Oferta de visita a la tienda en línea -->
                                    <p>¡Descubre más fragancias en nuestra <a href="https://perfumeriaperfum.com" target="_blank">https://perfumeriaperfum.com</a>!</p>
                                    

                                
                            <!-- Agrega la imagen SVG al final de la información, centrada -->
                            <div class="text-center">
                                
                                        <img src="../ico/qr.svg" alt="Descripción de la imagen" width="200" height="150">
                                    </div>
                                    </div>

                                <!-- Contenedor para centrar el botón -->
                                <div class="text-center">
                                    <!-- Botón "Imprimir ticket y cobrar" con clase personalizada -->
                                    <!-- Agrega el botón en tu HTML -->
                                    <button class="btn btn-primary btn-estrecho" id="imprimir-ticket">Imprimir ticket y cobrar</button> 
                                       
                                </div>
                                <br>
                            </div>
                        </div>





<!-- Nueva sección "Extra" (a la derecha) -->
<div class="col-md-4">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Extra</h3>
        </div>

        <div class="card-body">
            <label>Feremonas:</label>
            <input type="text" id="searchInput" placeholder="Buscar..." class="form-control">
            
            <br> 

            <div class="form-group">
                <label for "cantidad">Cantidad:</label>
                <div class="input-group">
                    <input type="text" id="cantidad" placeholder="Cantidad" class="form-control">
                    <div class="input-group-append">
                        <button type="button" id="addButton" class="btn btn-primary">Añadir</button>
                    </div>
                </div>
            </div>
            
            <ul id="searchResults"></ul>

            <br>

            <label>Gramo Extra:</label>
            <input type="text" id="searchInput2" placeholder="Buscar..." class="form-control">
            
            <br>

            <div class="form-group">
                <label for="cantidad2">Cantidad:</label>
                <div class="input-group">
                    <input type="text" id="cantidad2" placeholder="Cantidad" class="form-control">
                    <div class="input-group-append">
                        <button type="button" id="addButton2" class="btn btn-primary">Añadir</button>
                    </div>
                </div>
            </div>
            
            <div id="searchResults2"></div>

            <br>
            <!-- Button to "Agregar a la carrito" (centered) -->
            <div class="text-center">
                <button type="button" id="addToCartButton" class="btn btn-primary">Agregar a la carrito</button>
            </div>
        </div>
    </div>
</div>




                        
                    </div>
                </div>
                <!-- Fin del contenido de la página 'Ventas' -->
            </section>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
    var fechaHora = new Date();
    var elementoFechaHora = document.getElementById("fecha-hora");
    elementoFechaHora.textContent = fechaHora.toLocaleString();
</script>

    
<!-- Incluye este script en tu HTML para agregar la funcionalidad de impresión -->
<script>
    // Obtiene una referencia al botón
    var imprimirButton = document.getElementById("imprimir-ticket");

    // Agrega un evento de clic al botón
    imprimirButton.addEventListener("click", function () {
        // Oculta el contenido que no deseas imprimir
        var contenidoNoImprimir = document.querySelector('body');
        contenidoNoImprimir.style.display = 'none';

        // Crea un nuevo documento para imprimir solo la sección de "Ticket"
        var ventanaImpresion = window.open('', '', 'width=600,height=600');
        ventanaImpresion.document.write('<html><head><title>Ticket de compra</title></head><body>');
        ventanaImpresion.document.write(document.getElementById('ticket-content').innerHTML);
        ventanaImpresion.document.write('</body></html>');
        ventanaImpresion.document.close();
        ventanaImpresion.print();
        ventanaImpresion.close();

        // Restaura la visibilidad del contenido oculto
        contenidoNoImprimir.style.display = 'block';
    });
</script>

    

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        // Obtén una referencia al botón "Cobrar"
        var cobrarButton = document.getElementById("cobrar");

        // Obtén una referencia a la sección "Ticket"
        var ticketContent = document.getElementById("ticket-content");

        // Variable para rastrear si los elementos de encabezado ya se han agregado
        var encabezadosAgregados = false;

        // Agrega un escuchador de eventos al botón "Cobrar"
        cobrarButton.addEventListener("click", function () {
            // Crea un nuevo elemento de ticket para mostrar los datos seleccionados
            var ticketItem = document.createElement("div");
            ticketItem.className = "ticket"; // Clase CSS para dar formato

            // Obtiene los elementos del carrito
            var carritoItems = document.querySelectorAll("#carrito-lista li");

            // Crea una lista no ordenada para los elementos del ticket
            var ticketList = document.createElement("ul");

            // Recorre los elementos del carrito y agrega su contenido al ticket
            carritoItems.forEach(function (carritoItem) {
                // Filtra el contenido para omitir el texto "Eliminar"
                var itemText = carritoItem.textContent.replace("Eliminar", "");
                var itemInfo = document.createElement("li");
                itemInfo.textContent = itemText;
                ticketList.appendChild(itemInfo);
            });

            // Agrega "Método de Pago" al ticket
            var metodoPago = document.createElement("li");
            metodoPago.textContent = "Método de Pago: " + document.getElementById("metodoPago").value;
            ticketList.appendChild(metodoPago);

            // Agrega los elementos de encabezado una sola vez
            if (!encabezadosAgregados) {
                // Agrega "Total de Productos" al ticket
                var totalProductos = document.createElement("li");
                totalProductos.textContent = "Total de Productos: $" + document.getElementById("subtotal").value;
                ticketList.appendChild(totalProductos);

                // Agrega "Dinero recibido" al ticket
                var dineroRecibido = document.createElement("li");
                dineroRecibido.textContent = "Dinero recibido: $" + document.getElementById("dineroRecibido").value;
                ticketList.appendChild(dineroRecibido);

                // Agrega "Cambio a dar" al ticket
                var cambioADar = document.createElement("li");
                cambioADar.textContent = "Cambio a dar: $" + document.getElementById("cambioADar").value;
                ticketList.appendChild(cambioADar);

                // Marca los encabezados como agregados
                encabezadosAgregados = true;
            }

            // Agrega la lista al elemento del ticket
            ticketItem.appendChild(ticketList);

            // Agrega el elemento del ticket a la sección "Ticket"
            ticketContent.appendChild(ticketItem);
        });
    });
</script>



    <script>
    // Función para mostrar u ocultar "Dinero recibido" y "Cambio a dar" según el método de pago
    function toggleDineroRecibidoYCambio() {
        var metodoPago = document.getElementById("metodoPago").value;
        var campoDineroRecibido = document.getElementById("campoDineroRecibido");
        var campoCambioADar = document.getElementById("campoCambioADar");

        if (metodoPago === "tarjeta") {
            campoDineroRecibido.style.display = "none";
            campoCambioADar.style.display = "none";
            // Limpiar los valores cuando se ocultan
            document.getElementById("dineroRecibido").value = "";
            document.getElementById("cambioADar").value = "";
        } else {
            campoDineroRecibido.style.display = "block";
            campoCambioADar.style.display = "block";
        }
    }

    // Adjuntar un escuchador de eventos al menú desplegable "Método de Pago"
    document.getElementById("metodoPago").addEventListener("change", toggleDineroRecibidoYCambio);

    // Llamada inicial para establecer el estado inicial
    toggleDineroRecibidoYCambio();
</script>


           <!-- Agrega el JavaScript para la operación de resta y actualización -->
           <script>
            // Obtén referencias a los campos de entrada
            const subtotalInput = document.getElementById("subtotal");
            const dineroRecibidoInput = document.getElementById("dineroRecibido");
            const cambioADarInput = document.getElementById("cambioADar");

            // Agrega un escuchador de eventos de entrada al campo "Dinero recibido"
            dineroRecibidoInput.addEventListener("input", function () {
                // Convierte el valor del "Total de Productos" y el "Dinero recibido" en números
                const subtotal = parseFloat(subtotalInput.value) || 0; // Asegúrate de que sea un número o, de lo contrario, usa 0
                const dineroRecibido = parseFloat(dineroRecibidoInput.value) || 0;

                // Calcula el cambio a dar
                const cambioADar = dineroRecibido - subtotal;

                // Actualiza el campo "Cambio a dar" con el cambio calculado
                cambioADarInput.value = cambioADar.toFixed(2); // Muestra con 2 decimales
            });
        </script>
        

    <script>

// Arreglo para almacenar los elementos seleccionados en el carrito
var carritoItems = [];

$(document).ready(function () {
    $(document).on('click', '.agregar-btn', function () {
        var id = $(this).closest(".result-item").data("id");
        var envase = $(this).closest(".result-item").text().split('-')[0].trim();
        var precio = parseFloat($(this).closest(".result-item").text().match(/\d+\.\d+/));

        // Agregar el producto y su precio al carrito
        carritoItems.push({ id: id, envase: envase, precio: precio });

        actualizarCarrito();
    });

    $(document).on('click', '.agregar-btn-tendencia', function () {
        var resultItem = $(this).closest(".result-item");
        var producto = resultItem.text().split('-')[0].trim();
        var categoria = resultItem.text().split('-')[1].trim();

        // Agregar el producto de "Tendencia" al carrito
        carritoItems.push({ producto: producto, categoria: categoria });

        actualizarCarrito();
    });

    $(document).on('click', '#agregar-carrito', function () {
        var cantidad = parseInt($("#cantidad").val());

        if (cantidad > 0) {
            var producto = carritoItems[carritoItems.length - 1];
            producto.cantidad = cantidad;
            
            // Calcular el costo total de este artículo
            producto.totalCost = cantidad * producto.precio;

            actualizarCarrito();

            $("#cantidad").val("");
        }
    });

    // Función para eliminar un elemento del carrito
    $(document).on('click', '.eliminar-carrito', function () {
        var index = $(this).data("index");
        carritoItems.splice(index, 1);
        actualizarCarrito();
    });
});


function actualizarCarrito() {
    var carritoLista = $("#carrito-lista");
    carritoLista.empty();

    var subtotal = 0; // Inicializar el subtotal

    carritoItems.forEach(function (item, index) {
        var itemDescripcion = item.envase ? item.envase + " - $" + item.precio.toFixed(2) : item.producto;

        if (item.cantidad) {
            itemDescripcion += " - Cantidad: " + item.cantidad;

            if (item.totalCost) {
                subtotal += item.totalCost; // Sumar el costo total al subtotal
            }
        }

        carritoLista.append("<li>" + itemDescripcion +
            '<button class="btn btn-danger eliminar-carrito" data-index="' + index + '">Eliminar</button>' + "</li>");
    });

    // Actualizar el campo "Subtotal" con el valor calculado
    $("#subtotal").val(subtotal.toFixed(2));

    document.getElementById("busqueda").value = "";
    document.getElementById("resultados").innerHTML = "";
    document.getElementById("busqueda_tendencia").value = "";
    document.getElementById("resultados_tendencia").innerHTML = "";
}




function realizarBusquedaEnvase() {
    var consultaEnvase = document.getElementById("busqueda").value;

    if (consultaEnvase !== "") {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                document.getElementById("resultados").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "resultados.php?query=" + consultaEnvase, true);
        xhttp.send();
    } else {
        document.getElementById("resultados").innerHTML = "";
    }
}

function realizarBusquedaTendencia() {
    var consultaTendencia = document.getElementById("busqueda_tendencia").value;

    if (consultaTendencia !== "") {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                document.getElementById("resultados_tendencia").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "resultados_tendencia.php?query=" + consultaTendencia, true);
        xhttp.send();
    } else {
        document.getElementById("resultados_tendencia").innerHTML = "";
    }
}
</script>

    
</body>
</html>

