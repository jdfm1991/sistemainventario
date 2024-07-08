<?php
if (!$_SESSION) {
  header("Location: ./");
  die();
} else {
  echo '<input type="hidden" id="usuario" value=' . $_SESSION['id_cliente'] . '>';
}
require_once('head.php');
?>
<div class="container mt-5">
  <div class="row justify-content-center g-2 mt-3">
    <h1>Modulo de Usuario</h1>
    <hr>
    <div id="contenedor_fomulario" class="col">
      <div class="card">
        <div class="card-header">
          <h3> Formulario de Registro </h3>
        </div>
        <div class="card-body">
          <form id="formulariodeusuario">
            <input type="hidden" id="idusuario">
            <div class="row mb-3">
              <div class="col">
                <label for="nom_usuario"> Nombre de Usuario</label>
                <input type="text" class="form-control" id="nom_usuario" required>
              </div>
              <div class="col">
                <label for="ape_usuario"> Apellido de Usuario</label>
                <input type="text" class="form-control" id="ape_usuario" required>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col">
                <label for="correo"> Correo</label>
                <input type="email" class="form-control" id="correo" required>
              </div>
              <div class="col">
                <label for="contrasenna"> Contraseña </label>
                <input type="password" class="form-control" id="contrasenna" required>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col">
                <label for="telefono"> Telefono</label>
                <input type="tel" class="form-control" id="telefono" required>
              </div>
              <div class="col">
                <div class="form-floating">
                  <select id="rol" class="form-control" required>
                    <!--Carga Mediante Ajax-->
                  </select>
                  <label for="rol" class="form-label">Rol</label>
                </div>
              </div>
            </div>
            <div class="row mb-3">

              <div class="col-6">
                <div class="form-floating">
                  <select id="estatus" class="form-control" required>
                    <!--Carga Mediante Ajax-->
                  </select>
                  <label for="estatus" class="form-label">Estatus</label>
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
    <div id="contenedor_tabla" class="col">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-sm-8 text-center">
              <h2> Listado de Ususario </h2>
            </div>
            <div class="col-sm-4">
              <!--<button id="btnproducto" type="button" class="btn btn-outline-primary btn-light">
                                <i class="bi bi-person-fill-add"></i><span class="">Nuevo Ususario</span>
                            </button>-->
            </div>
          </div>
        </div>
        <div class="card-body">
          <table id="usuariotabla" class="table table-striped" style="width:100%">
            <thead>
              <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Correo</th>
                <th scope="col">Rol</th>
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
<script src="app/usuario/usuario.js"></script>
<?php
require_once('foot.php')
?>