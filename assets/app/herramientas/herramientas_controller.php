<?php
session_name('intentario');
session_start();
date_default_timezone_set('america/caracas');
require_once("../../../config/conexion.php");
require_once("herramientas_model.php");

$herramientas = new Herramientas();

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
}
