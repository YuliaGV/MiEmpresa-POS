<?php

class ControladorCategorias{

    // Método para crear las categorías

    static public function ctrCrearCategoria(){

        if(isset($_POST["nuevaCategoria"])){

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaCategoria"])){

                $tabla = "tblcategorias";
                $datos = $_POST["nuevaCategoria"];
                $respuesta = ModeloCategorias::mdlIngresarCategoria($tabla, $datos);

                if($respuesta == "ok"){

                    echo '<script>

					Swal.fire({

						icon: "sucess",
						title: "La categoría ha sido ingresada correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
                        closeOnConfirm: false

					}).then(function(result){

						if(result.value){
						
							window.location = "categorias";

						}

					});
				

				</script>';

                

                }

            }else{
                echo '<script>

					Swal.fire({

						icon: "error",
						title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
                        closeOnConfirm: false

					}).then(function(result){

						if(result.value){
						
							window.location = "categorias";

						}

					});
				

				</script>';
            }

        }   
            
        
    }

	// Método para mostrar las categorías

	static public function ctrMostrarCategorias($item, $valor){

		$tabla = "tblcategorias";
		$respuesta = ModeloCategorias::mdlMostrarCategorias($tabla, $item, $valor);
		return $respuesta;

	}

	// Método para editar las categorías

	static public function ctrEditarCategoria(){

        if(isset($_POST["editarCategoria"])){

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCategoria"])){

                $tabla = "tblcategorias";
				$datos = array("id"=>$_POST["idCategoria"],
						"categoria"=>$_POST["editarCategoria"]);
							  

                $respuesta = ModeloCategorias::mdlEditarCategoria($tabla, $datos);

                if($respuesta == "ok"){

                    echo '<script>

					Swal.fire({

						icon: "sucess",
						title: "La categoría ha sido editada correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
                        closeOnConfirm: false

					}).then(function(result){

						if(result.value){
						
							window.location = "categorias";

						}

					});
				

				</script>';

                }
				

            }else{
                echo '<script>

					Swal.fire({

						icon: "error",
						title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
                        closeOnConfirm: false

					}).then(function(result){

						if(result.value){
						
							window.location = "categorias";

						}

					});
				

				</script>';
            }

        }   
            
        
    }

	// Método para eliminar las categorías

	static public function ctrBorrarCategoria(){

		if(isset($_GET["idCategoria"])){

			$tabla = "tblcategorias";
			$datos = $_GET["idCategoria"];

			$respuesta = ModeloCategorias::mdlBorrarCategoria($tabla, $datos);

			if($respuesta == "ok"){

				echo '<script>

					Swal.fire({

						icon: "sucess",
						title: "La categoría ha sido borrada correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
                        closeOnConfirm: false

					}).then(function(result){

						if(result.value){
						
							window.location = "categorias";

						}

					});
				

				</script>';

			}

		}


	}

	


	








}