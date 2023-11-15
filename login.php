<?php
session_start(); // Iniciar la sesión

// Verificar si hay un mensaje de error almacenado en la sesión
if(isset($_SESSION['login_error']) && !empty($_SESSION['login_error'])) {
    $errorMessage = $_SESSION['login_error'];
    // Limpiar el mensaje de error de la sesión para que no se muestre en futuras cargas de la página
    unset($_SESSION['login_error']);
} else {
    $errorMessage = ""; // Si no hay mensaje de error, dejarlo vacío
}

// Continúa con el resto del código HTML
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Punto de Venta</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Logo -->
    <link rel="shortcut icon" type="image/x-icon" href="ico/log.png">

    <!-- Load Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
    .text-custom {
        color: #F85BFF;
    }
</style>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .section-container {
            display: flex;
        }

        .section {
            flex: 1;
            padding: 20px;
            border-radius: 10px;
        }

        /* Estilo personalizado para el botón */
        .btn-custom {
            background-color: #F85BFF;
            color: #fff;
        }
    </style>
</head>

<body>
    <!-- Layout and SVG -->
    <div style="width: 100%; height: 100%;">
        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 1440 35" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M0 7.17639L60 12.0163C120 16.8562 240 26.3691 360 31.209C480 36.0489 600 36.0489 720 32.3772C840 28.8725 960 21.6961 1080 20.3609C1200 19.1927 1320 24.0326 1380 26.3691L1440 28.8725V0H1380C1320 0 1200 0 1080 0C960 0 840 0 720 0C600 0 480 0 360 0C240 0 120 0 60 0H0V7.17639Z" fill="#F85BFF"/>
        </svg>
    </div>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="section-container">
                            <section class="section">
                                <h2 align="center" class="mb-4">Iniciar sesión</h2>
                                <div class="text-center mt-4">
                                    <img src="tic/p.png" class="img-fluid" alt="Imagen" width="150px">
                                </div>
                                <br>
                                <!-- Mostrar el mensaje de error aquí -->
                                <?php if (!empty($errorMessage)) { ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?php echo $errorMessage; ?>
                                    </div>
                                <?php } ?>
                                <form action="login_process.php" method="POST">
                                    <div class="form-group">
                                        <label for="email_phone">
                                            <i class="fas fa-user"></i> Usuario:
                                        </label>
                                        <input type="text" class="form-control" id="email_phone" name="email_phone" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">
                                            <i class="fas fa-lock"></i> Contraseña:
                                        </label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                    <button type="submit" class="btn btn-custom btn-block">
                                        <i class="fas fa-sign-in-alt"></i> Iniciar sesión
                                    </button>
                                </form>
                            </section>

                            <section class="section">
                                <h2 align="center" class="mb-4">Recordatorio</h2>
                                <div class="text-center mt-4">
                                    <i class="fas fa-info-circle fa-3x text-custom"></i> <!-- Icono de información con color personalizado -->
                                </div>
                                <p class="text-center mt-4">
                                    <span class="icon">
                                        <i class="fas fa-clock"></i> <!-- Icono de reloj -->
                                    </span>
                                    ¡Hola! Bienvenido. <br> Por favor, recuerda que para obtener tu bono de puntualidad, debes iniciar sesión 5 minutos antes. <br>
                                    <span class="icon">
                                        <i class="fas fa-exclamation-circle"></i> <!-- Icono de exclamación -->
                                    </span>
                                    ¡Evita perder tu bono de puntualidad!
                                </p>
                                <div class="text-center mt-4">
                                    <img src="tic/p.png" class="img-fluid" alt="Imagen" width="189.5px">
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Load Bootstrap JS (optional) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
