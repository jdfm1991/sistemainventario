$(document).ready(function () {
  //************************************************/
  //********Accion para cargar la informacion*******/
  //******el Datatable de los usuario***************/
  usuariotabla = $('#usuariotabla').DataTable({
    responsive: false,
    pageLength: 10,
    ajax: {
      url: "usuario_controller.php?op=showdatausers",
      method: 'POST',
      dataSrc: ""
    },
    columns: [
      { data: "user" },
      { data: "name" },
      { data: "user_email" },
      { data: "user_rol" },
      { data: "user_status" },
      {
        data: "id",
        "render": function (data, type, row) {
          return "<div class='text-center'><div class='btn-group'>" +
            "<button onclick='tomarId(`" + data + "`)' class='btn btn-outline-info btn-sm btneditar'><i class='bi bi-pencil-square'></i></button>" +
            "<button onclick='tomarId(`" + data + "`)' class='btn btn-outline-danger btn-sm btneliminar'><i class='bi bi-x-octagon'></i></button>" +
            "</div></div>"
        }
      },
    ],
  });
  //************************************************/
  //********Accion para cargar la informacion********/
  //*********el selector de roles de usuario*********/
  $.ajax({
    url: "usuario_controller.php?op=showdataroles",
    method: "POST",
    dataType: "json",
    success: function (data) {
      $('#roles').append('<option value="">_-_Seleccione_-_</option>');
      $.each(data, function (idx, opt) {
        $('#roles').append('<option value="'+opt.id+'">'+opt.rol +'</option>');
      });
    }
  });
  //************************************************/
  //********Accion para cargar la informacion********/
  //*********el selector el estatus de usuario*********/
  $.ajax({
    url: "usuario_controller.php?op=showdatastatus",
    method: "POST",
    dataType: "json",
    success: function (data) {
      $('#estatus').append('<option value="">_-_Seleccione_-_</option>');
      $.each(data, function (idx, opt) {
        $('#estatus').append('<option value="' + opt.id + '">' + opt.estatus + '</option>');
      });
    }
  });
  //************************************************/
  //********Accion para Enviar y guardar la*********/
  //*********informacion del usuario************/
  $('#formulariodeusuario').submit(function (e) {
    e.preventDefault();
    id = $('#idusuario').val();
    usuario = $('#login_usuario').val();
    nom_usuario = $('#nom_usuario').val();
    ape_usuario = $('#ape_usuario').val();
    contrasenna = $('#contrasenna').val();
    correo = $('#correo').val();
    telefono = $('#telefono').val();
    rol = $('#roles').val();
    estatus = $('#estatus').val();
    $.ajax({
      url: "usuario_controller.php?op=saveuserdata",
      type: "POST",
      dataType: "json",
      data: {
        id: id,
        usuario:usuario,
        nom_usuario: nom_usuario,
        ape_usuario: ape_usuario,
        contrasenna: contrasenna,
        correo: correo,
        telefono: telefono,
        rol: rol,
        estatus: estatus
      },
      success: function (data) {
        if (data.status == true) {
          Swal.fire({
            icon: 'success',
            html: '<h2>¡' + data.message + '!</h2>',
            showConfirmButton: false,
            timer: 2000,
          })
          setTimeout(() => {
            limpiarFormulario()
          }, 1000);
          setTimeout(() => {
            usuariotabla.ajax.reload(null, false);
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
//*********Opcion para Eliminar un usuario*******/
//*****************de la base de datos************/
$(document).on("click", ".btneliminar", function () {
  id = $('#idusuario').val();
  Swal.fire({
    title: "¿Está seguro de borrar esta informacion?",
    showCancelButton: true,
    confirmButtonText: "Si",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "usuario_controller.php?op=deleteuserdata",
        type: "POST",
        dataType: "json",
        data: { id: id },
        success: function (data) {
          if (data.status == true) {
            Swal.fire({
              icon: 'success',
              title: data.message,
              showConfirmButton: false,
              timer: 2000,
            });
            limpiarFormulario()
            setTimeout(() => {
              usuariotabla.ajax.reload(null, false);
              console.log(id);
            }, 1000);
          } else {
            Swal.fire({
              icon: 'error',
              title: data.message,
              showConfirmButton: false,
              timer: 2000,
            });
            limpiarFormulario()
          }
        }
      });
    }
  });
});
//************************************************/
//*********Opcion para editar un producto*******/
//*****************de la base de datos************/
$(document).on("click", ".btneditar", function () {
  id = $('#idusuario').val();
  $.ajax({
    url: "usuario_controller.php?op=showdatauser",
    method: "POST",
    dataType: "json",
    data: { id: id },
    success: function (data) {
      $.each(data, function (idx, opt) {
        $('#nom_usuario').val(opt.user_name);
        $('#ape_usuario').val(opt.user_last_name);
        $('#login_usuario').val(opt.user);
        $('#correo').val(opt.user_email);
        $('#telefono').val(opt.user_phone);
        $('#roles').val(opt.user_rol);
        $('#estatus').val(opt.user_status);
        $("#contrasenna").prop('required', false);
      });
    }
  });
});

function tomarId(id) {
  $('#idusuario').val(id);
}
function limpiarFormulario() {
  $('#idusuario').val('');
  $('#login_usuario').val('')
  $('#nom_usuario').val('');
  $('#ape_usuario').val('');
  $('#contrasenna').val('');
  $('#correo').val('');
  $('#telefono').val('');
  $('#roles').val('');
  $('#estatus').val('');
}


