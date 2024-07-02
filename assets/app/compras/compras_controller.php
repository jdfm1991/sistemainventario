<?php
session_name('intentario');
session_start();
date_default_timezone_set('america/caracas');
require_once("../../../config/conexion.php");
require_once("compras_model.php");

$compras = new Compras();

$idsujeto = (isset($_POST['idsujeto'])) ? $_POST['idsujeto'] : '';
$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$documento = (isset($_POST['documento'])) ? $_POST['documento'] : '';
$fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : date("Y-m-d");
$fecha2 = date("Y-m-d H:m:s");
$items = (isset($_POST['items'])) ? $_POST['items'] : '';
$cant = (isset($_POST['cant'])) ? $_POST['cant'] : '';
$subtotal = (isset($_POST['subtotal'])) ? $_POST['subtotal'] : '';
$excent = (isset($_POST['excento'])) ? $_POST['excento'] : '';
$base = (isset($_POST['base'])) ? $_POST['base'] : '';
$impuesto = (isset($_POST['impuesto'])) ? $_POST['impuesto'] : '';
$iva = (isset($_POST['iva'])) ? $_POST['iva'] : '';
$total = (isset($_POST['total'])) ? $_POST['total'] : '';
$producto = (isset($_POST['producto'])) ? $_POST['producto'] : [];

switch ($_GET["op"]) {
  case 'registar':
    $dato = array();
    $excento = ($excent) ? $excent : 0;
    $Tipo_movimiento = 4;
    $compra = $compras->registrarCompra($idsujeto, $usuario, $documento, $fecha, $fecha2, $items, $cant, $subtotal, $excento,    $base, $impuesto, $iva, $total);
    if ($compra) {
      $arr_prod = json_decode($producto, true);
      foreach ($arr_prod as $row) {
        $producto = $row['idproducto'];
        $costo = $row['costact'];
        $cant = $row['countact'];
        $existencia = $compras->tomarExistencia($producto);
        $cantidad = $cant + $existencia;
        $costoinventario = $cantidad * $costo;
        $guardarproducto = $compras->guardarDatosProducto($producto, $cantidad, $costoinventario);
        if ($guardarproducto) {
          $itmscompra = $compras->guardarDetalleCompra($producto, $Tipo_movimiento, $fecha2, $usuario, $cant, $existencia, $cantidad);
          if ($itmscompra) {
            $dato['status']  = true;
            $dato['message'] = 'Se Registro Informacion de Manera Exitosa';
          } else {
            $dato['status']  = false;
            $dato['message'] = 'Error al Cargar Movimiento de Inventario';
          }
        } else {
          $dato['status']  = false;
          $dato['message'] = 'Error al Actualizar Producto';
        }
      }
    } else {
      $dato['status']  = false;
      $dato['message'] = 'Error al Registrar la Compra';
    }
    echo json_encode($dato, JSON_UNESCAPED_UNICODE);
    break;

  default:
    # code...
    break;
}
