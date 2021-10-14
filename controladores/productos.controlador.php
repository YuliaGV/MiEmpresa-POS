<?php 

    class ControladorProductos{

        // Mostrar productos

        static public function ctrMostrarProductos($item, $valor){

            $tabla = "tblproductos";
            $respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor);
            return $respuesta;

        }

        //Crear productos

        static public function ctrCrearProducto(){


            if(isset($_POST["nuevaDescripcion"])){

    
                if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDescripcion"]) &&
                   preg_match('/^[0-9]+$/', $_POST["nuevoStock"]) &&	
                   preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioCompra"]) &&
                   preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioVenta"])){


                    //Validar imagen
    
                    $revisar = getimagesize($_FILES["nuevaImagen"]["tmp_name"]);

                    if($revisar !== false){

    
                        //Crear directorio
                        $directorio = "vistas/img/productos/".$_POST["nuevoCodigo"];
					    mkdir($directorio, 0755);

                        //Asignar nombre a la imagen
                        $aleatorio = mt_rand(100,999);
                        $pname = $aleatorio."-".$_FILES["nuevaImagen"]["name"];
                        $tname = $_FILES["nuevaImagen"]["tmp_name"];
                        $ruta = $directorio."/".$pname;
                        move_uploaded_file($tname, $directorio.'/'.$pname);
    
                    } else {
                        $ruta = "";
                    }
    
                    $tabla = "tblproductos";
    
                    $datos = array(
                                "id_categoria" => $_POST["nuevaCategoria"],
                                "codigo" => $_POST["nuevoCodigo"],
                                "descripcion" => $_POST["nuevaDescripcion"],
                                "stock" => $_POST["nuevoStock"],
                                "precio_compra" => $_POST["nuevoPrecioCompra"],
                                "precio_venta" => $_POST["nuevoPrecioVenta"],
                                "imagen" => $ruta
                                );
    
                    $respuesta = ModeloProductos::mdlIngresarProducto($tabla, $datos);
    
                    if($respuesta == "ok"){
    
                        echo'<script>
    
                            Swal.fire({

                                icon: "success",
                                title: "El producto ha sido guardado correctamente",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false
        
                            }).then(function(result){
        
                                if(result.value){
                                
                                    window.location = "productos";
        
                                }
        
                            });
    
                        </script>';
    
                    }else{

                        '<script>
                        alert("Error al guardar el producto");
    
                        </script>';
    
                    }
                

    
    
                }else{
    
                    echo'<script>
    
                        Swal.fire({

                            icon: "error",
                            title: "¡El producto no puede ir vacío o llevar caracteres especiales!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false

                        }).then(function(result){

                            if(result.value){
                            
                                window.location = "productos";

                            }

                        });
    
                      </script>';
                }
            }
    
        }

        // Editar productos

        static public function ctrEditarProducto(){


            if(isset($_POST["editarDescripcion"])){

                if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcion"]) &&
                   preg_match('/^[0-9]+$/', $_POST["editarStock"]) &&	
                   preg_match('/^[0-9.]+$/', $_POST["editarPrecioCompra"]) &&
                   preg_match('/^[0-9.]+$/', $_POST["editarPrecioVenta"])){


                    $ruta = $_POST["imagenActual"];

                    if(isset($_FILES["editarImagen"]["tmp_name"]) && !empty($_FILES["editarImagen"]["tmp_name"])){


                        //Si tenía imagen anterior, eliminarla

                        if(!empty($_POST["imagenActual"])){

                            unlink($_POST["imagenActual"]);

                        }	

                        //Creando directorio
                        $directorio = "vistas/img/productos/".$_POST["editarCodigo"];
					    mkdir($directorio, 0755);

                        //Asignar nombre a la foto
                        $aleatorio = mt_rand(100,999);
                        $pname = $aleatorio."-".$_FILES["editarImagen"]["name"];
                        $tname = $_FILES["editarImagen"]["tmp_name"];
                        $ruta = $directorio."/".$pname;
                        move_uploaded_file($tname, $directorio.'/'.$pname);


                    } else {
                        $ruta = $_POST["imagenActual"];
                    }

    
                    $tabla = "tblproductos";
    
                    $datos = array("id_categoria" => $_POST["editarCategoria"],
                                   "codigo" => $_POST["editarCodigo"],
                                   "descripcion" => $_POST["editarDescripcion"],
                                   "stock" => $_POST["editarStock"],
                                   "precio_compra" => $_POST["editarPrecioCompra"],
                                   "precio_venta" => $_POST["editarPrecioVenta"],
                                   "imagen" => $ruta);
    
                    $respuesta = ModeloProductos::mdlEditarProducto($tabla, $datos);
    
                    if($respuesta == "ok"){
    
                        echo'<script>
    
                            Swal.fire({

                                icon: "success",
                                title: "El producto ha sido editado correctamente",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false
        
                            }).then(function(result){
        
                                if(result.value){
                                
                                    window.location = "productos";
        
                                }
        
                            });
    
                            </script>';
    
                    }
    
    
                }else{
    
                    echo'<script>
    
                        Swal.fire({

                            icon: "error",
                            title: "¡El producto no puede ir vacío o llevar caracteres especiales!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false

                        }).then(function(result){

                            if(result.value){
                            
                                window.location = "productos";

                            }

                        });

        
                      </script>';
                }
            }

        }

        // Eliminar producto

        static public function ctrBorrarProducto(){

            if(isset($_GET["idProducto"])){

                $tabla = "tblproductos";
                $datos = $_GET["idProducto"];

                if($_GET["imagen"] != ""){

                    unlink($_GET["imagen"]);
                    rmdir('vistas/img/productos/'.$_GET["codigo"]);

                }

                $respuesta = ModeloProductos::mdlBorrarProducto($tabla, $datos);

                if($respuesta == "ok"){

                    echo '<script>

					Swal.fire({

						icon: "success",
						title: "El producto ha sido eliminado correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
                        closeOnConfirm: false

					}).then(function(result){

						if(result.value){
						
							window.location = "productos";

						}

					});
				

				</script>';

                    
                }

            

             }

        }
            
            
            





    }

        


        
    






        

    









