$(document).ready(function () {

	var base_url = $('body').data('base_url');

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

	//	console.log('------');
	//	console.log(colors_camaras);
	var markers = [
		{
			latLng: [-34.67507287396606, -58.48608696658111],
			labels: 'Unicameral',
			name: 'Ciudad Autónoma de Buenos Aires',
			code: 'AR-C',
			status: 'caba',
			offsets: [0, 2]
		},
		{
			latLng: [-51.75208986335677, -60.564034018240505],
			labels: '',
			name: 'Islas Malvinas',
			code: 'FK',
			status: 'malvinas',
			offsets: [0, 2]
		}
				];
	//	console.table(markers);

	var mimapa = new jvm.Map({
		container: $('#map'),
		backgroundColor: "transparent",
		//		regionsSelectable: true,
		//		regionsSelectableOne: true,
		markers: markers.map(function (h) {
			return {
				name: h.name,
				latLng: h.coords
			}
		}),
		labels: {
			markers: {
				render: function (index) {
					// return markers[index].name;
				},
				offsets: function (index) {
					var offset = markers[index]['offsets'] || [0, 0];

					return [offset[0] - 7, offset[1] + 3];
				}
			}
		},
		markers: markers,
		onMarkerClick: function (events, index, weburl, code) {
			//			console.log(markers[index].weburl);
			//			console.log(markers[index].code);

			if (markers[index].code != 'FK') {

				redirigir_url_mapa(markers[index].code);
			}



		},
		regionStyle: {
			initial: {
				fill: '#128da7',
				stroke: "#250E62",
				"stroke-width": 1.5,

			},
			hover: {
				fill: "#A0D1DC"
			}
		},
		zoomOnScroll: false,
		map: 'ar_mill',
		zoomButtons: false,
		series: {
			markers: [{
				attribute: 'image',
				scale: {
					'caba': base_url + 'static/web/images/mapa_caba.png',
					'malvinas': base_url + 'static/web/images/malvinas_interno.png'
				},
				values: markers.reduce(function (p, c, i) {
					p[i] = c.status;
					return p
				}, {}),
          }],
			regions: [colors_camaras],
		},
		onRegionOver: function (event, code) {

		},
		hover: {
			"fill-opacity": 1
		},
		selected: {
			fill: '#A0D1DC'
		},
		onRegionClick: function (event, code) {
			//			console.log(event);
			//			console.log(code);
			//			console.log(names[code]);

			redirigir_url_mapa(code, names[code])


		},
		onRegionTipShow: function (event, label, code) {
			if (!labels.hasOwnProperty(code)) {
				// no text found, return standard state name
				return true;
			}

			// construct label for state with extra text
			label.html(
				//'<strong>' + label.html() + '</strong><br/>' + labels[code]
				'<strong>' + names[code] + '</strong><br/>' + labels[code]
			);
		},
		onMarkerTipShow: function (event, label, code) {

			var markers = $('#map').vectorMap('get', 'mapObject').markers;
			// console.log(markers);

			label.html(
				//'<strong>' + label.html() + '</strong><br/>' + labels[code]
				'<strong>' + markers[code].config.name + '</strong><br/>' + markers[code].config.labels
			);

		}
	});
	mimapa.series.regions[0].setValues(colors_camaras);

	function redirigir_url_mapa(code, name) {

		//console.log('IR A ' + code);

		var dato = new FormData();
		dato.append('code', code);

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
			url: $("body").data('base_url') + "Manager/Contenidos/redirect",
			success: function (result) {
				//				console.log('result');
				//				console.log(result);
				//														alert(result.provincia.url);
				window.location.href = result.provincia.url;
			},
			error: function (xhr, errmsg, err) {
				toastr["warning"]("Aún no disponemos información para la Provincia de " + name, "Atención");
				console.log('Error : ' + xhr.status + ": " + xhr.responseText);
			}
		});


	}


	var $filter = $('#filterto').val();
	if ($filter != '') {
		/*
				var $current = $('.detalles_legis[data-filter2="' + $filter + '"]').toggle();
  				$('.detalles_legis').not($current).hide();
				*/
		var regex = new RegExp('\\b\\w*' + $filter + '\\w*\\b');
		$('.detalles_legis').hide().filter(function () {
			return regex.test($(this).data('filter2'))
		}).show();
		var $filterColor = $('#filtercolor').val();
		//mimapa.series.regions[0].setValues(myCustomColors);
		var mapObject = $('#map').vectorMap('get', 'mapObject');
		mapObject.clearSelectedRegions();
		mimapa.regions[$filter].element.config.style.selected.fill = $filterColor;
		mapObject.setSelectedRegions($filter);
	}

	$("#clearFilter").click(function () {
		var myCustomColors = [];
		$('.detalles_legis').show();
		$('#filterAlert').hide();
		var mapObject = $('#map').vectorMap('get', 'mapObject');
		mapObject.clearSelectedRegions();
		mimapa.series.regions[0].setValues(myCustomColors);
		//mapObject.setSelectedRegions(0);
		var urlPathG = $(this).data("url");
		//	console.log(urlPathG);
		//window.location.href = urlPathG;
		window.history.pushState("", "Legislaturas Conectadas", urlPathG);
		/*
		if (history.pushState) {
			window.history.pushState("object or string", "Legislaturas Conectadas",url);
		} else {
			document.location.href = url;
		}*/
		/*
		document.getElementById("content").innerHTML = response.html;
		 document.title = response.pageTitle;
		 window.history.pushState({"html":response.html,"pageTitle":response.pageTitle},"", urlPath);
		*/
	});


});


function getUrlParameter(sParam, url) {
	url = url || window.location.search.substring(1); //empty
	var sPageURL = url;
	var sURLVariables = sPageURL.split('&');
	for (var i = 0; i < sURLVariables.length; i++) {
		var sParameterName = sURLVariables[i].split('=');
		if (sParameterName[0] == sParam) {
			return sParameterName[1];
		}
	}
}
