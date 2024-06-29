<?php
require_once('head.php');
if (!$_SESSION) {
  header("Location: ./");
  die();
} else {
  echo '<input type="hidden" id="usuario" value=' . $_SESSION['id_cliente'] . '>';
}
$today = date('Y-m-d');
?>
<div class="container-md mt-5">
  <div class="row justify-content-center g-2">
    <div id="contenedor_botones" class="col-sm-3">
      <div class="card">
        <div class="card-header">
          <b><span>Opciones de Compras</span></b>
        </div>
        <div class="card-body">
          <!-- Hover added -->
          <div class="list-group">
            <button type="button" id="rcompra" class="list-group-item list-group-item-action">
              Registrar Compras
            </button>
            <button type="button" id="vcompra" class="list-group-item list-group-item-action">
              Ver Comprar
            </button>
          </div>

        </div>
        <div class="card-footer text-muted"></div>
      </div>
    </div>
    <div id="contenedor_ver_compra" class="col-sm-9">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-sm-8 text-center">
              <h2> Lista de compras </h2>
            </div>
          </div>
        </div>
        <div class="card-body">
          <table id="comprastable" class="table table-striped" style="width:100%">
            <thead>
              <tr>
                <th scope="col">Nombre de Producto</th>
                <th scope="col">Tipo de Movimiento</th>
                <th scope="col">Fecha movimiento</th>
                <th scope="col">Comentario</th>
                <th scope="col">Usuario</th>
                <th scope="col">Cantidad anterior</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Nueva Cantidad</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
        <div class="card-footer text-muted"></div>
      </div>
    </div>
    <div id="contenedor_compra" class="col-sm-9">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-sm-8 text-center">
              <h2> Registro de compras </h2>
            </div>
          </div>
        </div>
        <div class="card-body">

          <div id="content1">
            <form id="comprasform">
              <div class="card-header">
                <div class="row">
                  <!--
                    <div class="col-lg-12">
                      <div class="row justify-content-md-end">
                          <div class="col-lg-3">
                              <b><span id="datecreate"><?php date('d-m-Y H:i:s') ?></span></b>
                          </div>
                      </div>
                    </div>
                    -->
                  <!--side-right Form header-->
                  <div class="col-sm-8">
                    <div class="row justify-content-start align-items-center g-2">
                      <div class="col-sm-3">
                        <label for="sujeto" class="col-form-label">Proveedor</label>
                      </div>
                      <div class="col-sm-4">
                        <input type="text" id="sujeto" class="form-control" placeholder="R.I.F ó D.N.I" required>
                      </div>
                      <div class="col-sm-1">
                        <div class="d-grid gap-2 d-md-block btn-group-sm">
                          <button id="btnsujeto" class="btn btn-primary" type="button"><i class="bi bi-search"></i></button>
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <b><span id="nombresujeto" class="fs-6 form-text mx-5"></span></b>
                      </div>
                      <div class="col-sm-3">
                        <label for="documento" class="col-form-label">N# Factura</label>
                      </div>
                      <div class="col-sm-5">
                        <input type="text" id="documento" class="form-control" placeholder="N# Factura" required>
                      </div>
                      <div class="col-3">
                        <div class="form-floating">
                            <select id="impuesto" class="form-select form-select-sm" required>
                            <!--Carga Mediante Ajax-->
                            </select>
                            <label for="impuesto" class="form-label">Alicuota</label>
                        </div> 
                      </div>
                      <div class="col-4">
                        <label for="fecha" class="col-form-label">Fecha de Compra</label>
                      </div>
                      <div class="col-4">
                        <input type="date" id="fecha" class="form-control" value=<?php echo $today; ?> max=<?php echo $today; ?> required>
                      </div>
                      <div class="col-4">
                        <div class="form-floating">
                          <input type="text" id="excento" class="form-control form-control-sm" required>
                            <label for="excento" class="form-label">Monto Excento</label>
                        </div> 
                      </div>
                    </div>

                  </div>
                  <!--side-left Form header-->
                  <div class="col-sm-4">
                    <div class="row justify-content-start align-items-center g-2">
                      <label class="col-sm-8"><b>Total Producto</b></label>
                      <div class="col-sm-4">
                        <b><span id="pcant" class="fs-6 form-text"></span></b>
                      </div>
                      <label class="col-6"><b>Sub-Total</b></label>
                      <div class="col-6">
                        <b><span id="subtotal" class="fs-6 form-text"></span></b>
                      </div>
                      <label class="col-6"><b>Impuestos</b></label>
                      <div class="col-6">
                        <b><span id="iva" class="fs-6 form-text"></span></b>
                      </div>
                      <label class="col-6"><b>Total</b></label>
                      <div class="col-6">
                        <input type="hidden" id="total">
                        <b><span id="tota" class="fs-6 form-text"></span></b>
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
                  <table id="rcomprastable" style="width:100%">
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
                  <button id="save" class="btn btn-outline-primary" type="submit"><i class="bi bi-hdd"></i>Registrar</button>
                  <button id="clean" class="btn btn-outline-danger" type="button"><i class="bi bi-trash2"></i>Cancelar</button>
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
<script src="assets/app/compras/compras.js"></script>
<?php
require_once('foot.php')
?>