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

  public function buscarIdDepartamento($departamento)
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "SELECT id FROM departamento WHERE departamento=?";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $departamento);
    $sql->execute();
    return ($sql->fetch(PDO::FETCH_ASSOC)['id']);
  }

  public function guardarPermisoRolDepartamento($id,$rol)
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $data = NULL;
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "INSERT INTO permiso_departamento_rol(rol,departamento) VALUES (?,?)";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $rol);
    $sql->bindValue(2, $id);
    return $sql->execute();
  }

  public function verPermisosRolDepartamento($rol)
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "SELECT B.id, B.departamento FROM permiso_departamento_rol AS A 
            INNER JOIN departamento AS B ON A.departamento=B.id 
            WHERE rol=?";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $rol);
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  public function verModuloDepartamento($departamento)
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "SELECT modulo FROM modulo WHERE departamento=?";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $departamento);
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
  }

}
