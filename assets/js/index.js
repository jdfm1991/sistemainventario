$(document).ready(function () {
  let rol = $('#rol').val();
  let usuario = $('#usuario').val();
  let link = ''
  //************************************************/
  //*******Se Oculta los elementos iniciales********/
  //*****************de modulo**********************/
  $('#contenedor_departamento').hide();
  $('#contenedor_modulo').hide();
  if (rol && usuario) {
    link = $('#link').val();
    $('a').removeClass('active');
    $('#opcionusuario').append('<li><a id="gestionsu" href="'+link+'herramientas" class="nav-link px-2">Gestion SU</a></li>');
  }
  //************************************************/
  //***********Evento para Mostrar modal************/
  //**************de inicio de sesion***************/
  $("#btnlogin").click(function (e) {
    e.preventDefault();
    $(".modal-title").text("Inicio de Sesion")
    $("#messegel").hide();
    $("#optreg").hide();
    $("#name").prop('required', false);
    $("#phone").prop('required', false);
    $("#btnRegister").hide();
    $("#btnStart").show();
    $("#options").show();
    $('#loginModal').modal('show');
  });
  //************************************************/
  //***********Evento para enviar infor*************/
  //**************para iniciar sesion***************/
  $("#formLogin").submit(function (e) {
    e.preventDefault();
    email = $.trim($('#email').val());
    passw = $.trim($('#pass').val());

    var datos = new FormData();
    datos.append('email', email)
    datos.append('passw', passw)
    $.ajax({
      url: "usuario/usuario_controller.php?op=login",
      type: "POST",
      dataType: "json",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success: function (data) {
        if (data['status'] == true) {
          $('#loginModal').modal('hide');
          Swal.fire({
            icon: 'success',
            title: 'Bienvenido...',
            html: '<h2>¡Estimado ' + data['rol'] + '!</h2><br><h4>Usted ' + data['message'] + '</h4>',
            showConfirmButton: false,
            timer: 2000,
          });

            if (data['idrol'] == 1) {
              location.reload();
              $(location).attr('href', link+'herramientas');
            } else {
              location.reload();
            }

        } else {
          $("#errorl").text(data['message']);
          $("#messegel").show();
          setTimeout(() => {
            $("#errorl").text("");
            $("#messegel").hide();
          }, 3000);
        }
      }
    });
  });
  //************************************************/
  //***********Evento para cerrar sesion************/
  //************************************************/
  $('#btnlogout').click(function (e) {
    e.preventDefault();
    newlink = link.split('/').slice(0,4,).join('/')
    $(location).attr('href', newlink+'/config/logout.php');
  });
  //************************************************/
  //*********Accion para el boton ver  los**********/
  //*************departamentos registrados**********/
  $('#departamento').click(function (e) {
    e.preventDefault();
    $('#contenedor_departamento').show();
    $('button').removeClass('active');
    $('#departamento').addClass('active');
    $('#contenedor_default').hide();
    $('#contenedor_modulo').hide();
    cargarListaDepartamento()
  });
  //************************************************/
  //***********Accion para Mostrar modal************/
  //************registrar departamento**************/
  $("#btndepart").click(function (e) {
    e.preventDefault();
    $(".modal-title").text("Registro de Departamento")
    $("#messege").hide();
    $('#departmodal').modal('show');
  });
  //************************************************/
  //**********Accion para guardar info**************/
  //***********del nuevo departamento***************/
  $("#departform").submit(function (e) {
    e.preventDefault();
    departamento = $.trim($('#namedepart').val());
    $.ajax({
      url: "herramientas_controller.php?op=guardardepartamento",
      type: "POST",
      dataType: "json",
      data: {departamento:departamento},
      success: function (data) {
        if (data.status == true) {
          Swal.fire({
            icon: 'success',
            html: '<h2>¡' + data.message + '!</h2>',
            showConfirmButton: false,
            timer: 2000,
          })
          $('#departmodal').modal('hide');
          $('#namedepart').val('')
          setTimeout(() => {
            departable.ajax.reload(null, false);
          }, 1500);
        } else {
          $('#messege').addClass('alert-danger');
          $('#messege').show();
          $('#error').text(data.message);
          setTimeout(() => {
            $("#error").text("");
            $("#messege").hide();
          }, 3000);
        }
      
      }
    });
  });
  //************************************************/
  //*********Accion para el boton ver  los**********/
  //***************modulos registrados**************/
  $('#modulo').click(function (e) {
    e.preventDefault();
    $('#contenedor_departamento').hide();
    $('button').removeClass('active');
    $('#modulo').addClass('active');
    $('#contenedor_default').hide();
    $('#contenedor_modulo').show();
    cargarListaModulos()
  });
  //************************************************/
  //***********Accion para Mostrar modal************/
  //************modulos departamento**************/
  $("#btnmodulo").click(function (e) {
    e.preventDefault();
    $(".modal-title").text("Registro de Departamento")
    $("#messegem").hide();
    cargarSelectorDepartamento()
    cargarModulosDisponibles()
    $('#modulomodal').modal('show');
  });
  //************************************************/
  //**********Accion para guardar info**************/
  //***************del nuevo Modulo*****************/
  $("#moduloform").submit(function (e) {
    e.preventDefault();
    modulo = $.trim($('#namemodulo').val());
    departamento = $.trim($('#depmodulo').val());
    $.ajax({
      url: "herramientas_controller.php?op=guardarmodulo",
      type: "POST",
      dataType: "json",
      data: {modulo:modulo,departamento:departamento},
      success: function (data) {
        if (data.status == true) {
          Swal.fire({
            icon: 'success',
            html: '<h2>¡' + data.message + '!</h2>',
            showConfirmButton: false,
            timer: 2000,
          })
          $('#modulomodal').modal('hide');
          $('#depmodulo').val('')
          $('#namemodulo').val('')
          setTimeout(() => {
            modulotable.ajax.reload(null, false);
          }, 1500);
        } else {
          $('#messege').addClass('alert-danger');
          $('#messege').show();
          $('#error').text(data.message);
          setTimeout(() => {
            $("#error").text("");
            $("#messege").hide();
          }, 3000);
        }
      
      }
    });
  });
});
//************************************************/
//**********Funcion para cargar la lista**********/
//*************de departamento creados************/
function cargarListaDepartamento() {
  $('#departable').DataTable().destroy();
  departable = $('#departable').DataTable({
    responsive: true,
    pageLength: 10,
    ajax: {
      url: "herramientas_controller.php?op=verdepartamentos",
      method: 'POST',
      dataSrc: ""
    },
    columns: [
      { data: "id" },
      { data: "nombre" },
      { data: "descripcion" },
    ],
    order: {
      name: 'id',
      dir: 'asc'
    }
  })
}
//************************************************/
//**********Funcion para cargar la lista**********/
//****************de modulos creados**************/
function cargarListaModulos() {
  $('#modulotable').DataTable().destroy();
  modulotable = $('#modulotable').DataTable({
    responsive: true,
    pageLength: 10,
    ajax: {
      url: "herramientas_controller.php?op=vermodulos",
      method: 'POST',
      dataSrc: ""
    },
    columns: [
      { data: "id" },
      { data: "modulo" },
      { data: "departamento" },
      { data: "descripcion" },
    ],
    order: {
      name: 'id',
      dir: 'asc'
    }
  })
}
//************************************************/
//**********Funcion para cargar la lista**********/
//*********en el selectord de departamento********/
function cargarSelectorDepartamento() {
  $.ajax({
    url: "herramientas_controller.php?op=verdepartamentos",
    method: "POST",
    dataType: "json",
    success: function (data) {
      $('#depmodulo').empty();
      $('#depmodulo').append('<option value="">_-_Seleccione_-_</option>');
      $.each(data, function (idx, opt) {
        $('#depmodulo').append('<option value="' + opt.id + '">' + opt.nombre + '</option>');
      });
    }
  });
}
//************************************************/
//**********Funcion para cargar la lista**********/
//****************de modulos creados**************/
function cargarModulosDisponibles() {
  $.ajax({
    url: "herramientas_controller.php?op=listamodulos",
    method: "POST",
    dataType: "json",
    success: function (data) {
      $('#namemodulo').empty();
      $.each(data, function (idx, opt) {
        $('#namemodulo').append('<option value="' + opt.modulo + '">' + opt.modulo + '</option>');
      });
    }
  });
}
