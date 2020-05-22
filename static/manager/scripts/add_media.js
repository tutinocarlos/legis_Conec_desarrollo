$(document).ready(function () {

$('input[type=file]').change(function(){
	
    $('#cargar_imagen').removeAttr('disabled');   
})
	//    

	//	subir imagen principal
	$("#my_form_2").on('submit', function (e) {
		e.preventDefault();
		
		alert();

		if ($("#mi_archivo").val() == '') {
			alert('Seleccione un archivo');
			return false;
		}

		$.ajax({
			type: "POST",
			contentType: false,
			data: new FormData(this),
			processData: false,
			cache: false,
			beforeSend: function () {


			},
			url: $("body").data('base_url')+"Manager/Post/upload_file_2",
			success: function (result) {

				console.log('result');
				console.log(result);

				$("#image_post").html('');
				$("#image_post").html(result);
				toastr.success('Registro Editado correctamente!', 'Categorías');
			},
			error: function (xhr, errmsg, err) {
				console.log(xhr.status + ": " + xhr.responseText);
			}
		});

	});


	$("#checkTouTubed").on('click', function (e) {

		var url_video = $("#url_video").val();

		var IdVideo = getUrlParameter('v', url_video);



	})

});
