<?php
require_once("../../config/conexion.php");

class Usuario extends Conectar
{

  public function getLoginUser($correo)
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "SELECT id, user, user_name, user_last_name, user_password,user_rol,user_status 
            FROM user_data_table 
            WHERE user_email=? OR user=?";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $correo);
    $sql->bindValue(2, $correo);
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  public function showDataUsers()
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "SELECT A.id, user, user_name, user_last_name, user_email, B.user_rol, C.user_status 
            FROM user_data_table AS A 
            INNER JOIN user_roles_data_table AS B ON B.id=A.user_rol
            INNER JOIN user_status_data_table AS C ON C.id=A.user_status;";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  public function showDataUsers1()
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "SELECT A.id, user, user_name, user_last_name, user_email, B.user_rol, C.user_status 
            FROM user_data_table AS A 
            INNER JOIN user_roles_data_table AS B ON B.id=A.user_rol
            INNER JOIN user_status_data_table AS C ON C.id=A.user_status
            WHERE A.user_rol NOT IN (1)";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  public function showDataUsersById($id)
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "SELECT * FROM user_data_table  WHERE id=?";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $id);
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  public function showDataRoles()
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "SELECT * FROM user_roles_data_table";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  public function showDataRoles1()
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "SELECT * FROM user_roles_data_table WHERE id NOT IN (1)";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  public function showDataStatus()
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "SELECT * FROM user_status_data_table";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getUserDataByEmail($correo)
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "SELECT * FROM user_data_table 
            WHERE user_email=?";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $correo);
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getUserDataByUser($login_usuario)
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "SELECT * FROM user_data_table 
            WHERE user=?";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $login_usuario);
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  public function NewUserData($login_usuario,$nom_usuario, $ape_usuario, $contrasenna, $correo, $telefono, $rol, $estatus)
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $data = NULL;
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "INSERT INTO user_data_table(user,user_name, user_last_name, user_password, user_email, user_phone,user_rol,user_status) VALUES (?,?,?,?,?,?,?,?)";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $login_usuario);
    $sql->bindValue(2, $nom_usuario);
    $sql->bindValue(3, $ape_usuario);
    $sql->bindValue(4, $contrasenna);
    $sql->bindValue(5, $correo);
    $sql->bindValue(6, $telefono);
    $sql->bindValue(7, $rol);
    $sql->bindValue(8, $estatus);

    return $sql->execute();
  }

  public function getUserRolById($id)
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "SELECT user_rol FROM user_data_table WHERE id=?";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $id);
    $sql->execute();
    return ($sql->fetch(PDO::FETCH_ASSOC)['user_rol']);
  }

  public function countUserRolSU($rol)
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "SELECT COUNT(*) AS N FROM user_data_table WHERE user_rol=?";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $rol);
    $sql->execute();
    return ($sql->fetch(PDO::FETCH_ASSOC)['N']);
  }
  
  public function deleteUserData($id)
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $conectar = parent::conexion();
    parent::set_names();
    //QUERY
    $sql = "DELETE FROM user_data_table WHERE id=?";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $id);
    $sql->execute();
    return $sql;
  }
  public function updateUserData($id, $nom_usuario, $ape_usuario, $contrasenna, $correo, $telefono, $rol, $estatus, $login_usuario)
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $conectar = parent::conexion();
    parent::set_names();
    ///QUERY
    $sql = "UPDATE user_data_table SET user=?,user_name=?,user_last_name=?,user_password=?,user_email=?,user_phone=?, user_rol=?, user_status=? WHERE id=?";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $login_usuario);
    $sql->bindValue(2, $nom_usuario);
    $sql->bindValue(3, $ape_usuario);
    $sql->bindValue(4, $contrasenna);
    $sql->bindValue(5, $correo);
    $sql->bindValue(6, $telefono);
    $sql->bindValue(7, $rol);
    $sql->bindValue(8, $estatus);
    $sql->bindValue(9, $id);
    return $sql->execute();
  }

  public function updateUserData1($id, $nom_usuario, $ape_usuario, $correo, $telefono, $rol, $estatus,$login_usuario)
  {
    //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
    //CUANDO ES APPWEB ES CONEXION.
    $conectar = parent::conexion();
    parent::set_names();
    ///QUERY
    $sql = "UPDATE user_data_table SET user=?,user_name=?,user_last_name=?,user_email=?,user_phone=?, user_rol=?, user_status=? WHERE id=?";
    //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $login_usuario);
    $sql->bindValue(2, $nom_usuario);
    $sql->bindValue(3, $ape_usuario);
    $sql->bindValue(4, $correo);
    $sql->bindValue(5, $telefono);
    $sql->bindValue(6, $rol);
    $sql->bindValue(7, $estatus);
    $sql->bindValue(8, $id); 
    return $sql->execute();
  }
}
