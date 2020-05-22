		$(document).ready(function () {
							$("label#captcha_error").html('Validar Recaptcha ');
//			toastr["success"]("El mensaje se ha enviado correctamente", "Legislaturas Conectadas");

			var name = " minomnnbr e";
			toastr.options = {
				"closeButton": true,
				"debug": false,
				"newestOnTop": true,
				"progressBar": false,
				"positionClass": "toast-top-center",
				"preventDuplicates": false,
				"onclick": null,
				"showDuration": "300",
				"hideDuration": "1000",
				"timeOut": "5000",
				"extendedTimeOut": "1000",
				"showEasing": "swing",
				"hideEasing": "linear",
				"showMethod": "fadeIn",
				"hideMethod": "fadeOut"
			};

			//				toastr["success"]("El mensaje se ha enviado correctamente" , "Legislaturas Conectadas");
			//				toastr["success"]("Aún no disponemos información para la Provincia de " + name, "Atención");

			$.validator.addMethod("valueNotEquals", function (value, element, arg) {
				return arg != value;
			}, "Selecciona una opción");

			$("#form_cantacto_legis").validate({

				lang: 'es',
				rules: {
					legislatura: {
						valueNotEquals: 0
					}
				},
				messages: {
					nombre: {
						required: 'El campo Nombre es requerido'
					},
					apellido: {
						required: 'El campo Apellido es requerido'
					},
					email: {
						required: 'El campo Email es requerido'
					},
					legislatura: {
						valueNotEquals: "Selecciona un Organismo a contactar",
					},
					mensaje: {
						required: "Por favor enviamos un mensaje",
					}
				},


				submitHandler: function (form) {
 event.preventDefault();
					
					if(grecaptcha.getResponse()){

					}else{
	
						$("div#captcha_errorss span").html('Validar Recaptcha 2');
							toastr["error"]("Debe validar el Recaptcha ", "Legislaturas Conectadas - Contacto");
						return false;
						
					}


					$.ajax({
						type: "POST",
//													contentType: false,
						dataType: 'json',

						url: base_url + 'Home/enviar_contacto',

						data: $('#form_cantacto_legis').serialize(),
						beforeSend: function () {
							$('#enviar_correo').attr('disabled', 'disabled');
							$("#enviar_correo").html('enviando mensaje ...');
						},
						success: function (response) {
							console.log('response');
							console.log(response);
							if (response.error) {
								if (response.nombre_error != '') {
									$('#nombre_error').html(response.nombre_error);
								} else {
									$('#nombre_error').html('');
								}
								if (response.apellido_error != '') {
									$('#apellido_error').html(response.apellido_error);
								} else {
									$('#apellido_error').html('');
								}
								if (response.email_error != '') {
									$('#email_error').html(response.email_error);
								} else {
									$('#email_error').html('');
								}
								if (response.subject_error != '') {
									$('#legislatura_error').html(response.legislatura_error);
								} else {
									$('#legislatura_error').html('');
								}
								if (response.mensaje_error != '') {
									$('#mensaje_error').html(response.mensaje_error);
								} else {
									$('#mensaje_error').html('');
								}
								
							}
							$('#enviar_correo').attr('disabled', false);
							if (response.success) {
								toastr["success"]("El mensaje se ha enviado correctamente", "Legislaturas Conectadas");
								$('#nombre_error').html('');
								$('#apellido_error').html('');
								$('#legislatura_error').html('');
								$('#mensaje_error').html('');

								$("#enviar_correo").html('Enviar Mensaje');
								$("form#form_cantacto_legis")[0].reset();
								$('#enviar_correo').attr('disabled', false);
							}

							if (response.error_envio) {
								toastr["error"]("ha ocurrido un error al enviar el mensaje ", "Legislaturas Conectadas");
							}

						}
					});
				}
			});


			$('#table_contacto').DataTable({

				dom: '<"html5buttons"B>lTfgitp',
				buttons: [{
						extend: 'copy'
					}, {
						extend: 'csv'
					}, {
						extend: 'excel',
						title: 'Listado de Organismos. \n Legislaturas Conectadas'
					},
					// { extend: 'pdf', title: 'Normativas - legislaturas Conectadas'  },

					{
						extend: 'pdfHtml5',
						orientation: 'landscape',
						pageSize: 'LEGAL',
						text: '<u>E</u>xportar Tabla a (PDF)',

						messageBottom: {
							text: ' \n \n \n www.legislaturasconectadas.gob.ar',
							alignment: 'center',

						},

						key: {
							key: 'e',
							altKey: false
						},

						customize: function (doc) {
							doc.content.splice(0, 1, {
								margin: [0, 0, 0, 24],
								fit: [100, 100],
								image: img_base64
							});
							doc.content.splice(1, 0, {
								margin: [0, 0, 0, 12],
								alignment: 'left',
								text: 'Listado de Organismos. \n  Legislaturas Conectadas ',
								fontSize: 12,

							});

						},
						// download: 'download',
						exportOptions: {
							stripHtml: true,
							// modifier: {
							//         page: 'current'
							//     },
							// columns: [0,1,2,3]


						}
					}
				],

				"paging": false,
				"info": false,
				"order": [[0, "DESC"]],
				"pageLength": 100,
				"columnDefs": [
					{
						"targets": [0],
						"orderable": false

					}
				],
				'language': {
					'url': $("body").data('base_url') + 'static/manager/translate/spanish.json'
				},
				"oLanguage": {
					"sSearch": "Buscar Organismo"
				},
				"ajax": {
					"url": $("body").data('base_url') + "Home/contacto",
					"type": "POST"
				},
				initComplete: function () {


				}

			});

		});
