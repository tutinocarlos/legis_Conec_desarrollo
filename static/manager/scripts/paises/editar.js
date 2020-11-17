
$(document).ready(function() {
	
	$('textarea#detalle_pais' ).ckeditor();
	$('textarea#detalles').css('display', 'none');
	$("#detalles").text(CKEDITOR.instances.detalle_pais.getData());
	
});