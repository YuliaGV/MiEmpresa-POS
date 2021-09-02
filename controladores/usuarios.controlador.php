<?php


class ControladorUsuarios{

    //Ingreso al sistema(Login)

    static public function ctrIngresoUsuario(){

        if( isset($_POST['user'])){


            if(preg_match( '/^[a-zA-Z0-9]+$/', $_POST['user']) &&
                preg_match( '/^[a-zA-Z0-9]+$/', $_POST['password'])){

                    $encriptar = crypt($_POST["password"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                    $tabla = "tblusuarios";

                    $item = "us_usuario";

                    $valor = $_POST['user'];

                    $respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

                    if(!$respuesta){

                        echo '<br><div class="alert alert-danger">Error de autenticación, intenta nuevamente</div>';

                    }else{

                        if($respuesta["us_usuario"] == $_POST['user'] &&  $respuesta["us_password"] == $encriptar){


							if($respuesta["us_estado"] == 1){
								echo '<br><div class="alert alert-success">Bienvenido al sistema</div>';

								$_SESSION['iniciarSesion'] = "ok";
								$_SESSION['us_id'] = $respuesta["us_id"];
								$_SESSION['us_nombre'] = $respuesta["us_nombre"];
								$_SESSION['us_usuario'] = $respuesta["us_usuario"];
								$_SESSION['us_foto'] = $respuesta["us_foto"];
								$_SESSION['us_perfil'] = $respuesta["us_perfil"];

								//Registrar fecha de la ultima conexion
								
								date_default_timezone_set('America/Bogota');


								$fecha = date('Y-m-d');
								$hora = date('H:i:s');

								$fechaActual = date('Y-m-d H:i:s');

								$item1 = "us_ultimologin";
								$valor1 = $fechaActual;

								$item2 = "us_id";
								$valor2 = $respuesta["us_id"];

								$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

								if($ultimoLogin == "ok"){

									echo '<script>

										window.location = "inicio";

									</script>';

								}	
						  

							}else{
								echo '<br><div class="alert alert-danger">El usuario no está activado</div>';

							}
                            
                             

                        }else{

                            echo '<br><div class="alert alert-danger">Error de autenticación, intenta nuevamente</div>';
                        }

                    }

            }

        }

    }

    // Registro de nuevos usuarios

    static public function ctrCrearUsuario(){


        if(isset($_POST["nuevoUsuario"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"])){


                //Validar la imagen

                $revisar = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

                if($revisar !== false){

                    //Crear directorio
                    $directorio = "vistas/img/usuarios/".$_POST["nuevoUsuario"];
				    mkdir($directorio, 0755);

                    //Asignar nombre a la foto
                    $aleatorio = mt_rand(100,999);
                    $pname = $aleatorio."-".$_FILES["nuevaFoto"]["name"];

                    $tname = $_FILES["nuevaFoto"]["tmp_name"];

                    $ruta = $directorio."/".$pname;

                    move_uploaded_file($tname, $directorio.'/'.$pname);

                } else {
                    $ruta = "";
                }

                

                $tabla = "tblusuarios";

                $encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $datos = array("nombre" => $_POST["nuevoNombre"],
                               "usuario" => $_POST["nuevoUsuario"],
                               "password" => $encriptar,
                               "perfil" => $_POST["nuevoPerfil"],
                               "foto" => $ruta
                            );
                
                $respuesta = ModeloUsuarios::MdlIngresarUsuario($tabla, $datos);

                if($respuesta == "ok"){

                    echo '<script>

					Swal.fire({

						icon: "success",
						title: "El usuario ha sido guardado correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
                        closeOnConfirm: false

					}).then(function(result){

						if(result.value){
						
							window.location = "usuarios";

						}

					});
				

				</script>';
            
                }else{

                    '<script>
                    alert("Error al guardar el usuario");

					</script>';

                }



			}else{

				echo '<script>

					Swal.fire({

						icon: "error",
						title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
                        closeOnConfirm: false

					}).then(function(result){

						if(result.value){
						
							window.location = "usuarios";

						}

					});
				

				</script>';

	    }	}


	}

    //Mostrar usuarios

    static public function ctrMostrarUsuarios($item, $valor){

        $tabla = "tblusuarios";

        $respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

        return $respuesta;

    }



	//Modificar usuarios


	static public function ctrEditarUsuario(){

		if(isset($_POST["editarUsuario"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])){

				$ruta = $_POST["fotoActual"];

				if(isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])){


					//Si tenía imagen anterior, eliminarla

					if(!empty($_POST["fotoActual"])){

						unlink($_POST["fotoActual"]);

					}	

					//Creando directorio


					$directorio = "vistas/img/usuarios/".$_POST["editarUsuario"];
					mkdir($directorio, 0755);
	

					//Asignar nombre a la foto

					$aleatorio = mt_rand(100,999);
					$pname = $aleatorio."-".$_FILES["editarFoto"]["name"];

					$tname = $_FILES["editarFoto"]["tmp_name"];
					$ruta = $directorio."/".$pname;
					move_uploaded_file($tname, $directorio.'/'.$pname);


				} else {
					$ruta = $_POST["fotoActual"];
				}

				$tabla = "tblusuarios";

				if($_POST["editarPassword"] != ""){

					if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])){

						$encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

					}else{

						echo'<script>

								Swal.fire({
									  type: "error",
									  title: "¡La contraseña no puede llevar caracteres especiales!",
									  showConfirmButton: true,
									  confirmButtonText: "Cerrar"
									  }).then(function(result){
										if (result.value) {

										window.location = "usuarios";

										}
									})

						  	</script>';

					}

				}else{

					$encriptar = $_POST["passwordActual"];

				}

				$datos = array("nombre" => $_POST["editarNombre"],
							   "usuario" => $_POST["editarUsuario"],
							   "password" => $encriptar,
							   "perfil" => $_POST["editarPerfil"],
							   "foto" => $ruta);

				$respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					Swal.fire({
						  type: "success",
						  title: "El usuario ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "usuarios";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					Swal.fire({
						  type: "error",
						  title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "usuarios";

							}
						})

			  	</script>';

			}

		}

	}

	//Borrar usuario
	
	static public function ctrBorrarUsuario(){

		if(isset($_GET["idUsuario"])){

			$tabla ="tblusuarios";
			$datos = $_GET["idUsuario"];

			if($_GET["fotoUsuario"] != ""){

				unlink($_GET["fotoUsuario"]);
				rmdir('vistas/img/usuarios/'.$_GET["usuario"]);

			}

			$respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				Swal.fire({
					  icon: "success",
					  title: "El usuario ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "usuarios";

								}
							})

				</script>';

			}		

		}

	}


	






    






}








