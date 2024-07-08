<?php
require_once("../../config/conexion.php");

class Usuario extends Conectar
{

  public function getLoginUser($email)
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "SELECT id_cliente, correo, contrasenna, B.rol, B.id, estatus FROM usuario AS A 
                INNER JOIN rol_usuario AS B ON A.rol=B.id 
                WHERE correo=?";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $email);
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getDataUserAll()
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "SELECT id_cliente,nom_usuario,ape_usuario,correo, B.rol FROM usuario AS A 
                INNER JOIN rol_usuario AS B ON A.rol=B.id";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  public function verUsuario($id)
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "SELECT * FROM usuario  WHERE id_cliente=?";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $id);
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  public function verRolesUsuarios()
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "SELECT * FROM rol_usuario";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
  }
  public function verEstatusUsuarios()
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "SELECT * FROM estatus";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
  }
  public function Bloquearusuario()
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "SELECT * FROM bloqueo";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  public function guardarDatosUsuario($nom_usuario, $ape_usuario, $contrasenna, $correo, $telefono, $rol, $estatus)
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $data = NULL;
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "INSERT INTO usuario(nom_usuario,ape_usuario, contrasenna, correo, telefono, rol,estatus) VALUES (?,?,?,?,?,?,?)";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $nom_usuario);
    $sql->bindValue(2, $ape_usuario);
    $sql->bindValue(3, $contrasenna);
    $sql->bindValue(4, $correo);
    $sql->bindValue(5, $telefono);
    $sql->bindValue(6, $rol);
    $sql->bindValue(7, $estatus);

    return $sql->execute();
  }
  
  public function eliminarusuario($id)
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "DELETE FROM usuario WHERE id_cliente=?";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $id);
    $sql->execute();
    return $sql;
  }
  public function actualizarDatosUsuario($id, $nom_usuario, $ape_usuario, $contrasenna, $correo, $telefono, $rol, $estatus)
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $conectar = parent::conexion();
    parent::set_names();
    ///QUERY
    $sql = "UPDATE usuario SET nom_usuario=?,ape_usuario=?,contrasenna=?,correo=?,telefono=?,rol=?, estatus=? WHERE id_cliente=?";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $nom_usuario);
    $sql->bindValue(2, $ape_usuario);
    $sql->bindValue(3, $contrasenna);
    $sql->bindValue(4, $correo);
    $sql->bindValue(5, $telefono);
    $sql->bindValue(6, $rol);
    $sql->bindValue(7, $estatus);
    $sql->bindValue(8, $id);
    return $sql->execute();
  }

  public function actualizarDatosUsuario1($id, $nom_usuario, $ape_usuario, $correo, $telefono, $rol, $estatus)
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $conectar = parent::conexion();
    parent::set_names();
    ///QUERY
    $sql = "UPDATE usuario SET nom_usuario=?,ape_usuario=?,correo=?,telefono=?,rol=?, estatus=? WHERE id_cliente=?";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $nom_usuario);
    $sql->bindValue(2, $ape_usuario);
    $sql->bindValue(3, $correo);
    $sql->bindValue(4, $telefono);
    $sql->bindValue(5, $rol);
    $sql->bindValue(6, $estatus);
    $sql->bindValue(7, $id);
    return $sql->execute();
  }
}
