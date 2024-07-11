<?php
require_once("../../config/conexion.php");

class Inventario extends Conectar
{

  public function registrarMovimiento($usuario, $documento, $fecha, $fecha2, $items, $cant, $total, $movimiento)
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "INSERT INTO operacion_inventario(sujeto, usuario, documento, fecha_o, fecha_r, cant_items, cant_producto, subtotal, total, tipo_operacion ) VALUES (?,?,?,?,?,?,?,?,?,?)";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $usuario);
    $sql->bindValue(2, $usuario);
    $sql->bindValue(3, $documento);
    $sql->bindValue(4, $fecha);
    $sql->bindValue(5, $fecha2);
    $sql->bindValue(6, $items);
    $sql->bindValue(7, $cant);
    $sql->bindValue(8, $total);
    $sql->bindValue(9, $total);
    $sql->bindValue(10, $movimiento);
    return $sql->execute();
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

  public function guardarDetalleMovimiento($producto, $Tipo_movimiento, $fecha2, $usuario, $cant, $existencia, $cantidad,$documento)
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $data = NULL;
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "INSERT INTO movimiento_inventario(codigo_producto, codigo_tmovi, fecha_movimiento, id_usuario, cantidad, cant_ant, nueva_cant,documento) VALUES (?,?,?,?,?,?,?,?)";
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

  public function verSiguienteMovimiento($prefijo,$movimiento)
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "SELECT CONCAT('$prefijo-',LPAD(COUNT(*) + 1, 4, '0'), '/', YEAR(NOW())) AS n_fact
            FROM operacion_inventario
            WHERE year(fecha_o) = YEAR(NOW()) AND tipo_operacion=?";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $movimiento);
    $sql->execute();
    return ($sql->fetch(PDO::FETCH_ASSOC)['n_fact']);
  }

  public function verMovimiento()
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
    ORDER BY A.id  DESC";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  public function verDetalleMovimiento()
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "SELECT A.id, B.Descripcion, C.Movimiento, fecha_movimiento, documento, comentario, D.nom_usuario, D.ape_usuario, cant_ant AS cantidad_anterior , A.cantidad, nueva_cant AS cantidad_actual 
    FROM movimiento_inventario AS A 
    INNER JOIN producto AS B ON A.codigo_producto=B.id_producto 
    INNER JOIN tipo_movimiento AS C on A.codigo_tmovi=C.id 
    INNER JOIN usuario as D on A.id_usuario=D.id_cliente 
    ORDER BY A.id DESC";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  public function verListaProducto($producto)
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "SELECT * FROM producto WHERE Descripcion LIKE '%$producto%'";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    //$sql->bindValue(1, $producto);
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  public function verProducto($producto)
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "SELECT * FROM producto WHERE Descripcion=?";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $producto);
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  public function verTipoMovimiento()
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "SELECT * FROM tipo_movimiento WHERE id IN (1,2,3)";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
  }
}
