//Subiendo la foto del usuario

$(".nuevaFoto").change(function(){

	var imagen = this.files[0];
	
	//Validar el formato de la imagen

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$(".nuevaFoto").val("");

  		 swal.fire({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      icon: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 2000000){

  		$(".nuevaFoto").val("");

  		 swal.fire({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      icon: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previsualizar").attr("src", rutaImagen);

  		})

  	}
})

//Editar usuario

$(document).on("click", ".btnEditarUsuario", function(){

	var idUsuario = $(this).attr("idUsuario");
	
	var datos = new FormData();
	datos.append("idUsuario", idUsuario);

	$.ajax({

		url:"ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarNombre").val(respuesta["us_nombre"]);
			$("#editarUsuario").val(respuesta["us_usuario"]);
			$("#editarPerfil").html(respuesta["us_perfil"]);
			$("#editarPerfil").val(respuesta["us_perfil"]);
			$("#fotoActual").val(respuesta["us_foto"]);

			$("#passwordActual").val(respuesta["us_password"]);

			if(respuesta["us_foto"] != ""){

				$(".previsualizar").attr("src", respuesta["us_foto"]);

			}

		}

	});

})

//Activar usuario

$(document).on("click", ".btnActivar", function(){

	var idUsuario = $(this).attr("idUsuario");
	var estadoUsuario = $(this).attr("estadoUsuario");

	var datos = new FormData();
 	datos.append("activarId", idUsuario);
  	datos.append("activarUsuario", estadoUsuario);

  	$.ajax({

	  url:"ajax/usuarios.ajax.php",
	  method: "POST",
	  data: datos,
	  cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){

		Swal.fire({
			title: "El usuario ha sido actualizado",
			icon: "success",
			confirmButtonText: "¡Cerrar!"
		  }).then(function(result) {
		  
			  if (result.value) {

			  window.location = "usuarios";

		  }

		});

		
      }

  	})

  	if(estadoUsuario == 0){

  		$(this).removeClass('btn-success');
  		$(this).addClass('btn-danger');
  		$(this).html('Desactivado');
  		$(this).attr('estadoUsuario',1);

  	}else{

  		$(this).addClass('btn-success');
  		$(this).removeClass('btn-danger');
  		$(this).html('Activado');
  		$(this).attr('estadoUsuario',0);

  	}

})

//Revisar si el usuario ya existe

$("#nuevoUsuario").change(function(){

	$(".alert").remove();

	var usuario = $(this).val();

	var datos = new FormData();
	datos.append("validarUsuario", usuario);

	 $.ajax({
	    url:"ajax/usuarios.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta){

	    		$("#nuevoUsuario").parent().after('<div class="alert alert-warning" style="margin:1rem;">Este usuario ya existe en la base de datos</div>');

	    		$("#nuevoUsuario").val("");

	    	}

	    }

	})
})

//Eliminar usuario

$(document).on("click", ".btnEliminarUsuario", function(){

	var idUsuario = $(this).attr("idUsuario");
	var fotoUsuario = $(this).attr("fotoUsuario");
	var usuario = $(this).attr("usuario");
  
	Swal.fire({
	  title: '¿Está seguro de borrar el usuario?',
	  text: "¡Si no lo está puede cancelar la accíón!",
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar usuario!'
	}).then(function(result){
  
	  if(result.value){
  
		window.location = "index.php?ruta=usuarios&idUsuario="+idUsuario+"&usuario="+usuario+"&fotoUsuario="+fotoUsuario;
  
	  }
  
	})


})

  





