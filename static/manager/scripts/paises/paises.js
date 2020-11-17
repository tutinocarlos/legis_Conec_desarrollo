	/*MAPA sudamerica_map*/
//jQuery.fn.vectorMap('addMap', 'sudamerica_mill', {
//	"insets": [{
//		"width": 400,
//		"top": 0,
//		"height": 905.8723093907364,
//		"bbox": [{
//			"y": -1391900.644539083,
//			"x": -12188330.527048683
//		}, {
//			"y": 6974170.643481547,
//			"x": -3876492.223609794
//		}],
//		"left": 0
//	}],
//	"paths": {
//		"PY": {
//			"path": "M617.96,397.13l0.51,1.91l1.38,1.97l0.3,2.45l1.0,1.01l-0.05,1.74l0.83,1.52l0.04,1.56l-0.79,2.14l0.2,0.71l-0.84,1.85l0.34,2.51l-0.39,1.88l0.17,0.76l-0.61,1.7l0.39,1.02l1.95,0.65l1.21,-0.52l1.83,1.03l2.79,0.41l1.23,-0.23l3.66,0.95l3.93,-0.58l1.27,-1.62l0.68,-0.25l2.31,2.35l4.74,0.56l0.93,1.05l0.07,1.18l0.56,1.17l0.98,0.9l-0.38,2.67l0.61,2.74l0.48,0.79l0.07,1.93l0.43,1.23l-0.23,2.16l0.98,1.51l0.19,2.21l0.44,1.29l0.79,0.59l2.22,0.34l2.64,-0.58l4.14,-2.0l1.99,1.02l1.98,1.6l-0.65,0.98l0.44,2.31l-0.37,2.72l-1.7,6.89l0.19,0.79l-2.08,4.0l-0.26,7.36l-0.54,3.86l-0.91,2.83l-0.75,1.36l-1.31,0.69l-0.41,0.81l-1.98,1.6l-0.15,0.58l-3.31,0.93l-0.92,1.42l-0.93,0.58l-0.44,0.95l0.04,0.94l-1.19,1.34l-0.63,0.01l-2.02,-1.17l-1.4,-0.23l-1.29,0.18l-1.17,0.72l-1.52,2.14l-0.42,0.11l-0.91,-0.8l-1.12,-0.26l-1.47,0.32l-0.9,-0.1l-0.93,-0.59l-1.23,-0.06l-1.71,0.44l-3.26,-0.5l-5.11,-1.49l-4.29,-0.56l-5.03,0.5l-0.32,-1.1l0.2,-0.59l0.84,-0.63l1.26,-2.01l1.43,-0.89l0.0,-0.67l0.66,-0.53l0.44,-1.29l0.59,-0.7l-0.14,-3.19l1.09,-2.51l2.55,-2.09l1.75,-4.11l2.13,-2.02l0.17,-1.15l-1.03,-1.97l-2.17,-2.5l-1.74,-1.19l-2.27,-0.98l-1.4,-0.3l-0.78,0.28l-0.42,-0.16l-0.74,-0.85l-1.17,-0.66l-2.51,-0.75l-5.54,-2.85l-8.55,-6.02l-2.63,-1.08l-1.95,0.03l-2.86,-0.63l-3.98,-1.33l-2.19,-1.23l-0.67,-1.28l-1.49,-1.27l-2.41,-1.31l-1.98,-1.74l-2.72,-1.73l-1.52,-1.52l-1.64,-2.37l-1.82,-3.31l-1.91,-2.2l-2.96,-1.82l-0.24,-0.59l4.43,-14.56l0.02,-6.33l4.27,-6.28l1.89,-5.0l20.85,-4.31l10.9,-0.14l10.79,6.54l0.38,1.99l-0.23,2.03Z",
//			"name": "Paraguay"
//		},},
//
//	"height": 905.8723093907364,
//	"projection": {
//		"type": "mill",
//		"centralMeridian": 0.0
//	},
//	"width": 900.0
//});
	/* finMAPA*/

function redirigir_url_mapa(code){
	console.log('code');
	console.log(code);
}

//	 function crear_mapa(){
	var mimapa = new jvm.Map({
		projection: {
    centralMeridian: -100,
    type: "aea"
},
		container: $('#sudamerica_map'),

		onMarkerClick: function (events, index, weburl, code) {
//			console.log(markers[index].weburl);
//			console.log(markers[index].code);

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
				fill: "yellow"
			}

		},
		zoomOnScroll: false,
		map: 'sudamerica_mill',
		zoomButtons: false,
		backgroundColor: 'none',
		series: {
			regions: [{
				attribute: 'fill'
						}],
			markers: [{}]
		},
		onRegionOver: function (event, index) {
										console.log(event);
										console.log(index);

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

	console.log('mimapa');
	console.log(mimapa.mapData);
//}
	
$(document).ready(function() {
//	crear_mapa();

	/*
	var mimapa = new $('#sudamerica_map').vectorMap({
		map: 'sudamerica_mill',
		backgroundColor: '#855',
//		"paths": {
//		"PY": {
//			"path": "M617.96,397.13l0.51,1.91l1.38,1.97l0.3,2.45l1.0,1.01l-0.05,1.74l0.83,1.52l0.04,1.56l-0.79,2.14l0.2,0.71l-0.84,1.85l0.34,2.51l-0.39,1.88l0.17,0.76l-0.61,1.7l0.39,1.02l1.95,0.65l1.21,-0.52l1.83,1.03l2.79,0.41l1.23,-0.23l3.66,0.95l3.93,-0.58l1.27,-1.62l0.68,-0.25l2.31,2.35l4.74,0.56l0.93,1.05l0.07,1.18l0.56,1.17l0.98,0.9l-0.38,2.67l0.61,2.74l0.48,0.79l0.07,1.93l0.43,1.23l-0.23,2.16l0.98,1.51l0.19,2.21l0.44,1.29l0.79,0.59l2.22,0.34l2.64,-0.58l4.14,-2.0l1.99,1.02l1.98,1.6l-0.65,0.98l0.44,2.31l-0.37,2.72l-1.7,6.89l0.19,0.79l-2.08,4.0l-0.26,7.36l-0.54,3.86l-0.91,2.83l-0.75,1.36l-1.31,0.69l-0.41,0.81l-1.98,1.6l-0.15,0.58l-3.31,0.93l-0.92,1.42l-0.93,0.58l-0.44,0.95l0.04,0.94l-1.19,1.34l-0.63,0.01l-2.02,-1.17l-1.4,-0.23l-1.29,0.18l-1.17,0.72l-1.52,2.14l-0.42,0.11l-0.91,-0.8l-1.12,-0.26l-1.47,0.32l-0.9,-0.1l-0.93,-0.59l-1.23,-0.06l-1.71,0.44l-3.26,-0.5l-5.11,-1.49l-4.29,-0.56l-5.03,0.5l-0.32,-1.1l0.2,-0.59l0.84,-0.63l1.26,-2.01l1.43,-0.89l0.0,-0.67l0.66,-0.53l0.44,-1.29l0.59,-0.7l-0.14,-3.19l1.09,-2.51l2.55,-2.09l1.75,-4.11l2.13,-2.02l0.17,-1.15l-1.03,-1.97l-2.17,-2.5l-1.74,-1.19l-2.27,-0.98l-1.4,-0.3l-0.78,0.28l-0.42,-0.16l-0.74,-0.85l-1.17,-0.66l-2.51,-0.75l-5.54,-2.85l-8.55,-6.02l-2.63,-1.08l-1.95,0.03l-2.86,-0.63l-3.98,-1.33l-2.19,-1.23l-0.67,-1.28l-1.49,-1.27l-2.41,-1.31l-1.98,-1.74l-2.72,-1.73l-1.52,-1.52l-1.64,-2.37l-1.82,-3.31l-1.91,-2.2l-2.96,-1.82l-0.24,-0.59l4.43,-14.56l0.02,-6.33l4.27,-6.28l1.89,-5.0l20.85,-4.31l10.9,-0.14l10.79,6.54l0.38,1.99l-0.23,2.03Z",
//			"name": "Paraguay"
//		},},
	});
	*/

	
// 	var markers = [];
//	var mimapa = new jvm.Map({
//		container: $('#sudamerica_map'),
//zoomButtons: true,
//		markers: markers.map(function (h) {
//				console.log('h.name');
//				console.log(h.name);
//			return {
//				name: h.name,
//				latLng: h.coords
//			}
//		}),
//		labels: {
//			markers: {
//				render: function (index) {
//					// return markers[index].name;
//				},
//				offsets: function (index) {
//					var offset = markers[index]['offsets'] || [0, 0];
//
//					return [offset[0] - 7, offset[1] + 3];
//				}
//			}
//		},
//		markers: markers,
//		onMarkerClick: function (events, index, weburl, code) {
//			console.log(markers[index].weburl);
//			console.log(markers[index].code);
//
//			redirigir_url_mapa(markers[index].code)
//
//		},
//		regionLabelStyle: {
//			initial: {
//				'font-family': 'Verdana',
//				'font-size': '12',
//				'font-weight': 'bold',
//				cursor: 'default',
//
//			},
//			hover: {
//				cursor: 'default'
//			}
//		},
//		regionStyle: {
//			initial: {
//				fill: '#128da7',
//				stroke: "#250E62",
//				"stroke-width": 1.5,
//			},
//			hover: {
//				fill: "#A0D1DC"
//			}
//
//		},
//			"paths": {
//		"PY": {
//			"path": "M617.96,397.13l0.51,1.91l1.38,1.97l0.3,2.45l1.0,1.01l-0.05,1.74l0.83,1.52l0.04,1.56l-0.79,2.14l0.2,0.71l-0.84,1.85l0.34,2.51l-0.39,1.88l0.17,0.76l-0.61,1.7l0.39,1.02l1.95,0.65l1.21,-0.52l1.83,1.03l2.79,0.41l1.23,-0.23l3.66,0.95l3.93,-0.58l1.27,-1.62l0.68,-0.25l2.31,2.35l4.74,0.56l0.93,1.05l0.07,1.18l0.56,1.17l0.98,0.9l-0.38,2.67l0.61,2.74l0.48,0.79l0.07,1.93l0.43,1.23l-0.23,2.16l0.98,1.51l0.19,2.21l0.44,1.29l0.79,0.59l2.22,0.34l2.64,-0.58l4.14,-2.0l1.99,1.02l1.98,1.6l-0.65,0.98l0.44,2.31l-0.37,2.72l-1.7,6.89l0.19,0.79l-2.08,4.0l-0.26,7.36l-0.54,3.86l-0.91,2.83l-0.75,1.36l-1.31,0.69l-0.41,0.81l-1.98,1.6l-0.15,0.58l-3.31,0.93l-0.92,1.42l-0.93,0.58l-0.44,0.95l0.04,0.94l-1.19,1.34l-0.63,0.01l-2.02,-1.17l-1.4,-0.23l-1.29,0.18l-1.17,0.72l-1.52,2.14l-0.42,0.11l-0.91,-0.8l-1.12,-0.26l-1.47,0.32l-0.9,-0.1l-0.93,-0.59l-1.23,-0.06l-1.71,0.44l-3.26,-0.5l-5.11,-1.49l-4.29,-0.56l-5.03,0.5l-0.32,-1.1l0.2,-0.59l0.84,-0.63l1.26,-2.01l1.43,-0.89l0.0,-0.67l0.66,-0.53l0.44,-1.29l0.59,-0.7l-0.14,-3.19l1.09,-2.51l2.55,-2.09l1.75,-4.11l2.13,-2.02l0.17,-1.15l-1.03,-1.97l-2.17,-2.5l-1.74,-1.19l-2.27,-0.98l-1.4,-0.3l-0.78,0.28l-0.42,-0.16l-0.74,-0.85l-1.17,-0.66l-2.51,-0.75l-5.54,-2.85l-8.55,-6.02l-2.63,-1.08l-1.95,0.03l-2.86,-0.63l-3.98,-1.33l-2.19,-1.23l-0.67,-1.28l-1.49,-1.27l-2.41,-1.31l-1.98,-1.74l-2.72,-1.73l-1.52,-1.52l-1.64,-2.37l-1.82,-3.31l-1.91,-2.2l-2.96,-1.82l-0.24,-0.59l4.43,-14.56l0.02,-6.33l4.27,-6.28l1.89,-5.0l20.85,-4.31l10.9,-0.14l10.79,6.54l0.38,1.99l-0.23,2.03Z",
//			"name": "Paraguay"
//		},},
//		zoomOnScroll: false,
//		map: 'sudamerica_mill',
//		backgroundColor: 'none',
//		series: {
//			regions: [{
//				attribute: 'fill'
//						}],
////			markers: [{
////				attribute: 'image',
////				scale: {
////					'caba': 'static/web/images/mapa_caba.png',
////					'malvinas': 'static/web/images/malvinas.png'
////				},
////				values: markers.reduce(function (p, c, i) {
////					p[i] = c.status;
////					return p
////				}, {}),
////          }]
//		},
//		onRegionOver: function (event, index) {
//										console.log(event);
//										console.log(index);
//			//		
//			//					var dato = new FormData();
//			//					dato.append('code', code);
//			//
//			//					$.ajax({
//			//						type: "POST",
//			//						contentType: false,
//			//						//						dataType: 'json',
//			//						data: dato,
//			//						processData: false,
//			//						cache: false,
//			//						beforeSend: function () {
//			//							$(".preloader").fadeIn();
//			//						},
//			//						url: $("body").data('base_url') + "Manager/Contenidos/jvectormapa",
//			//						success: function (result) {
//			//							console.log('result');
//			////							console.log(result);
//			//
//			//							// ac ael resultado de la busqueda de la provincia
//			//							//$("#legis_tab").html(result);
//			//							if (result.estado == true) {} else {}
//			//
//			//
//			//						},
//			//						error: function (xhr, errmsg, err) {
//			//							console.log(xhr.status + ": " + xhr.responseText);
//			//						}
//			//					});
//		},
//		hover: {
//			"fill-opacity": 1
//		},
//		selected: {
//			fill: 'yellow'
//		},
//		onRegionClick: function (event, code) {
//			redirigir_url_mapa(code)
//
//		},
//	});
	
	
	
	$('#dt_paises').DataTable( {
		 "order": [[2, "asc" ]],
			columnDefs: [
				{
				"targets": [-1],
				"orderable": false
			},
			{
				targets: 0,
				className: 'dt-body-left'
			},
			{
				targets: -1,
				className: 'dt-body-right'
			}
  	],
			language: {
        url: $("body").data('base_url')+'static/manager/translate/spanish.json'
    },
			 "pageLength": 10,
       
        "ajax": {
					"url": $("body").data('base_url')+"Manager/paises/list_paises",
					"type": "GET"
        }
    } );

	if ( $(".minicolors-input_prov").length > 0 ) {

		$('.minicolors-input_prov').minicolors({
			change: function (value, opacity) {
				console.log(value);
				$('span.provincia').css('background-color', value);
			},
			theme: 'bootstrap'
	});
	}

	$(".card-body").on("click","a.activar_pais",function(){	

			var dato = new FormData();
			dato.append('id',$(this).data('id'));
			dato.append('tabla',$(this).data('tabla'));
			dato.append('estado',$(this).data('estado'));
						
			$.ajax({
				type : "POST",
				contentType:false,
				dataType:'json',
				data: dato,
				processData:false,
				cache:false,
				beforeSend: function(){
					 $(".preloader").fadeIn();
				},
				url : $("body").data('base_url')+"Manager/Paises/status",
				success : function (result) {
					console.log('result');
					console.log(result.estado);
					if(result.estado == true){
					toastr.success('Registro Editado correctamente!', 'Categorías');
					}else{
					toastr.error('Registro no Actualizado!', 'Categorías');
					}
					 location.reload();
										
//					setTimeout(function(){
//					$(".preloader").fadeOut();
// 						location.reload();
//					}, 2000);

//						console.log(result.estado);
//					if(result.estado){
//						console.log(result.estado);
//					}else{
//						console.log(result.estado);
//						
//					}
//					
					
				},
				error : function(xhr,errmsg,err) {
									console.log(xhr.status + ": " + xhr.responseText);
								}
			});
	});
	
});