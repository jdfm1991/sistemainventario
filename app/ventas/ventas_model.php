<?php
require_once("../../../config/conexion.php");

class Ventas extends Conectar
{

  public function verSiguienteFactura()
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "SELECT CONCAT('F-',LPAD(COUNT(*) + 1, 4, '0'), '/', YEAR(NOW())) AS n_fact
            FROM operacion_inventario
            WHERE year(fecha_o) = YEAR(NOW()) AND tipo_operacion=5";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->execute();
    return ($sql->fetch(PDO::FETCH_ASSOC)['n_fact']);
  }

  public function registrarVenta($idsujeto, $usuario, $documento, $fecha, $fecha2, $items, $cant, $subtotal, $excento, $base, $impuesto, $iva, $total, $Tipo_movimiento)
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "INSERT INTO operacion_inventario(sujeto, usuario, documento, fecha_o, fecha_r, cant_items, cant_producto, subtotal, excento, base, impuesto, iva, total, tipo_operacion ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $idsujeto);
    $sql->bindValue(2, $usuario);
    $sql->bindValue(3, $documento);
    $sql->bindValue(4, $fecha);
    $sql->bindValue(5, $fecha2);
    $sql->bindValue(6, $items);
    $sql->bindValue(7, $cant);
    $sql->bindValue(8, $subtotal);
    $sql->bindValue(9, $excento);
    $sql->bindValue(10, $base);
    $sql->bindValue(11, $impuesto);
    $sql->bindValue(12, $iva);
    $sql->bindValue(13, $total);
    $sql->bindValue(14, $Tipo_movimiento);
    return $sql->execute();
  }

  public function tomarExistencia($producto)
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "SELECT Cantidad FROM producto WHERE id_producto=?";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $producto);
    $sql->execute();
    return ($sql->fetch(PDO::FETCH_ASSOC)['Cantidad']);
  }

  public function guardarDatosProducto($producto, $cantidad, $costoinventario)
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $conectar = parent::conexion();
    parent::set_names();
    ///QUERY
    $sql = "UPDATE producto SET Cantidad=?,valor_inventario=? WHERE id_producto=?";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $cantidad);
    $sql->bindValue(2, $costoinventario);
    $sql->bindValue(3, $producto);
    return $sql->execute();
  }

  public function guardarDetalleVenta($producto, $Tipo_movimiento, $fecha2, $usuario, $cant, $existencia, $cantidad,$documento)
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $data = NULL;
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "INSERT INTO movimiento_inventario(codigo_producto, codigo_tmovi, fecha_movimiento, id_usuario, cantidad, cant_ant, nueva_cant, documento) VALUES (?,?,?,?,?,?,?,?)";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $producto);
    $sql->bindValue(2, $Tipo_movimiento);
    $sql->bindValue(3, $fecha2);
    $sql->bindValue(4, $usuario);
    $sql->bindValue(5, $cant);
    $sql->bindValue(6, $existencia);
    $sql->bindValue(7, $cantidad);
    $sql->bindValue(8, $documento);
    return $sql->execute();
  }

  public function verDatosventas()
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "SELECT A.id, B.nombre, C.nom_usuario, C.ape_usuario, D.Movimiento, documento, fecha_o, fecha_r, cant_items, cant_producto, subtotal, excento, base, iva, total 
    FROM operacion_inventario AS A 
    INNER JOIN sujeto AS B ON B.id=A.sujeto 
    INNER JOIN usuario AS C ON C.id_cliente=A.usuario 
    INNER JOIN tipo_movimiento AS D ON D.id=A.tipo_operacion 
    WHERE tipo_operacion = 5 ORDER BY documento  DESC";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  public function verDetallesCompras()
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "SELECT B.Descripcion, C.Movimiento, fecha_movimiento, comentario, D.nom_usuario, D.ape_usuario, cant_ant AS cantidad_anterior , A.cantidad, nueva_cant AS cantidad_actual FROM movimiento_inventario AS A INNER JOIN producto AS B ON A.codigo_producto=B.id_producto INNER JOIN tipo_movimiento AS C on A.codigo_tmovi=C.id INNER JOIN usuario as D on A.id_usuario=D.id_cliente ORDER BY fecha_movimiento DESC";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
  }
}
