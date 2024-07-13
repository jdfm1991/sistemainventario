<?php
date_default_timezone_set('america/caracas');
require_once("../../config/abrir_sesion.php");
require_once("../../config/conexion.php");
require_once("herramientas_model.php");

$herramientas = new Herramientas();

$departamento = (isset($_POST['departamento'])) ? $_POST['departamento'] : '';
$posision = (isset($_POST['posision'])) ? $_POST['posision'] : '';
$modulo = (isset($_POST['modulo'])) ? $_POST['modulo'] : '';
$detalle = (isset($_POST['detalle'])) ? $_POST['detalle'] : '';

switch ($_GET["op"]) {

  case 'impuestos':
    $dato = array();
    $data = $herramientas->verImpuestos();
    foreach ($data as $data) {
      $sub_array = array();
      $sub_array['id'] = $data['id'];
      $sub_array['impuesto'] = $data['impuesto'];
      $sub_array['estatus'] = $data['estatus'];
      $dato[] = $sub_array;
    }
    echo json_encode($dato, JSON_UNESCAPED_UNICODE);
    break;

  case 'verdepartamentos':
    $dato = array();
    $data = $herramientas->showDepartmentData();
    foreach ($data as $data) {
      $sub_array = array();
      $sub_array['id'] = $data['id'];
      $sub_array['department'] = $data['department'];
      $sub_array['position'] = $data['position'];
      $sub_array['detail'] = $data['detail'];
      $dato[] = $sub_array;
    }
    echo json_encode($dato, JSON_UNESCAPED_UNICODE);
    break;

  case 'savedepartment':
    $dato = array();
    $data = $herramientas->saveDepartmentData($departamento, $posision, $detalle);
    if ($data) {
      if ($_SESSION['rol'] == 1) {
        $id = $herramientas->getDepartmentDataByName($departamento);
        if ($id) {
          $data1 = $herramientas->saveDepartmentRolePermissions($id, $_SESSION['rol']);
          if ($data1) {
            $dato['status']  = true;
            $dato['message'] = 'Se Guardo La Infomacion de Manera Satisfactoria';
          } else {
            $dato['status']  = false;
            $dato['message'] = 'Error al Guardar La Infomacion';
          }
        } else {
          $dato['status']  = true;
          $dato['message'] = 'Error al Encontrar ID de Departamento';
        }
      }
    } else {
      $dato['status']  = false;
      $dato['message'] = 'Error al Guardar La Infomacion';
    }
    echo json_encode($dato, JSON_UNESCAPED_UNICODE);
    break;

  case 'vermodulos':
    $dato = array();
    $data = $herramientas->verModulos();
    foreach ($data as $data) {
      $sub_array = array();
      $sub_array['id'] = $data['id'];
      $sub_array['modulo'] = $data['modulo'];
      $sub_array['departamento'] = $data['departamento'];
      $sub_array['descripcion'] = $data['descripcion'];
      $dato[] = $sub_array;
    }
    echo json_encode($dato, JSON_UNESCAPED_UNICODE);
    break;

  case 'listamodulos':
    $dato = array();
    $omision = array('herramientas', 'foot.php', 'gestionsu.php', 'head.php', 'index.php', 'menu.php');
    $data = $herramientas->verModulos();
    $fichero = new FilesystemIterator(PATH_APP);
    foreach ($data as $row) {
      array_push($omision, $row['modulo']);
    }
    foreach ($fichero as $row) {
      $modulo = array();
      if (!in_array($row->getFilename(), $omision)) {
        $modulo['modulo'] =  $row->getFilename();
      }
      if (!empty($modulo)) {
        $dato[] = $modulo;
      }
    }
    echo json_encode($dato, JSON_UNESCAPED_UNICODE);
    break;

  case 'guardarmodulo':
    $data = $herramientas->guardarModulo($modulo, $departamento);
    if ($data) {
      $dato['status']  = true;
      $dato['message'] = 'Se Guardo La Infomacion de Manera Satisfactoria';
    } else {
      $dato['status']  = false;
      $dato['message'] = 'Error al Guardar La Infomacion';
    }
    echo json_encode($dato, JSON_UNESCAPED_UNICODE);
    break;

  case 'showmenurol':
    $dato = array();
    $data = $herramientas->showDepartmentRolePermissions($_SESSION['rol']);
    foreach ($data as $data) {
      $sub_array = array();
      $departamento = $data['id'];
      $sub_array['department'] = $data['department'];
      /*
      $sub_array['modulo'] = [];
      $modulo = $herramientas->verModuloDepartamento($departamento);
      foreach ($modulo as $row) {
        $module_arr = array();
        $module_arr['modulo'] = $row['modulo'];
        array_push($sub_array['modulo'],$module_arr);
      }*/
      $dato[] = $sub_array;
    }
    echo json_encode($dato, JSON_UNESCAPED_UNICODE);
    break;

  default:
    header("Location: ../../");
    die();
    break;
}
