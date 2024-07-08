<div class="container">
    <header class="navbar fixed-top  navbar-expand-lg bg-black bg-gradient rounded px-5">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample11" aria-controls="navbarsExample11" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse d-lg-flex" id="navbarsExample11">
          <div class="col-md-2 mb-2 mb-md-0">
            <a href="./" class="d-inline-flex link-body-emphasis text-decoration-none">
              <svg class="bi" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
            </a>
          </div>
          <ul id="opcionusuario" class="nav nav-pills navbar-nav col-md-8 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="./" id="home" class="nav-link px-2">Home</a></li>
            <li><a href="compras.php" class="nav-link px-2">Compras</a></li>
            <li><a href="ventas.php" class="nav-link px-2">Ventas</a></li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle px-2" href="#" data-bs-toggle="dropdown" aria-expanded="false">Gestion Administrativa</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="producto.php">Productos</a></li>
                <li><a class="dropdown-item" href="inventario.php">Inventario</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle px-2" href="#" data-bs-toggle="dropdown" aria-expanded="false">Gestion de Sistema</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="usuario.php">Usuarios</a></li>
              </ul>
            </li>
          </ul>
          <div class="col-md-2 text-end">
            <?php 
            if ($_SESSION) { ?>
              <button id="btnlogout" type="button" class="btn btn-outline-danger me-2">
                <i class="bi bi-person-fill-slash"></i>Log Out
              </button>
            <?php
            }else{ ?>
              <button id="btnlogin" type="button" class="btn btn-outline-primary me-2">
                <i class="bi bi-person-fill"></i>Login
              </button>
            <?php
            } ?>
          </div>
        </div>
      </div>
    </header>
  </div>