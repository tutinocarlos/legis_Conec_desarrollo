$(document).ready(function () {

$('input[type=file]').change(function(){
	
    $('#cargar_imagen').removeAttr('disabled');   
})
	//    

	//	subir imagen principal
	$("#my_form_2").on('submit', function (e) {
		e.preventDefault();
		var dato = new FormData();
		dato.append('id_post', $('input#id_post').val());
		dato.append('titulo_video', $('input#titulo_video').val());
		dato.append('detalle_video', $('#detalle_video').val());
		dato.append('url_video', $('input#mi_video').val());


		$.ajax({
			type: "POST",
			contentType: false,
			dataType: 'json',
			data: dato,
			processData: false,
			cache: false,
			beforeSend: function () {

			},
			url: $("body").data('base_url')+"Manager/Post/add_video",
			success: function (result) {

				console.log('result');
				console.log(result);

				if(result.status === true){
					toastr.success('Se ha agregado el video correctamente', 'Publicaciones');
					
				}else{
					toastr.error('Ocurrió un error al cargar el video', 'Publicaciones');
				}
				location.reload();
			},
			error: function (xhr, errmsg, err) {
				console.log(xhr.status + ": " + xhr.responseText);
			}
		});

	});


	$("#checkTouTubed").on('click', function (e) {
alert();
		var url_video = $("#url_video").val();

		var IdVideo = getUrlParameter('v', url_video);



	})

	
	
	
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

	
	$("#enviar_video").click(function(e){

		e.preventDefault();
		
		if($('input#url_video').val() == ''){
			$("#titulo_video_error").html('La url del video es obligatoria');
			toastr.error('El campo URL es Obligatorio', 'Publicaciones - Videos');
			return false;
																											
		}
		
		
		var dato = new FormData();
		dato.append('id_post', $('input#id_post').val());
		dato.append('titulo_video', $('input#titulo_video').val());
		dato.append('detalle_video', $('#detalle_video').val());
		dato.append('url_video', $('input#mi_video').val());

		$.ajax({
			type: "POST",
			contentType: false,
			dataType: 'json',
			data: dato,
			processData: false,
			cache: false,
			beforeSend: function () {


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
					$('#my_form_2')[0].reset();
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
	
	
	$('#userfile').change(function(){

	$('#subir_archivos').removeAttr('disabled');   
	})
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
	
});
