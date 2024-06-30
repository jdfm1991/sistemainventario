<?php
session_name('intentario');
session_start();
require_once("../../../config/conexion.php");
require_once("compras_model.php");

$compras = new Compras();

$idsujeto = (isset($_POST['idsujeto'])) ? $_POST['idsujeto'] : '1';
$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '1';
$documento = (isset($_POST['documento'])) ? $_POST['documento'] : '1';
$fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : date("Y-m-d");
$fecha2 = date("Y-m-d H:m:s");
$items = (isset($_POST['items'])) ? $_POST['items'] : '1';
$cant = (isset($_POST['cant'])) ? $_POST['cant'] : '1';
$subtotal = (isset($_POST['subtotal'])) ? $_POST['subtotal'] : '1';
$excento = (isset($_POST['excento'])) ? $_POST['excento'] : '1';
$base = (isset($_POST['base'])) ? $_POST['base'] : '1';
$impuesto = (isset($_POST['impuesto'])) ? $_POST['impuesto'] : '1';
$iva = (isset($_POST['iva'])) ? $_POST['iva'] : '1';
$total = (isset($_POST['total'])) ? $_POST['total'] : '1';

switch ($_GET["op"]) {
  case 'registar':
    $dato = array();
    $compra = $compras->registrarCompra(
      $idsujeto,
      $usuario,
      $documento,
      $fecha,
      $fecha2,
      $items,
      $cant,
      $subtotal,
      $excento,
      $base,
      $impuesto,
      $iva,
      $total
    );
    if ($compra) {
      $dato['status']  = true;
      $dato['message'] = 'Se Registro Informacion de Manera Exitosa';
    } else {
      $dato['status']  = false;
      $dato['message'] = 'Error al Registrar la Informacion';
    }
    echo json_encode($dato, JSON_UNESCAPED_UNICODE);
    break;

  default:
    # code...
    break;
}
