$(document).ready(function () {

	var tabla_news = $('#newsletters').DataTable({
	"order": [[ 0, "desc" ]],
	"columnDefs": [
		{
			targets: 0,
			className: 'dt-body-center',
			"width": "1%",
    	},
		{
			targets: 1,
			className: 'dt-body-left',
		
    	},
		{
			targets: 2,
			className: 'dt-body-left',
			"width": "2%",
    	},
		{
			targets: 3,
			className: 'dt-body-center',
		
    	},
		{
			targets: 4,
			className: 'dt-body-left',
		
    	},
		{
			targets: 5,
			className: 'dt-body-left',
    	},
		{
			targets: 6,
			className: 'dt-body-left',
    	}, {
			targets: 7,
			className: 'dt-body-left',
    	}, {
			targets: 8,
			className: 'dt-body-left',
    	}
  	],
	'language': {
		url: $("body").data('base_url') + 'static/manager/translate/spanish.json'
	},
	"pageLength": 25,
	"ajax": {
		url: $("body").data('base_url') + "Manager/breves/get_newsletters_dt",
		type: "POST"
	}
});
	
	var intervalo = 0;
	
	function esperando(){
		
		progreso = setInterval(function(){ 
		displaying = $("#enviando").css("visibility");
		if(displaying == "visible") {
			$("#enviando").css("visibility","hidden");
		} else {
			$("#enviando").css("visibility","visible");
		};

		},1000);
	
	}
	
//$(".modal_enviar_newsletter").modal("show");
 $("#modal_enviar_newsletter").on('hidden.bs.modal', function () {
       
    });
	$("#newsletters").on("click", ".acciones_abrir_modal", function () {
		
		if($(this).data('estado') == 're-enviar'){
			
			$("a#link_enviado").removeClass('btn-success').addClass('btn-warning').html('se enviará otra vez');
			var dato = new FormData();
			dato.append('id_news',$(this).data('id_news'));
			
			$.ajax({
						type: "POST",
						contentType: false,
						dataType: 'json',
						data: dato,
						processData: false,
						cache: false,
						url: $("body").data('base_url') + "Manager/Breves/reset_news",
						success: function (result) {
							
						},
						error: function (xhr, errmsg, err) {
						console.log(xhr.status + ": " + xhr.responseText);
						}
						});
		}

		// modal_enviar_newsletter

		$('#modal_enviar_newsletter').modal('show')

		$("span#news_subject").html($(this).data('id_news') + '-' + $(this).data('subject'));

		$("button#enviar_newsletter").attr('id_news', $(this).data('id_news'));
		$("span#cant_remitentes").html($(this).data('suscriptores'));
		$("span#cant_publicaciones").html($(this).data('publicaciones'));

		//barra de progreso
		$("span#total_data").html($(this).data('suscriptores'));

	});

	
//	$("#newsletters").on("click", "#enviar_newsletter", function () {
	$(".modal-content").on("click", "#enviar_newsletter", function () {
		
		var dato = new FormData();
		dato.append('id_news',$(this).attr('id_news'));
		$.confirm({
		 columnClass: 'medium',
			closeIcon: true,
			icon: 'fa fa-warning',
			title: 'Breves en Imágenes',
			content: 'Desea enviar el newsletter??',
			buttons: {

				confirm:{
					text: 'Proceder',
					btnClass: 'btn btn-green', 
					action: function () {
						
						$("button#enviar_newsletter").hide();
						esperando();
	
						$.ajax({
						type: "POST",
						contentType: false,
						dataType: 'json',
						data: dato,
						processData: false,
						cache: false,
						beforeSend: function () {
//						$(".preloader").fadeIn();
						},
						url: $("body").data('base_url') + "Manager/Breves/send_news",
							success: function (result) {
							console.log('result enviados ');
							console.log(result);
							$(".preloader").fadeOut();
				
								clearInterval(progreso);
								
							$('#newsletters').DataTable().ajax.reload();
													
								$("#enviando").css("visibility","visible").html('<h3>Finalizado</h3>');
								$("#cerrar_modal").show();
									
								$("section#enviados").html(result.txtMail);
								$("span#cant_enviado").html(result.cant_ok);
								$("span#cant_error").html(result.cant_error);
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
						$.alert('Acción Cancelada, no se enviarán los newsletters');
					}
				},

			}
		});
		
	});
	
	function get_import() {


		$('#process').css('display', '');
		var data = new FormData();
		data.append('id_news', $("#enviar_newsletter").attr('id_news'));

		$.ajax({
			type: "POST",
			contentType: false,
			dataType: 'json',
			data: data,
			processData: false,
			cache: false,
			beforeSend: function () {
				//$(".preloader").fadeIn();
			},
			url: $("body").data('base_url') + "Manager/Breves/send_news",
			success: function (result) {
				console.log('result');
				console.log(result);

				if (result.status == true) {


					var total_data = $('#total_data').text();
					var width = Math.round((result.enviados / total_data) * 100);
					console.log('witdh');
					console.log(width);

					$('#process_data').text(result.enviados);
					$('.progress-bar').css('width', width + '%');

					if (width == 100) {

						tabla_news.ajax.reload();

						//	$("#enviados").append('<div class="alert alert-danger" role="alert">' + result.mensaje + '</div>');
					} else {
						get_import()
					}




					$("#enviados").append('<p>' + result.email + ' - ' + result.mensaje + '</p>');

					toastr.success(result.mensaje, 'Newsletters');
				} else {


					//	$("#enviados").append('<div class="alert alert-danger" role="alert">' + result.mensaje + '</div>');

				}
				//location.reload();
			},
			error: function (xhr, errmsg, err) {
				console.log(xhr.status + ": " + xhr.responseText);
			}
		});


	}


	$("#newsletters").on("click", ".borrar_news", function () {

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
							url: $("body").data('base_url') + "Manager/breves/borrar_newsletters",
							success: function (result) {
								console.log('result');
								console.log(result.estado);
								if (result.estado == true) {
									toastr.success('Registro Borrado correctamente!', 'Newsletters');
								} else {
									toastr.error('Registro no Borrado!', 'Newsletters');
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




});
