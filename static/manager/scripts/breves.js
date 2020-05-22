var Gacetilla_Module = {
	attrs: {
		publicaciones: [],

	},
	methods: function () {



		function checkAvailableListPublicaciones(id) {
			return Gacetilla_Module.attrs.publicaciones.includes(id) ? false : true;
		}

		function getAll() {
			return Gacetilla_Module.attrs.publicaciones;
		}

		function countList() {
			return Gacetilla_Module.attrs.publicaciones.length;
		}

		function display() {
			$('.publicaciones_seleccionadas').text(this.countList());
			console.log('[array publicaciones] - Lista de ids', this.getAll());
		}

		function onChangeNumberTextSelect() {
			$('.publicaciones_seleccionadas').text(this.countList());
		}

		function actionsButtons() {

			$('.remove-all-Publicaciones').click(function (e) {
				e.preventDefault();

				swal({
					title: 'Eliminar Publicaciones',
					text: "¿Esta seguro desea eliminar la(s) persona(s) seleccionada(s)?",
					type: 'error',
					showCancelButton: true,
					confirmButtonText: 'Si, eliminar',
					cancelButtonText: 'No, cancelar!',
					confirmButtonClass: 'btn btn-success',
					cancelButtonClass: 'btn btn-danger m-l-10',
					buttonsStyling: false
				}).then(function () {

					Gacetilla_Module.methods().multiDeletes();
				}, function () {
					swal("Cancelado!", "Operación cancelada por el usuario!", "error");
				});
			});
		}



		function insert(id) {

			if (this.checkAvailableListPublicaciones(id)) {
				Gacetilla_Module.attrs.publicaciones.push(id);
			}

			this.display();
			this.refresh();
		}

		function remove(id) {

			Gacetilla_Module.attrs.publicaciones.splice(Gacetilla_Module.attrs.publicaciones.indexOf(id), 1);

			this.display();
			this.refresh();
		}

		function refresh() {

			if (Gacetilla_Module.attrs.publicaciones.length) {

				this.onChangeNumberTextSelect();
			} else {

			}

			$('.publicaciones_seleccionadas').html(this.countList());
		}

		function clearAll() {
			Gacetilla_Module.attrs.publicaciones = [];
			this.display();
		}

		function clearAndRefresh() {
			Gacetilla_Module.methods().clearAll();

			Gacetilla_Module.methods().refresh();
		}

		function onAllSelectionPublicaciones() {
			this.clearAll();

		}

		function fetchIds(ids) {
			this.clearAndRefresh();

			$('.publicaciones_seleccionadas').html("");

			ids.map(r => Gacetilla_Module.methods().insert(r));
		}

		return {
			fetchIds: fetchIds,
			insert: insert,
			remove: remove,
			getAll: getAll,
			display: display,
			refresh: refresh,
			countList: countList,
			clearAll: clearAll,
			clearAndRefresh: clearAndRefresh,


			checkAvailableListPublicaciones: checkAvailableListPublicaciones,
			onChangeNumberTextSelect: onChangeNumberTextSelect,
			onAllSelectionPublicaciones: onAllSelectionPublicaciones
		};
	},
	init: function () {
		console.log('Module Publicaciones Loaded');

	}
};
var Suscriptores_Module = {
	attrs: {
		suscriptores: [],

	},
	methods: function () {



		function checkAvailableListSuscriptores(id) {
			return Suscriptores_Module.attrs.suscriptores.includes(id) ? false : true;
		}

		function getAll() {
			return Suscriptores_Module.attrs.suscriptores;
		}

		function countList() {
			return Suscriptores_Module.attrs.suscriptores.length;
		}

		function display() {
			$('.suscriptores_seleccionados').text(this.countList());
			console.log('[array suscriptores] - Lista de ids', this.getAll());
		}

		function onChangeNumberTextSelect() {
			$('.suscriptores_seleccionados').text(this.countList());
		}

		function actionsButtons() {

			$('.remove-all-Suscriptores').click(function (e) {
				e.preventDefault();

				swal({
					title: 'Eliminar suscriptor',
					text: "¿Esta seguro desea eliminar la(s) persona(s) seleccionada(s)?",
					type: 'error',
					showCancelButton: true,
					confirmButtonText: 'Si, eliminar',
					cancelButtonText: 'No, cancelar!',
					confirmButtonClass: 'btn btn-success',
					cancelButtonClass: 'btn btn-danger m-l-10',
					buttonsStyling: false
				}).then(function () {

					Suscriptores_Module.methods().multiDeletes();
				}, function () {
					swal("Cancelado!", "Operación cancelada por el usuario!", "error");
				});
			});
		}



		function insert(id) {

			if (this.checkAvailableListSuscriptores(id)) {
				Suscriptores_Module.attrs.suscriptores.push(id);
			}

			this.display();
			this.refresh();
		}

		function remove(id) {

			Suscriptores_Module.attrs.suscriptores.splice(Suscriptores_Module.attrs.suscriptores.indexOf(id), 1);

			this.display();
			this.refresh();
		}

		function refresh() {

			if (Suscriptores_Module.attrs.suscriptores.length) {

				this.onChangeNumberTextSelect();
			} else {

			}

			$('.suscriptores_seleccionados').html(this.countList());
		}

		function clearAll() {
			Suscriptores_Module.attrs.suscriptores = [];
			this.display();
		}

		function clearAndRefresh() {
			Suscriptores_Module.methods().clearAll();

			Suscriptores_Module.methods().refresh();
		}

		function onAllSelectionSuscriptores() {
			this.clearAll();

		}

		function fetchIds(ids) {
			this.clearAndRefresh();

			$('.suscriptores_seleccionados').html("");

			ids.map(r => Suscriptores_Module.methods().insert(r));
		}

		return {
			fetchIds: fetchIds,
			insert: insert,
			remove: remove,
			getAll: getAll,
			display: display,
			refresh: refresh,
			countList: countList,
			clearAll: clearAll,
			clearAndRefresh: clearAndRefresh,


			checkAvailableListSuscriptores: checkAvailableListSuscriptores,
			onChangeNumberTextSelect: onChangeNumberTextSelect,
			onAllSelectionSuscriptores: onAllSelectionSuscriptores
		};
	},
	init: function () {
		console.log('Module Suscriptores Loaded');

	}
};

$(document).ready(function () {

	$("#selectAllPost").on("click", function (e) {

		if ($(this).is(":checked")) {
			dataTable_publicaciones.rows().select();
			dataTable_publicaciones.rows().iterator('row', function (context, index) {

				$(this.row(index).node()).hasClass('selected');
				var id = $(this.row(index).node()).attr('id');
				console.table('->' + $(this.row(index).node()).attr('id'));

				Gacetilla_Module.methods().insert(parseInt(id));

			});
		} else {

			dataTable_publicaciones.rows().deselect();
			Gacetilla_Module.methods().clearAndRefresh();
			Gacetilla_Module.methods().countList();
		}
	});

	$("#selectAllSuscriptores").on("click", function (e) {

		if ($(this).is(":checked")) {

			dataTable_suscriptores.rows().select();

			dataTable_suscriptores.rows().iterator('row', function (context, index) {

				$(this.row(index).node()).hasClass('selected');
				var id = $(this.row(index).node()).attr('id');
				console.table('->' + $(this.row(index).node()).attr('id'));

				Suscriptores_Module.methods().insert(parseInt(id));

			});


		} else {
			dataTable_suscriptores.rows().deselect();
			Suscriptores_Module.methods().clearAndRefresh();
			Suscriptores_Module.methods().countList();
		}
	});

	var dataTable_publicaciones = $('#dataTable_publicaciones').DataTable({

		'dom': '<"top"fi>rt<"bottom"lp><"clear">',
		'createdRow': function (row, data, dataIndex) {

			// agrego el atributo id al td 0 
			console.log('armo row');
			console.log(data);
			$(row).attr('id', data[1]);
			$(row).find('td:eq(0)').attr('id', data[1]);

		},
		'rowId': 'id',
		'select': true,
		'columnDefs': [{
				'width': "10px",
				'orderable': false,
				'className': 'select-checkbox',
				'targets': 0,
	}, {
				"targets": [4],
				"visible": false
            }, {
				"targets": [1],
				"visible": false
            }
																],
		'select': {
			'style': 'multi',
			'selector': 'td:first-child'
		},
		'order': [[1, 'asc']],
		'language': {

			'select': {
				rows: "%d Registros seleccionados"
			},
			'url': $("body").data('base_url') + 'static/Manager/translate/spanish.json'
		},
		"pageLength": 10,

		"ajax": {
			"url": $("body").data('base_url') + "Manager/Post/get_listados_ajax",
			"type": "POST",
			"data": {
				// envio tipo de tabla para reutilizar la funcion del controlador de Post_Model
				"tipo_tabla": 'gacetillas'
			},
		}
	});


	dataTable_publicaciones.on('select', function (e, dt, type, indexes) {

		if (type === 'row') {
			var data = dataTable_publicaciones.rows(indexes).data('id');
			Gacetilla_Module.methods().insert(parseInt(data[0][4]));

		}
	});

	dataTable_publicaciones.on('deselect', function (e, dt, type, indexes) {
		if (type === 'row') {
			var data = dataTable_publicaciones.rows(indexes).data('id');
			Gacetilla_Module.methods().remove(parseInt(data[0][4]));

		}
	});

	var dataTable_suscriptores = $('#dataTable_suscriptores').DataTable({

		'dom': '<"top"fi>rt<"bottom"lp><"clear">',
		'createdRow': function (row, data, dataIndex) {
			// agrego el atributo id al td 0 
			/*console.log('data');
			console.log(data);*/
			$(row).attr('id', data[3]);
			$(row).find('td:eq(0)').attr('id', data[3]);
		},
		'rowId': 'id',
		'select': true,
		'columnDefs': [{
			'width': "10px",
			'orderable': false,
			'className': 'select-checkbox',
			'targets': 0,

	}],
		'select': {
			'style': 'multi',
			'selector': 'td:first-child'
		},
		'order': [[1, 'asc']],
		'language': {

			'select': {
				rows: "%d Registros seleccionados"
			},
			'url': $("body").data('base_url') + 'static/Manager/translate/spanish.json'
		},
		"pageLength": 10,

		"ajax": {
			"url": $("body").data('base_url') + "Manager/Breves/get_suscriptores_ajax",
			"type": "POST",
			"data": {
				// envio tipo de tabla para reutilizar la funcion del controlador de Post_Model
				"tipo_tabla": 'suscriptores'
			},
		}
	});



	dataTable_suscriptores.on('select', function (e, dt, type, indexes) {
		if (type === 'row') {
			var data = dataTable_suscriptores.rows(indexes).data('id');
			Suscriptores_Module.methods().insert(parseInt(data[0][3]));

		}
	});

	dataTable_suscriptores.on('deselect', function (e, dt, type, indexes) {
		if (type === 'row') {
			var data = dataTable_suscriptores.rows(indexes).data('id');
			Suscriptores_Module.methods().remove(parseInt(data[0][3]));

		}
	});

	inicializar_listado();


	$("form#add_suscriptor").on("click", ":button#cancelar_datos ", function () {
		event.preventDefault();

		$('h4.titulo').html('Agregar Suscriptores');
		$("form#add_suscriptor")[0].reset();
		$("div.form-group > span").html('');
		$(this).addClass('invisible');
	});


	$("div#list_suscriptores").on("click", "a.editar_suscriptor ", function () {
		var id = $(this).data('id');
		var dato = new FormData();
		dato.append('id', $(this).data('id'));

		$.ajax({
			type: "POST",
			contentType: false,
			dataType: 'json',
			data: dato,
			processData: false,
			cache: false,
			beforeSend: function () {
				// $(".preloader").fadeIn();
				// $(".preloader").fadeOut();
			},
			url: base_url + "Manager/Breves/get_suscriptor",
			success: function (result) {
				console.log('result');
				console.log(result);

				if (result.estado == true) {

					$(":button#cancelar_datos").removeClass('invisible');
					$('h4.titulo').html('Editar Suscriptor');
					$('#id').val(result.id);
					$('#name').val(result.name);
					$('#lastname').val(result.lastname);
					$('#email').val(result.email);
					$('#telephone').val(result.telephone);
					$('#org').val(result.org);
					$('#iduser_ins').val(result.iduser_ins).attr('disabled', true);

				} else {
					toastr.error('Registro no Actualizado!', 'Categorías');
				}

			},
			error: function (xhr, errmsg, err) {
				console.log(xhr.status + ": " + xhr.responseText);
			}
		});

	});

	$("div#list_suscriptores").on("click", "a.ver_suscriptor", function () {
		var id = $(this).data('id');
		var dato = new FormData();
		dato.append('id', $(this).data('id'));

		$.ajax({
			type: "POST",
			contentType: false,
			dataType: 'json',
			data: dato,
			processData: false,
			cache: false,
			beforeSend: function () {
				// $(".preloader").fadeIn();
				// $(".preloader").fadeOut();
			},
			url: base_url + "Manager/Breves/get_suscriptor",
			success: function (result) {
				console.log('result');
				console.log(result);

				if (result.estado == true) {

					$('#name_view').val(result.name).attr('disabled', true);
					$('#lastname_view').val(result.lastname).attr('disabled', true);
					$('#email_view').val(result.email).attr('disabled', true);
					$('#telephone_view').val(result.telephone).attr('disabled', true);
					$('#org_view').val(result.org).attr('disabled', true);
					$('#iduser_ins_view').val(result.iduser_ins).attr('disabled', true);


				} else {
					alert(result.estado);
					return;
					toastr.error('Registro no Actualizado!', 'Categorías');
				}

			},
			error: function (xhr, errmsg, err) {
				console.log(xhr.status + ": " + xhr.responseText);
			}
		});

		$('#myModal').modal('show');

	});

	//acciones de publicar y suspender estado 1/0
	$("div#list_suscriptores").on("click", "a.borrar_suscriptor", function () {

		var id = $(this).data('id');
		var tabla = $(this).data('tabla');
		$.confirm({
			closeIcon: true,
			icon: 'fa fa-warning',
			title: 'Borrar Registro',
			content: 'Desea eliminar el registro:' + id,
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
							url: $("body").data('base_url') + "Manager/breves/borrar_suscriptor",
							success: function (result) {
								console.log('result');
								console.log(result.estado);
								if (result.estado == true) {
									toastr.success('Registro Borrado correctamente!', 'Suscriptores');
								} else {
									toastr.error('Registro no Borrado!', 'Suscriptores');
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
						$.alert('Acción Cancelada.<br>No se borrará el registro');
					}
				},

			}
		});

	});


	// envio de gacetillas
	$("div#send_gacetilla").click(function (event) {

		var ver = Gacetilla_Module.methods().getAll();

		event.preventDefault();

		var status = false;
		var asunto = $("#asunto").val();
		if ($("#asunto").val() == '') {
			$("#asunto_error").html('El campo Asunto es obligatorio');
			return false;
		} else {
			status = true;
			$("#asunto_error").html('');
		}

		if (Suscriptores_Module.attrs.suscriptores.length == 0) {
			$("#suscriptores_error").html('Seleccione Suscriptores a procesar');

		} else {
			status = true;
			$("#suscriptores_error").html('');
		}

		if (Gacetilla_Module.attrs.publicaciones.length == 0) {
			$("#publicaciones_error").html('Seleccione Publicaciones a procesar');

		} else {
			status = true;
			$("#publicaciones_error").html('');
		}

		if (!status) {
			return false;
		}

		var datos = new FormData();

		var titulo =
			datos.append('publicaciones', Gacetilla_Module.methods().getAll());
		datos.append('suscriptores', Suscriptores_Module.methods().getAll());
		datos.append('asunto', $("#asunto").val());

		$.ajax({
			type: "POST",
			contentType: false,
			dataType: 'json',
			data: datos,
			processData: false,
			cache: false,
			beforeSend: function () {
				// $(".preloader").fadeIn();
				// $(".preloader").fadeOut();
			},
			url: base_url + "/Manager/Breves/addGacetilla",
			success: function (result) {

				console.log('result addGacetilla');
				console.log(result);

				if (result.error) {
					toastr.error('Registro no Ingresado!', 'Breves en Imágenes<br>Agregar Gacetillas');
				} else {
				
//					window.location = base_url + 'Manager/Breves/Newsletters'
				//	window.location = base_url + 'Manager/Breves/Gacetillas'
					$("#response_ajax").html(result.response_ajax);
				}

			},
			error: function (xhr, errmsg, err) {
				console.log(xhr.status + ": " + xhr.responseText);
			}
		});



	});
	$("form#add_suscriptor").on("click", ":button#cargar_datos ", function (event) {

		event.preventDefault();

		$.ajax({
			url: base_url + 'Manager/breves/cargar_suscriptor',
			method: 'POST',
			data: $("form#add_suscriptor").serialize(),
			dataType: 'JSON',
			beforeSend: function () {

				$("#cargar_datos").attr('disabled', 'disabled');

			},
			success: function (result) {

				console.log('result');
				console.log(result);

				if (result.error) {

					if (result.nombre_error != '') {
						$("#nombre_error").html(result.nombre_error);
					} else {
						$("#nombre_error").html('');
					}
					if (result.apellido_error != '') {
						$("#apellido_error").html(result.apellido_error);
					} else {
						$("#apellido_error").html('');
					}
					if (result.email_error != '') {
						$("#email_error").html(result.email_error);
					} else {
						$("#email_error").html('');
					}

				}

				if (result.save_error) {

					toastr["error"](result.mensaje);

				}
				if (result.success) {
					$("#nombre_error").html('');
					$("#apellido_error").html('');
					$("#email").html('');
					$("form#add_suscriptor")[0].reset();

					toastr["success"](result.mensaje);

					$('#suscriptores').DataTable().destroy();
					inicializar_listado();

				}
				$("#cargar_datos").attr('disabled', false);
			}
		});

	});

});

function inicializar_listado() {

	$('#suscriptores').DataTable({
		'dom': '<"top"fi>rt<"bottom"lp><"clear">',
		"processing": true,
		"serverSide": true,

		columnDefs: [
			{
				"targets": [-1],
				"orderable": false
			},
			{
				targets: 0,
				width: "10px",
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
		"pageLength": 10,

		"ajax": {
			"url": $("body").data('base_url') + "Manager/breves/get_suscriptores_dt",
			"type": "POST"
		}
	});
}
