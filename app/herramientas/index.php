<?php
require_once("../../config/abrir_sesion.php");
require_once("../../config/conexion.php");
require_once("../../config/sesion_activa.php");
require_once('../head.php');
require_once('../menu.php');
$today = date('Y-m-d');
?>
<div class="container-md mt-5">
  <div class="row justify-content-center g-2 mt-5">
    <h1>Modulo de Ventas</h1>
    <hr>
    <div id="contenedor_botones" class="col-sm-3">
      <div class="card">
        <div class="card-header">
          <b><span>Opciones de Super Usuario</span></b>
        </div>
        <div class="card-body">
          <!-- Hover added -->
          <div class="list-group">
            <button type="button" id="departamento" class="list-group-item list-group-item-action">
              Crear Departamento
            </button>
            <button type="button" id="modulo" class="list-group-item list-group-item-action">
              Crear Modulo
            </button>
          </div>
        </div>
        <div class="card-footer text-muted"></div>
      </div>
    </div>
    <div id="contenedor_departamento" class="col-sm-9">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-sm-8 text-center">
              <h2> Lista de Departamento </h2>
            </div>
            <div class="col-sm-4">
              <button id="btndepart" type="button" class="btn btn-outline-success me-2">
                <i class="bi bi-arrows-fullscreen"></i>Crear Nuevo Departamento
              </button>
            </div>
          </div>
        </div>
        <div class="card-body">
          <table id="departable" class="table table-striped" style="width:100%">
            <thead>
              <tr>
                <th scope="col"># ID</th>
                <th scope="col">Departamento</th>
                <th scope="col">Descripcion</th>
              </tr>
            </thead>
            <tbody>
              <!--Carga Mediante Ajax-->
            </tbody>
          </table>
        </div>
        <div class="card-footer text-muted"></div>
      </div>
    </div>
    <div id="contenedor_modulo" class="col-sm-9">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-sm-8 text-center">
              <h2> Lista de Modulos </h2>
            </div>
            <div class="col-sm-4">
              <button id="btnmodulo" type="button" class="btn btn-outline-success me-2">
                <i class="bi bi-columns-gap"></i>Crear Nuevo Modulo
              </button>
            </div>
          </div>
        </div>
        <div class="card-body">
          <table id="modulotable" class="table table-striped" style="width:100%">
            <thead>
              <tr>
                <th scope="col"># ID</th>
                <th scope="col">Modulo</th>
                <th scope="col">Departamento</th>
                <th scope="col">Descripcion</th>
              </tr>
            </thead>
            <tbody>
              <!--Carga Mediante Ajax-->
            </tbody>
          </table>
        </div>
        <div class="card-footer text-muted"></div>
      </div>
    </div>
    <div id="contenedor_default" class="col-sm-9">
      <div class="card">

      </div>
    </div>
  </div>
</div>
<?php
require_once('../../config/modals.php');
require_once('../foot.php');
?>