<?php
session_name('intentario');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
  <title>Sistema de control de inventario de un restaurant</title>
  <link rel="stylesheet" href="assets/css/style.css" rel="stylesheet">
  <!--File Css bootstrap-->
  <link href="assets/css/bootstrap/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <!--File Jquery-->
  <script src="assets/js/jquery-3.7.0.min.js"></script>
  <!-- File Datatables -->
  <link href="assets/js/dataTables/datatables.min.css" rel="stylesheet">
  <script src="assets/js/dataTables/datatables.min.js"></script>
  <script src="assets/js/dataTables/dataTables.responsive.min.js"></script>

  <!-- File sweetalert2 -->
  <script src="assets/js/sweetalert2/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="assets/js/sweetalert2/sweetalert2.min.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid bg-success bg-gradient">
      <a class="navbar-brand" href="#">Sistema de inventario</a>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./">Inicio</a>
          </li>
          <?php
          if ($_SESSION) {
            if ($_SESSION['rol'] == 1) { ?>
              <li class="nav-item">
                <a class="nav-link" href="producto.php">Productos</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="compras.php">Compras</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="ventas.php">Ventas</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="inventario.php">Inventario</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="usuario.php">Usuarios</a>
              </li>

              <button id="btnlogout" type="button" class="btn btn-fill">
                <i class="bi bi-person-fill-slash"></i>
              </button>';
            <?php }
            if ($_SESSION['rol'] == 2) { ?>
              <li class="nav-item">
                <a class="nav-link" href="producto.php">Productos</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="inventario.php">Inventario</a>
              </li>
              <button id="btnlogout" type="button" class="btn btn-fill">
                <i class="bi bi-person-fill-slash"></i>
              </button>';
            <?php }
          } else { ?>
            <button id="btnlogin" type="button" class="btn btn-fill">
              <i class="bi bi-person-fill"></i>
            </button>
          <?php
          } ?>
        </ul>
      </div>
    </div>
  </nav>