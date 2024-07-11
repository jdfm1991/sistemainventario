<?php
require_once("../../config/abrir_sesion.php");
require_once("../../config/conexion.php");
require_once("../../config/sesion_activa.php");
require_once('../head.php');
require_once('../menu.php');
?>
<div class="container mt-5">
  <div class="row justify-content-center g-2 mt-5">
    <h1>Modulo de Producto</h1>
    <hr>
    <div id="contenedor_fomulario">
      <div class="card">
        <div class="card-header">
          <h3> Formulario de Registro </h3>
        </div>
        <div class="card-body">
          <form id="formulariodeproducto">
            <input type="hidden" id="idproducto">
            <div class="row">
              <div class="row mb-3">
                <div class="col-9">
                  <label for="descipcion"> Descripcion </label>
                  <input type="text" class="form-control" id="producto" required>
                </div>
                <div class="col-3">
                  <label for="excento" class="form-check-label"> Excento </label>
                  <input type="checkbox" class="form-check-input" id="excento">
                </div>
              </div>
              <div class="col">
                <div class="form-floating">
                  <select id="categoria" class="form-control" required>
                    <!--Carga Mediante Ajax-->
                  </select>
                  <label for="categoria" class="form-label">Categoria</label>
                </div>
              </div>
              <div class="col mb-3">
                <div class="form-floating">
                  <select id="familia" class="form-control" required>
                    <!--Carga Mediante Ajax-->
                  </select>
                  <label for="familia" class="form-label">Familia</label>
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col">
                <div class="form-floating">
                  <select id="ubicacion" class="form-control" required>
                    <!--Carga Mediante Ajax-->
                  </select>
                  <label for="ubicacion" class="form-label">Ubicacion</label>
                </div>
              </div>
              <div class="col">
                <div class="form-floating">
                  <select id="unidad" class="form-control" required>
                    <!--Carga Mediante Ajax-->
                  </select>
                  <label for="unidad" class="form-label">Unidad</label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="mb-3">
                  <label for="costo_unidad" class="form-label">Costo unidad</label>
                  <input type="text" class="form-control" id="costo_unidad" name="costo_unidad" required>
                </div>
              </div>
              <div class="col">
                <div class="mb-3">
                  <label for="cantidad" class="form-label">Porcentaje Venta</label>
                  <input type="text" class="form-control" id="cantidad" name="cantidad" required>
                </div>
              </div>
              <div class="col">
                <div class="mb-3">
                  <label for="valor_inventario" class="form-label">Precio Venta</label>
                  <input type="text" class="form-control" id="valor_inventario" name="cantidad" required>
                </div>
              </div>
            </div>
            <div id="messege" class="text-center alert" role="alert">
              <p id="error" class="mb-0"></p>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
            <button id="cancelar" type="button" class="btn btn-danger">Cancelar</button>
          </form>
        </div>
        <div class="card-footer text-muted"></div>
      </div>
    </div>
    <div id="contenedor_tabla">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-sm-8 text-center">
              <h2> Listado de productos </h2>
            </div>
            <div class="col-sm-4">
              <button id="btnproducto" type="button" class="btn btn-outline-primary btn-light">
                <i class="bi bi-person-fill-add"></i><span class="">Nuevo Producto</span>
              </button>
            </div>
          </div>
        </div>
        <div class="card-body">
          <table id="productotable" class="table table-striped" style="width:100%">
            <thead>
              <tr>
                <th scope="col">Descripcion</th>
                <th scope="col">Categoria</th>
                <th scope="col">Familia</th>
                <th scope="col">Ubicacion</th>
                <th scope="col">Unidad</th>
                <!--<th scope="col">Cantidad</th>
                <th scope="col">Costo de unidad</th>
                <th scope="col">Valor de inventario</th>-->
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
  </div>
</div>
<script src="producto.js"></script>
<?php
require_once('../../config/modals.php');
require_once('../foot.php');
?>