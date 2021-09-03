<?php

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

class AjaxCategorias{

    //Editar categorias

    public $idCategoria;

    public function ajaxEditarCategoria(){

        $item = "cat_id";
        $valor = $this->idCategoria;
        $respuesta = ControladorCategorias::ctrMostrarCategorias($item, $valor);
        echo json_encode($respuesta);
    }


}

//Editar categorias

if(isset($_POST["idCategoria"])){

    $categoria = new AjaxCategorias();
    $categoria -> idCategoria = $_POST["idCategoria"];
    $categoria -> ajaxEditarCategoria();

}



