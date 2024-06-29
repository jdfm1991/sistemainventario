$(document).ready(function () {
    $('#contenedor_fomulario').hide();
    $('#messege').hide();
    //************************************************/
    //***********Funcion para Validar solo************/
    //**************Entrada de Numeros****************/
    $(function() {
        $("input[name='cantidad']").on('input',function (e) {
            $(this).val($(this).val().replace(/[^0-9.]/g,''));
        });
    });
    //************************************************/
    //********Accion para cargar la informacion*******/
    //******el Datatable de los tipos de cuentas******/
    inventariotable = $('#inventariotable').DataTable({
        responsive: true,  
        pageLength: 10,
        ajax:{            
            url: "assets/app/inventario/inventario_controller.php?op=vermovimiento", 
            method: 'POST', 
            dataSrc:""
        },
        columns:[
            {data: "Descripcion"},
            {data: "Movimiento"},
            {data: "fecha_movimiento"},
            {data: "comentario"},
            {data: "usuario"},
            {data: "cantidad_anterior"},
            {data: "cantidad"},
            {data: "cantidad_actual"},
            
        ],
    })
    //************************************************/
    //********Accion mostrar el formulario para*******/
    //******crear o editar informacion de producto****/
    $('#btnproducto').click(function (e) { 
        e.preventDefault();
        limpiarFormulario()
        inventariotable.columns([2,3,5,6]).visible(false)
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
            data:  {producto:producto},
            success: function(data) {
                $('#listadeproducto').empty();
                $.each(data, function(idx, opt) {
                    $('#listadeproducto').append('<option>'+opt.Descripcion+'</option>');
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
            data:  {producto:producto},
            success: function(data) {
                $.each(data, function(idx, opt) {
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
        success: function(data) {
            $('#movimiento').append('<option value="">_-_Seleccione-_</option>');
            $.each(data, function(idx, opt) {
                $('#movimiento').append('<option value="'+opt.id+'">'+opt.Movimiento+'</option>');
            });
        }
    });
    //************************************************/
    //********Accion para Enviar y guardar la*********/
    //*********informacion del movimiento de inventario************/
    $('#formularioinventario').submit(function (e) { 
        e.preventDefault();
        id_producto= $('#idproducto').val();
        cantidad= $('#cantidad').val();
        movimiento= $('#movimiento').val();
        usuario= $('#usuario').val();
        comentario= $('#comentario').val();
        $.ajax({
            url: "assets/app//inventario/inventario_controller.php?op=VerCambiosCantidad",
            type: "POST",
            dataType:"json",    
            data: {id_producto:id_producto,cantidad:cantidad,movimiento:movimiento,usuario:usuario,comentario:comentario},  
            success: function(data) {
                if (data.status==true) {
                    Swal.fire({
                        icon: 'success',
                        html: '<h2>¡'+data.message+'!</h2>',
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
        inventariotable.columns([2,3,5,6]).visible(true)
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