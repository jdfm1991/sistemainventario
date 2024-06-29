<?php
session_name('intentario');
session_start();
require_once("../../../config/conexion.php");
require_once("usuario_model.php");

$usuario = new Usuario();

$id = (isset($_POST['id'])) ? $_POST['id'] : '3';
$nom_usuario = (isset($_POST['nom_usuario'])) ? $_POST['nom_usuario'] : '';
$ape_usuario = (isset($_POST['ape_usuario'])) ? $_POST['ape_usuario'] : '';
$contrasena = (isset($_POST['contrasenna'])) ? $_POST['contrasenna'] : '';
$correo = (isset($_POST['correo'])) ? $_POST['correo'] : '1';
$telefono = (isset($_POST['telefono'])) ? $_POST['telefono'] : '';
$rol = (isset($_POST['rol'])) ? $_POST['rol'] : '';
$estatus = (isset($_POST['estatus'])) ? $_POST['estatus'] : '';

switch ($_GET["op"]) {
    case 'vertodousuario':
        $dato = array();
        $data = $usuario->getDataUserAll();
        foreach ($data as $data) {
            $sub_array = array();
            $sub_array['id_cliente'] = $data['id_cliente'];
            $sub_array['nom_usuario'] = $data['nom_usuario'];
            $sub_array['ape_usuario'] = $data['ape_usuario'];
            $sub_array['correo'] = $data['correo'];
            $sub_array['rol'] = $data['rol'];
            $dato[] = $sub_array;

        }
        echo json_encode($dato, JSON_UNESCAPED_UNICODE); 
        break;

    case 'verusuario':
        $dato = array();
        $data = $usuario->verUsuario($id);
        foreach ($data as $data) {
            $sub_array = array();
            $sub_array['id_cliente'] = $data['id_cliente'];
            $sub_array['nom_usuario'] = $data['nom_usuario'];
            $sub_array['ape_usuario'] = $data['ape_usuario'];  
            $sub_array['contrasenna'] = $data['contrasenna'];
            $sub_array['correo'] = $data['correo'];
            $sub_array['telefono'] = $data['telefono'];
            $sub_array['rol'] = $data['rol'];
            $sub_array['estatus'] = $data['estatus'];
            $sub_array['bloqueo'] = $data['bloqueo'];
            $dato[] = $sub_array;
        }
        echo json_encode($dato, JSON_UNESCAPED_UNICODE); 
        break;

    case 'verroles':
        $dato = array();
        $data = $usuario->verRolesUsuarios();
        foreach ($data as $data) {
            $sub_array = array();
            $sub_array['id'] = $data['id'];
            $sub_array['rol'] = $data['rol'];
            $dato[] = $sub_array;
        }
        echo json_encode($dato, JSON_UNESCAPED_UNICODE); 
        break;
    case 'verestatus':
            $dato = array();
            $data = $usuario->verEstatusUsuarios();
            foreach ($data as $data) {
                $sub_array = array();
                $sub_array['id'] = $data['id'];
                $sub_array['estatus'] = $data['estatus'];
                $dato[] = $sub_array;
            }
            echo json_encode($dato, JSON_UNESCAPED_UNICODE); 
            break;
    case 'veropbloquear':
            $dato = array();
            $data = $usuario->Bloquearusuario();
             foreach ($data as $data) {
                    $sub_array = array();
                    $sub_array['id'] = $data['id'];
                    $sub_array['estatus'] = $data['estatus'];
                    $dato[] = $sub_array;
                }
                echo json_encode($dato, JSON_UNESCAPED_UNICODE); 
                break;
        
    case 'guargarusuario':
        $dato = array();
        if ($id) {
            if ($contrasena) {
                $contrasenna = password_hash($contrasena, PASSWORD_BCRYPT);
                $data = $usuario->actualizarDatosUsuario($id,$nom_usuario,$ape_usuario,$contrasenna,$correo,$telefono,$rol,$estatus);
                if ($data) {
                    $dato['status']  = true;
                    $dato['message'] = 'Se Actualizo La Infomacion de Manera Satisfactoria';
                } else {
                    $dato['status']  = false;
                    $dato['message'] = 'Error al Actualizar La Infomacion';
                }
            } else {
                $data = $usuario->actualizarDatosUsuario1($id,$nom_usuario,$ape_usuario,$correo,$telefono,$rol,$estatus);
                if ($data) {
                    $dato['status']  = true;
                    $dato['message'] = 'Se Actualizo La Infomacion de Manera Satisfactoria';
                } else {
                    $dato['status']  = false;
                    $dato['message'] = 'Error al Actualizar La Infomacion';
                }
            }
             
            
        } else {
            $contrasenna = password_hash($contrasena, PASSWORD_BCRYPT);
            $data = $usuario->guardarDatosUsuario($nom_usuario,$ape_usuario,$contrasenna,$correo,$telefono,$rol,$estatus);
            if ($data) {
                $dato['status']  = true;
                $dato['message'] = 'Se Guardo La Infomacion de Manera Satisfactoria';
            } else {
                $dato['status']  = false;
                $dato['message'] = 'Error al Guardar La Infomacion';
            }
        }
        echo json_encode($dato, JSON_UNESCAPED_UNICODE);
        break;

    case 'eliminarusuario':
        $dato = array();
        $data = $usuario->eliminarusuario($id);
        if ($data) {
            $dato['status']  = true;
            $dato['message'] = 'Se Elimino La Infomacion de Manera Satisfactoria';
        } else {
            $dato['status']  = false;
            $dato['message'] = 'Error al Elimino La Infomacion';
        }
        
        echo json_encode($dato, JSON_UNESCAPED_UNICODE);
        break;

    default:
        header("Location: ../../../");
        die();
        break;
}