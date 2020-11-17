$(document).ready(function () {
	var table = $('#table_links').DataTable({
		//className: "text-nowrap"
		"dom": '<"toolbar">frtip',
		rowReorder: true,
		"autoWidth": true,
		"paging": false,
		"info": false,
		"aaSorting": [[0, "desc"]],
		"pageLength": 100,
		"columnDefs": [
			{
				targets: [0, 1],
				visible: false,
					},
			{
				targets: [0, 1, 2, 4, 5],
				className: 'dt-body-left reorder',
				orderable: true,
				width: "auto",
    	},

				],
		'language': {
			'url': $("body").data('base_url') + 'static/manager/translate/spanish.json',
		},
		"oLanguage": {
			"sSearch": "Ingrese el texto para filtrar contenidos",
			"sEmptyTable": "Ningún dato disponible en esta tabla"
		},
		"ajax": {
			"url": $("body").data('base_url') + "Manager/Links",
			"type": "POST"
		},

		initComplete: function () {
			$("div.toolbar").html('<b class="txt_ordenar">Para cambiar el orden de los elementos arrastre la columna "título" a la posición deseada.</b>');
		}

	});


	table.on('row-reorder', function (e, diff, edit) {
		console.log('diff');
		console.log(diff);
		var myArray = [];
		var result_cb = 'Reorden a partir del : ' + edit.triggerRow.data()[0] + '<br>';

		for (var i = 0, ien = diff.length; i < ien; i++) {
			var rowData = table.row(diff[i].node).data();
			myArray.push({
				id_link: rowData[1],
				orden_link: diff[i].newData,
			});

			result_cb += '<br>El orden  ' + rowData[1] + ' fue cambiado a la posiciÃ³n  ' +
				diff[i].newData + ' (antes en  ' + diff[i].oldData + ')<br>';
		}
		$('#response').html(result_cb);
		/* di tetecto cambios de orden envio a ajax para reordenar */
		if (diff != '') {
			reordenar(myArray);
		}

		$('#result').data('evento', result_cb);
	});

	function reordenar(myArray, result_cb) {

		$.ajax({
			type: "POST",
			dataType: 'json',
			data: {
				'array': JSON.stringify(myArray)
			},
			beforeSend: function () {

			},
			url: $("body").data('base_url') + "Manager/Links/ordenar",
			success: function (result) {
				console.log('result');
				console.log(result);
				//						table.draw();

			},
			error: function (xhr, errmsg, err) {
				console.log(xhr.status + ": " + xhr.responseText);
			}
		});

	};

	//$('#table_links tbody').on( 'click', 'tr', function () {
	//    alert( 'Row index: '+table.row( this ).index() );
	//} );
	$("div.toolbar").html('<b class="txt_ordenar">Para cambiar el orden de los elementos arrastre la columna titulo a la posición deseada.</b>');

	$("#table_links").on("click", ".editar_link ", function () {
		
		var data = new FormData();
		data.append('id', $(this).data('id'));
		
		$.ajax({
			type: "POST",
			contentType: false,
			dataType: 'json',
			data: data,
			processData: false,
			cache: false,
			beforeSend: function () {
				$(".preloader").fadeIn();
			},
			url: $("body").data('base_url') + "Manager/Links/buscar_link",
			success: function (result) {
				$(".preloader").fadeOut();
			console.log(result);
				
				$("#id_link").val(result.id_link);
				$("#titulo_link").val(result.titulo_link);
				$("#url_link").val(result.url_link);
				$("#detalle_link").val(result.detalle_link);
//				$("#orden_link").val(result.orden_link);
				
				window.location.href = "#id_link";

			},
			error: function (xhr, errmsg, err) {
				console.log(xhr.status + ": " + xhr.responseText);
			}
		});
	});
	
	$("#table_links").on("click", ".accion_link ", function () {

		var data = new FormData();
//alert($(this).data('mensaje'));
		data.append('id', $(this).data('id'));
		data.append('estado', $(this).data('estado'));
		data.append('accion', $(this).data('accion'));
		data.append('mensaje', $(this).data('mensaje'));
		data.append('seccion', 'Links de Interés');

		acciones_links(data);

	});
	
});

	function acciones_links(data){

		$.confirm({
			columnClass: 'medium',
			closeIcon: true,
			icon: 'fa fa-warning',
			title: data.get("seccion"),
			content: 'Confirma la '+ data.get("mensaje") +' del archivo?',
			buttons: {

				confirm: {
					text: 'Proceder',
					btnClass: 'btn btn-green',
					action: function () {
						$.ajax({
							type: "POST",
							contentType: false,
							dataType: 'json',
							data: data,
							processData: false,
							cache: false,
							beforeSend: function () {
								$(".preloader").fadeIn();
							},
							url: $("body").data('base_url') + "Manager/Links/"+data.get("accion"),
							success: function (result) {
								$(".preloader").fadeOut();
								if (result.estado == true) {
									toastr.success(result.mensaje, 'Links de Interés');
								} else {
									toastr.error(result.mensaje, 'Links de Interés');
								};
								
								$("#table_links").DataTable().ajax.reload(null, false );
							
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
						$.alert('Acción Cancelada');
					}
				},

			}
		});
	}