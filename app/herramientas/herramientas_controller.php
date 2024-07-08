<?php
date_default_timezone_set('america/caracas');
require_once("../../config/abrir_sesion.php");
require_once("../../config/conexion.php");
require_once("herramientas_model.php");

$herramientas = new Herramientas();

$departamento = (isset($_POST['departamento'])) ? $_POST['departamento'] : '';

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
    $data = $herramientas->verDepartamentos();
    foreach ($data as $data) {
      $sub_array = array();
      $sub_array['id'] = $data['id'];
      $sub_array['nombre'] = $data['nombre'];
      $sub_array['descripcion'] = $data['descripcion'];
      $dato[] = $sub_array;
    }
    echo json_encode($dato, JSON_UNESCAPED_UNICODE);
    break;

    case 'guardarepartamento':
      $data = $herramientas->guardarDepartamento($departamento);
      if ($data) {
        $dato['status']  = true;
        $dato['message'] = 'Se Guardo La Infomacion de Manera Satisfactoria';
      } else {
        $dato['status']  = false;
        $dato['message'] = 'Error al Guardar La Infomacion';
      }
      echo json_encode($dato, JSON_UNESCAPED_UNICODE);
      break;

    case 'vermodulos':
      $dato = array();
      $data = $herramientas->verDepartamentos();
      foreach ($data as $data) {
        $sub_array = array();
        $sub_array['id'] = $data['id'];
        $sub_array['nombre'] = $data['nombre'];
        $sub_array['descripcion'] = $data['descripcion'];
        $dato[] = $sub_array;
      }
      echo json_encode($dato, JSON_UNESCAPED_UNICODE);
      break;

}
