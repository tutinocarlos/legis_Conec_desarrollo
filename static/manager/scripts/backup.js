$(document).ready(function() {
	
	/*backup*/
	$("a#backup").on("click", function (e) {
		
//		var url = $(this).data('url'); 
//		alert(url); return;
//			document.location = url;
		
		e.preventDefault();
		
		$.ajax({
				type : "POST",
				dataType:'json',
				contentType:false,
				processData:false,
				cache:false,
				beforeSend: function(){
					 $(".preloader").fadeIn();
				},
				url : $("body").data('base_url')+"Manager/Backup/respaldo_db_ajax",
				success : function (result) {
					
					
					$(".preloader").fadeOut();
					
					if(result.estado == true){
							console.log('result');
							console.log(result);
						$("#respaldos_legis").prepend(result.html);
						toastr.success(result.mensaje+'<br>'+result.archivo, 'Respaldo de Datos');
						document.location = $("body").data('base_url')+result.archivo;
						
					}else{

						toastr.error(result.mensaje, 'Respaldo de Datos');
						
					}
					
				},
				error : function(xhr,errmsg,err) {
									console.log(xhr.status + ": " + xhr.responseText);
								}
			});

	});
	
$("#respaldos_legis").on("click", ".borrar", function () {

	
	var data = new FormData();

	data.append('url', $(this).data('url'));
	data.append('id', $(this).data('id'));
	
	$.confirm({
		 columnClass: 'medium',
			closeIcon: true,
			icon: 'fa fa-warning',
			title: 'Respaldos',
			content: 'Confirma la eliminación del archivo?',
			buttons: {

				confirm:{
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
						url: $("body").data('base_url')+"Manager/Backup/borrar_archivo",
						success: function (result) {
							$(".preloader").fadeOut();
							if (result.estado == true) {
								$('li#backup_'+result.id).remove();
								
								toastr.success(result.mensaje, 'Respaldos');
							} else {
								toastr.error(result.mensaje, 'Respaldos');
							}
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
						$.alert('Acción Cancelada, no se eliminará el Archivo');
					}
				},

			}
		});
			

	
}	);
	
	
	
	
} );

	function descargar(url) {

		window.onfocus = finalizada;
		document.location = url;
}
function finalizada() {
window.onfocus = vacia;
alert();
// Modificar a partir de aquí
}
function vacia(){
	
}