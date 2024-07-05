<?php
session_name('intentario');
session_start();
date_default_timezone_set('america/caracas');
require_once("../../../config/conexion.php");
require_once("ventas_model.php");

$ventas = new Ventas();

$idsujeto = (isset($_POST['idsujeto'])) ? $_POST['idsujeto'] : '';
$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$documento = (isset($_POST['documento'])) ? $_POST['documento'] : '';
$fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : date("Y-m-d");
$fecha2 = date("Y-m-d H:m:s");
$items = (isset($_POST['items'])) ? $_POST['items'] : '';
$cant = (isset($_POST['cant'])) ? $_POST['cant'] : '';
$subtotal = (isset($_POST['subtotal'])) ? $_POST['subtotal'] : '';
$excento = (isset($_POST['excento'])) ? $_POST['excento'] : 0;
$base = (isset($_POST['base'])) ? $_POST['base'] : '';
$impuesto = (isset($_POST['impuesto'])) ? $_POST['impuesto'] : '';
$iva = (isset($_POST['iva'])) ? $_POST['iva'] : '';
$total = (isset($_POST['total'])) ? $_POST['total'] : '';
$producto = (isset($_POST['producto'])) ? $_POST['producto'] : [];

switch ($_GET["op"]) {

  case 'siguientefactura':
    $dato = $ventas->verSiguienteFactura();
    echo json_encode($dato, JSON_UNESCAPED_UNICODE);
    break;

  case 'registar':
    $dato = array();
    $Tipo_movimiento = 5;
    $compra = $ventas->registrarVenta($idsujeto, $usuario, $documento, $fecha, $fecha2, $items, $cant, $subtotal, $excento,    $base, $impuesto, $iva, $total, $Tipo_movimiento);
    if ($compra) {
      $arr_prod = json_decode($producto, true);
      foreach ($arr_prod as $row) {
        $producto = $row['idproducto'];
        $costo = $row['costact'];
        $cant = $row['countact'];
        $existencia = $ventas->tomarExistencia($producto);
        $cantidad = $existencia - $cant;
        $costoinventario = $cantidad * $costo;
        $guardarproducto = $ventas->guardarDatosProducto($producto, $cantidad, $costoinventario);
        if ($guardarproducto) {
          $itmscompra = $ventas->guardarDetalleVenta($producto, $Tipo_movimiento, $fecha2, $usuario, $cant, $existencia, $cantidad);
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

  case 'verventas':
    $dato = array();
    $data = $ventas->verDatosventas();
    foreach ($data as $data) {
      $sub_array = array();
      $sub_array['id'] = $data['id'];
      $sub_array['cliente'] = $data['nombre'];
      $sub_array['usuario'] = $data['nom_usuario'].' '.$data['ape_usuario'];
      $sub_array['Movimiento'] = $data['Movimiento'];
      $sub_array['documento'] = $data['documento'];
      $sub_array['fecha_o'] = $data['fecha_o'];
      $sub_array['fecha_r'] = $data['fecha_r'];
      $sub_array['cant_items'] = number_format($data['cant_items'], 2);
      $sub_array['cant_producto'] = number_format($data['cant_producto'], 2);
      $sub_array['subtotal'] = number_format($data['subtotal'], 2);
      $sub_array['excento'] = number_format($data['excento'], 2);
      $sub_array['base'] = number_format($data['base'], 2);
      $sub_array['iva'] = number_format($data['iva'], 2);
      $sub_array['total'] = number_format($data['total'], 2);
      $dato[] = $sub_array;
    }
    echo json_encode($dato, JSON_UNESCAPED_UNICODE);
    break;

  default:
    # code...
    break;
}
