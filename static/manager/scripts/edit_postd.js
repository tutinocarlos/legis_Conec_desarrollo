CKEDITOR.replace('resumen');
CKEDITOR.replace('cuerpo');
CKEDITOR.replace('extra');


$(document).ready(function () {
	$('input[type=file]').change(function(){

			$('#cargar_imagen').removeAttr('disabled');   
	})

	$("#id_user").html('');

	$("#publicacion").on("change", ".tab-content #id_legislatura", function () {
$("#id_user ").empty();
var dato = new FormData();
dato.append('id', $(this).val());

$.ajax({
	type: "POST",
	contentType: false,
	//    				    				dataType: 'json',
	data: dato,
	processData: false,
	cache: false,
	beforeSend: function () {
		$("#sub_categoria ").empty();

	},
	url: $("body").data('base_url')+"Manager/Usuarios/get_usuario_id",
	success: function (result) {

		console.log('result');
		if (result === 'false') {
			toastr.options.hideMethod = 'slideUp';
			toastr.options.progressBar = true;

			toastr.error('Legislatura<br>' + $("#id_legislatura option:selected").text() + ',<br> no posee usuarios!', 'Publicaciones');
		} else {
			$("#id_user ").empty();

			$("#id_user").append(result);

		}
	},
	error: function (xhr, errmsg, err) {
		console.log(xhr.status + ": " + xhr.responseText);
	}
});
});


	$("#publicacion").on("change", ".tab-content #categoria", function () {

var dato = new FormData();
dato.append('id', $(this).val());

$.ajax({
	type: "POST",
	contentType: false,
	//    				dataType: 'json',
	data: dato,
	processData: false,
	cache: false,
	beforeSend: function () {
		$("#sub_categoria ").empty();

	},
	url: $("body").data('base_url')+"Manager/Post/get_subcategorias_id",
	success: function (result) {

		console.log('result');
		console.log(result);
		$("#sub_categoria ").empty();

		$("#sub_categoria").append(result);


		toastr.success('Registro Editado correctamente!', 'Categorías');
	},
	error: function (xhr, errmsg, err) {
		console.log(xhr.status + ": " + xhr.responseText);
	}
});

});

	
	
	//agrega video al editar publicaciones
	$("#post_addVideo").click(function(e){
		

		e.preventDefault();
		var dato = new FormData();
		dato.append('id_post', $(this).data('post'));
		dato.append('titulo_video', $('input#titulo_video').val());
		dato.append('detalle_video', $('input#detalle_video').val());

		$.ajax({
			type: "POST",
			contentType: false,
			//    				    				dataType: 'json',
			data: dato,
			processData: false,
			cache: false,
			beforeSend: function () {
				$("#sub_categoria ").empty();

			},
			url: $("body").data('base_url')+"Manager/Usuarios/get_usuario_id",
			success: function (result) {

				console.log('result');
				if (result === 'false') {
					toastr.options.hideMethod = 'slideUp';
					toastr.options.progressBar = true;

					toastr.error('Legislatura<br>' + $("#id_legislatura option:selected").text() + ',<br> no posee usuarios!', 'Publicaciones');
				} else {
					$("#id_user ").empty();

					$("#id_user").append(result);

				}
			},
			error: function (xhr, errmsg, err) {
				console.log(xhr.status + ": " + xhr.responseText);
			}
		});


});
