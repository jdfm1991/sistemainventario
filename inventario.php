<?php
require_once('head.php');
if (!$_SESSION) {
    header("Location: ./");
    die();
  }else {
    echo '<input type="hidden" id="usuario" value='.$_SESSION['id_cliente'].'>';
  }
?>
<div class="container-md mt-5">
    <div class="row justify-content-center g-2">
        <div id="contenedor_fomulario" class="">
            <div class="card">
                <div class="card-header">
                    <h3> </h3>
                </div>
                <div class="card-body">
                    <form id="formularioinventario">
                        <input type="text" id="idproducto" class="form-control" disabled>
                        <div class="mb-3">
                            <label for="descipcion"> Descripcion </label>
                            <input type="text" list="listadeproducto" class="form-control" id="producto" required>
                            <datalist id="listadeproducto">
                                <!--Carga Mediante Ajax-->
                            </datalist>
                        </div>
                        <div class="row mb-3">
                            <div class="col mt-2">
                                <div class="form-floating">
                                    <select id="movimiento" class="form-control" required>
                                    <!--Carga Mediante Ajax-->
                                    </select>
                                    <label for="movimiento" class="form-label">Movimiento</label>
                                </div> 
                            </div>
                            <div class="col">
                                <label for="cantidad" class="form-label">Cantidad</label>
                                <input type="text" class="form-control" id="cantidad" name="cantidad" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="comentario" class="form-label">Comentario</label>
                                <textarea type="text" class="form-control" id="comentario" name="comentario" required></textarea>
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
        <div id="contenedor_tabla" class="">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-8 text-center">
                            <h2> Movimiento de inventario </h2>
                        </div>
                        <div class="col-sm-4">
                            <button id="btnproducto" type="button" class="btn btn-outline-primary btn-light">
                                <i class="bi bi-person-fill-add"></i><span class="">Crear Movimiento</span>
                            </button>
                        </div>
                    </div> 
                </div>
                <div class="card-body">
                    <table  id="inventariotable" class="table table-striped" style="width:100%">
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
    </div>
</div>
<script src="assets/app/inventario/inventario.js"></script>
<?php
require_once('foot.php')
?>