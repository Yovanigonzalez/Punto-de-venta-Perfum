<?php
session_start();
// Resto del código de login.php

if (empty($_SERVER['HTTP_REFERER'])) {
    // El acceso se está realizando directamente desde la URL
    header('Location: error.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Agregar enlaces a los archivos CSS de AdminLTE y Bootstrap -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.5.2/css/bootstrap.min.css">
  <!-- Agregar enlace a los archivos CSS de Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <link rel="shortcut icon" type="image/x-icon" href="../ico/log.png">

</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Barra de navegación superior -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Agregar contenido de la barra de navegación aquí -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button">
            <i class="fas fa-bars"></i>
          </a>
        </li>
      </ul>

      <!-- Botones de la barra de navegación a la derecha -->
      <ul class="navbar-nav ml-auto">


        <style>
    .nav-icon {
        margin-right: 20px; /* Puedes ajustar el valor según tus preferencias */
    }
</style>

<?php
if (isset($_SESSION['nombre_usuario'])) {
    echo '<div class="nav-icon position-relative text-dark"><i class="fa fa-user-circle"></i> Hola! Bienvenido, ' . $_SESSION['nombre_usuario'] . '</div>';
    echo '<a class="nav-icon position-relative text-decoration-none" href="logout.php">';
    echo '<i class="fa fa-fw fa-sign-out-alt text-dark"></i> Cerrar Sesión</a>';
} else {
    echo '<a class="nav-icon position-relative text-decoration-none" href="login.php">';
    echo '<i class="fa fa-fw fa-user text-dark"></i> Iniciar Sesión</a>';
}
?>     
      </ul>



    </nav>

    <!-- Barra lateral -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <a href="inicio.php" class="brand-link">
      <span class="brand-text font-weight-light">Sucursal 1 Tecamachalco</span>
    <div class="text-center mb-4">
                            <img src="../log/log.png" class="img-fluid rounded-circle" alt="Login Image" width="70px">
                        </div>
      </a>
      <div class="sidebar">
        <div class="">
          <!-- Agregar contenido del panel de usuario aquí -->
        </div>
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">







            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cash-register"></i>
                <p>
                  Corte de Caja
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="logout.php" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                  Cerrar Sesión
                </p>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </aside>


  
  <!-- Agregar enlaces a los archivos JavaScript de jQuery y Bootstrap -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.5.2/js/bootstrap.bundle.min.js"></script>
  <!-- Agregar enlace al archivo JavaScript de AdminLTE -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
</body>
</html>
