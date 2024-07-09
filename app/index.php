<?php
require_once("../config/abrir_sesion.php");
require_once("../config/conexion.php");
require_once("../config/sesion_activa.php");
require_once('head.php');
require_once('menu.php');
?>
<div class="container mt-5">
  <div class="container mt-5 my-5">
    <hr>
    <h1>Bienvenido</h1>
    <hr>
    <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
      <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
        <h1 class="display-4 fw-bold lh-1 text-body-emphasis">Border hero with cropped image and shadows</h1>
        <p class="lead">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
      </div>
      <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg">
          <img class="rounded-lg-3" src="bootstrap-docs.png" alt="" width="720">
      </div>
    </div>
  </div>
  <hr>
</div>
<?php
require_once('../config/modals.php');
require_once('foot.php')
?>