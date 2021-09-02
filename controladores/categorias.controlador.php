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
						
							window.location = "usuarios";

						}

					});
				

				</script>';
            }

        }

            



        

          
            
        
    }









}