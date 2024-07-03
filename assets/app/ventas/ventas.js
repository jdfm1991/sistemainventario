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
  $('#contenedor_ver_compra').hide();
  $('#contenedor_compra').hide();
  //************************************************/
  //***********Funcion para Validar solo************/
  //**************Entrada de Numeros****************/
  $(function () {
    $("input[name='excento']").on('input', function (e) {
      $(this).val($(this).val().replace(/[^0-9.]/g, ''));
    });
  });
  //************************************************/
  //*********Accion para el boton registrar*********/
  //*******************Comprar**********************/
  $('#rcompra').click(function (e) {
    e.preventDefault();
    $('#contenedor_compra').show();
    $('button').removeClass('active');
    $('#rcompra').addClass('active');
    $('#contenedor_default').hide();
    $('#contenedor_ver_compra').hide();
    //************************************************/
    //**********Accion para Cargar numero de**********/
    //**************la siguiente factura**************/
    $.ajax({
      url: "assets/app/ventas/ventas_controller.php?op=siguientefactura",
      method: "POST",
      dataType: "json",
      success: function (data) {
        $('#documento').text(data);
      }
    });
  });
  //************************************************/
  //*************Accion para el boton Ver***********/
  //*******************Comprar**********************/
  $('#vcompra').click(function (e) {
    e.preventDefault();
    $('#contenedor_compra').hide();
    $('button').removeClass('active');
    $('#vcompra').addClass('active');
    $('#contenedor_default').hide();
    $('#contenedor_ver_compra').show();
    cargarListaComprasRealizadas()
  });
  //************************************************/
  //**********Accion para el boton Cancelar*********/
  //************************************************/
  $('#clean').click(function (e) {
    e.preventDefault();
    $('#comprasform').get(0).reset();
    $('#rcomprastable tbody').empty();
    $('#contenedor_ver_compra').hide();
    $('#contenedor_compra').hide();
    $('#contenedor_default').show()
  });
  //************************************************/
  //********Accion para escoger un proveedor********/
  //************************************************/
  $('#btnsujeto').click(function (e) {
    e.preventDefault();
    cargarListaProveedores()
    $('#proveedormodal').modal('show');
  });
  //************************************************/
  //**********Accion para Cargar la tase de*********/
  //*****************los impuestos******************/
  $.ajax({
    url: "assets/app/herramientas/herramientas_controller.php?op=impuestos",
    method: "POST",
    dataType: "json",
    success: function (data) {
      $('#impuesto').append('<option value="">Alicuota</option>');
      $.each(data, function (idx, opt) {
        if (opt.estatus == 1) {
          $('#impuesto').append('<option value="' + opt.impuesto + '" selected>' + opt.impuesto + '</option>');
        } else {
          $('#impuesto').append('<option value="' + opt.impuesto + '">' + opt.impuesto + '</option>');
        }

      });
    }
  });
  //************************************************/
  //**********Accion para calculos los montos*******/
  //*************teniendo un monto excento**********/
  $('#excento').keyup(function (e) {
    verTotalesGenerales()
  });
  //************************************************/
  //**********Accion para el boton Agragar**********/
  //****************un nuevo producro***************/
  $('#agregarproducto').click(function (e) {
    e.preventDefault();
    sujeto = $('#sujeto').val();
    documento = $('#documento').val();
    impuesto = $('#impuesto').val();
    if (!sujeto) {
      Swal.fire({
        icon: 'warning',
        html: '<h2>¡Antes debe Escoger un Proveedor!</h2>',
        showConfirmButton: false,
        timer: 2000,
      })
    } else {
      if (!documento) {
        Swal.fire({
          icon: 'warning',
          html: '<h2>¡Antes debe colocar un numero de factura!</h2>',
          showConfirmButton: false,
          timer: 2000,
        })
      } else {
        if (!impuesto) {
          Swal.fire({
            icon: 'warning',
            html: '<h2>¡Antes de Carga Algun Producto Debe Escoger Una Alicuota!</h2>',
            showConfirmButton: false,
            timer: 2000,
          })
        } else {
          cargarListaProductos()
          $('#productomodal').modal('show');
        }
      }
    }
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
  //**********Accion para Registar compra***********/
  //*****************de los producro****************/
  $('#comprasform').submit(function (e) {
    e.preventDefault();
    array = []
    idsujeto = $('#idsujeto').val();
    usuario = $('#usuario').val();
    documento = $('#documento').val();
    impuesto = $('#impuesto').val();
    excento = $('#excento').val();
    fecha = $('#fecha').val();
    items = $('#nitems').text();
    cant = $('#pcant').text();
    subtotal = $('#subtotal').text();
    base = $('#base').text();
    iva = $('#iva').text();
    total = $('#total').text();
    for (i = 1; i <= numero; i++) {
      subarray = {}
      countact = $("#countact" + (i)).val()
      if (countact !== undefined) {
        subarray['idproducto'] = $("#idproducto" + (i)).val();
        subarray['producto'] = $("#producto" + (i)).val();
        subarray['costact'] =$("#costact" + (i)).val();
        subarray['countact'] = $("#countact" + (i)).val();
        subarray['costacttotal'] =$("#costacttotal" + (i)).val();
        array.push(subarray);
      }
    }
    var datos = new FormData();
    datos.append('idsujeto', idsujeto)
    datos.append('usuario', usuario)
    datos.append('documento', documento)
    datos.append('impuesto', impuesto)
    datos.append('excento', excento)
    datos.append('fecha', fecha)
    datos.append('items', items)
    datos.append('cant', cant)
    datos.append('subtotal', subtotal)
    datos.append('base', base)
    datos.append('iva', iva)
    datos.append('total', total)
    datos.append('producto', JSON.stringify(array))
    if (!Array.isArray(array) || array.length === 0) {
      Swal.fire({
        icon: 'warning',
        html: '<h2>¡Debe Agregar al Menos Agregar Un Producto a la Compra!</h2>',
        showConfirmButton: false,
        timer: 2000,
      })
    } else {
      $.ajax({
        url: "assets/app/compras/compras_controller.php?op=registar",
        type: "POST",
        dataType: "json",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
          if (data.status == true) {
            Swal.fire({
              icon: 'success',
              title: data.message,
              showConfirmButton: false,
              timer: 2000,
            });
            $('#comprasform').get(0).reset();
            $('#rcomprastable tbody').empty();
            $('#nitems').text('');
            $('#pcant').text('');
            $('#subtotal').text('');
            $('#base').text('');
            $('#iva').text('');
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
});

//************************************************/
//**********Funcion para cargar la lista**********/
//***************de los proveedores***************/
function cargarListaProveedores() {
  $('#modaproveedortable').DataTable().destroy();
  modaproveedortable = $('#modaproveedortable').DataTable({
    pageLength: 10,
    ajax: {
      url: "assets/app/proveedor/proveedor_controller.php?op=verproveedores",
      method: 'POST', //usamos el metodo POST
      dataSrc: ""
    },
    columns: [
      { data: "nombre" },
      { data: "codigo" },
      {
        data: "id",
        "render": function (data, type, row) {
          return "<div class='text-center'><div class='btn-group'>" +
            "<button onclick='cargarDataProveedor(`" + data + "`)' class='btn btn-outline-info btn-sm btneditar'><i class='bi bi-pencil-square'></i></button>" +
            "</div></div>"
        }
      },
    ],
  });
}
//************************************************/
//*********Funcion para cargar informacion********/
//*****************del proveedores****************/
function cargarDataProveedor(id) {
  $.ajax({
    url: "assets/app/proveedor/proveedor_controller.php?op=verproveedor",
    method: "POST",
    dataType: "json",
    data: { id: id },
    success: function (data) {
      $.each(data, function (idx, opt) {
        $('#idsujeto').val(opt.id);
        $('#sujeto').val(opt.codigo);
        $('#nombresujeto').text(opt.nombre);
        $('#proveedormodal').modal('hide');
      });

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
            "<button onclick='agragarItemCompra(`" + data + "`)' class='btn btn-outline-info btn-sm btneditar'><i class='bi bi-pencil-square'></i></button>" +
            "</div></div>"
        }
      },
    ],
  });
}
//************************************************/
//*********Funcion para agragar nuevo item********/
//*************al registro de compra**************/
function agragarItemCompra(id) {
  $.ajax({
    url: "assets/app/producto/producto_controller.php?op=verproducto",
    method: "POST",
    dataType: "json",
    data: { id: id },
    success: function (data) {
      $.each(data, function (idx, opt) {
        if (opt.Costo_unidad > 0) {
          numero = $itemcolumn.children().length + 1;
          $('#cuerpo').append(
            '<tr name=ncolumn>' +
            '<td>' +
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
          verTotalesGenerales()
        } else {
          Swal.fire({
            icon: 'warning',
            html: '<h2>¡No Se Puede Cargar Productos Con Costo 0!</h2>',
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
  nuevomonto = costact * countact
  $(`#costacttotal${nitem}`).val(nuevomonto.toFixed(2));
  verTotalesGenerales()
}
//************************************************/
//*********Funcion para cargar los totales********/
//*****************de la factura******************/
function verTotalesGenerales() {
  let cant = 0;
  let subtotal = 0;
  let base = 0;
  let iva = 0;
  let total = 0;
  let items = 0;
  array = []
  impuesto = Number($('#impuesto').val());
  excento = Number($('#excento').val());
  items = $itemcolumn.children().length;
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
    subtotal += data.costacttotal;
  });
  if (excento) {
    base = subtotal - excento;
    iva = (base * impuesto) / 100;
    total = base + iva + excento;
  } else {
    base = subtotal;
    iva = (base * impuesto) / 100;
    total = base + iva;
  }
  $('#nitems').text(items);
  $('#pcant').text(cant);
  $('#subtotal').text(subtotal.toFixed(2));
  $('#base').text(base.toFixed(2));
  $('#iva').text(iva.toFixed(2));
  $('#total').text(total.toFixed(2));
}
//************************************************/
//**********Funcion para cargar la lista**********/
//***************de los proveedores***************/
function cargarListaComprasRealizadas() {
  $('#comprastable').DataTable().destroy();
  comprastable = $('#comprastable').DataTable({
    responsive: true,
    pageLength: 10,
    ajax: {
      url: "assets/app/compras/compras_controller.php?op=vercompras",
      method: 'POST',
      dataSrc: ""
    },
    columns: [
      { data: "Proveedor" },
      { data: "fecha_o" },
      { data: "documento" },
      { data: "cant_items" },
      { data: "cant_producto" },
      { data: "total" },
      { data: "usuario" },
    ],
    order: {
      name:'fecha_o',
      dir:'desc'
    }
  })
}















