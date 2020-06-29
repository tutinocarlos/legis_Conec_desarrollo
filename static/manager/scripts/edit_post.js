			toastr.options.hideMethod = 'slideUp';
			toastr.options.progressBar = true;

		function crear_tags(){
		var valueLength = $("#tags").val().length;
		if(valueLength > 3){
			var valor = '<input size="'+valueLength+'" class= "business-tag " type="text" name="tags[]" value="'+$("#tags").val()+'" style="text-align: center" readonly>'
			$("#nube_tags").append(valor);
			
			var cadena = $("#tags").val()+',';
			
			$("#text_tags").append(cadena);
			$("#tags").val('');
		}
	
	}

$(document).ready(function () {

	$("#borrar_video").click(function(e){
		
		
		$.confirm({
		 columnClass: 'medium',
			closeIcon: true,
			icon: 'fa fa-warning',
			title: 'Tutoriales',
			content: 'Confirma eliminar el video?',
			buttons: {

				confirm:{
					text: 'Proceder',
					btnClass: 'btn btn-green', 
					action: function () {
						
						var dato = new FormData();
		
						dato.append('id_video', $("a#borrar_video").data('id_video'));
		
						$.ajax({
							type: "POST",
							contentType: false,
							dataType: 'json',
							data: dato,
							processData: false,
										cache: false,
							beforeSend: function () {
								$("#sub_categoria ").empty();

							},
							url: $("body").data('base_url')+"Manager/Post/borrar_video",
							success: function (result) {

											console.log('result');
											console.log(result);


											if (result.status === true) {
							//					toastr.onShown = function() {
							//						 location.reload();
							//						
							//					}
							//					toastr.options.hideMethod = 'slideUp';
							//					toastr.options.progressBar = true;

							//					toastr.success('Se ha borrado el video correctamente', 'Publicaciones');
											} else {
							//					toastr.error('Ocurrió un error al borrar el video', 'Publicaciones');

											}
											location.reload();
										},
										error: function (xhr, errmsg, err) {
											console.log(xhr.status + ": " + xhr.responseText);
										}
									});
					}
				},
				cancel: {
					text: 'Cancelar',
					btnClass: 'btn btn-red', 
					action: function () {
						$.alert('Acción Cancelada, no se eliminará el Video');
					}
				},

			}
		});

	});

	
	$("#post_addVideo").click(function(e){
		alert();	
		e.preventDefault();
		
		if($('input#url_video').val() == ''){
			$("#titulo_video_error").html('La url del video es obligatoria');
			toastr.error('El campo URL es Obligatorio', 'Publicaciones - Videos');
			return false;
																											
		}
		
		
		var dato = new FormData();
		dato.append('id_post', $(this).data('post'));
		dato.append('titulo_video', $('input#titulo_video').val());
		dato.append('detalle_video', $('#detalle_video').val());
		dato.append('url_video', $('input#url_video').val());

		$.ajax({
			type: "POST",
			contentType: false,
			dataType: 'json',
			data: dato,
			processData: false,
						cache: false,
			beforeSend: function () {
				$("#sub_categoria ").empty();

			},
			url: $("body").data('base_url')+"Manager/Post/add_video",
			success: function (result) {

				console.log('result');
				console.log(result);
				
				
				if (result.status === true) {
//					toastr.onShown = function() {
//						 location.reload();
//						
//					}
//					toastr.options.hideMethod = 'slideUp';
//					toastr.options.progressBar = true;
					$('#form_cargar_video')[0].reset();
					toastr.success(result.mensaje, 'Publicaciones');
					location.reload();
				} else {
					$("#titulo_video_error").html('La url del video es obligatoria')
					toastr.error(result.mensaje, 'Publicaciones');
				}
			},
			error: function (xhr, errmsg, err) {
				console.log(xhr.status + ": " + xhr.responseText);
			}
		});


});
	
	
	/* SUBIR ARCHIVOS ADJUNTOS */
	$('#upload_file').submit(function(e) {

		e.preventDefault();
		
		var formData = new FormData($("form#upload_file")[0]);
		$.ajax({
			type: $("form#upload_file").attr('method'),
			url :	$('body').data('base_url')+'Manager/Post/add_archivo_adjunto', 
			cache: false,
			contentType: false,
			processData: false,
			data			: formData,
			success	: function (response)
			{
				response = $.parseJSON(response); 
				console.log('status');
				console.log(status);
				console.log('data');
				console.log(response.msg);
				
				
	
				if(response.status != 'error'){
					$('#upload_file').trigger("reset");
					$('#subir_archivos').attr('disabled','disabled');
					toastr.success('Archivos Adjuntos<br>' + response.msg + ',<br>', 'Publicaciones');
					$("div.comment-widgets").append(response.html);
				}else{
					toastr.error('Archivos Adjuntos<br>' + response.msg + ',<br>', 'Publicaciones');
				}
			}
		});
		return false;
	});
	
	
$( 'textarea#resumen,textarea#cuerpo,textarea#extra').css('display','none');	
	
	
	$( 'textarea#resumen_prev' ).ckeditor();
	$( 'textarea#cuerpo_prev' ).ckeditor();
	$( 'textarea#extra_prev' ).ckeditor();
	
	//quito el foco del boton de envio
	$( "submit[name='botonSubmit']" ).blur();
	
	function alerta(element, valor)
    {
    var mensaje;
    var opcion = confirm("Desea eliminar "+element.val()+"\n de la lista? \n Click en Aceptar o Cancelar");
    if (opcion == true) {
			
			$('#text_tags').val($('#text_tags').val().replace(element.val()+',', ""));
	 		element.remove();
	} else {
	}
}
	
	
	
	/*BORRAR ADJUNTO */
	
	$("div.comment-widgets").on("click", "button.borrar_adjunto", function () {
		
		var id = $(this).data('id');
		var archivo = $(this).data('archivo');
		$.confirm({
		 columnClass: 'medium',
			closeIcon: true,
			icon: 'fa fa-warning',
			title: 'Borrar Legislatura',
			content: 'Desea eliminar el id:'+id + '<br><strong>Archivo: '+archivo+'</strong>',
			buttons: {

				confirm:{
					text: 'Proceder',
					btnClass: 'btn btn-green', 
					action: function () {

						var dato = new FormData();
						dato.append('id', id);
	

						$.ajax({
						type: "POST",
						contentType: false,
						dataType: 'json',
						data: dato,
						processData: false,
						cache: false,
						beforeSend: function () {
						$(".preloader").fadeIn();
						},
						url: $("body").data('base_url') + "Manager/Post/borrar_adjunto",
						success: function (result) {
							console.log('result');
							console.log(result.estado);
							$(".preloader").fadeOut();
							if (result.estado == 'true') {
								
									$("#adjunto_"+id).remove();
									toastr.success('Registro borrado correctamente!', 'Legislaturas');
								
			
							} else {
								toastr.error('Registro no Borrado !', 'Legislaturas');
							}
						},
						error: function (xhr, errmsg, err) {
						console.log(xhr.status + ": " + xhr.responseText);
						}
						});



					}
				},
				cancel: {
					text: 'Cancelar',
					btnClass: 'btn btn-red', 
					action: function () {
						$.alert('Acción Cancelada, no se borrará el dato');
					}
				},
//								somethingElse: {
//									text: 'Something else',
//									btnClass: 'btn-blue',
//									keys: ['enter', 'shift'],
//									action: function () {
//										$.alert('Something else?');
//									}
//								}
			}
		});
		
		
	});
		
	$('#userfile').change(function(){

			$('#subir_archivos').removeAttr('disabled');   
	})

	
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


		toastr.success('Registro Editado correctamente!', 'Publicaciones ');
	},
	error: function (xhr, errmsg, err) {
		console.log(xhr.status + ": " + xhr.responseText);
	}
});

});


});
