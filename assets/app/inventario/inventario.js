//************************************************/
//*********Se Crean Variables Globales************/
//***************y se inicializan*****************/
let cont = 0;
let numero = 0;
const $itemcolumn = $('tbody');
$(document).ready(function () {
  //************************************************/
  //*******Se Oculta los elementos iniciales********/
  //*****************de modulo**********************/
  $('#contenedor_ver_inventario').hide();
  $('#contenedor_inventario').hide();
  //************************************************/
  //***********Funcion para Validar solo************/
  //**************Entrada de Numeros****************/
  $(function () {
    $("input[name='cantidad']").on('input', function (e) {
      $(this).val($(this).val().replace(/[^0-9.]/g, ''));
    });
  });
  //************************************************/
  //*********Accion para el boton registrar*********/
  //************movimientos de inventario***********/
  $('#r_inventario').click(function (e) {
    e.preventDefault();
    $('#contenedor_inventario').show();
    $('button').removeClass('active');
    $('#r_inventario').addClass('active');
    $('#contenedor_default').hide();
    $('#contenedor_ver_inventario').hide();
  });
   //************************************************/
  //**************Accion para el boton Ver***********/
  //**************movimientos de inventario**********/
  $('#v_inventario').click(function (e) {
    e.preventDefault();
    $('#contenedor_inventario').hide();
    $('button').removeClass('active');
    $('#v_inventario').addClass('active');
    $('#contenedor_default').hide();
    $('#contenedor_ver_inventario').show();
    cargarListaComprasRealizadas()
  });
  //************************************************/
  //**********Accion para el cargar selector********/
  //*************del Tipo de Operacion**************/
  $('#movimiento').change(function (e) { 
    e.preventDefault();
    movimiento = $('#movimiento').val();
    cargarNumeroFactura(movimiento)
  });
   //************************************************/
  //**********Accion para el boton Agragar**********/
  //****************un nuevo producro***************/
  $('#agregarproducto').click(function (e) {
    e.preventDefault();
      cargarListaProductos()
      $('#productomodal').modal('show');
  });
  //************************************************/
  //********Accion para cargar la informacion*******/
  //******el Datatable de los tipos de cuentas******/
  inventariotable = $('#inventariotable').DataTable({
    responsive: true,
    pageLength: 10,
    ajax: {
      url: "assets/app/inventario/inventario_controller.php?op=vermovimiento",
      method: 'POST',
      dataSrc: ""
    },
    columns: [
      { data: "Descripcion" },
      { data: "Movimiento" },
      { data: "fecha_movimiento" },
      { data: "comentario" },
      { data: "usuario" },
      { data: "cantidad_anterior" },
      { data: "cantidad" },
      { data: "cantidad_actual" },

    ],
  })
  //************************************************/
  //********Accion mostrar el formulario para*******/
  //******crear o editar informacion de producto****/
  $('#btnproducto').click(function (e) {
    e.preventDefault();
    limpiarFormulario()
    inventariotable.columns([2, 3, 5, 6]).visible(false)
    $('#contenedor_fomulario').addClass('col-4');
    $('#contenedor_tabla').addClass('col-8');
    $('#btnproducto').hide();
    $('#contenedor_fomulario').show();
  });
  //************************************************/
  //********Accion para cargar la informacion*******/
  //******en lista de opciones de descripcion ******/
  $('#producto').keyup(function (e) {
    producto = $('#producto').val();
    $.ajax({
      url: "assets/app/inventario/inventario_controller.php?op=verlistproducto",
      method: "POST",
      dataType: "json",
      data: { producto: producto },
      success: function (data) {
        $('#listadeproducto').empty();
        $.each(data, function (idx, opt) {
          $('#listadeproducto').append('<option>' + opt.Descripcion + '</option>');
        });
      }
    });
  });
  //************************************************/
  //************Accion para establecer la***********/
  //**********informacion del producto que**********/
  $('#producto').change(function (e) {
    e.preventDefault();
    producto = $('#producto').val();
    $.ajax({
      url: "assets/app/inventario/inventario_controller.php?op=verproducto",
      method: "POST",
      dataType: "json",
      data: { producto: producto },
      success: function (data) {
        $.each(data, function (idx, opt) {
          $('#idproducto').val(opt.id_producto);
          $('#producto').val(opt.Descripcion);
        });
      }
    });
  });
  //************************************************/
  //********Accion para cargar la informacion*******/
  //*************el selector de movimiento***********/
  $.ajax({
    url: "assets/app/inventario/inventario_controller.php?op=vertipomovimiento",
    method: "POST",
    dataType: "json",
    success: function (data) {
      $('#movimiento').append('<option value="">_-_Seleccione-_</option>');
      $.each(data, function (idx, opt) {
        $('#movimiento').append('<option value="' + opt.id + '">' + opt.Movimiento + '</option>');
      });
    }
  });
  //************************************************/
  //********Accion para Enviar y guardar la*********/
  //*********informacion del movimiento de inventario************/
  $('#formularioinventario').submit(function (e) {
    e.preventDefault();
    id_producto = $('#idproducto').val();
    cantidad = $('#cantidad').val();
    movimiento = $('#movimiento').val();
    usuario = $('#usuario').val();
    comentario = $('#comentario').val();
    $.ajax({
      url: "assets/app//inventario/inventario_controller.php?op=VerCambiosCantidad",
      type: "POST",
      dataType: "json",
      data: { id_producto: id_producto, cantidad: cantidad, movimiento: movimiento, usuario: usuario, comentario: comentario },
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

            inventariotable.ajax.reload(null, false);
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
  //********Accion cancelar el formulario de*******/
  //******ediccion de la informacion de movimiento****/
  $('#cancelar').click(function (e) {
    e.preventDefault();
    inventariotable.columns([2, 3, 5, 6]).visible(true)
    $('#contenedor_fomulario').removeClass('col-4');
    $('#contenedor_tabla').removeClass('col-8');
    $('#btnproducto').show();
    $('#contenedor_fomulario').hide();
  });
});
function limpiarFormulario() {
  $('#idproducto').val('');
  $('#producto').val('');
  $('#id_producto').val('');
  $('#cantidad').val('');
  $('#movimiento').val('');
  $('#comentario').val('');
}

//************************************************/
//**********Funcion para Cargar numero de*********/
//**************la siguiente factura**************/
function cargarNumeroFactura(movimiento) {
  $.ajax({
    url: "assets/app/inventario/inventario_controller.php?op=siguientemovimiento",
    method: "POST",
    dataType: "json",
    data: { movimiento: movimiento },
    success: function (data) {
      $('#documento').text(data);
    }
  });
}
//************************************************/
//**********Funcion para cargar la lista**********/
//*****************de los producro****************/
function cargarListaProductos() {
  $('#pmtable').DataTable().destroy();
  pmtable = $('#pmtable').DataTable({
    pageLength: 10,
    ajax: {
      url: "assets/app/producto/producto_controller.php?op=vertodoproducto",
      method: 'POST', //usamos el metodo POST
      dataSrc: ""
    },
    columns: [
      { data: "Descripcion" },
      { data: "Cantidad" },
      {
        data: "id_producto",
        "render": function (data, type, row) {
          return "<div class='text-center'><div class='btn-group'>" +
            "<button onclick='agragarItemMovimiento(`" + data + "`)' class='btn btn-outline-info btn-sm btneditar'><i class='bi bi-pencil-square'></i></button>" +
            "</div></div>"
        }
      },
    ],
  });
}
//************************************************/
//*********Funcion para agragar nuevo item********/
//*************al registro de compra**************/
function agragarItemMovimiento(id) {
  $.ajax({
    url: "assets/app/producto/producto_controller.php?op=verproducto",
    method: "POST",
    dataType: "json",
    data: { id: id },
    success: function (data) {
      $.each(data, function (idx, opt) {
        if (opt.precio_unidad > 0) {
          numero = $itemcolumn.children().length + 1;
          $('#cuerpo').append(
            '<tr name=ncolumn>' +
            '<td>' +
            '<input type="hidden" id="tipo' + numero + '" value="' + opt.excento + '">' +
            '<input type="text" class="form-control" id="idproducto' + numero + '" value="' + opt.id_producto + '" disabled>' +
            '</td>' +
            '<td>' +
            '<input type="text" class="form-control" id="producto' + numero + '" value="' + opt.Descripcion + '" disabled>' +
            '</td>' +
            '<td>' +
            '<input type="text" class="form-control"  id="costact' + numero + '" value="' + opt.Costo_unidad + '" disabled>' +
            '</td>' +
            '<td>' +
            '<input type="number" class="form-control" onclick="calcularSubTotales(`' + numero + '`)" id="countact' + numero + '" value= "1" min="1" max=' + opt.Cantidad + '>' +
            '</td>' +
            '<td>' +
            '<input type="text" class="form-control"  id="costacttotal' + numero + '" value="' + opt.Costo_unidad + '" disabled>' +
            '</td>' +
            '<td>' +
            '<button id="delcol" type="button" class="btn btn-danger">' +
            '<i class="bi bi-x-circle"></i>' +
            '</button>' +
            '</td>' +
            '</tr>');
          $('#productomodal').modal('hide');
          verTotalesGenerales();
        } else {
          Swal.fire({
            icon: 'warning',
            html: '<h2>¡No Se Puede Cargar Productos Con Precio 0!</h2>',
            showConfirmButton: false,
            timer: 2000,
          })
        }
      });
    }
  });
}
//************************************************/
//********Funcion para calcular los totales*******/
//****************de cada producto****************/
function calcularSubTotales(nitem) {
  countact = $('#countact' + nitem).val();
  costact = $('#costact' + nitem).val();
  tipo = $('#tipo' + nitem).val();
  nuevomonto = costact * countact
  $(`#costacttotal${nitem}`).val(nuevomonto.toFixed(2));
  verTotalesGenerales()
}
//************************************************/
//*********Funcion para cargar los totales********/
//*****************de la factura******************/
function verTotalesGenerales() {
  let cant = 0;
  let total = 0;
  let items = 0;
  array = []
  items = $itemcolumn.children().length;
  console.log(items);
  for (i = 1; i <= numero; i++) {
    subarray = []
    countact = $("#countact" + (i)).val()
    if (countact !== undefined) {
      subarray['countact'] = Number($("#countact" + (i)).val());
      subarray['costacttotal'] = Number($("#costacttotal" + (i)).val());
      array.push(subarray);
    }
  }
  array.forEach(data => {
    cant += data.countact;
    total += data.costacttotal;
  });

  $('#nitems').text(items);
  $('#pcant').text(cant);
  $('#total').text(total.toFixed(2));
}