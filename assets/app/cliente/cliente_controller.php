<?php
session_name('intentario');
session_start();
require_once("../../../config/conexion.php");
require_once("cliente_model.php");

$cliente = new Cliente();

$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch ($_GET["op"]) {
  case 'verclientes':
    $dato = array();
    $data = $cliente->verDatosClientes();
    foreach ($data as $data) {
      $sub_array = array();
      $sub_array['id'] = $data['id'];
      $sub_array['nombre'] = $data['nombre'];
      $sub_array['codigo'] = $data['codigo'];
      $dato[] = $sub_array;
    }
    echo json_encode($dato, JSON_UNESCAPED_UNICODE);
    break;

  case 'vercliente':
    $dato = array();
    $data = $cliente->verDatosCiente($id);
    foreach ($data as $data) {
      $sub_array = array();
      $sub_array['id'] = $data['id'];
      $sub_array['nombre'] = $data['nombre'];
      $sub_array['codigo'] = $data['codigo'];
      $dato[] = $sub_array;
    }
    echo json_encode($dato, JSON_UNESCAPED_UNICODE);
    break;

  default:
    header("Location: ../../../");
    die();
    break;
}
