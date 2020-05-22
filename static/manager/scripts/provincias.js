$(document).ready(function () {


	$('.minicolors-input_prov').minicolors({
		//			control: $(this).attr('data-control') || 'hue',
		//			position: $(this).attr('data-position') || 'bottom left',

		change: function (value, opacity) {
			console.log(value);
			$('span.provincia').css('background-color', value);
		},
		theme: 'bootstrap'

	});

	$('.minicolors-input_camara').minicolors({
		control: $(this).attr('data-control') || 'hue',
		position: $(this).attr('data-position') || 'bottom left',

		change: function (value, opacity) {
			alert()
			$('span.minicolors-swatch-color_camara').css('background-color', value);
		},
		theme: 'bootstrap'

	});


	$('#example').DataTable({
		columnDefs: [
			{
				targets: -1,
				className: 'dt-body-right'
    			},
			{
				"targets": [-1],
				"orderable": false
					},
			{
				targets: -1,
				className: 'dt-body-right'
					},
			{
				targets: 0,
				className: 'dt-body-left'
					}
			],
		language: {
			url: $("body").data('base_url') + 'static/manager/translate/spanish.json'
		},
		"pageLength": 50,

		"ajax": {
			"url": $("body").data('base_url') + "Manager/Provincias",
			"type": "GET"
		}
	});

	$(".card-body").on("click", "button.acciones", function () {

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
			url: $("body").data('base_url') + "Manager/Provincias/status_normativa",
			success: function (result) {
				console.log('result');
				console.log(result.estado);
				if (result.estado == true) {
					toastr.success('Registro Editado correctamente!', 'Tipos');
				} else {
					toastr.error('Registro no Actualizado!', 'Tipos');
				}
				//					 location.reload();


				location.reload();


			},
			error: function (xhr, errmsg, err) {
				console.log(xhr.status + ": " + xhr.responseText);
			}
		});
	});
});
