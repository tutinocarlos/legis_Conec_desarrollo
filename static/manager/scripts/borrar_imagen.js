$(document).ready(function () {

	$("div#fondo_imagen").on("click", "a.borrar_imagen", function () {

		var id 	= $(this).data('imagen');
		var foto = $(this).data('foto');
		var url = $(this).data('url');
		var id_legis = $(this).data('legis');
	

		$.confirm({
			closeIcon: true,
			icon: 'fa fa-warning',
			title: 'Borrar Imagenes',
			content: 'Desea eliminar la imagen:'+id + '<br>'+foto,
			buttons: {

				confirm:{
					text: 'Proceder',
					btnClass: 'btn btn-green', 
					action: function () {

						var dato = new FormData();
						dato.append('id', id);
						dato.append('url', url);
						dato.append('foto', foto);
						dato.append('id_legis', id_legis);

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
						url: $("body").data('base_url') + "Manager/Legislaturas/eliminar_imagen",
						success: function (result) {
							$(".preloader").fadeOut();
							console.log('result');
							console.log(result);
							if (result.estado == true) {
								$("div#file_"+id).remove();

								toastr.success(result.mensaje, 'Imágenes');
								if(result.cantidad == 0){
									$("div#fondo_imagen").html('<div class="alert alert-info col-sm-12" role="alert"><h4 class="alert-heading">Legislatura  sin imágenes</h4><hr><p>Se mostrará el video por defecto del sistema</p></div>');
								}
						
							} else {
							toastr.error('Registro no Borrado !', 'Imágenes');
							}
//									location.reload();
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
						$.alert('Acción Cancelada, no se borrará la imagen');
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
	
	
	
	
	$("div#accordian-4").on("click", "a.borrar_imagen_post", function () {

		var id 	= $(this).data('imagen');
		var url = $(this).data('url');
		var foto = $(this).data('foto');
		var id_post = $(this).data('post');

		$.confirm({
			closeIcon: true,
			icon: 'fa fa-warning',
			title: 'Borrar Imagenes',
			content: 'Desea eliminar la imagen:'+id + '<br>'+foto,
			buttons: {

				confirm:{
					text: 'Proceder',
					btnClass: 'btn btn-green', 
					action: function () {

						var dato = new FormData();
						dato.append('id', id);
						dato.append('url', url);
						dato.append('foto', foto);
						dato.append('post', id_post);

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
						url: $("body").data('base_url') + "Manager/Post/eliminar_imagen",
						success: function (result) {
							$(".preloader").fadeOut();
							console.log('result');
							console.log(result);
							if (result.estado == true) {
								$("div#file_"+id).remove();

								toastr.success('Imagen Borada correctamente!', 'Imágenes');
								if(result.cantidad == 0){
									$("div#fondo_imagen").html('<div class="alert alert-danger" role="alert"><h4 class="alert-heading">Publicación sin imágenes</h4><hr><p>Se mostrará la imagen por defecto del sistema</p></div>');
								}
							$('div#Toggle-2').addClass('show');
							} else {
							toastr.error('Registro no Borrado !', 'Imágenes');
							}
//									location.reload();
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
						$.alert('Acción Cancelada, no se borrará la imagen');
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
