$(document).ready(function () {

	$('#example').DataTable({
		
		  columnDefs: [
				{
				"targets": [-1],
				"orderable": false
			},
			{
				targets: 0,
				className: 'dt-body-left'
			},
			{
				targets: -1,
				className: 'dt-body-right'
			}
  ],
		language: {
			url: $("body").data('base_url') + '/static/manager/translate/spanish.json'
		},
		"pageLength": 30,

		"ajax": {
			"url": $("body").data('base_url') + "Manager/Categorias/get_categorias",
			"type": "POST"
		}
	});


	// VALIDACION QUE EXISTA O NO EL NOMBRE DE LA CATEGORIA A CARGAR
	$('#nombre').on('keyup', function () {

		table = $('#example').DataTable();

		table.search(this.value).draw();
		tables = $('#example').DataTable();
		var info = table.page.info();
		var rowstot = info.recordsTotal;
		var rowsshown = info.recordsDisplay;


		if (rowsshown === 0) {

			$("#add_categoria").removeAttr("disabled");
			$("#existe_categoria").html('')
		} else {

			$("#existe_categoria").html('<div class="invalid-feedback" style="display:block;">Ya existe una categoría con ese nombre</div>')
			$("#add_categoria").attr("disabled", "disabled");

		}

	});

	//acciones de publicar y suspender estado 1/0
	$(".card-body").on("click", "a.acciones", function () {
		//	alert();
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
			url: $("body").data('base_url') + "Manager/Categorias/status_categoria",
			success: function (result) {
				console.log('result');
				console.log(result.estado);
				if (result.estado == true) {

					toastr.success('Registro Editado correctamente!', 'Categorías');
				} else {
					toastr.error('Registro no Actualizado!', 'Categorías');
				}
				location.reload();
			},
			error: function (xhr, errmsg, err) {
				console.log(xhr.status + ": " + xhr.responseText);
			}
		});
	});
	
	
	$(".card-body").on("click", "a.borrar_pub", function () {

		var id = $(this).data('id');

		$.confirm({
			closeIcon: true,
			icon: 'fa fa-warning',
			title: 'Borrar Categoría',
			content: 'Desea eliminar La categoría:',
			buttons: {

				confirm:{
					text: 'Confirmar',
					btnClass: 'btn btn-green', 
					action: function () {


						var dato = new FormData();

						dato.append('id',id);
					

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
							url: $("body").data('base_url') + "Manager/Categorias/borrar_categoria",
							success: function (result) {
							console.log('result');
							console.log(result.estado);

							if (result.estado == true) {
								toastr.success('Registro Borrado correctamente!', 'Temáticas');
							} else {
								toastr.error('Registro no Borrado!', 'Temáticas');
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
						$.alert('Acción Cancelada, no se borrará el dato');
					}
				},

			}
		});
		
		
	});

});
