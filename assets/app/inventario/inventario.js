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
  $('#contenedor_ver_inventario_d').hide();
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
  //**************Accion para el boton Ver**********/
  //**************movimientos de inventario*********/
  $('#v_inventario').click(function (e) {
    e.preventDefault();
    $('#contenedor_inventario').hide();
    $('button').removeClass('active');
    $('#v_inventario').addClass('active');
    $('#contenedor_default').hide();
    $('#contenedor_botones').hide();
    $('#contenedor_ver_inventario').removeClass('col-sm-9');
    $('#contenedor_ver_inventario').addClass('col-sm');
    $('#contenedor_ver_inventario').show();
    cargarListaMovimientosRealizadas()
  });
  //************************************************/
  //******Accion para el boton ver movimientos******/
  //**************detallados de inventario**********/
  $('#v_inventario_d').click(function (e) {
    e.preventDefault();
    $('#contenedor_inventario').hide();
    $('button').removeClass('active');
    $('#v_inventario_d').addClass('active');
    $('#contenedor_default').hide();
    $('#contenedor_botones').hide();
    $('#contenedor_ver_inventario_d').removeClass('col-sm-9');
    $('#contenedor_ver_inventario_d').addClass('col-sm');
    $('#contenedor_ver_inventario_d').show();
    cargarListaMovimientosDetaladosRealizadas()
  });
  //************************************************/
  //***********Accion para el boton volver**********/
  //**********restablecer la vista del menu*********/
  $('.back').click(function (e) {
    e.preventDefault();
    $('#contenedor_inventario').hide();
    $('#contenedor_ver_inventario').hide();
    $('#contenedor_ver_inventario_d').hide();
    $('button').removeClass('active');
    $('#contenedor_default').show();
    $('#contenedor_botones').show();
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
  //**********Accion para el boton Cancelar*********/
  //************************************************/
  $('#clean').click(function (e) {
    e.preventDefault();
    $('#minventarioform').get(0).reset();
    $('#rminventariotable tbody').empty();
    $('#contenedor_inventario').hide();
    $('#contenedor_default').show()
  });
  //************************************************/
  //**********Accion para el boton Eliminar*********/
  //*****************un producro********************/
  $(document).on("click", "#delcol", function () {
    column = $(this).closest('tr')
    column.remove();
    verTotalesGenerales()
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
  //********Accion para Registar informacion********/
  //*************movimiento de inventar*************/
  $('#minventarioform').submit(function (e) {
    e.preventDefault();
    array = []
    usuario = $('#usuario').val();
    movimiento = $('#movimiento').val();
    documento = $('#documento').text();
    fecha = $('#fecha').val();
    items = $('#nitems').text();
    cant = $('#pcant').text();
    total = $('#total').text();
    for (i = 1; i <= numero; i++) {
      subarray = {}
      countact = $("#countact" + (i)).val()
      if (countact !== undefined) {
        subarray['idproducto'] = $("#idproducto" + (i)).val();
        subarray['producto'] = $("#producto" + (i)).val();
        subarray['costact'] = $("#costact" + (i)).val();
        subarray['countact'] = $("#countact" + (i)).val();
        subarray['costacttotal'] = $("#costacttotal" + (i)).val();
        array.push(subarray);
      }
    }
    var datos = new FormData();
    datos.append('usuario', usuario)
    datos.append('movimiento', movimiento)
    datos.append('documento', documento)
    datos.append('fecha', fecha)
    datos.append('items', items)
    datos.append('cant', cant)
    datos.append('total', total)
    datos.append('producto', JSON.stringify(array))
    if (!Array.isArray(array) || array.length === 0) {
      Swal.fire({
        icon: 'warning',
        html: '<h2>¡Debe Agregar al Menos Agregar Un Producto!</h2>',
        showConfirmButton: false,
        timer: 2000,
      })
    } else {
      $.ajax({
        url: "assets/app/inventario/inventario_controller.php?op=registar",
        type: "POST",
        dataType: "json",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
          console.log(data);
          if (data.status == true) {
            Swal.fire({
              icon: 'success',
              title: data.message,
              showConfirmButton: false,
              timer: 2000,
            });
            $('#minventarioform').get(0).reset();
            $('#rminventariotable tbody').empty();
            $('#nitems').text('');
            $('#pcant').text('');
            $('#total').text('');
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
          $('#cuerpoinventario').append(
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
            '<input type="number" class="form-control" onclick="calcularSubTotales(`' + numero + '`)" id="countact' + numero + '" value= "1" min="0" max=' + opt.Cantidad + '>' +
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
  items = array.length
  $('#nitems').text(items);
  $('#pcant').text(cant);
  $('#total').text(total.toFixed(2));
}
//********Accion para cargar la informacion*******/
//*********el Datatable de los Movimiento*********/
//******************del inventario****************/
function cargarListaMovimientosRealizadas() {
  $('#inventariotable').DataTable().destroy();
  inventariotable = $('#inventariotable').DataTable({
    responsive: true,
    pageLength: 10,
    ajax: {
      url: "assets/app/inventario/inventario_controller.php?op=vermovimiento",
      method: 'POST',
      dataSrc: ""
    },
    columns: [
      { data: "id" },
      { data: "responsable" },
      { data: "Movimiento" },
      { data: "fecha_o" },
      { data: "documento" },
      { data: "cant_items" },
      { data: "cant_producto" },
      { data: "total" },
      { data: "usuario" },
    ],
    order: {
      name: 'id',
      dir: 'desc'
    }
  })
}
//********Accion para cargar la informacion*******/
//*********el Datatable de los Movimiento*********/
//**************del inventario detallado**********/
function cargarListaMovimientosDetaladosRealizadas() {
  $('#inventariodtable').DataTable().destroy();
  inventariodtable = $('#inventariodtable').DataTable({
    responsive: true,
    pageLength: 10,
    ajax: {
      url: "assets/app/inventario/inventario_controller.php?op=vermovimientodatallado",
      method: 'POST',
      dataSrc: ""
    },
    columns: [
      { data: "id" },
      { data: "Descripcion" },
      { data: "Movimiento" },
      { data: "documento" },
      { data: "fecha_movimiento" },
      { data: "cantidad_anterior" },
      { data: "cantidad" },
      { data: "cantidad_actual" },
      { data: "usuario" },
    ],
    order: {
      name: 'id',
      dir: 'desc'
    }
  })
}