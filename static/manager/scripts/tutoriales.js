$(document).ready(function () {
/*BORRAR TUTORIAL*/
	
	$("div#tutos > ul#tutoriales_legis").on("click", "div.borrar", function (e) {
		e.preventDefault();
		var dato = new FormData();
		dato.append('video', $(this).data('video'));
		dato.append('id', $(this).data('id'));
		dato.append('url', $(this).data('url'));
		if( $(this).data('video') == 0){
			var mensaje = 'Desea eliminar el Documentos PDF ?';
		}else{
			var mensaje = 'Desea eliminar el video tutorial ?';
		}
		$.confirm({
		 columnClass: 'medium',
			closeIcon: true,
			icon: 'fa fa-warning',
			title: 'Tutoriales',
			content: mensaje,
			buttons: {

				confirm:{
					text: 'Proceder',
					btnClass: 'btn btn-green', 
					action: function () {
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
						url: $("body").data('base_url')+"Manager/Tutoriales/borrar",
						success: function (result) {
							$(".preloader").fadeOut();
							console.log('result');
							console.log(result.estado);
							if (result.estado == true) {
								
								$('li#tutorial_'+result.id).remove();
								
								toastr.success('Registro Borrado correctamente! ', 'Tutoriales');
							} else {
								toastr.error('Registro no Borrado!', 'Tutoriales');
							}
								$('#example').DataTable().ajax.reload();

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
						$.alert('Acción Cancelada, no se eliminará el Tutorial');
					}
				},

			}
		});
		
		
		
	});
	/*CARGA VIDEOS YOUTUBE*/
	$("#video_youtube").on("submit", function (e) {
		e.preventDefault();

		
		var data = new FormData($("#video_youtube")[0]);
					$.ajax({
				type : "POST",
				dataType:'json',
				data:data,
				contentType:false,
				processData:false,
				cache:false,
				beforeSend: function(){
					 $(".preloader").fadeIn();
				},
				url : $("body").data('base_url')+"Manager/Tutoriales/grabar_video",
				success : function (result) {
					$(".preloader").fadeOut();
					console.log('result');
					console.log(result);
					if(result.estado == true){
						$("#video_post").html('');
						toastr.success(result.mensaje+'<br>'+result.archivo, 'Tutoriales');
						//reseteo el formulario
						$('span').html('');
						
						$('#video_youtube').trigger("reset");
						// agrego elemento nuevo al ul
						$("#tutoriales_legis").prepend(result.html);
						
					}else{

					if (result.titulo_error != '') {
						$("#you_tube_titulo_error").html(result.titulo_error);
					} else {
						$("#you_tube_titulo_error").html('');
					}
					if (result.descripcion_error != '') {
						$("#you_tube_descripcion_error").html(result.descripcion_error);
					} else {
						$("#you_tube_descripcion_error").html('');
					}				
						if (result.url_error != '') {
						$("#you_tube_url_error").html(result.url_error);
					} else {
						$("#you_tube_url_error").html('');
					}

						toastr.error(result.mensaje, 'Tutoriales');
						
					}
					
				},
				error : function(xhr,errmsg,err) {
									console.log(xhr.status + ": " + xhr.responseText);
								}
			});

	});
	
	
	
	/* CARGA DE ARCHIVOS PDF*/
	// detecto cambio de input file para poner el nombre del archivo en el imput
	$("input:file").change(function (){
		var fileName = $('input[type=file]').val().replace(/.*(\/|\\)/, '');
			$("#userfile_pdf").html(fileName).addClass('text-success').removeClass('text-danger');
		});
	
	$("#form_alta_archivo").on("submit", function (e) {

		e.preventDefault();
				var data = new FormData($("#form_alta_archivo")[0]);

			$.ajax({
				type : "POST",
				dataType:'json',
				data:data,
				contentType:false,
				processData:false,
				cache:false,
				beforeSend: function(){
					 $(".preloader").fadeIn();
				},
				url : $("body").data('base_url')+"Manager/Tutoriales/grabar_archivo",
				success : function (result) {
					$(".preloader").fadeOut();
					console.log('result');
					console.log(result);
					if(result.estado == true){
						toastr.success(result.mensaje+'<br>'+result.archivo, 'Tutoriales');
						//reseteo el formulario
						$("#userfile_pdf").removeClass('text-success').html('Seleccione el Archivo PDF');
						$('span').html('');
						$('#form_alta_archivo').trigger("reset");
						// agrego elemento al ul
						$("#tutoriales_legis").prepend(result.html);
					}else{

					if (result.titulo_error != '') {
						$("#titulo_error").html(result.titulo_error);
					} else {
						$("#titulo_error").html('');
					}
					if (result.descripcion_error != '') {
						$("#descripcion_error").html(result.descripcion_error);
					} else {
						$("#descripcion_error").html('');
					}
					if (result.archivo_error != '') {
						$("#userfile_pdf").addClass('text-danger');
						$("#userfile_pdf").html(result.archivo_error);
					} else {
						$("#userfile_pdf").removeClass('text-danger');
						$("#userfile_pdf").html(result.archivo_nombre);
					}
						toastr.error(result.mensaje, 'Tutoriales');
						
					}
					
				},
				error : function(xhr,errmsg,err) {
									console.log(xhr.status + ": " + xhr.responseText);
								}
			});
	});


});