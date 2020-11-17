//
//var reformattedArray = colores.map(function(obj){ 
//   var rObj = {};
//   rObj[obj.zona] = obj.color;
//   return rObj;
//});


$(document).ready(function () {
	

  
	
	$('#nodal_notificaciones').modal('show')


	/* initialize the slider based on the Slider's ID attribute */
	jQuery('#rev_slider_1').show().revolution({
		stopLoop: "on",
//		stopLoop: "off",
		stopAfterLoops: 0,
		stopAtSlide: 1,

		/* options are 'auto', 'fullwidth' or 'fullscreen' */
		sliderLayout: 'fullwidth',

		/* basic navigation arrows and bullets */
		navigation: {

			arrows: {

				enable: true,
				// style: 'hesperiden',
				tmp: '',
				rtl: false,
				hide_onleave: false,
				hide_onmobile: true,
				hide_under: 0,
				hide_over: 9999,
				hide_delay: 200,
				hide_delay_mobile: 1200,

				left: {
					container: 'slider',
					h_align: 'left',
					v_align: 'center',
					h_offset: 20,
					v_offset: 0
				},

				right: {
					container: 'slider',
					h_align: 'right',
					v_align: 'center',
					h_offset: 20,
					v_offset: 0
				}

			}

		},

	});

	//alert(colores);

	$('.carousel').carousel();


	$("div.blog-pagination ").on("click", "a.page-link", function (e) {
		e.preventDefault();
		console.log($(this).data('ci-pagination-page'));
		//carga paginacion de noticias
		var dato = new FormData();
		dato.append('offset', $(this).data('ci-pagination-page'));
		dato.append('tabla', 'publicaciones');

		$.ajax({
			type: "POST",
			contentType: false,
			//					dataType: 'json',
			data: dato,
			processData: false,
			cache: false,
			url: $("body").data('base_url') + "home/get_paginador",
			beforeSend: function () {
				$("section#noticias").html('');
			},
			success: function (result) {
				console.log('result');

				$("section#noticias").html(result);



			},
			error: function (xhr, errmsg, err) {
				console.log(xhr.status + ": " + xhr.responseText);
			}
		})

	});

	var myCustomColors = {
		"CL": '#fff000',
		"AR-W": '#fff000',
		"AR-B": '#7DBDEC',
		"AR-C": '#CBE7F7',
		"AR-K": '#7DBDEC',
		"AR-H": '#CBE7F7',
		"AR-U": '#CBE7F7',
		"AR-X": '#CBE7F7',
		"AR-W": '#7DBDEC',
		"AR-E": '#7DBDEC',
		"AR-P": '#CBE7F7',
		"AR-Y": '#CBE7F7',
		"AR-L": '#CBE7F7',
		"AR-F": '#CBE7F7',
		"AR-M": '#7DBDEC',
		"AR-N": '#CBE7F7',
		"AR-Q": '#CBE7F7',
		"AR-R": '#CBE7F7',
		"AR-A": '#7DBDEC',
		"AR-J": '#CBE7F7',
		"AR-D": '#7DBDEC',
		"AR-Z": '#CBE7F7',
		"AR-S": '#7DBDEC',
		"AR-G": '#CBE7F7',
		"AR-V": '#CBE7F7',
		"AR-T": '#CBE7F7',
	};

	var markers = [
		{
			latLng: [-34.67507287396606, -58.48608696658111],
			name: 'Ciudad Autónoma de Buenos Aires',
			code: 'AR-C',
			status: 'caba',
			offsets: [0, 2]
		},
		{
			latLng: [-51.75208986335677, -60.564034018240505],
			name: 'Islas Malvinas',
			code: 'FK',
			status: 'malvinas',
			offsets: [0, 2]
		}
				];

	var mimapa = new jvm.Map({
		container: $('#map'),

		markers: markers.map(function (h) {
				console.log('h.name');
				console.log(h.name);
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
			console.log(markers[index].weburl);
			console.log(markers[index].code);

			redirigir_url_mapa(markers[index].code)

		},
		regionLabelStyle: {
			initial: {
				'font-family': 'Verdana',
				'font-size': '12',
				'font-weight': 'bold',
				cursor: 'default',

			},
			hover: {
				cursor: 'default'
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
		backgroundColor: 'none',
		series: {
			regions: [{
				attribute: 'fill'
						}],
			markers: [{
				attribute: 'image',
				scale: {
					'caba': 'static/web/images/mapa_caba.png',
					'malvinas': 'static/web/images/malvinas.png'
				},
				values: markers.reduce(function (p, c, i) {
					p[i] = c.status;
					return p
				}, {}),
          }]
		},
		onRegionOver: function (event, index) {
										console.log(event);
										console.log(index);
			//		
			//					var dato = new FormData();
			//					dato.append('code', code);
			//
			//					$.ajax({
			//						type: "POST",
			//						contentType: false,
			//						//						dataType: 'json',
			//						data: dato,
			//						processData: false,
			//						cache: false,
			//						beforeSend: function () {
			//							$(".preloader").fadeIn();
			//						},
			//						url: $("body").data('base_url') + "Manager/Contenidos/jvectormapa",
			//						success: function (result) {
			//							console.log('result');
			////							console.log(result);
			//
			//							// ac ael resultado de la busqueda de la provincia
			//							//$("#legis_tab").html(result);
			//							if (result.estado == true) {} else {}
			//
			//
			//						},
			//						error: function (xhr, errmsg, err) {
			//							console.log(xhr.status + ": " + xhr.responseText);
			//						}
			//					});
		},
		hover: {
			"fill-opacity": 1
		},
		selected: {
			fill: 'yellow'
		},
		onRegionClick: function (event, code) {
			redirigir_url_mapa(code)

		},
	});

	function redirigir_url_mapa(code) {

		console.log('IR A ' + code);
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
				console.log('result');
				console.log(result);
				//														alert(result.provincia.url);
				window.location.href = result.provincia.url;
			},
			error: function (xhr, errmsg, err) {
				console.log(xhr.status + ": " + xhr.responseText);
			}
		});


	}

	//-34.67507287396606
	//-58.48608696658111


	// aplica los colore al mapa
	//			mimapa.addMarker(markerIndex, {latLng: [latLng.lat, latLng.lng]});
	console.log('serie mimapa');
	console.log(mimapa.series.regions[0]);
	mimapa.series.regions[0].setValues(myCustomColors);
	markerIndex = 0,
		markersCoords = {};
	mimapa.container.click(function (e) {

		var latLng = mimapa.pointToLatLng(
							e.pageX - mimapa.container.offset().left,
							e.pageY - mimapa.container.offset().top
						),
						targetCls = $(e.target).attr('class');
			
					if (latLng && (!targetCls || (targetCls && $(e.target).attr('class').indexOf('jvectormap-marker') === -1))) {
						markersCoords[markerIndex] = latLng;
						mimapa.addMarker(markerIndex, {
							latLng: [latLng.lat, latLng.lng]
						});
						markerIndex += 1;
					}
			
					console.log(latLng.lat);
					console.log(latLng.lng);
	});
	
	
	
	
	
	function crea_mapa2(){
		var mimapa = new jvm.Map({
		container: $('#map2'),

		markers: markers.map(function (h) {
				console.log('h.name');
				console.log(h.name);
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
			console.log(markers[index].weburl);
			console.log(markers[index].code);

			redirigir_url_mapa(markers[index].code)

		},
		regionLabelStyle: {
			initial: {
				'font-family': 'Verdana',
				'font-size': '12',
				'font-weight': 'bold',
				cursor: 'default',

			},
			hover: {
				cursor: 'default'
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
		backgroundColor: 'none',
		series: {
			regions: [{
				attribute: 'fill'
						}],
			markers: [{
				attribute: 'image',
				scale: {
					'caba': 'static/web/images/mapa_caba.png',
					'malvinas': 'static/web/images/malvinas.png'
				},
				values: markers.reduce(function (p, c, i) {
					p[i] = c.status;
					return p
				}, {}),
          }]
		},
		onRegionOver: function (event, index) {
										console.log(event);
										console.log(index);
			//		
			//					var dato = new FormData();
			//					dato.append('code', code);
			//
			//					$.ajax({
			//						type: "POST",
			//						contentType: false,
			//						//						dataType: 'json',
			//						data: dato,
			//						processData: false,
			//						cache: false,
			//						beforeSend: function () {
			//							$(".preloader").fadeIn();
			//						},
			//						url: $("body").data('base_url') + "Manager/Contenidos/jvectormapa",
			//						success: function (result) {
			//							console.log('result');
			////							console.log(result);
			//
			//							// ac ael resultado de la busqueda de la provincia
			//							//$("#legis_tab").html(result);
			//							if (result.estado == true) {} else {}
			//
			//
			//						},
			//						error: function (xhr, errmsg, err) {
			//							console.log(xhr.status + ": " + xhr.responseText);
			//						}
			//					});
		},
		hover: {
			"fill-opacity": 1
		},
		selected: {
			fill: 'yellow'
		},
		onRegionClick: function (event, code) {
			redirigir_url_mapa(code)

		},
	});
	}
	
});
