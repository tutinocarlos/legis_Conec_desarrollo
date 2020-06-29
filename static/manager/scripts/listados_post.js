$(document).ready(function () {


	$('#listados_post').DataTable({

		language: {
			url: $("body").data('base_url') + 'static/manager/translate/spanish.json'
		},
		"columnDefs": [
			{
				"targets": [5],
				"orderable": false
			},
			{
				targets: -1,
				className: 'dt-body-right'
    	},
			{
				targets: -2,
				className: 'dt-body-center'
    	}
  ],
		"order": [[0, "DESC"]],
		"pageLength": 50,

		"ajax": {
			"url": $("body").data('base_url') + "Manager/Post/get_listados_ajax",
			"type": "POST",
			"complete": function (xhr, responseText) {

			}
		}
	});

	//acciones de publicar y suspender estado 1/0
	$(".card-body").on("click", "a.borrar_pub", function () {

		var id = $(this).data('id');
		var tabla = $(this).data('tabla');
		$.confirm({
			closeIcon: true,
			icon: 'fa fa-warning',
			title: 'Borrar Publicación',
			content: 'Desea eliminar la publicación:' + id,
			buttons: {

				confirm: {
					text: 'Confirmar',
					btnClass: 'btn btn-green',
					action: function () {
						var dato = new FormData();
						dato.append('id', id);
						dato.append('tabla', tabla);
						dato.append('estado', 1);

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
							url: $("body").data('base_url') + "Manager/Post/borrar_post",
							success: function (result) {

								if (result.estado == true) {
									toastr.success('Registro Borrado correctamente!', 'Publicaciones');
								} else {
									toastr.error('Registro no Borrado!', 'Publicaciones');
								}
								location.reload();


							},
							error: function (xhr, errmsg, err) {
								//console.log(xhr.status + ": " + xhr.responseText);
							}
						});

					}
				},
				cancel: {
					text: 'Cancelar',
					btnClass: 'btn btn-red',
					action: function () {
						$.alert('Acción Cancelada, no se borrará la Publicación');
					}
				},

			}
		});

	});

	$(".card-body").on("click", "a.acciones", function () {

		var dato = new FormData();
		dato.append('id', $(this).data('id'));
		dato.append('tabla', $(this).data('tabla'));
		dato.append('estado', $(this).data('estado'));

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
			url: $("body").data('base_url') + "Manager/Post/status_post",
			success: function (result) {
//								console.log('result');
//								console.log(result.estado);
				if (result.estado == true) {
					toastr.success('Registro Editado correctamente!', 'Publicaciones');
				} else {
					toastr.error('Registro no Actualizado!', 'Publicaciones');
				}

				location.reload();

				//					setTimeout(function(){
				//					$(".preloader").fadeOut();
				// 						location.reload();
				//					}, 2000);

				//						console.log(result.estado);
				//					if(result.estado){
				//						console.log(result.estado);
				//					}else{
				//						console.log(result.estado);
				//						
				//					}
				//					

			},
			error: function (xhr, errmsg, err) {
				//console.log(xhr.status + ": " + xhr.responseText);
			}
		});
	});

});
