<?php

require_once "conexion.php";

class ModeloUsuarios{

    //Mostrar usuarios

    static public function MdlMostrarUsuarios($tabla, $item, $valor){


        if($item !== null){

        $stmt = Conexion::Conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

        $stmt->bindParam(":$item", $valor, PDO::PARAM_STR);

        $stmt->execute();

        $row_cnt = $stmt->rowCount();;

        if($row_cnt > 0){
            return $stmt->fetch();
        }else{
            return false;
        }

        $stmt ->close();

        $stmt = null;

        }else{

            $stmt = Conexion::Conectar()->prepare("SELECT * FROM $tabla");

            $stmt->execute();

            return $stmt->fetchAll();


        }


    }

    //Ingresar usuario

    static public function MdlIngresarUsuario($tabla, $datos){

        $stmt = Conexion::Conectar()->prepare("INSERT INTO $tabla(us_nombre, us_usuario, us_password, us_perfil, us_foto) VALUES (:nombre, :usuario, :password, :perfil, :foto)");

        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
        $stmt->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
        $stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);

        if($stmt->execute()){  //Si se ejecuta correctamente
            return "ok";
        }else{
            return "error";
        }

        $stmt->close();

        $stmt = null;

    }

    //Editar usuario
    
    static public function mdlEditarUsuario($tabla, $datos){
	
		$stmt = Conexion::Conectar()->prepare("UPDATE $tabla SET us_nombre = :nombre, us_password = :password, us_perfil = :perfil, us_foto = :foto WHERE us_usuario = :usuario");

		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt -> bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt -> bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
		$stmt -> bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

    //Actualizar usuario
    static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::Conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}


    //Borrar usuario

    static public function mdlBorrarUsuario($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE us_id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;


	}

















}