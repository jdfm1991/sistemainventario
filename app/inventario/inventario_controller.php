<?php
session_name('intentario');
session_start();
date_default_timezone_set('america/caracas');
require_once("../../../config/conexion.php");
require_once("inventario_model.php");

$inventario = new Inventario();

$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$movimiento = (isset($_POST['movimiento'])) ? $_POST['movimiento'] : '';
$documento = (isset($_POST['documento'])) ? $_POST['documento'] : '';
$fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : date("Y-m-d");
$fecha2 = date("Y-m-d H:m:s");
$items = (isset($_POST['items'])) ? $_POST['items'] : '';
$cant = (isset($_POST['cant'])) ? $_POST['cant'] : '';
$total = (isset($_POST['total'])) ? $_POST['total'] : '';
$producto = (isset($_POST['producto'])) ? $_POST['producto'] : [];
$comentario = (isset($_POST['comentario'])) ? $_POST['comentario'] : '';

switch ($_GET["op"]) {

  case 'siguientemovimiento':
    $prefijo = '';
    if ($movimiento == 1) {
      $prefijo = 'C';
    }
    if ($movimiento == 2) {
      $prefijo = 'D';
    }
    if ($movimiento == 3) {
      $prefijo = 'A';
    }
    $dato = $inventario->verSiguienteMovimiento($prefijo,$movimiento);
    echo json_encode($dato, JSON_UNESCAPED_UNICODE);
    break;

  case 'vermovimiento':
    $dato = array();
    $data = $inventario->verMovimiento();
    foreach ($data as $data) {
      $sub_array = array();
      $sub_array['id'] = $data['id'];
      $sub_array['responsable'] = $data['nombre'];
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

  case 'vermovimientodatallado':
    $dato = array();
    $data = $inventario->verDetalleMovimiento();
    foreach ($data as $data) {
        $sub_array = array();
        $sub_array['id'] = $data['id'];
        $sub_array['Descripcion'] = $data['Descripcion'];
        $sub_array['Movimiento'] = $data['Movimiento'];
        $sub_array['fecha_movimiento'] = $data['fecha_movimiento'];
        $sub_array['documento'] = $data['documento'];
        $sub_array['comentario'] = $data['comentario'];
        $sub_array['usuario'] = $data['nom_usuario'].' '.$data['ape_usuario'];
        $sub_array['cantidad_anterior'] = number_format($data['cantidad_anterior'],2);
        $sub_array['cantidad'] = number_format($data['cantidad'],2);
        $sub_array['cantidad_actual'] = number_format($data['cantidad_actual'],2);
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

  case 'registar':
    $dato = array();
    $mov = $inventario->registrarMovimiento($usuario, $documento, $fecha, $fecha2, $items, $cant, $total, $movimiento);
    if ($mov) {
      $arr_prod = json_decode($producto, true);
      foreach ($arr_prod as $row) {
        $cantidad = 0;
        $producto = $row['idproducto'];
        $costo = $row['costact'];
        $cant = $row['countact'];
        $existencia = $inventario->tomarExistencia($producto);
        if ($movimiento == 1) {
          $cantidad = $existencia + $cant;
        }
        if ($movimiento == 2) {
          $cantidad = $existencia - $cant;
        }
        if ($movimiento == 3) {
          $cantidad = $cant;
        }
        $costoinventario = $cantidad * $costo;
        $guardarproducto = $inventario->guardarDatosProducto($producto, $cantidad, $costoinventario);
        if ($guardarproducto) {
          $itmscompra = $inventario->guardarDetalleMovimiento($producto, $movimiento, $fecha2, $usuario, $cant, $existencia, $cantidad,$documento);
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
      $dato['message'] = 'Error al Registrar Movimiento de Inventario';
    }
    echo json_encode($dato, JSON_UNESCAPED_UNICODE);
    break;
}
