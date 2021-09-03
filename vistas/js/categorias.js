//Editar categoría

$(".btnEditarCategoria").click(function(){

    var idCategoria = $(this).attr("idCategoria");
    var datos = new FormData();
    datos.append("idCategoria", idCategoria);

    $.ajax({
        url:"ajax/categorias.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            $("#editarCategoria").val(respuesta["cat_nombre"]);
            $("#idCategoria").val(respuesta["cat_id"]);
        }
    });


});


//Eliminar categoría

$(".btnEliminarCategoria").click(function(){

    var idCategoria = $(this).attr("idCategoria");

    Swal.fire({

        icon: "warning",
        title: "¿Está seguro de borrar la categoría?",
        text: "¡Si no lo está puede cancelar la acción!",
        confirmButtonColor: '#3085d6',
		confirmButtonText: 'Si, borrar categoría!', 
		showCancelButton: true,
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar'

    }).then(function(result){

        if(result.value){
        
            window.location = "index.php?ruta=categorias&idCategoria="+idCategoria;

        }

    });

    
    
});


