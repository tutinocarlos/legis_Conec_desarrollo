//https://ckeditor.com/latest/samples/toolbarconfigurator/index.html#basic

//CKEDITOR.replace('cuerpo');
//
//CKEDITOR.replace('resumen');
//
//CKEDITOR.replace('extra');
//CKEDITOR.editorConfig = function( config ) {
//	// Define changes to default configuration here.
//	// For complete reference see:
//	// http://docs.ckeditor.com/#!/api/CKEDITOR.config
//
//	// The toolbar groups arrangement, optimized for two toolbar rows.
//	config.toolbarGroups = [
//		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
//		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
//		{ name: 'links' },
//		{ name: 'insert' },
//		{ name: 'forms' },
//		{ name: 'tools' },
//		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
//		{ name: 'others' },
//		'/',
//		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
//		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
//		{ name: 'styles' },
//		{ name: 'colors' },
//		{ name: 'about' }
//	];
//
//	// Remove some buttons provided by the standard plugins, which are
//	// not needed in the Standard(s) toolbar.
//	config.removeButtons = 'Underline,Subscript,Superscript';
//
//	// Set the most common block elements.
//	config.format_tags = 'p;h1;h2;h3;pre';
//
//	// Simplify the dialog windows.
//	config.removeDialogTabs = 'image:advanced;link:advanced';
//};





function alerta(element, valor) {
	var mensaje;
	var opcion = confirm("Desea eliminar " + element.val() + "\n de la lista? \n Click en Aceptar o Cancelar");
	if (opcion == true) {

		$('#text_tags').val($('#text_tags').val().replace(element.val() + ',', ""));
		element.remove();
	} else {}
}

// creacion de nube de tags
function crear_tags() {
	var valueLength = $("#tags").val().length;
	if (valueLength > 3) {
		var valor = '<input size="' + valueLength + '" class= "business-tag" type="text" name="tags[]" value="' + $("#tags").val() + '" style="text-align: center" readonly>'
		$("#nube_tags").append(valor);

		var cadena = $("#tags").val() + ',';

		$("#text_tags").append(cadena);
		$("#tags").val('');
	}

}


/*borrar tags*/
$("#publicacion").on("click", ".business-tag", function () {
	alerta($(this), $(this).val());
})
//inicializo los texatrea
$('textarea#resumen,textarea#cuerpo,textarea#extra').css('display', 'none');
$('textarea#resumen_prev').ckeditor();
$('textarea#cuerpo_prev').ckeditor();
$('textarea#extra_prev').ckeditor();


$(document).ready(function () {


	$("#cargar_datos").click(function () {

		$("#resumen").text(CKEDITOR.instances.resumen_prev.getData());
		$("#cuerpo").text(CKEDITOR.instances.cuerpo_prev.getData());
		$("#extra").text(CKEDITOR.instances.extra_prev.getData());


		$("#send_post").submit();

	})





	var base_url = $('body').data('base_url');
	//quito foco de boton de envio del POST
	$("submit[name='botonSubmit']").blur();

	$('#example').DataTable({
		language: {
			url: $("body").data('base_url') + 'static/Manager/translate/spanish.json'
		},
		"pageLength": 50,

		"ajax": {
			"url": $("body").data('base_url') + "Manager/Post/get_post",
			"type": "POST"
		}
	});

	$("#sub_categoria").html('');
	$("#id_user").html('');
	//    		$("#categoria").select(function () {



	// anulo la seleccion del usuario 
	$("#publicacion").on("change", ".tab-content #id_legislatura", function () {
		$("#id_user ").empty();
		var dato = new FormData();
		dato.append('id', $(this).val());

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
			url: $("body").data('base_url') + "Manager/Usuarios/get_usuario_id",
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


	//	$("#publicacion").on("change", "select[name=tipo]", function () {
	//
	//		if ($(this).val() != 2) {
	//			$("#estado_art").removeClass('invisible');
	//		} else {
	//			$("#estado_art").addClass('invisible');
	//
	//		}
	//
	//
	//	});

	$("#publicacions").on("change", "select[name=categoria]", function () {

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
			url: $("body").data('base_url') + "Manager/Post/get_subcategorias_id",
			success: function (result) {

				console.log('result');
				console.log(result);
				$("#sub_categoria ").empty();

				$("#sub_categoria").append(result);

				//    					toastr.success('Registro Editado correctamente!', 'Categorías');
			},
			error: function (xhr, errmsg, err) {
				console.log(xhr.status + ": " + xhr.responseText);
			}
		});

	});

});
