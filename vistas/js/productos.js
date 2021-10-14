//Cargar tabla dinámica de productos


/*
$.ajax({

   	url: "ajax/datatable-productos.ajax.php",
     	success:function(respuesta){
            
     		console.log("respuesta", respuesta);
    
     	}
    
    })

*/


$('.tablaProductos').DataTable( {
    "ajax": "ajax/datatable-productos.ajax.php",
	"deferRender": true,
	"retrieve": true,
	"processing": true,
    "language": {

		"sProcessing":     "Procesando...",
		"sLengthMenu":     "Mostrar _MENU_ registros",
		"sZeroRecords":    "No se encontraron resultados",
		"sEmptyTable":     "Ningún dato disponible en esta tabla",
		"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix":    "",
		"sSearch":         "Buscar:",
		"sUrl":            "",
		"sInfoThousands":  ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
		"sFirst":    "Primero",
		"sLast":     "Último",
		"sNext":     "Siguiente",
		"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		}

	}
    
} );


//Capturando la categoría para asignar código

$("#nuevaCategoria").change(function(){

    var idCategoria = $(this).val();

    var datos = new FormData();
    datos.append("idCategoria", idCategoria);

    $.ajax({

        url:"ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){

			if(respuesta){
				var nuevoCodigo = Number(respuesta["prod_codigo"]);
		   		$("#nuevoCodigo").val(nuevoCodigo+1);
			}else{
				var nuevoCodigo = idCategoria+"01";
				$("#nuevoCodigo").val(nuevoCodigo);
			}


        }

    })

});


function definirPrecioVenta(){

	if($("#porcentaje").prop("checked")){

		var valorPorcentaje = $("#nuevoPorcentaje").val();
		var ganancia = Number(($("#nuevoPrecioCompra").val()*valorPorcentaje/100));
		$("#nuevoPrecioVenta").val(Number($("#nuevoPrecioCompra").val())+ganancia);
		$("#nuevoPrecioVenta").prop("readonly", true);

	
	}


}

//Determinando el precio de venta

$("#nuevoPrecioCompra").change(function(){

	definirPrecioVenta();


});


//Si cambia el porcentaje...

$("#nuevoPorcentaje").change(function(){

	definirPrecioVenta();
	definirNuevoPrecioVenta();


});

$("#porcentaje").on("ifUnchecked", function(){

	$("#nuevoPrecioVenta").prop("readonly", false);
});



$("#porcentaje").on("ifChecked", function(){

	$("#nuevoPrecioVenta").prop("readonly", true);
});


//Validar imagen

$(".nuevaImagen").change(function(){

	var imagen = this.files[0];

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$(".nuevaImagen").val("");

		  swal.fire({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 2000000){

  		$(".nuevaImagen").val("");

		  swal.fire({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
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


//Editar producto

$(document).on("click", ".btnEditarProducto", function(){

	var idProducto = $(this).attr("idProducto");
	
	var datos = new FormData();
    datos.append("idProducto", idProducto);

     $.ajax({

      url:"ajax/productos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
          
          var datosCategoria = new FormData();
          datosCategoria.append("idCategoria",respuesta["prod_idcat"]);

           $.ajax({

              url:"ajax/categorias.ajax.php",
              method: "POST",
              data: datosCategoria,
              cache: false,
              contentType: false,
              processData: false,
              dataType:"json",
              success:function(respuesta){
                  
                  $("#editarCategoria").val(respuesta["cat_id"]);
                  $("#editarCategoria").html(respuesta["cat_nombre"]);

              }

          })

           $("#editarCodigo").val(respuesta["prod_codigo"]);

           $("#editarDescripcion").val(respuesta["prod_descripcion"]);

           $("#editarStock").val(respuesta["prod_stock"]);

           $("#editarPrecioCompra").val(respuesta["prod_preciocompra"]);

           $("#editarPrecioVenta").val(respuesta["prod_precioventa"]);

           if(respuesta["prod_imagen"] != ""){

           	$("#imagenActual").val(respuesta["prod_imagen"]);

           	$(".previsualizar").attr("src",  respuesta["prod_imagen"]);

           }

      }

  })

})



$("#editarPrecioCompra").change(function(){

	definirNuevoPrecioVenta();

});


function definirNuevoPrecioVenta(){

	if($("#porcentaje").prop("checked")){

		var valorPorcentaje = $("#nuevoPorcentaje").val();
		var ganancia = Number(($("#editarPrecioCompra").val()*valorPorcentaje/100));
		$("#editarPrecioVenta").val(Number($("#editarPrecioCompra").val())+ganancia);
		$("#editarPrecioVenta").prop("readonly", true);

	
	}


}

//Eliminar producto



$(document).on("click", ".btnEliminarProducto", function(){

	var idProducto = $(this).attr("idProducto");
	var codigo = $(this).attr("codigo");
	var imagen = $(this).attr("imagen");

	Swal.fire({
		title: '¿Está seguro de borrar el producto?',
		text: "¡Si no lo está puede cancelar la acción!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar producto!'
	}).then((result) => {
		if (result.value) {
			window.location = "index.php?ruta=productos&idProducto="+idProducto+"&codigo="+codigo+"&imagen="+imagen;

		}

	})




})









	

