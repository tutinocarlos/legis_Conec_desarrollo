function buscar_video(url) {

	if (url == '') {
		toastr.error('Ingrese la url del Video no es válida ', 'Videos');
		return false;
	}

	var IdVideo = getParameterByName('v', url);
	if (IdVideo == '') {
		toastr.error('La url no posee el parámetro correcto ', 'Videos');
		return false;
	}
	var youTubeURL = 'https://www.googleapis.com/youtube/v3/videos?id=' + IdVideo + '&part=snippet&key=AIzaSyCXDz8DxWsZEJwZffnXSTOZviYIi7k2vDE'; //&key=<YOUR_API_KEY>&
	//jqueryGritter(youTubeURL,'','info','');
	$.ajax({
		'async': false,
		'global': false,
		'url': youTubeURL,
		'dataType': "jsonp",
		'success': function (data) {
			console.log(data);
			//jqueryGritter(data.items[0].snippet.title,'Titulo Cargado','info','');
			$('#titulo_video').val(data.items[0].snippet.title);
			$('#detalle_video').val(data.items[0].snippet.description);
			$('#video_post').html('<img class="img-responsive" src="' + data.items[0].snippet.thumbnails.high.url + '"/>');
		}
	});
}
