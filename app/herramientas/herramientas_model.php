<?php
require_once("../../config/conexion.php");

class Herramientas extends Conectar
{

  public function verImpuestos()
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "SELECT * FROM impuesto";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  public function verDepartamentos()
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "SELECT * FROM departamento";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  public function guardarDepartamento($departamento)
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $data = NULL;
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "INSERT INTO departamento(departamento) VALUES (?)";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $departamento);
    return $sql->execute();
  }

  public function guardarModulo($modulo,$departamento)
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $data = NULL;
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "INSERT INTO modulo(modulo,departamento) VALUES (?,?)";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $modulo);
    $sql->bindValue(2, $departamento);
    return $sql->execute();
  }

  public function verModulos()
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "SELECT A.id, modulo, B.departamento, A.descripcion 
              FROM modulo AS A 
              INNER JOIN departamento AS B ON A.departamento=B.id;";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
  }

}
