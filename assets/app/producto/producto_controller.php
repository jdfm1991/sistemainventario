<?php
session_name('intentario');
session_start();
require_once("../../../config/conexion.php");
require_once("producto_model.php");

$producto = new Producto();

$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$product = (isset($_POST['producto'])) ? $_POST['producto'] : '';
$categoria = (isset($_POST['categoria'])) ? $_POST['categoria'] : '';
$familia = (isset($_POST['familia'])) ? $_POST['familia'] : '';
$ubicacion = (isset($_POST['ubicacion'])) ? $_POST['ubicacion'] : '';
$unidad = (isset($_POST['unidad'])) ? $_POST['unidad'] : '';
$cantidad = (isset($_POST['cantidad'])) ? $_POST['cantidad'] : '';
$costo_unidad = (isset($_POST['costo_unidad'])) ? $_POST['costo_unidad'] : '';
$valor_inventario = (isset($_POST['valor_inventario'])) ? $_POST['valor_inventario'] : '';

switch ($_GET["op"]) {
    
    case 'vertodoproducto':
        $dato = array();
        $data = $producto->verTodosProducto();
        foreach ($data as $data) {
            $sub_array = array();
            $sub_array['id_producto'] = $data['id_producto'];
            $sub_array['Categoria'] = $data['Categoria'];
            $sub_array['Familia'] = $data['Familia'];
            $sub_array['Ubicacion'] = $data['Ubicacion'];
            $sub_array['Descripcion'] = $data['Descripcion'];
            $sub_array['Unidad'] = $data['Unidad'];
            $sub_array['Cantidad'] = number_format($data['Cantidad'],2);
            $sub_array['Costo_unidad'] = number_format($data['Costo_unidad'],2);
            $sub_array['valor_inventario'] = number_format($data['valor_inventario'],2);
            $dato[] = $sub_array;
        }
        echo json_encode($dato, JSON_UNESCAPED_UNICODE); 
        break;

    case 'verproducto':
        $dato = array();
        $data = $producto->verProducto($id);
        foreach ($data as $data) {
            $sub_array = array();
            $sub_array['id_producto'] = $data['id_producto'];
            $sub_array['Categoria'] = $data['Categoria'];
            $sub_array['Familia'] = $data['Familia'];
            $sub_array['Ubicacion'] = $data['Ubicacion'];
            $sub_array['Descripcion'] = $data['Descripcion'];
            $sub_array['Unidad'] = $data['Unidad'];
            $sub_array['Cantidad'] = number_format($data['Cantidad'],2);
            $sub_array['Costo_unidad'] = number_format($data['Costo_unidad'],2);
            $sub_array['valor_inventario'] = number_format($data['valor_inventario'],2);
            $dato[] = $sub_array;
        }
        echo json_encode($dato, JSON_UNESCAPED_UNICODE); 
        break;

    case 'vercategorias':
        $dato = array();
        $data = $producto->verCategorias();
        foreach ($data as $data) {
            $sub_array = array();
            $sub_array['id'] = $data['id'];
            $sub_array['categoria'] = $data['categoria'];
            $dato[] = $sub_array;
        }
        echo json_encode($dato, JSON_UNESCAPED_UNICODE); 
        break;

    case 'verfamilias':
        $dato = array();
        $data = $producto->verFamilia();
        foreach ($data as $data) {
            $sub_array = array();
            $sub_array['id'] = $data['id'];
            $sub_array['familia'] = $data['familia'];
            $dato[] = $sub_array;
        }
        echo json_encode($dato, JSON_UNESCAPED_UNICODE); 
        break;

    case 'verubicaciones':
        $dato = array();
        $data = $producto->verUbicaciones();
        foreach ($data as $data) {
            $sub_array = array();
            $sub_array['id'] = $data['id'];
            $sub_array['ubicacion'] = $data['ubicacion'];
            $dato[] = $sub_array;
        }
        echo json_encode($dato, JSON_UNESCAPED_UNICODE); 
        break;

    case 'verunidades':
        $dato = array();
        $data = $producto->verUnidades();
        foreach ($data as $data) {
            $sub_array = array();
            $sub_array['id'] = $data['id'];
            $sub_array['unidad'] = $data['unidad'];
            $dato[] = $sub_array;
        }
        echo json_encode($dato, JSON_UNESCAPED_UNICODE); 
        break;

    case 'guargarproducto':
        $dato = array();
        if ($id) {
            $data = $producto->actualizarDatosProductos($id,$product,$categoria,$familia,$ubicacion,$unidad,$cantidad,$costo_unidad,$valor_inventario);
            if ($data) {
                $dato['status']  = true;
                $dato['message'] = 'Se Actualizo La Infomacion de Manera Satisfactoria';
            } else {
                $dato['status']  = false;
                $dato['message'] = 'Error al Actualizar La Infomacion';
            }
        } else {
            $data = $producto->guardarDatosProductos($product,$categoria,$familia,$ubicacion,$unidad,$cantidad,$costo_unidad,$valor_inventario);
            if ($data) {
                $dato['status']  = true;
                $dato['message'] = 'Se Guardo La Infomacion de Manera Satisfactoria';
            } else {
                $dato['status']  = false;
                $dato['message'] = 'Error al Guardar La Infomacion';
            }
        }
        echo json_encode($dato, JSON_UNESCAPED_UNICODE);
        break;

    case 'eliminarproducto':
        $dato = array();
        $data = $producto->eliminarProducto($id);
        if ($data) {
            $dato['status']  = true;
            $dato['message'] = 'Se Elimino La Infomacion de Manera Satisfactoria';
        } else {
            $dato['status']  = false;
            $dato['message'] = 'Error al Elimino La Infomacion';
        }
        
        echo json_encode($dato, JSON_UNESCAPED_UNICODE);
        break;
        
    default:
        header("Location: ../../../");
        die();
        break;
}