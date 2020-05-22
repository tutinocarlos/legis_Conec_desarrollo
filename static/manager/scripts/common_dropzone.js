Dropzone.autoDiscover = false;



// If you use jQuery, you can use the jQuery plugin Dropzone ships with:
var myDropzone = new Dropzone("div#mydropzone", { 
	url: base_url+"Manager/legislaturas/subir_imagenes?id="+id_legis+"&nombre='"+nombre_legis+"'",
	dictDefaultMessage: '<i class="fas fa-upload fa-3x"></i><br> <strong> Click</strong> para seleccionar  o arrastre los archivos aquí'
});