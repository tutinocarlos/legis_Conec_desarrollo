$(document).ready(function () {

	fill_datatable();
;
	var provincias = [];
	var tematicas = [];
	var tipo_normativa = [];
	var ambito = [];

	
//	$("ul.simplefilter li").click(function(){
//		
//		
//	$("ul.simplefilter li").removeClass('active');
//	$('.portfolio-header-menu > ul li:first').addClass('active');
//	$(this).addClass('active');
//	});
	
function fill_datatable(provincias = [],tematicas = [],tipo_normativa = [],ambito = []){
	
		var oTable = $('#publicaciones').DataTable({

			dom: '<"html5buttons"B>lTfgitp',
			buttons: [ {
					extend: 'copy'
				}, {
					extend: 'csv'
				}, {
					extend: 'excel',
					title: 'Listado Normativas - legislaturas Conectadas'
				},
				// { extend: 'pdf', title: 'Normativas - legislaturas Conectadas'  },

				{
					messageBottom:{
					text: ' \n \n \n www.legislaturasconectadas.com.ar',
					alignment: 'center',

					} ,
					extend: 'pdfHtml5',
					orientation: 'landscape',
					pageSize: 'LEGAL',
					text: '<u>E</u>xportar Tabla a (PDF)',
					key: {
						key: 'e',
						altKey: false
					},

					customize: function ( doc ) {
						doc.content.splice( 0, 1, {
							margin: [ 0, 0, 0, 24 ],
							fit: [ 100, 100 ],
							image: img_base64
						} );
						doc.content.splice( 1, 0, {
							margin: [ 0, 0, 0, 12 ],
							alignment: 'left',
							text: 'Normativas Publicadas Legislaturas Conectadas ',
							fontSize: 12
						} );
					},
					download: 'download',
					exportOptions: {
						stripHtml: true,
						// modifier: {
						//         page: 'current'
						//     },
				    columns: [1,2,3,4,5]

						    
					}
				}
			],
			language: {
			url: $("body").data('base_url') + 'static/manager/translate/spanish.json'
		},
			"pageLength" : 10,
			"columnDefs": [{ 
			"targets": [0],
			"orderable": false
			}],

			"processing": true,
			"serverSide": true,
			"searching": false,
				ajax: {
				data:{
				tematica: tematicas,
				ambito: ambito,
				provincias: provincias,
				tipo_normativa: tipo_normativa,

				},
				url:  $("body").data('base_url') + "Home/get_listado_publicaciones_ajax",
				type: 'POST'
				},


		});
	
}
//		var oTable = $('#publicaciones').DataTable(); 
	
	
	
		
	$('ul.simplefilter > li.borrar-filtros').on('click', function () {
		
		$('ul.simplefilter > li').removeClass('active');
		$('#publicaciones').DataTable().destroy();
		fill_datatable();
	});
	
	$('ul.simplefilter > li.filter').on('click', function () {
		
		if($(this).hasClass('active')){
//		console.log('si');
		$(this).removeClass('active');
			
		}else{
//		console.log('no');
		$(this).addClass('active');
			
		}

	});

	
	
// aplico los filtros	
	$('ul.simplefilter > li.aplicar-filtros').on('click', function () {
		
		var provincias = [];
		var tematicas = [];
		var tipo_normativa = [];
		var ambito = [];

		$( "ul#provincias > li.active" ).each(function() {
			provincias.push($(this).data('filter'));
		});		
		
		$( "ul#tamaticas > li.active" ).each(function() {
			tematicas.push($(this).data('filter'));
		});		
		
		$( "ul#ambito > li.active" ).each(function() {
			ambito.push($(this).data('filter'));
		});	
		
		$( "ul#tipo_normativa > li.active" ).each(function() {
			tipo_normativa.push($(this).data('filter'));
		});
				
		 	console.log("tematicas");
		 	console.log(provincias);
		 	console.log("provincias");
		 	console.log(tematicas);
		 	console.log("normativas");
		 	console.log(tipo_normativa);
		 	console.log("ambito");
		 	console.log(ambito);
		
		 	$('#publicaciones').DataTable().destroy();
     
			fill_datatable(provincias, tematicas,tipo_normativa,ambito);
   })

		
	});

