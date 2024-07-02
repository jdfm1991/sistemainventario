<?php
session_name('intentario');
session_start();
date_default_timezone_set('america/caracas');
require_once("../../../config/conexion.php");
require_once("inventario_model.php");

$inventario = new Inventario();

$id_producto = (isset($_POST['id_producto'])) ? $_POST['id_producto'] : '';
$cantidad = (isset($_POST['cantidad'])) ? $_POST['cantidad'] : '';
$movimiento = (isset($_POST['movimiento'])) ? $_POST['movimiento'] : '';
$producto = (isset($_POST['producto'])) ? $_POST['producto'] : '';
$comentario = (isset($_POST['comentario'])) ? $_POST['comentario'] : '';
$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';

switch ($_GET["op"]) {
  case 'vermovimiento':
    $dato = array();
    $data = $inventario->verMovimiento();
    foreach ($data as $data) {
      $sub_array = array();
      $sub_array['Descripcion'] = $data['Descripcion'];
      $sub_array['Movimiento'] = $data['Movimiento'];
      $sub_array['fecha_movimiento'] = $data['fecha_movimiento'];
      $sub_array['comentario'] = $data['comentario'];
      $sub_array['usuario'] = $data['nom_usuario'] . ' ' . $data['ape_usuario'];
      $sub_array['cantidad_anterior'] = number_format($data['cantidad_anterior'], 2);
      $sub_array['cantidad'] = number_format($data['cantidad'], 2);
      $sub_array['cantidad_actual'] = number_format($data['cantidad_actual'], 2);
      $dato[] = $sub_array;
    }
    echo json_encode($dato, JSON_UNESCAPED_UNICODE);
    break;

  case 'verlistproducto':
    $dato = array();
    $data = $inventario->verListaProducto($producto);
    foreach ($data as $data) {
      $sub_array = array();
      $sub_array['Descripcion'] = $data['Descripcion'];
      $dato[] = $sub_array;
    }
    echo json_encode($dato, JSON_UNESCAPED_UNICODE);
    break;

  case 'verproducto':
    $dato = array();
    $data = $inventario->verProducto($producto);
    foreach ($data as $data) {
      $sub_array = array();
      $sub_array['id_producto'] = $data['id_producto'];
      $sub_array['Descripcion'] = $data['Descripcion'];
      $dato[] = $sub_array;
    }
    echo json_encode($dato, JSON_UNESCAPED_UNICODE);
    break;

  case 'vertipomovimiento':
    $dato = array();
    $data = $inventario->verTipoMovimiento();
    foreach ($data as $data) {
      $sub_array = array();
      $sub_array['id'] = $data['id'];
      $sub_array['Movimiento'] = $data['Movimiento'];
      $dato[] = $sub_array;
    }
    echo json_encode($dato, JSON_UNESCAPED_UNICODE);
    break;

  case 'VerCambiosCantidad':
    $dato = array();
    $nueva_cant = 0;
    $cantidad_act = 0;
    $ahora = date("Y-m-d H:m:s");
    if ($id_producto) {
      $data = $inventario->verProductoporId($id_producto);
      foreach ($data as $data) {
        $cantidad_act = $data['Cantidad'];
        $costo_act = $data['Costo_unidad'];
      }
      if ($movimiento == 1) {
        $nueva_cant = $cantidad_act + $cantidad;
      }
      if ($movimiento == 2) {
        $nueva_cant = $cantidad_act - $cantidad;
      }
      if ($movimiento == 3) {
        $nueva_cant = $cantidad;
      }
      $nuevo_valor = $nueva_cant * $costo_act;

      $datains = $inventario->guardarMovimiento(
        $id_producto,
        $movimiento,
        $ahora,
        $comentario,
        $usuario,
        $cantidad,
        $cantidad_act,
        $nueva_cant
      );
      if ($datains) {
        $dataupd = $inventario->actualizarProductoPorId($id_producto, $nueva_cant, $nuevo_valor);
        if ($dataupd) {
          $dato['status']  = true;
          $dato['message'] = 'Se Guardo La Infomacion de Manera Satisfactoria';
        } else {
          $dato['status']  = false;
          $dato['message'] = 'Error al Guardar La Infomacion';
        }
      } else {
        $dato['status']  = false;
        $dato['message'] = 'Error al Guardar La Infomacion';
      }
    } else {
      $dato['status']  = true;
      $dato['message'] = 'Producto no existe';
    }
    echo json_encode($dato, JSON_UNESCAPED_UNICODE);
    break;
}
