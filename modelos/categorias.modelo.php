<?php 


require_once 'conexion.php';

class ModeloCategorias{

    //Crear categorias

    static public function mdlIngresarCategoria($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(cat_nombre) VALUES (:cat_nombre)");

        $stmt->bindParam(":cat_nombre", $datos, PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }


    }

    //Mostrar categorias

    static public function mdlMostrarCategorias($tabla, $item, $valor){

        if($item != null){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();


        }else{

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt->execute();
            return $stmt->fetchAll();

        }

        $stmt->close();
        $stmt = null;

        
    }

    //Modificar categorias

    static public function mdlEditarCategoria($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET cat_nombre = :cat_nombre WHERE cat_id = :cat_id");

        $stmt->bindParam(":cat_nombre", $datos["categoria"], PDO::PARAM_STR);
        $stmt->bindParam(":cat_id", $datos["id"], PDO::PARAM_INT);
       

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt->close();
        $stmt = null;

    }

    //Borrar categorias

    static public function mdlBorrarCategoria($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE cat_id = :cat_id");
        
        $stmt->bindParam(":cat_id", $datos, PDO::PARAM_INT);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt->close();
        $stmt = null;


    }


        







}