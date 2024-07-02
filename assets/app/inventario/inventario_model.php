<?php
require_once("../../../config/conexion.php");

class Inventario extends Conectar
{

  public function verMovimiento()
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

  public function verProductoporId($id_producto)
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "SELECT * FROM producto WHERE id_producto=?";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $id_producto);
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
    $sql = "SELECT * FROM tipo_movimiento";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  public function guardarMovimiento($id_producto, $Tipo_movimiento, $ahora, $comentario, $usuario, $Cantidad, $cantidad_act, $nueva_cant)
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $data = NULL;
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "INSERT INTO movimiento_inventario(codigo_producto, codigo_tmovi, fecha_movimiento, comentario, id_usuario, cantidad, cant_ant, nueva_cant) VALUES (?,?,?,?,?,?,?,?)";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $id_producto);
    $sql->bindValue(2, $Tipo_movimiento);
    $sql->bindValue(3, $ahora);
    $sql->bindValue(4, $comentario);
    $sql->bindValue(5, $usuario);
    $sql->bindValue(6, $Cantidad);
    $sql->bindValue(7, $cantidad_act);
    $sql->bindValue(8, $nueva_cant);
    return $sql->execute();
  }

  public function actualizarProductoPorId($id_producto, $nueva_cant, $nuevo_valor)
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $conectar = parent::conexion();
    parent::set_names();
    ///QUERY
    $sql = "UPDATE producto SET Cantidad=?,valor_inventario=? WHERE id_producto=?";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $nueva_cant);
    $sql->bindValue(2, $nuevo_valor);
    $sql->bindValue(3, $id_producto);
    return $sql->execute();
  }
}
