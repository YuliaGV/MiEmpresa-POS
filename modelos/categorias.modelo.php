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







}