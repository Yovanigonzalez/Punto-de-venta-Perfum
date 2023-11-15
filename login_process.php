<?php
session_start(); // Iniciar la sesión

// Continúa con el resto del código para la autenticación de usuario
// Conexión a la base de datos (reemplaza con tus propios valores)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "venta";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener los datos del formulario
$emailPhone = $_POST['email_phone'];
$password = $_POST['password'];

// Sanitizar los valores de entrada para prevenir la inyección SQL
$emailPhone = mysqli_real_escape_string($conn, $emailPhone);
$password = mysqli_real_escape_string($conn, $password);

// Consulta para verificar las credenciales
$query = "SELECT * FROM usuarios WHERE email='$emailPhone' OR phone='$emailPhone'";
$result = $conn->query($query);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        // Inicio de sesión exitoso
        $_SESSION['nombre'] = $row['nombre']; // Almacenar el nombre en una variable de sesión

        // Establecer la zona horaria a Tecamachalco, Puebla (GMT-6)
        date_default_timezone_set('America/Mexico_City');

        // Obtener la fecha actual
        $fechaActual = date('Y-m-d'); // Obtener la fecha actual en formato 'YYYY-MM-DD'

        // Obtener el nombre de usuario de la sesión
        $nombreUsuario = $_SESSION['nombre'];

        // Consulta SQL para verificar si ya existe una sesión para el usuario en la fecha actual
        $existQuery = "SELECT * FROM sesiones WHERE nombre_usuario='$nombreUsuario' AND DATE(fecha_hora_inicio) = '$fechaActual'";
        $resultExist = $conn->query($existQuery);

        if ($resultExist->num_rows == 0) {
            // No existe una sesión para el usuario en la fecha actual, entonces insertar una nueva sesión
            // Obtener la fecha y hora actual
            $fechaHoraInicio = date('Y-m-d H:i:s'); // Obtener la fecha y hora actual en formato 'YYYY-MM-DD HH:MI:SS'

            // Consulta SQL para insertar los datos en la tabla sesiones
            $insertQuery = "INSERT INTO sesiones (nombre_usuario, fecha_hora_inicio) VALUES ('$nombreUsuario', '$fechaHoraInicio')";

            if ($conn->query($insertQuery) === TRUE) {
                // Datos de sesión guardados en la base de datos
            } else {
                // Error al guardar los datos de sesión en la base de datos
                echo "Error al guardar los datos de sesión: " . $conn->error;
            }
        }

        // Redirigir según el rol
        if ($row['rol'] == 'empleado1') {
            $_SESSION['nombre_usuario'] = $row['nombre']; // Almacenar el nombre en la sesión
            header("Location: cliente/shop.php");
        } elseif ($row['rol'] == 'admin') {
            $_SESSION['nombre_usuario'] = $row['nombre']; // Almacenar el nombre en la sesión
            header("Location: Admin_Venta/inicio.php");
        } elseif ($row['rol'] == 'empleado') {
            $_SESSION['nombre_usuario'] = $row['nombre']; // Almacenar el nombre en la sesión
            header("Location: sucursal1/venta.php");
        }
        // Agregar más condiciones de roles según sea necesario

        exit(); // Salir del script
    } else {
        $_SESSION['login_error'] = "Contraseña incorrecta";
        header("Location: login.php"); // Redirigir con mensaje de error
        exit(); // Salir del script
    }
} else {
    $_SESSION['login_error'] = "Usuario no encontrado";
    header("Location: login.php"); // Redirigir con mensaje de error
    exit(); // Salir del script
}

$conn->close(); // Cerrar la conexión a la base de datos
?>