<?php
if (!$_SESSION) {
  header("Location: ./");
  die();
} else {
  echo '<input type="hidden" id="usuario" value=' . $_SESSION['id_cliente'] . '>';
}
require_once('head.php');
$today = date('Y-m-d');
?>
<div class="container-fluid mt-5">
  <div class="row justify-content-center g-2 mt-5">
    <h1>Modulo de Inventario</h1>
    <hr>
    <div id="contenedor_botones" class="col-sm-3">
      <div class="card">
        <div class="card-header">
          <b><span class="text-center">Opciones de Movimiento de Inventario</span></b>
        </div>
        <div class="card-body">
          <!-- Hover added -->
          <div class="list-group">
            <button type="button" id="r_inventario" class="list-group-item list-group-item-action">
              Registrar Movimiento
            </button>
            <button type="button" id="v_inventario" class="list-group-item list-group-item-action">
              Ver Movimientos
            </button>
            <button type="button" id="v_inventario_d" class="list-group-item list-group-item-action">
              Ver Movimientos Detallados
            </button>
          </div>

        </div>
        <div class="card-footer text-muted"></div>
      </div>
    </div>
    <div id="contenedor_ver_inventario" class="col-sm-9">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-sm-8 text-center">
              <h2> Movimientos de Inventario Realizados </h2>
            </div>
            <div class="col-sm-4">
              <button type="button" class="btn btn-outline-danger btn-light back">
                <i class="bi bi-backspace"></i><span class="">Volver</span>
              </button>
            </div>
          </div>
        </div>
        <div class="card-body">
          <table id="inventariotable" class="table table-striped" style="width:100%">
            <thead>
              <tr>
                <th scope="col">#ID</th>
                <th scope="col">Responsable</th>
                <th scope="col">Tipo de Operacion</th>
                <th scope="col">Fecha movimiento</th>
                <th scope="col">N# Documento</th>
                <th scope="col">N# Items</th>
                <th scope="col">N# Productos</th>
                <th scope="col">Total Procesado</th>
                <th scope="col">Nombre de Usuario</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
        <div class="card-footer text-muted"></div>
      </div>
    </div>
    <div id="contenedor_ver_inventario_d" class="col-sm-9">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-sm-8 text-center">
              <h2> Movimientos de Inventario Realizados </h2>
            </div>
            <div class="col-sm-4">
              <button type="button" class="btn btn-outline-danger btn-light back">
                <i class="bi bi-backspace"></i><span class="">Volver</span>
              </button>
            </div>
          </div>
        </div>
        <div class="card-body">
          <table id="inventariodtable" class="table table-striped" style="width:100%">
            <thead>
              <tr>
                <th scope="col">#ID</th>
                <th scope="col">Producto</th>
                <th scope="col">Movimiento</th>
                <th scope="col">N# Documento</th>
                <th scope="col">Fecha movimiento</th>
                <th scope="col">Cantidad anterior</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Nueva Cantidad</th>
                <th scope="col">Usuario</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
        <div class="card-footer text-muted"></div>
      </div>
    </div>
    <div id="contenedor_inventario" class="col-sm-9">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-sm text-center">
              <h2>Registro de Movimiento de Inventario</h2>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form id="minventarioform">
            <div class="card-header">
              <div class="row">
                <!--side-right Form header-->
                <div class="col-sm-8">
                  <div class="row justify-content-start align-items-center g-2">
                    <div class="col-4">
                      <div class="form-floating">
                          <select id="movimiento" class="form-select form-select-sm" required>
                          <!--Carga Mediante Ajax-->
                          </select>
                          <label for="movimiento" class="form-label">Tipo de Operacion</label>
                      </div> 
                    </div>
                    <div class="col-sm-3">
                      <label for="documento" class="col-form-label">N# Operacion</label>
                    </div>
                    <div class="col-sm-5">
                      <b><span id="documento" class="fs-6 form-text"></span></b>
                    </div>
                    <div class="col-4">
                      <label for="fecha" class="col-form-label">Fecha de Operacion</label>
                    </div>
                    <div class="col-4">
                      <input type="date" id="fecha" class="form-control" value=<?php echo $today; ?> max=<?php echo $today; ?> required disabled>
                    </div>
                  </div>
                </div>
                <!--side-left Form header-->
                <div class="col-sm-4">
                  <div class="row justify-content-start align-items-center g-2">
                    <label class="col-sm-8"><b>N° de Items</b></label>
                    <div class="col-sm-4">
                      <b><span id="nitems" class="fs-6 form-text"></span></b>
                    </div>
                    <label class="col-sm-8"><b>Total Producto</b></label>
                    <div class="col-sm-4">
                      <b><span id="pcant" class="fs-6 form-text"></span></b>
                    </div>
                    <label class="col-8"><b>Total</b></label>
                    <div class="col-4">
                      <b><span id="total" class="fs-6 form-text"></span></b>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button id="agregarproducto" class="btn btn-light me-md-2" type="button">
                  <i class="bi bi-node-plus"></i>
                </button>
              </div>
              <div class="table-wrapper">
                <table id="rminventariotable" style="width:100%">
                  <thead>
                    <tr>
                      <th>#ID</th>
                      <th>Producto</th>
                      <th>Costo</th>
                      <th>Cant.</th>
                      <th>Total Costo</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody id="cuerpoinventario">

                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer text-muted">
              <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button id="clean" class="btn btn-outline-danger" type="button"><i class="bi bi-x-octagon"></i>Cancelar</button>
                <button class="btn btn-outline-primary" type="submit"><i class="bi bi-hdd"></i>Registrar</button>
              </div>
            </div>
          </form>
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

<script src="app/inventario/inventario.js"></script>
<?php
require_once('foot.php')
?>