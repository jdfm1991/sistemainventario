$(document).ready(function () {
  $('#contenedor_fomulario').hide();
  $('#messege').hide();
  //************************************************/
  //***********Funcion para Validar solo************/
  //**************Entrada de Numeros****************/
  $(function () {
    $("input[name='cantidad']").on('input', function (e) {
      $(this).val($(this).val().replace(/[^0-9.]/g, ''));
    });
  });
  $(function () {
    $("input[name='costo_unidad']").on('input', function (e) {
      $(this).val($(this).val().replace(/[^0-9.]/g, ''));
    });
  });
  //************************************************/
  //********Accion para cargar la informacion*******/
  //******el Datatable de los tipos de cuentas******/
  productotable = $('#productotable').DataTable({
    responsive: true,
    pageLength: 10,
    ajax: {
      url: "assets/app/producto/producto_controller.php?op=vertodoproducto",
      method: 'POST',
      dataSrc: ""
    },
    columns: [
      { data: "Descripcion" },
      { data: "Categoria" },
      { data: "Familia" },
      { data: "Ubicacion" },
      { data: "Unidad" },
      //{data: "Cantidad"},
      //{data: "Costo_unidad"},
      //{data: "valor_inventario"},
      {
        data: "id_producto",
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
  //********Accion mostrar el formulario para*******/
  //******crear o editar informacion de producto****/
  $('#btnproducto').click(function (e) {
    e.preventDefault();
    limpiarFormulario()
    $('#contenedor_fomulario').addClass('col-5');
    $('#contenedor_tabla').addClass('col-7');
    $('#btnproducto').hide();
    $('#contenedor_fomulario').show();
  });
  //************************************************/
  //********Accion cancelar el formulario de*******/
  //******ediccion de la informacion de producto****/
  $('#cancelar').click(function (e) {
    e.preventDefault();
    $('#contenedor_fomulario').removeClass('col-5');
    $('#contenedor_tabla').removeClass('col-7');
    $('#btnproducto').show();
    $('#contenedor_fomulario').hide();
  });
  //************************************************/
  //********Accion para cargar la informacion*******/
  //*************el selector de categoria***********/
  $.ajax({
    url: "assets/app/producto/producto_controller.php?op=vercategorias",
    method: "POST",
    dataType: "json",
    success: function (data) {
      $('#categoria').append('<option value="">_-_Seleccione_-_</option>');
      $.each(data, function (idx, opt) {
        $('#categoria').append('<option value="' + opt.id + '">' + opt.categoria + '</option>');
      });
    }
  });
  //************************************************/
  //********Accion para cargar la informacion*******/
  //*************el selector de Familia*************/
  $.ajax({
    url: "assets/app/producto/producto_controller.php?op=verfamilias",
    method: "POST",
    dataType: "json",
    success: function (data) {
      $('#familia').append('<option value="">_-_Seleccione-_</option>');
      $.each(data, function (idx, opt) {
        $('#familia').append('<option value="' + opt.id + '">' + opt.familia + '</option>');
      });
    }
  });
  //************************************************/
  //********Accion para cargar la informacion*******/
  //*************el selector de Ubicacion***********/
  $.ajax({
    url: "assets/app/producto/producto_controller.php?op=verubicaciones",
    method: "POST",
    dataType: "json",
    success: function (data) {
      $('#ubicacion').append('<option value="">_-_Seleccione-_</option>');
      $.each(data, function (idx, opt) {
        $('#ubicacion').append('<option value="' + opt.id + '">' + opt.ubicacion + '</option>');
      });
    }
  });
  //************************************************/
  //********Accion para cargar la informacion*******/
  //*************el selector de Ubicacion***********/
  $.ajax({
    url: "assets/app/producto/producto_controller.php?op=verunidades",
    method: "POST",
    dataType: "json",
    success: function (data) {
      $('#unidad').append('<option value="">_-_Seleccione-_</option>');
      $.each(data, function (idx, opt) {
        $('#unidad').append('<option value="' + opt.id + '">' + opt.unidad + '</option>');
      });
    }
  });
  //************************************************/
  //************Accion si cambia el valor***********/
  //***************del input de cantidad************/
  $('#cantidad').keyup(function (e) {
    e.preventDefault();
    cantidad = $('#cantidad').val();
    costo_unidad = $('#costo_unidad').val();
    if (costo_unidad != '') {
      monto = cantidad * costo_unidad
      $('#valor_inventario').val(monto);
    }
  });
  //************************************************/
  //************Accion si cambia el valor***********/
  //***************del input de costo***************/
  $('#costo_unidad').keyup(function (e) {
    e.preventDefault();
    cantidad = $('#cantidad').val();
    costo_unidad = $('#costo_unidad').val();
    if (cantidad != '') {
      monto = cantidad * costo_unidad
      $('#valor_inventario').val(monto);
    }
  });
  //************************************************/
  //********Accion para Enviar y guardar la*********/
  //*********informacion del producto************/
  $('#formulariodeproducto').submit(function (e) {
    e.preventDefault();
    id = $('#idproducto').val();
    producto = $('#producto').val();
    categoria = $('#categoria').val();
    familia = $('#familia').val();
    ubicacion = $('#ubicacion').val();
    unidad = $('#unidad').val();
    cantidad = $('#cantidad').val();
    costo_unidad = $('#costo_unidad').val();
    valor_inventario = $('#valor_inventario').val();
    $.ajax({
      url: "assets/app/producto/producto_controller.php?op=guargarproducto",
      type: "POST",
      dataType: "json",
      data: { id: id, producto: producto, categoria: categoria, familia: familia, ubicacion: ubicacion, unidad: unidad, cantidad: cantidad, costo_unidad: costo_unidad, valor_inventario: valor_inventario },
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
            $('#contenedor_fomulario').hide();
            $('#contenedor_fomulario').removeClass('col-5');
            $('#contenedor_tabla').removeClass('col-7');
            $('#btnproducto').show();
            productotable.columns([4, 5, 6]).visible(true)
            productotable.ajax.reload(null, false);
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
  //*********Opcion para Eliminar un producto*******/
  //*****************de la base de datos************/
  $(document).on("click", ".btneliminar", function () {
    id = $('#idproducto').val();
    Swal.fire({
      title: "¿Está seguro de borrar esta informacion?",
      showCancelButton: true,
      confirmButtonText: "Si",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "assets/app/producto/producto_controller.php?op=eliminarproducto",
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
                productotable.ajax.reload(null, false);
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
    id = $('#idproducto').val();
    $.ajax({
      url: "assets/app/producto/producto_controller.php?op=verproducto",
      method: "POST",
      dataType: "json",
      data: { id: id },
      success: function (data) {
        $.each(data, function (idx, opt) {
          $('#idproducto').val(opt.id_producto);
          $('#producto').val(opt.Descripcion);
          $('#categoria').val(opt.Categoria);
          $('#familia').val(opt.Familia);
          $('#ubicacion').val(opt.Ubicacion);
          $('#unidad').val(opt.Unidad);
          $('#cantidad').val(opt.Cantidad);
          $('#costo_unidad').val(opt.Costo_unidad);
          $('#valor_inventario').val(opt.valor_inventario);
        });

        $('#contenedor_fomulario').addClass('col-5');
        $('#contenedor_tabla').addClass('col-7');
        $('#contenedor_fomulario').show();
      }
    });
  });
});

function limpiarFormulario() {
  $('#idproducto').val('');
  $('#producto').val('');
  $('#categoria').val('');
  $('#familia').val('');
  $('#ubicacion').val('');
  $('#unidad').val('');
  $('#cantidad').val('');
  $('#costo_unidad').val('');
  $('#valor_inventario').val('');
}

function tomarId(id) {
  $('#idproducto').val(id);
}