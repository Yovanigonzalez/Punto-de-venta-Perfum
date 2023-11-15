<?php
include 'menu.php';
?>


<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "perfum";

// Crear una conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para obtener todos los productos de la tabla 'tendencias'
$sqlTendencias = "SELECT id, producto FROM tendencias";
$resultTendencias = $conn->query($sqlTendencias);

// Consulta SQL para obtener todos los productos de la tabla 'extra'
$sqlExtra = "SELECT id, embase, capacidad, uso, precio, sucursal FROM extra WHERE sucursal = 'Sucursal 1'";
$resultExtra = $conn->query($sqlExtra);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/ti.css"> <!-- Enlaza la hoja de estilo externa -->
    <link rel="stylesheet" href="../css/bus.css"> <!-- Enlaza la hoja de estilo externa -->
    <!--Logo-->
    <link rel="shortcut icon" type="image/x-icon" href="../log/log.png">



    <title>Punto de Venta</title>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content">
                <br>
                <div class="container-fluid">
                    <div class="row">
                        <!-- Columna del Punto de Venta -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Punto de Venta</h3>
                                </div>
                                <div class="card-body">
                                    <!-- Código del punto de venta -->
                                    <section>
                                        <h2>Productos de Tendencias</h2>
                                        <!-- Campo de búsqueda para productos de tendencias -->
                                        <input type="text" id="searchTendencias" onkeyup="searchTendencias()" placeholder="Buscar productos de tendencias...">
                                        <!-- Lista de productos de tendencias (inicialmente oculta) -->
                                        <ul id="tendenciasList" style="display: none;">
                                            <?php
                                            if ($resultTendencias->num_rows > 0) {
                                                while ($rowTendencias = $resultTendencias->fetch_assoc()) {
                                                    echo '<li>' . $rowTendencias['producto'] . ' <button class="btn" onclick="agregarAlCarrito(\'' . $rowTendencias['producto'] . '\')">Agregar</button></li>';
                                                }
                                            } else {
                                                echo "No se encontraron productos de tendencias.";
                                            }
                                            ?>
                                        </ul>
                                    </section>
                                    <section>
                                        <h2>Productos Extra</h2>
                                        <!-- Campo de búsqueda para productos extra -->
                                        <input type="text" id="searchExtra" onkeyup="searchExtra()" placeholder="Buscar productos extra...">
                                        <!-- Lista de productos extra (inicialmente oculta) -->
                                        <ul id="extraList" style="display: none;">
                                            <?php
                                            if ($resultExtra->num_rows > 0) {
                                                while ($rowExtra = $resultExtra->fetch_assoc()) {
                                                    echo '<li>' . $rowExtra['embase'] . ' - Capacidad: ' . $rowExtra['capacidad'] . ' ml - Uso: ' . $rowExtra['uso'] . ' - Precio: $' . $rowExtra['precio'] . ' <button class="btn" onclick="agregarAlCarrito(\'' . $rowExtra['embase'] . '\', ' . $rowExtra['precio'] . ', \'' . $rowExtra['capacidad'] . '\', \'' . $rowExtra['uso'] . '\')">Agregar</button></li>';
                                                }
                                            } else {
                                                echo "No se encontraron productos Extra.";
                                            }
                                            ?>
                                        </ul>
                                    </section>
                                    <section>
    <h2>Carrito de Compra</h2>
    <!-- Mostrar productos agregados al carrito -->
    <ul id="carrito">
        <!-- Los elementos del carrito se agregarán aquí dinámicamente -->
    </ul>
    <p>Total: $<span id="total">0</span></p>

    <!-- Campo para ingresar el dinero recibido -->

    <!-- Campo para seleccionar el método de pago -->
<div class="form-group">
    <label for="metodoPago">Método de Pago:</label>
    <select class="form-control" id="metodoPago" onchange="calcularCambio()">
        <option value="Efectivo">Efectivo</option>
        <option value="Tarjeta">Tarjeta de Débito/Crédito</option>
    </select>
</div>

<!-- Campo para ingresar el dinero recibido (solo se muestra si se elige 'Efectivo') -->
<div class="form-group" id="dineroRecibidoField">
    <label for="dineroRecibido">Dinero Recibido:</label>
    <input type="number" class="form-control" id="dineroRecibido" placeholder="Ingrese el monto recibido" oninput="calcularCambio()">
</div>

<!-- Campo para mostrar el cambio -->
<p>Cambio: $<span id="cambio">0</span></p>

<!-- Botón para realizar el pago e imprimir el ticket -->
<button class="btn" onclick="realizarPago()">Pagar e Imprimir Ticket</button>


</section>

                                    <!-- Fin del código del punto de venta -->
                                </div>
                            </div>
                        </div>

<!-- Columna del Ticket de Compra -->
<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Ticket de Compra</h3>
        </div>
        <img id="imagenTicket" src="../tic/t.png" alt="Imagen del ticket" style="display: block; margin: 0 auto; width: 100px; height: auto; margin-top: 10px;">

        <div class="card-body">
            <!-- Contenido del ticket de compra -->
            <pre id="ticketContent"></pre>
                        <!-- Imagen que se agregará al ticket -->
            <!-- Botón para realizar el pago e imprimir el ticket -->
            <!--<button class="btn" onclick="realizarPago()">Pagar</button>-->
            <button class="btn" onclick="imprimirTicket()">Imprimir Ticket</button>
        </div>
    </div>
</div>


                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- Agrega el enlace al archivo JavaScript que maneja las funciones -->
    <script>

let carrito = [];
    let total = 0;

    function agregarAlCarrito(producto, precio, capacidad, uso) {
        if (precio !== undefined) {
            carrito.push({ producto, precio, capacidad, uso });
            total += precio;
        } else {
            carrito.push({ producto });
        }
        actualizarCarritoYTotal();
    }

    function actualizarCarritoYTotal() {
        const carritoList = document.getElementById('carrito');
        const totalElement = document.getElementById('total');
        carritoList.innerHTML = '';
        carrito.forEach(item => {
            const li = document.createElement('li');
            if (item.precio !== undefined) {
                li.textContent = `${item.producto} - Capacidad: ${item.capacidad} ml - Uso: ${item.uso} - Precio: $${item.precio}`;
            } else {
                li.textContent = `${item.producto}`;
            }
            carritoList.appendChild(li);
        });
        totalElement.textContent = total;
    }

    function calcularCambio() {
    const metodoPago = document.getElementById('metodoPago').value;
    const cambioElement = document.getElementById('cambio');

    if (metodoPago === 'Efectivo') {
        const dineroRecibido = parseFloat(document.getElementById('dineroRecibido').value);
        if (isNaN(dineroRecibido)) {
            alert('Por favor, ingrese un monto válido.');
            return;
        }

        const cambio = dineroRecibido - total;
        cambioElement.textContent = cambio.toFixed(2);
    } else {
        // Si se selecciona "Tarjeta de Débito/Crédito", el campo de dinero recibido se oculta y el cambio se establece en 0.
        document.getElementById('dineroRecibidoField').style.display = 'none';
        cambioElement.textContent = '0.00';
    }
}



    function realizarPago() {
        const ticketContent = document.getElementById('ticketContent');
        ticketContent.textContent = '¡Gracias por su preferencia! \n';
        let subtotal = 0;
        carrito.forEach(item => {
            if (item.precio !== undefined) {
                ticketContent.textContent += `Envase: ${item.producto}\n`;
                ticketContent.textContent += `Capacidad: ${item.capacidad} ml\n`;
                ticketContent.textContent += `Tipo: ${item.uso}\n`;
                ticketContent.textContent += `Precio: $${item.precio}\n\n`;
                ticketContent.textContent += `------------------------\n`;
                subtotal += item.precio;
            } else {
                ticketContent.textContent += `Tendencia: ${item.producto}\n`;
            }
        });
        total = subtotal;
        ticketContent.textContent += `Total: $${total}\n\n¡Gracias por su compra!`;

        const ticketSection = document.getElementById('ticket');
        ticketSection.style.display = 'block';
        window.print();
    }

//IMPRIME EL TICKET
function imprimirTicket() {
    const ticketContent = document.getElementById('ticketContent').textContent;
    const imagenTicket = document.getElementById('imagenTicket');
    const maxWidth = 200; // Tamaño máximo en píxeles

    // Aplicar un estilo CSS para ajustar la imagen al ancho máximo
    if (imagenTicket.width > maxWidth) {
        imagenTicket.style.width = maxWidth + 'px';
        imagenTicket.style.height = 'auto'; // Mantener la relación de aspecto
    }

    const printWindow = window.open('', '', 'width=800,height=800');
    printWindow.document.open();
    printWindow.document.write('<html><head><title>Ticket de Compra</title></head><body>');
    printWindow.document.write(imagenTicket.outerHTML); // Agregar la imagen al principio
    printWindow.document.write('<pre>' + ticketContent + '</pre>'); // Luego agregar el contenido del ticket
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
    printWindow.close();
}






        // Función para buscar productos de tendencias
        function searchTendencias() {
            const input = document.getElementById('searchTendencias').value.toLowerCase();
            const tendenciasList = document.getElementById('tendenciasList');

            // Mostrar u ocultar la lista de productos de tendencias según la búsqueda
            if (input === '') {
                tendenciasList.style.display = 'none';
            } else {
                tendenciasList.style.display = 'block';
            }

            // Filtrar y mostrar los elementos coincidentes
            const items = tendenciasList.getElementsByTagName('li');
            for (let i = 0; i < items.length; i++) {
                const itemName = items[i].textContent.toLowerCase();
                if (itemName.includes(input)) {
                    items[i].style.display = 'block';
                } else {
                    items[i].style.display = 'none';
                }
            }
        }

        // Función para buscar productos extra
        function searchExtra() {
            const input = document.getElementById('searchExtra').value.toLowerCase();
            const extraList = document.getElementById('extraList');

            // Mostrar u ocultar la lista de productos extra según la búsqueda
            if (input === '') {
                extraList.style.display = 'none';
            } else {
                extraList.style.display = 'block';
            }

            // Filtrar y mostrar los elementos coincidentes
            const items = extraList.getElementsByTagName('li');
            for (let i = 0; i < items.length; i++) {
                const itemName = items[i].textContent.toLowerCase();
                if (itemName.includes(input)) {
                    items[i].style.display = 'block';
                } else {
                    items[i].style.display = 'none';
                }
            }
        }
    </script>

    <!-- Agrega el enlace a jQuery y a Bootstrap.js si no lo has hecho ya -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Cerrar la conexión a la base de datos
$conn->close();
?>

