let rol = $('#rol').val();
let usuario = $('#usuario').val();
link = $('#link').val();
$(document).ready(function () { 
  if (rol && usuario) {
    $.ajax({
      url: link +"herramientas/herramientas_controller.php?op=verpermisosroldepartamento",
      type: "POST",
      dataType: "json",
      data: { rol: rol },
      success: function (data) {
        $.each(data, function (idx, opt) {
          $('#opcionusuario').append(
            '<li class="nav-item dropdown">' +
            '<a class="nav-link dropdown-toggle px-2" href="#" data-bs-toggle="dropdown" aria-expanded="false">' + opt.departamento + '</a>' +
            '<ul id="' + opt.departamento + '" class="dropdown-menu">' +
            '</ul>' +
            '</li>'
          );
          if (opt.modulo.length > 0) {
            $.each(opt.modulo, function (idx, sub) {
              $('#' + opt.departamento).append('<li><a class="dropdown-item" href="' + link + sub.modulo + '">' + sub.modulo + '</a></li>');
            });
          } else {
            $('#' + opt.departamento).append('<li><a class="dropdown-item" href="">sin dep</a></li>');
          }

        });
        if (rol == 1) {
          $('#opcionusuario').append('<li><a id="gestionsu" href="' + link + 'herramientas" class="nav-link px-2">Gestion SU</a></li>');
        }
      }
    });



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
            $(location).attr('href', 'herramientas');
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
    newlink = link.split('/').slice(0, 4,).join('/')
    $(location).attr('href', newlink + '/config/logout.php');
  });
});


