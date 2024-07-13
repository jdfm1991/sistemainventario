<?php
require_once("../../config/abrir_sesion.php");
require_once("../../config/conexion.php");
require_once("usuario_model.php");

$usuario = new Usuario();

//---- Variables Para Inicion de Sesion---//
$email = (isset($_POST['email'])) ? $_POST['email'] : '';
$passw = (isset($_POST['passw'])) ? $_POST['passw'] : '';

//---- Variables Para Registro de Usuario---//
$id = (isset($_POST['id'])) ? $_POST['id'] : '1';
$login_usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$nom_usuario = (isset($_POST['nom_usuario'])) ? $_POST['nom_usuario'] : '';
$ape_usuario = (isset($_POST['ape_usuario'])) ? $_POST['ape_usuario'] : '';
$correo = (isset($_POST['correo'])) ? $_POST['correo'] : 'admin@admin.com';
$contrasena = (isset($_POST['contrasenna'])) ? $_POST['contrasenna'] : '';
$telefono = (isset($_POST['telefono'])) ? $_POST['telefono'] : '';
$rol = (isset($_POST['rol'])) ? $_POST['rol'] : '';
$estatus = (isset($_POST['estatus'])) ? $_POST['estatus'] : '';

switch ($_GET["op"]) {

  case 'login':
    $dato = array();
    $data = $usuario->getLoginUser($email);
    if (is_array($data) and count($data) > 0) {
      foreach ($data as $data) {
        if ($data['user_status'] == 1) {
          if (password_verify($passw, $data['user_password'])) {
            //sesion
            $_SESSION['id'] = $data['id'];
            $_SESSION['rol'] = $data['user_rol'];
            //para js
            $dato['status']  = true;
            $dato['rol'] = $data['user_rol'];
            $dato['user'] = $data['user_name'].' '.$data['user_last_name'];
            $dato['message'] = 'Ingreso de Manera Exitosa, Sea Bienvenido!';
          } else {
            $dato['status']  = false;
            $dato['message'] = 'La Contraseña es incorrecto';
          }
        } else {
          $dato['status']  = false;
          $dato['message'] = 'Este Usuario Se Encuentra Inactivo';
        }
      }
    } else {
      $dato['status']  = false;
      $dato['message'] = 'El Usuario es incorrecto';
    }
    echo json_encode($dato, JSON_UNESCAPED_UNICODE);
    break;

  case 'showdatausers':
    $dato = array();
    if ($_SESSION['rol'] == 1) {
      $data = $usuario->showDataUsers();
    } else {
      $data = $usuario->showDataUsers1();
    }
    foreach ($data as $data) {
      $sub_array = array();
      $sub_array['id'] = $data['id'];
      $sub_array['user'] = $data['user'];
      $sub_array['name'] = $data['user_name'].' '.$data['user_last_name'];
      $sub_array['user_email'] = $data['user_email'];
      $sub_array['user_rol'] = $data['user_rol'];
      $sub_array['user_status'] = $data['user_status'];
      $dato[] = $sub_array;
    }
    echo json_encode($dato, JSON_UNESCAPED_UNICODE);
    break;

  case 'showdatauser':
    $dato = array();
    $data = $usuario->showDataUsersById($id);
    foreach ($data as $data) {
      $sub_array = array();
      $sub_array['id'] = $data['id'];
      $sub_array['user'] = $data['user'];
      $sub_array['user_name'] = $data['user_name'];
      $sub_array['user_last_name'] = $data['user_last_name'];
      $sub_array['user_email'] = $data['user_email'];
      $sub_array['user_phone'] = $data['user_phone'];
      $sub_array['user_rol'] = $data['user_rol'];
      $sub_array['user_status'] = $data['user_status'];
      $dato[] = $sub_array;
    }
    echo json_encode($dato, JSON_UNESCAPED_UNICODE);
    break;

  case 'showdataroles':
    $dato = array();
    if ($_SESSION['rol'] == 1) {
      $data = $usuario->showDataRoles();
    } else {
      $data = $usuario->showDataRoles1();
    }
    foreach ($data as $data) {
      $sub_array = array();
      $sub_array['id'] = $data['id'];
      $sub_array['rol'] = $data['user_rol'];
      $dato[] = $sub_array;
    }
    echo json_encode($dato, JSON_UNESCAPED_UNICODE);
    break;
  case 'showdatastatus':
    $dato = array();
    $data = $usuario->showDataStatus();
    foreach ($data as $data) {
      $sub_array = array();
      $sub_array['id'] = $data['id'];
      $sub_array['estatus'] = $data['user_status'];
      $dato[] = $sub_array;
    }
    echo json_encode($dato, JSON_UNESCAPED_UNICODE);
    break;

  case 'saveuserdata':
    $dato = array();
    if ($id) {
      if ($contrasena) {
        $contrasenna = password_hash($contrasena, PASSWORD_BCRYPT);
        $data = $usuario->updateUserData($id, $nom_usuario, $ape_usuario, $contrasenna, $correo, $telefono, $rol, $estatus, $login_usuario);
        if ($data) {
          $dato['status']  = true;
          $dato['message'] = 'Se Actualizo La Infomacion de Manera Satisfactoria';
        } else {
          $dato['status']  = false;
          $dato['message'] = 'Error al Actualizar La Infomacion';
        }
      } else {
        $data = $usuario->updateUserData1($id, $nom_usuario, $ape_usuario, $correo, $telefono, $rol, $estatus,$login_usuario);
        if ($data) {
          $dato['status']  = true;
          $dato['message'] = 'Se Actualizo La Infomacion de Manera Satisfactoria';
        } else {
          $dato['status']  = false;
          $dato['message'] = 'Error al Actualizar La Infomacion';
        }
      }
    } else {
      $mailexist = $usuario->getUserDataByEmail($correo);
      if (!$mailexist) {
        $userexist = $usuario->getUserDataByUser($login_usuario);
        if (!$userexist) {
          $contrasenna = password_hash($contrasena, PASSWORD_BCRYPT);
          $data = $usuario->NewUserData($login_usuario,$nom_usuario, $ape_usuario, $contrasenna, $correo, $telefono, $rol, $estatus);
          if ($data) {
            $dato['status']  = true;
            $dato['message'] = 'Se Guardo La Infomacion de Manera Satisfactoria';
          } else {
            $dato['status']  = false;
            $dato['message'] = 'Error al  Guardar La Infomacion';
          }
        } else {
          $dato['status']  = false;
          $dato['message'] = 'Este Usuario ya se Encuentra en Uso';
        }
      } else {
        $dato['status']  = false;
        $dato['message'] = 'Este Correo ya se Encuentra en Uso';
      }
      
    }
    echo json_encode($dato, JSON_UNESCAPED_UNICODE);
    break;

  case 'deleteuserdata':
    $dato = array();
    $rol = $usuario->getUserRolById($id);
    if ($rol == 1) {
      $limite = $usuario->countUserRolSU($rol);
      if ($limite > 1) {
        $data = $usuario->deleteUserData($id);
        if ($data) {
          $dato['status']  = true;
          $dato['message'] = 'Se Elimino La Infomacion de Manera Satisfactoria';
        } else {
          $dato['status']  = false;
          $dato['message'] = 'Error al Elimino La Infomacion';
        }
      } else {
        $dato['status']  = false;
        $dato['message'] = 'No Se Puede Eliminar Este Usuario, El Sistema Debe de Tener Al Menos Un Super Usuario';
      }
    } else {
      $data = $usuario->deleteUserData($id);
      if ($data) {
        $dato['status']  = true;
        $dato['message'] = 'Se Elimino La Infomacion de Manera Satisfactoria';
      } else {
        $dato['status']  = false;
        $dato['message'] = 'Error al Elimino La Infomacion';
      }
    }
    echo json_encode($dato, JSON_UNESCAPED_UNICODE);
    break;

  default:
    header("Location: ../../");
    die();
    break;
}
