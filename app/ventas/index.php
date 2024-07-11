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
          <b><span>Opciones de Ventas</span></b>
        </div>
        <div class="card-body">
          <!-- Hover added -->
          <div class="list-group">
            <button type="button" id="rventa" class="list-group-item list-group-item-action">
              Registrar Ventas
            </button>
            <button type="button" id="vventa" class="list-group-item list-group-item-action">
              Ver Ventas
            </button>
          </div>
        </div>
        <div class="card-footer text-muted"></div>
      </div>
    </div>
    <div id="contenedor_ver_venta" class="col-sm-9">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-sm-8 text-center">
              <h2> Lista de Ventas </h2>
            </div>
          </div>
        </div>
        <div class="card-body">
          <table id="ventasstable" class="table table-striped" style="width:100%">
            <thead>
              <tr>
                <th scope="col">Nombre de Cliente</th>
                <th scope="col">Fecha de venta</th>
                <th scope="col">Nuemmero de Dcumento</th>
                <th scope="col">Items de Factura</th>
                <th scope="col">Productos Facturados</th>
                <th scope="col">Total Facturado</th>
                <th scope="col">Nombre de Usuario</th>
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
    <div id="contenedor_venta" class="col-sm-9">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-sm-8 text-center">
              <h2> Registro de Ventas </h2>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div id="content1">
            <form id="ventasform">
              <div class="card-header">
                <div class="row">
                  <!--side-right Form header-->
                  <div class="col-sm-8">
                    <div class="row justify-content-start align-items-center g-2">
                      <input type="hidden" id="idsujeto">
                      <div class="col-sm-3">
                        <label for="sujeto" class="col-form-label">Cliente</label>
                      </div>
                      <div class="col-sm-4">
                        <input type="text" id="sujeto" class="form-control" placeholder="R.I.F ó D.N.I" required disabled>
                      </div>
                      <div class="col-sm-1">
                        <div class="d-grid gap-2 d-md-block btn-group-sm">
                          <button id="btnsujeto" class="btn btn-primary" type="button"><i class="bi bi-search"></i></button>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-floating">
                            <select id="impuesto" class="form-select form-select-sm" required disabled>
                            <!--Carga Mediante Ajax-->
                            </select>
                            <label for="impuesto" class="form-label">Alicuota</label>
                        </div> 
                      </div>
                      <div class="col-sm-12">
                        <b><span id="nombresujeto" class="fs-6 form-text mx-5"></span></b>
                      </div>
                      <div class="col-sm-3">
                        <label for="documento" class="col-form-label">N# Factura</label>
                      </div>
                      <div class="col-sm-5">
                        <b><span id="documento" class="fs-6 form-text"></span></b>
                      </div>
                      <div class="col-4">
                        <div class="form-floating">
                          <input type="text" id="excento" name="excento" class="form-control form-control-sm" disabled>
                          <label for="excento" class="form-label">Monto Excento</label>
                        </div> 
                      </div>
                      <div class="col-4">
                        <label for="fecha" class="col-form-label">Fecha de Venta</label>
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
                      <label class="col-8"><b>Sub-Total</b></label>
                      <div class="col-4">
                        <b><span id="subtotal" class="fs-6 form-text"></span></b>
                      </div>
                      <label class="col-8"><b>Base Imponible</b></label>
                      <div class="col-4">
                        <b><span id="base" class="fs-6 form-text"></span></b>
                      </div>
                      <label class="col-8"><b>Impuestos</b></label>
                      <div class="col-4">
                        <b><span id="iva" class="fs-6 form-text"></span></b>
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
                  <table id="rventastable" style="width:100%">
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
                    <tbody id="cuerpo">

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
<script src="ventas.js"></script>
<?php
require_once('../../config/modals.php');
require_once('../foot.php');
?>