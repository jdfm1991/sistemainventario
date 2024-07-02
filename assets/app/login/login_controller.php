<?php
session_name('intentario');
session_start();
require_once("../../../config/conexion.php");
require_once("login_model.php");

$login = new Login();

$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$name = (isset($_POST['name'])) ? $_POST['name'] : '';
$phone = (isset($_POST['phone'])) ? $_POST['phone'] : '';
$email = (isset($_POST['email'])) ? $_POST['email'] : 'admin@admin.com';
$passw = (isset($_POST['passw'])) ? $_POST['passw'] : '';

switch ($_GET["op"]) {
  case 'login':
    $dato = array();
    $data = $login->getLoginUser($email);
    if (is_array($data) and count($data) > 0) {
      foreach ($data as $data) {
        if ($data['estatus'] == 1) {
          if (password_verify($passw, $data['contrasenna'])) {
            //sesion
            $_SESSION['id_cliente'] = $data['id_cliente'];
            $_SESSION['contrasenna'] = $data['contrasenna'];
            $_SESSION['correo'] = $data['correo'];
            $_SESSION['rol'] = $data['id'];
            //para js
            $dato['status']  = true;
            $dato['rol'] = $data['rol'];
            $dato['idrol'] = $data['id'];
            $dato['message'] = 'Ingreso de Manera Exitosa, Sea Bienvenido!';
          } else {
            $dato['status']  = false;
            $dato['message'] = 'La Contraseña es incorrecto';
          }
        } else {
          $dato['status']  = false;
          $dato['message'] = 'Este usuario se encuentra bloqueado';
        }
      }
    } else {
      $dato['status']  = false;
      $dato['message'] = 'El Usuario es incorrecto';
    }
    echo json_encode($dato, JSON_UNESCAPED_UNICODE);
    break;

  case 'register':
    $id = uniqid();
    $passenc = password_hash($passw, PASSWORD_BCRYPT);
    $type = 2;
    $dato = array();
    $userDB = $home->getLoginUser($email);
    if ($userDB) {
      $dato['status']  = false;
      $dato['message'] = 'Ya se Encuentra un Usuario Registrado con ese Correo, Por Favor Verifique Informacion o Seleccione la Opcion de Olvide Contraseña';
    } else {
      $logreg = $home->setDataLogin($id, $email, $passenc, $type);
      if ($logreg) {
        $setdata = $home->setDataUser($id, $name, $phone);
        if ($setdata) {
          $data = $home->getLoginUser($email);
          if (is_array($data) and count($data) > 0) {
            foreach ($data as $data) {
              if (password_verify($passw, $data['passw'])) {
                $_SESSION['id'] = $data['id'];
                $_SESSION['email'] = $data['email'];
                $_SESSION['passw'] = $data['passw'];
                $_SESSION['idtype'] = $data['idtype'];
                $dato['status']  = true;
                $dato['message'] = 'Ingreso de Manera Exitosa, Sea Bienvenido!';
                $dato['idtype'] = $data['idtype'];
                $dato['type'] = $data['type'];
              } else {
                $dato['status']  = false;
                $dato['message'] = 'La Contraseña es incorrecto';
              }
            }
          } else {
            $dato['status']  = false;
            $dato['message'] = 'El Usuario es incorrecto';
          }
        } else {
          $dato['status']  = false;
          $dato['message'] = 'Error al Registrar Informacion de Nuevo Usuario!';
        }
      } else {
        $dato['status']  = false;
        $dato['message'] = 'Error al Registrar Nuevo Usuario!';
      }
    }
    echo json_encode($dato, JSON_UNESCAPED_UNICODE);
    break;

  case 'Valideteinfo':
    $dato = array();
    $data = $home->getDataInitialInfo($id);
    if ($data > 0) {
      $dato['status']  = true;
      $dato['message'] = 'Este Usuario No Posee La Infomacion de Perfil Completa, Desea Completarla Ahora?';
    }
    echo json_encode($dato, JSON_UNESCAPED_UNICODE);
    break;

  default:
    # code...
    break;
}
