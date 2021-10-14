<?php 

require_once 'conexion.php';



    class ModeloProductos{

        //Mostrar los productos

        static public function mdlMostrarProductos($tabla, $item, $valor){

            if($item != null){

                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY prod_id DESC");
                $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
                $stmt -> execute();
                return $stmt -> fetch();
                
            }else{

                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
                $stmt -> execute();
                return $stmt -> fetchAll();


            }


        }


        //Registro de productos

        static public function mdlIngresarProducto($tabla, $datos){


            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(prod_idcat, prod_codigo, prod_descripcion, prod_imagen, prod_stock, prod_preciocompra, prod_precioventa) VALUES (:id_categoria, :codigo, :descripcion, :imagen, :stock, :precio_compra, :precio_venta)");
    
            $stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
            $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
            $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
            $stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
            $stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
            $stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
            $stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);
    
            if($stmt->execute()){
    
                return "ok";
    
            }else{
    
                return "error";
            
            }
    
            $stmt->close();
            $stmt = null;
    
        }


        //Editar producto

        static public function mdlEditarProducto($tabla, $datos){

            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET prod_idcat = :id_categoria, prod_descripcion = :descripcion, prod_imagen = :imagen, prod_stock = :stock, prod_preciocompra = :precio_compra, prod_precioventa = :precio_venta WHERE prod_codigo = :codigo");
    
            $stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
            $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
            $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
            $stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
            $stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
            $stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
            $stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);
    
            if($stmt->execute()){
    
                return "ok";
    
            }else{
    
                return "error";
            
            }
    
            $stmt->close();
            $stmt = null;
    
        }


        //Eliminar producto

        static public function mdlBorrarProducto($tabla, $datos){

            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE prod_id = :id");
    
            $stmt->bindParam(":id", $datos, PDO::PARAM_STR);
    
            if($stmt->execute()){
                return "ok";
            }else{
                return "error";
            }

            $stmt->close();
            $stmt = null;
    
        }







    }



    
    



    