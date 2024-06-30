<?php
require_once("../../../config/conexion.php");

class Compras extends Conectar
{

  public function registrarCompra($idsujeto,$usuario,$documento,$fecha,$fecha2,$items,$cant,$subtotal,$excento,$base,$impuesto,$iva,$total)
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "INSERT INTO operacion_inventario(sujeto, usuario, documento, fecha_o, fecha_r, cant_items, cant_producto, subtotal, excento, base, impuesto, iva, total) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
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
    return $sql->execute();
  }
}
