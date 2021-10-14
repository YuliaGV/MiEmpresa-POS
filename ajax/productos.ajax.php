<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

class AjaxProductos{

    //Generar código del producto a partir de IdCategoria

    public $idCategoria;

    public function ajaxCrearCodigoProducto(){

        $item = "prod_idcat";
        $valor = $this->idCategoria;

        $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);
        echo json_encode($respuesta);

    }

    //Editar producto

    public $idProducto;

    public function ajaxEditarProducto(){
  
      $item = "prod_id";
      $valor = $this->idProducto;
  
      $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);
  
      echo json_encode($respuesta);
  
    }



}


//Generar código del producto a partir de IdCategoria


if(isset($_POST["idCategoria"])){

    $codigoProducto = new AjaxProductos();
    $codigoProducto -> idCategoria = $_POST["idCategoria"];
    $codigoProducto -> ajaxCrearCodigoProducto();

}

//Editar producto

if(isset($_POST["idProducto"])){

    $editarProducto = new AjaxProductos();
    $editarProducto -> idProducto = $_POST["idProducto"];
    $editarProducto -> ajaxEditarProducto();
  
  }
  



