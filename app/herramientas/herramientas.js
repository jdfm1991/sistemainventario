$(document).ready(function () {
  //************************************************/
  //*******Se Oculta los elementos iniciales********/
  //*****************de modulo**********************/
  $('#contenedor_departamento').hide();
  $('#contenedor_modulo').hide();
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
    $("#messeged").hide();
    $('#departmodal').modal('show');
    cargarSelectorPosicion()
  });
  //************************************************/
  //**********Accion para guardar info**************/
  //***********del nuevo departamento***************/
  $("#departform").submit(function (e) {
    e.preventDefault();
    departamento = $('#namedepart').val();
    posision = $('#posisiond').val();
    detalle = $('#detaild').val();
    $.ajax({
      url: "herramientas_controller.php?op=savedepartment",
      type: "POST",
      dataType: "json",
      data: {departamento:departamento,posision:posision,detalle:detalle},
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
      data: { modulo: modulo, departamento: departamento },
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
      { data: "department" },
      { data: "position" },
      { data: "detail" },
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
//********Funcion para cargar la posiciones*******/
//*********en el selector de departamento********/
function cargarSelectorPosicion() {
  $.ajax({
    url: "herramientas_controller.php?op=verdepartamentos",
    method: "POST",
    dataType: "json",
    success: function (data) {
      $('#posisiond').empty();
      $('#posisiond').append('<option value="">Seleccione</option>');
      for (let i = 1; i <= data.length + 1; i++) {
        $('#posisiond').append('<option value="'+ i +'">'+ i +'</option>');
      }
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
