        // Arreglo para almacenar los elementos seleccionados en el carrito
        var carritoItems = [];

        $(document).ready(function () {
            $(document).on('click', '.agregar-btn', function () {
                // Obtener el ID del elemento
                var id = $(this).closest(".result-item").data("id");

                // Abrir el modal
                $("#cantidadModal").modal("show");

                // Configurar el botón "Confirmar Venta" para abrir el modal de selección de tendencia
                $("#confirmarVenta").off("click").on("click", function () {
                    var cantidad = $("#cantidadVender").val();

                    // Agregar el elemento al carrito
                    carritoItems.push({ id: id, cantidad: cantidad });

                    // Actualizar la lista del carrito
                    actualizarCarrito();

                    // Cerrar el modal de cantidad
                    $("#cantidadModal").modal("hide");

                    // Abrir el modal de selección de tendencia
                    $("#tendenciaModal").modal("show");
                });
            });

            // Configurar el botón "Seleccionar Tendencia" en el segundo modal
            $("#seleccionarTendencia").click(function () {
                // Realizar la acción deseada con la tendencia seleccionada
                // Por ejemplo, puedes guardar la tendencia en una variable y utilizarla

                // Cerrar el modal de selección de tendencia
                $("#tendenciaModal").modal("hide");
            });
        });

        function actualizarCarrito() {
            var carritoLista = $("#carrito-lista");
            carritoLista.empty();

            carritoItems.forEach(function (item) {
                carritoLista.append("<li>Elemento ID: " + item.id + " - Cantidad: " + item.cantidad + "</li>");
            });
        }

        // Función para realizar la búsqueda en tiempo real del envase
        function realizarBusqueda() {
            var consulta = document.getElementById("busqueda").value;

            // Verificar que la consulta no esté vacía
            if (consulta !== "") {
                // Realizar una solicitud AJAX para buscar en la base de datos
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState === 4 && this.status === 200) {
                        // Mostrar los resultados en un elemento con el id "resultados"
                        document.getElementById("resultados").innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", "resultados.php?query=" + consulta, true);
                xhttp.send();
            } else {
                // Si la consulta está vacía, borrar los resultados
                document.getElementById("resultados").innerHTML = "";
            }
        }

        // Función para realizar la búsqueda en tiempo real de la tendencia
        function realizarBusquedaTendencia() {
            var consulta = document.getElementById("busquedaTendencia").value;

            // Verificar que la consulta no esté vacía
            if (consulta !== "") {
                // Realizar una solicitud AJAX para buscar en la base de datos
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState === 4 && this.status === 200) {
                        // Mostrar los resultados en un elemento con el id "resultadosTendencia"
                        document.getElementById("resultadosTendencia").innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", "resultados_tendencia.php?query=" + consulta, true);
                xhttp.send();
            } else {
                // Si la consulta está vacía, borrar los resultados
                document.getElementById("resultadosTendencia").innerHTML = "";
            }
        }
