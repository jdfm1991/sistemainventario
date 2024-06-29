let cont = 0;
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
    $('#productomodal').modal('show');
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
    taxTable()
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

function cargarproducto(id) {
  $.ajax({
    url: "assets/app/producto/producto_controller.php?op=verproducto",
    method: "POST",
    dataType: "json",
    data: { id: id },
    success: function (data) {
      $.each(data, function(idx, opt) {  
        const numero = $itemcolumn.children().length + 1;
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
        taxTable()

        $(document).on('change', `#countact${numero}`, function () {
          //$(`#countact${numero}`).val($(this).val());
          countact  = $('#countact'+numero).val();
          costact = $('#costact'+numero).val();
          nuevomonto = costact * countact
          $(`#costacttotal${numero}`).val(nuevomonto.toFixed(2));
          //document.getElementById(`costacttotal${numero}`).setAttribute('value', nuevomonto) //.value = nuevomonto
          taxTable()
        });
    }); 

    }
  });
}

function taxTable() {
  let data = [];
  var ncolumn = document.getElementsByName("ncolumn");
  var ndata = ncolumn.length;
  for (var i = 0; i < ndata; i++) {
    subarray = []
    subarray['idproducto'] = $("#idproducto" + (i + 1)).val();
    subarray['producto'] = $("#producto" + (i + 1)).val();
    subarray['costact'] = $("#costact" + (i + 1)).val();
    subarray['countact'] = $("#countact" + (i + 1)).val();
    subarray['costacttotal'] = $("#costacttotal" + (i + 1)).val();
    data = subarray
  }

 

}
















