$(document).ready(function () {

	$('#representantes').DataTable({


		dom: '<"html5buttons"B>lTfgitp',
		buttons: [{
				extend: 'copy'
				}, {
				extend: 'csv'
				}, {
				extend: 'excel',
				title: 'Listado Representantes : ' + organismo + '. \n legislaturas Conectadas'
				},
				// { extend: 'pdf', title: 'Normativas - legislaturas Conectadas'  },

			{
				extend: 'pdfHtml5',
				orientation: 'vertical',
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
						text: 'Listado Representantes: ' + organismo + '. \n Legislaturas Conectadas ',
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
		"pageLength": 50,
		"order": [],
		"autoWidth": true,

		language: {
			url: $("body").data('base_url') + 'static/manager/translate/spanish.json'
		},

		"ajax": {
			"url": $("body").data('base_url') + "Home/get_representantes_legislatura/" + id_legis,
			"type": "POST"
		}
	});


	var owl = $("#noticias");

	owl.owlCarousel({
		center: false,
		items: 4,
		nav: true,
		dots: false,
		loop: ($('.owl-carousel .items').length > 4),
		rewind: true,
		navElement: 'i',
		navText: [$('.am-prev'),$('.am-next') ],
		//	navText: ['	<button class="am-next btn btn-outline-secondary">Siguiente</button>','	<button class="am-next btn btn-outline-secondary">Siguiente</button>'],
		autoplay: true,

		margin: 15,
		mouseDrag: true,
		singleItem: true,

		responsiveClass: true,
		responsive: {
			0: {
				items: 1,
				nav: true
			},
			600: {
				items: 4,
				nav: true
			},
			1000: {
				items: 4,
				nav: true,
			}
		},

	});


	var owl_normativas = $("#normativas");

	owl_normativas.owlCarousel({
		center: false,
		items: 4,
		nav: true,
		dots: true,
		loop: ($('.owl-carousel-normativas .items').length > 4),
		rewind: true,
		navElement: 'i',
		navText: [ $('.am-prev-normativa'),$('.am-next-normativa')],
		//	navText: ['	<button class="am-next btn btn-outline-secondary">Siguiente</button>','	<button class="am-next btn btn-outline-secondary">Siguiente</button>'],
		autoplay: true,

		margin: 15,
		mouseDrag: true,
		singleItem: true,

		responsiveClass: true,
		responsive: {
			0: {
				items: 1,
				nav: true
			},
			600: {
				items: 4,
				nav: true
			},
			1000: {
				items: 4,
				nav: true,
			}
		},

	});


});
