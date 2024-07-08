$(document).ready(function () {
  //************************************************/
  //********Accion para cargar la informacion*******/
  //******el Datatable de los usuario***************/
  usuariotabla = $('#usuariotabla').DataTable({
    responsive: false,
    pageLength: 10,
    ajax: {
      url: "app/usuario/usuario_controller.php?op=vertodousuario",
      method: 'POST',
      dataSrc: ""
    },
    columns: [
      { data: "nom_usuario" },
      { data: "ape_usuario" },
      { data: "correo" },
      { data: "rol" },
      {
        data: "id_cliente",
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
    url: "app/usuario/usuario_controller.php?op=verroles",
    method: "POST",
    dataType: "json",
    success: function (data) {
      $('#rol').append('<option value="">_-_Seleccione_-_</option>');
      $.each(data, function (idx, opt) {
        $('#rol').append('<option value="' + opt.id + '">' + opt.rol + '</option>');
      });
    }
  });
  //************************************************/
  //********Accion para cargar la informacion********/
  //*********el selector el estatus de usuario*********/
  $.ajax({
    url: "app/usuario/usuario_controller.php?op=verestatus",
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
  //********Accion para bloquear usuarios********/
  //*********que interactuen en el sistema*********/
  $.ajax({
    url: "app/usuario/usuario_controller.php?op=veropbloquear",
    method: "POST",
    dataType: "json",
    success: function (data) {
      $('#bloqueo').append('<option value="">_-_Seleccione_-_</option>');
      $.each(data, function (idx, opt) {
        $('#bloqueo').append('<option value="' + opt.id + '">' + opt.bloqueo + '</option>');
      });
    }
  });
  //************************************************/
  //********Accion para Enviar y guardar la*********/
  //*********informacion del usuario************/
  $('#formulariodeusuario').submit(function (e) {
    e.preventDefault();
    id = $('#idusuario').val();
    nom_usuario = $('#nom_usuario').val();
    ape_usuario = $('#ape_usuario').val();
    contrasenna = $('#contrasenna').val();
    correo = $('#correo').val();
    telefono = $('#telefono').val();
    rol = $('#rol').val();
    estatus = $('#estatus').val();
    $.ajax({
      url: "app/usuario/usuario_controller.php?op=guargarusuario",
      type: "POST",
      dataType: "json",
      data: {
        id: id,
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
        url: "app/usuario/usuario_controller.php?op=eliminarusuario",
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
            setTimeout(() => {
              usuariotabla.ajax.reload(null, false);
            }, 1000);
          } else {
            Swal.fire({
              icon: 'error',
              title: data.message,
              showConfirmButton: false,
              timer: 2000,
            });
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
    url: "app/usuario/usuario_controller.php?op=verusuario",
    method: "POST",
    dataType: "json",
    data: { id: id },
    success: function (data) {
      $.each(data, function (idx, opt) {
        $('#nom_usuario').val(opt.nom_usuario);
        $('#ape_usuario').val(opt.ape_usuario);
        //$('#contrasenna').val(opt.contrasenna);
        $("#contrasenna").prop('required', false);
        $('#correo').val(opt.correo);
        $('#telefono').val(opt.telefono);
        $('#rol').val(opt.rol);
        $('#estatus').val(opt.estatus);
        /*
        if (opt.bloqueo==1) {
            $('#bloqueo').prop('checked', true);
        } else {
            $('#bloqueo').prop('checked', false); 
        } 
        */
      });
    }
  });
});
function tomarId(id) {
  $('#idusuario').val(id);
}

function limpiarFormulario() {
  $('#idusuario').val('');
  $('#nom_usuario').val('');
  $('#ape_usuario').val('');
  $('#contrasenna').val('');
  $('#correo').val('');
  $('#telefono').val('');
  $('#rol').val('');
  $('#estatus').val('');
}


