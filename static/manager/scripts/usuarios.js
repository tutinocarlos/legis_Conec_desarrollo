var password = document.getElementById("password")
//var confirm_password = document.getElementById("re-password");

//function validatePassword() {
//
//	if (password.value != confirm_password.value) {
//
//		$('#repassword_error').html('<div id="repassword_error" class="invalid-feedback " style="display:block;"><strong>Las contraseñas no coinciden.</strong></div>')
//	} else {
//		confirm_password.setCustomValidity('');
//	}
//}

//password.onchange = validatePassword;
//confirm_password.onkeyup = validatePassword;

$(document).ready(function () {
	
	$("#myform")[0].reset();

	var tabla_user = $('#example').DataTable({
		"columnDefs": [
		{
			targets: 0,
			className: 'dt-body-center',
			"width": "1%",
			},		{
			targets: 1,
			className: 'dt-body-left',
			"width": "1%",
			},
			{
			targets: 4,
			className: 'dt-body-center',
			"width": "1%",
			},
			{
			targets: 5,
			className: 'dt-body-right',
				orderable: false
			
			}
		],
		language: {
			url: $("body").data('base_url')+'static/manager/translate/spanish.json'
		},
		"pageLength": 50,

		"ajax": {
			"url": $("body").data('base_url')+"Manager/Usuarios/get_usuarios",
			"type": "POST"
		}
	});


	$(".card-body").on("click", "button.reset_pw", function () {
		var dato = new FormData();
		dato.append('id_user', $(this).data('id_user'));
		$.confirm({
		 columnClass: 'medium',
			closeIcon: true,
			icon: 'fa fa-warning',
			title: 'Usuarios',
			content: 'Desea blanquear la contraseña para  <strong>'+$(this).data('nombre')+'</strong> ?',
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
			//				$(".preloader").fadeIn();
						},
						url: $("body").data('base_url')+"Manager/Usuarios/cambiar_pwd",
						success: function (result) {

							console.log('result');
							console.log(result);


							$("#salida").html(result.html);

							if (result.estado == true) {
								toastr.success('Password Actualizada correctamente!', 'Usuarios');
							} else {
								toastr.error('Password no Actualizada!', 'Usuarios');
							}
			//					 location.reload();


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
						$.alert('Acción Cancelada.', 'Usuarios - Contraseñas');
					}
				},

			}
		});
		
	
});
	$(".card-body").on("click", "button.edit_usr", function () {
		window.location.href = $("body").data('base_url')+"Manager/Usuarios/editar/"+$(this).data('id_user');
		
//		Manager/Usuarios/editar/".$r->id
	
});
	
	$(".card-body").on("click", ":button.acciones", function () {

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
			url: $("body").data('base_url')+"Manager/usuarios/cambiar_estado",
			success: function (result) {
				console.log('result');
				console.log(result.estado);
				if (result.estado == true) {
					toastr.success('Registro Actualizado correctamente!', 'Usuarios');
				} else {
					toastr.error('Registro no Actualizado!', 'Usuarios');
				}
					 location.reload();
				

			},
			error: function (xhr, errmsg, err) {
				console.log(xhr.status + ": " + xhr.responseText);
			}
		});
	});
	
	
	$(".card-body").on("click", ":button.delete_usr", function () {

		var dato = new FormData();
		dato.append('id_user', $(this).data('id_user'));
		var borrar = 0;
		var mensaje = 'Desea Eliminar el usuario <strong>'+$(this).data('nombre')+'</strong> ?, <br> Las <strong> '+$(this).data('publicaciones')+'</strong> publicaciones  y / o normativas a su nombre serán actualizadas';

		if($(this).data('publicaciones') == '0'){
			borrar = 1;
			mensaje = 'Desea Eliminar el usuario <strong>'+$(this).data('nombre')+'</strong> ?, <br>No posee publicaciones.';
		};
		
		dato.append('borrar', borrar);

				$.confirm({
		 columnClass: 'medium',
			closeIcon: true,
			icon: 'fa fa-warning',
			title: 'Usuarios',
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
						url: $("body").data('base_url')+"Manager/usuarios/borrar_usuario",
						success: function (result) {
							$(".preloader").fadeOut();
							console.log('result');
							console.log(result.estado);
							if (result.estado == true) {
								toastr.success('Registro Borrado correctamente! '+result.message, 'Usuarios');
							} else {
								toastr.error('Registro no Borrado!', 'Usuarios');
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
						$.alert('Acción Cancelada, no se eliminará el Usuarios	');
					}
				},

			}
		});

	});


});
