$(document).ready(function () {
    //************************************************/
    //***********Evento para Mostrar modal************/
    //**************de inicio de sesion***************/
    $("#btnlogin").click(function (e) { 
        e.preventDefault();
        $(".modal-title").text("Inicio de Sesion")
        $("#messegel").hide();
        $("#optreg").hide();
        $("#name").prop('required',false);
        $("#phone").prop('required',false);
        $("#btnRegister").hide();
        $("#btnStart").show();
        $("#options").show();	
        $('#loginModal').modal('show');	
    });
    //************************************************/
    //***********Evento para registrar un ************/
    //******************nuevo usuario*****************/
    $('#lnkRegister').click(function (e) { 
        e.preventDefault();
        $("#btnStart").hide();
        $("#options").hide();
        $("#optreg").show();
        $("#name").prop('required',true);
        $("#phone").prop('required',true);
        $("#btnRegister").show();
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
            url: "assets/app/login/login_controller.php?op=login",
            type: "POST",
            dataType:"json",    
            data:  datos,
            cache: false,
            contentType: false,
            processData: false, 
            success: function(data) {
                if (data['status']==true) {
                    $('#loginModal').modal('hide');
                    //resetFormLogin()
                    Swal.fire({
                        icon: 'success',
                        title: 'Bienvenido...',
                        html: '<h2>¡Estimado '+data['rol']+'!</h2><br><h4>Usted '+data['message']+'</h4>',
                        showConfirmButton: false,
                        timer: 2000,
                        });
                    setTimeout(() => {
                        if (data['idrol']==1) {
                            $(location).attr('href','usuario.php');
                        }else{
                            location.reload();
                        }
                    }, 2000);
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
        $(location).attr('href','logout.php');
    });
});