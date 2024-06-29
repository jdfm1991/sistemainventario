<?php
require_once("../../../config/conexion.php");

class Producto extends Conectar{

    public function guardarDatosProductos($product,$categoria,$familia,$ubicacion,$unidad,$cantidad,$costo_unidad,$valor_inventario){
        //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
        //CUANDO ES APPWEB ES CONEXION.
        $data=NULL;
		$conectar= parent::conexion();
		parent::set_names();
 		//QUERY
			$sql="INSERT INTO producto(Descripcion, Categoria, Familia, Ubicacion, Unidad, Cantidad, Costo_unidad, valor_inventario) VALUES (?,?,?,?,?,?,?,?)";
		//PREPARACION DE LA CONSULTA PARA EJECUTARLA.
		$sql = $conectar->prepare($sql);
        $sql->bindValue(1, $product);
		$sql->bindValue(2, $categoria);
        $sql->bindValue(3, $familia);
        $sql->bindValue(4, $ubicacion);
        $sql->bindValue(5, $unidad);
		$sql->bindValue(6, $cantidad);
        $sql->bindValue(7, $costo_unidad);
        $sql->bindValue(8, $valor_inventario);
		return $sql->execute();
	}

    public function verTodosProducto(){
        //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
        //CUANDO ES APPWEB ES CONEXION.
        $conectar= parent::conexion();
        parent::set_names();
        //QUERY
            $sql="SELECT id_producto, B.Categoria, C.Familia, D.Ubicacion, Descripcion, E.Unidad, Cantidad, Costo_unidad, valor_inventario
                FROM producto AS A 
                INNER JOIN categoria AS B ON A.Categoria=B.id
                INNER JOIN familia AS C ON A.Familia=C.id
                INNER JOIN ubicacion D ON A.Ubicacion=D.id
                INNER JOIN unidad E ON A.Unidad=E.id";
        //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function verProducto($id){
        //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
        //CUANDO ES APPWEB ES CONEXION.
        $conectar= parent::conexion();
        parent::set_names();
        //QUERY
            $sql="SELECT * FROM producto WHERE id_producto=?";
        //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function verCategorias(){
        //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
        //CUANDO ES APPWEB ES CONEXION.
        $conectar= parent::conexion();
        parent::set_names();
        //QUERY
            $sql="SELECT * FROM categoria";
        //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function verFamilia(){
        //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
        //CUANDO ES APPWEB ES CONEXION.
        $conectar= parent::conexion();
        parent::set_names();
        //QUERY
            $sql="SELECT * FROM familia";
        //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function verUbicaciones(){
        //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
        //CUANDO ES APPWEB ES CONEXION.
        $conectar= parent::conexion();
        parent::set_names();
        //QUERY
            $sql="SELECT * FROM ubicacion";
        //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function verUnidades(){
        //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
        //CUANDO ES APPWEB ES CONEXION.
        $conectar= parent::conexion();
        parent::set_names();
        //QUERY
            $sql="SELECT * FROM unidad";
        //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function eliminarProducto($id){
        //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
        //CUANDO ES APPWEB ES CONEXION.
        $conectar= parent::conexion();
        parent::set_names();
        //QUERY
            $sql="DELETE FROM producto WHERE id_producto=?";    
        //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id);
        $sql->execute();
        return $sql;
    
    }

    public function actualizarDatosProductos($id,$product,$categoria,$familia,$ubicacion,$unidad,$cantidad,$costo_unidad,$valor_inventario){
        //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
        //CUANDO ES APPWEB ES CONEXION.
        $conectar= parent::conexion();
        parent::set_names();
        ///QUERY
            $sql="UPDATE producto SET Descripcion=?,Categoria=?,Familia=?,Ubicacion=?,Unidad=?,Cantidad=?,Costo_unidad=?,valor_inventario=? WHERE id_producto=?";
        //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $product);
        $sql->bindValue(2, $categoria);
        $sql->bindValue(3, $familia);
        $sql->bindValue(4, $ubicacion);
        $sql->bindValue(5, $unidad);
        $sql->bindValue(6, $cantidad);
        $sql->bindValue(7, $costo_unidad);
        $sql->bindValue(8, $valor_inventario);
        $sql->bindValue(9, $id);
        return $sql->execute();
    }

}

