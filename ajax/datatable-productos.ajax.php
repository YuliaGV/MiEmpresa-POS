<?php 

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";


class TablaProductos{

    //Mostrar la tabla de productos

    public function mostrarTablaProductos(){


        $item = null;
    	$valor = null;

  		$productos = ControladorProductos::ctrMostrarProductos($item, $valor);	
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($productos); $i++){

            //Traemos la imagen

			if ($productos[$i]["prod_imagen"] != ""){

				$imagen = "<img src='".$productos[$i]["prod_imagen"]."' width='50px'>";

			}else{

				$imagen = "<img src='vistas/img/productos/ProductoSinImagen.PNG' width='50px'>";

			}


		  	//Traemos la categoría

		  	$item = "cat_id";
		  	$valor = $productos[$i]["prod_idcat"];

		  	$categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

            //Traemos el stock

  			if($productos[$i]["prod_stock"] <= 10){

  				$stock = "<button class='btn btn-danger'>".$productos[$i]["prod_stock"]."</button>";

  			}else if($productos[$i]["prod_stock"] > 11 && $productos[$i]["prod_stock"] <= 15){

  				$stock = "<button class='btn btn-warning'>".$productos[$i]["prod_stock"]."</button>";

  			}else{

  				$stock = "<button class='btn btn-success'>".$productos[$i]["prod_stock"]."</button>";

  			}

		  	//Acciones

		  	$botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='".$productos[$i]["prod_id"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-edit'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto='".$productos[$i]["prod_id"]."' codigo='".$productos[$i]["prod_codigo"]."' imagen='".$productos[$i]["prod_imagen"]."'><i class='fa fa-trash-alt'></i></button></div>"; 

		  	$datosJson .='[
			      "'.($i+1).'",
			      "'.$imagen.'",
			      "'.$productos[$i]["prod_codigo"].'",
			      "'.$productos[$i]["prod_descripcion"].'",
			      "'.$categorias["cat_nombre"].'",
			      "'.$stock.'",
			      "'.$productos[$i]["prod_preciocompra"].'",
			      "'.$productos[$i]["prod_precioventa"].'",
			      "'.$productos[$i]["prod_fecha"].'",
			      "'.$botones.'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;
         


    }


}




//Activar tabla de productos

$activarProductos = new TablaProductos();
$activarProductos -> mostrarTablaProductos();