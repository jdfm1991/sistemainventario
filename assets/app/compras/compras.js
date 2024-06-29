let cont = 0;
let numero = 0;
const $itemcolumn = $('tbody');

$(document).ready(function () {

  $('#contenedor_ver_compra').hide();
  $('#contenedor_compra').hide();

  $('#rcompra').click(function (e) {
    e.preventDefault();
    $('#contenedor_compra').show();
    $('button').removeClass('active');
    $('#rcompra').addClass('active');
    $('#contenedor_default').hide();
    $('#contenedor_ver_compra').hide();
  });

  $('#vcompra').click(function (e) {
    e.preventDefault();
    $('#contenedor_compra').hide();
    $('button').removeClass('active');
    $('#vcompra').addClass('active');
    $('#contenedor_default').hide();
    $('#contenedor_ver_compra').show();
  });

  $('.atras').click(function (e) {
    e.preventDefault();
    $('#contenedor_ver_compra').hide();
    $('#contenedor_compra').hide();
    $('#contenedor_default').show()

  });

  $('#agregarproducto').click(function (e) {
    e.preventDefault();
    cargarlistaproducto()
    sujeto = $('#sujeto').val();
    impuesto = $('#impuesto').val();

    if (!sujeto) {
      Swal.fire({
        icon: 'warning',
        html: '<h2>¡Antes de Carga Escoger un Proveedor!</h2>',
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
        $('#productomodal').modal('show');
      }
    }
  });

  $('#btnsujeto').click(function (e) {
    e.preventDefault();
    cargarListaProveedores()
    $('#proveedormodal').modal('show'); 
  });

  $('#clean').click(function (e) { 
    e.preventDefault();
    $('#comprasform').get(0).reset();
    $('#rcomprastable tbody').empty();
    $('#contenedor_ver_compra').hide();
    $('#contenedor_compra').hide();
    $('#contenedor_default').show()
  });

  $(document).on("click", "#delcol", function () {
    column = $(this).closest('tr')
    column.remove();
    leftSide()
  });

  $.ajax({
    url: "assets/app/herramientas/herramientas_controller.php?op=impuestos",
    method: "POST",
    dataType: "json",
    success: function(data) {
      $('#impuesto').append('<option value="">Alicuota</option>');
        $.each(data, function(idx, opt) {
          if (opt.estatus==1) {
            $('#impuesto').append('<option value="'+opt.id+'" selected>'+opt.impuesto+'</option>');
          }else{
            $('#impuesto').append('<option>'+opt.impuesto+'</option>');
          }
            
        });
    }
}); 

});

function cargarlistaproducto() {
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
            "<button onclick='cargarproducto(`" + data + "`)' class='btn btn-outline-info btn-sm btneditar'><i class='bi bi-pencil-square'></i></button>" +
            "</div></div>"
        }
      },
    ],
  });
}

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
      { data: "id",
        "render": function (data, type, row) {
          return "<div class='text-center'><div class='btn-group'>" +
            "<button onclick='cargarDataProveedor(`" + data + "`)' class='btn btn-outline-info btn-sm btneditar'><i class='bi bi-pencil-square'></i></button>" +
            "</div></div>"
        }
      },
    ],
  });
}

function cargarproducto(id) {
  $.ajax({
    url: "assets/app/producto/producto_controller.php?op=verproducto",
    method: "POST",
    dataType: "json",
    data: { id: id },
    success: function (data) {
      $.each(data, function(idx, opt) {
        if (opt.Costo_unidad > 0) {
          numero = $itemcolumn.children().length + 1 ;
          $('#cuerpo').append(
            '<tr name=ncolumn>'+
            '<td>'+
              '<input type="text" class="form-control" id="idproducto'+numero+'" value="'+opt.id_producto+'" disabled>'+
            '</td>'+
            '<td>'+
              '<input type="text" class="form-control" id="producto'+numero+'" value="'+opt.Descripcion+'" disabled>'+
            '</td>'+
            '<td>'+
              '<input type="text" class="form-control"  id="costact'+numero+'" value="'+opt.Costo_unidad+'" disabled>'+
            '</td>'+
            '<td>'+
              '<input type="number" class="form-control" id="countact'+numero+'" value= "1" min="1" max='+opt.Cantidad+'>'+
            '</td>'+
            '<td>'+
              '<input type="text" class="form-control"  id="costacttotal'+numero+'" value="'+opt.Costo_unidad+'" disabled>'+
            '</td>'+
            '<td>'+
              '<button id="delcol" type="button" class="btn btn-danger">'+
                '<i class="bi bi-x-circle"></i>'+
              '</button>'+
            '</td>'+
          '</tr>');    
          $('#productomodal').modal('hide');
          leftSide()
          $(document).on('change', `#countact${numero}`, function () {
            countact  = $('#countact'+numero).val();
            costact = $('#costact'+numero).val();
            nuevomonto = costact * countact
            $(`#costacttotal${numero}`).val(nuevomonto.toFixed(2));
            leftSide()
          });
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

function cargarDataProveedor(id) {
  $.ajax({
    url: "assets/app/proveedor/proveedor_controller.php?op=verproveedor",
    method: "POST",
    dataType: "json",
    data: { id: id },
    success: function (data) {
      $.each(data, function(idx, opt) { 
        $('#sujeto').val(opt.codigo);
        $('#nombresujeto').text(opt.nombre);
        $('#proveedormodal').modal('hide');
    }); 

    }
  });
}

function leftSide() {
  let cant = 0;
  let subtotal = 0;
  array = []
  for (i = 1; i <= numero; i++) {
    subarray = []
    countact = $("#countact" + (i)).val()
    if (countact !== undefined) {
      subarray['countact'] = Number($("#countact" + (i)).val());
      subarray['costacttotal'] = Number($("#costacttotal" + (i)).val()); 
      array.push(subarray);
    }
    //cant += subarray['countact'];
    //subtotal += subarray['costacttotal'];
  }
  console.log(array);
  //$('#pcant').text(cant);
  //$('#subtotal').text(subtotal.toFixed(2));
}

function reset() {
  array = []
  ncolumn = document.getElementsByName("ncolumn");
  ndata = ncolumn.length;
  for (i = 1; i <= ndata; i++) {
    countact = $("#countact" + (i)).val()
    if (countact !== undefined) {
      subarray = []
      subarray['idproducto'] = $("#idproducto" + (i)).val();
      subarray['producto'] = $("#producto" + (i)).val(); 
      subarray['costact'] = $("#costact" + (i)).val(); 
      subarray['countact'] = $("#countact" + (i)).val();
      subarray['costacttotal'] = $("#costacttotal" + (i)).val(); 
      array.push(subarray);
    }
    
    console.log(array);
  }

}















