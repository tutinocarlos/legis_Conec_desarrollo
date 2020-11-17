$(document).ready(function () {
	var table = $('#table_links').DataTable({
		dom: '<"html5buttons"B>lTfgitp',
		"autoWidth": true,
		"paging": false,
		"info": false,
		"aaSorting": [],
		"pageLength": 100,
		"columnDefs": [
			{
				className: ["text-nowrap"],
				"targets": [0],
			},
			{
				className: ["text-left"],
				"targets": [1],
				className: "dt-head-center",
				
//				"orderable": false
			},
		],
		'language': {
			'url': $("body").data('base_url') + 'static/manager/translate/spanish.json'
		},
		"oLanguage": {
			"sSearch": "Ingrese el texto para filtrar contenidos",
			"sEmptyTable": "Ningún dato disponible en esta tabla"
		},
		"ajax": {
			"url": $("body").data('base_url') + "Home/links",
			"type": "POST"
		},
		//						crea el registro cono un enlace 
		//						'createdRow': function( row, data, dataIndex ) {
		//      $(row).attr('data-url_link', data.url_link);
		//      $(row).attr('title', data.url_link);
		//  },
		initComplete: function () {}

	});

//	table.columns.adjust().draw();
	//			
	//$('#table_links tbody').on('click', 'tr', function () {
	//	
	//   var link = $(this).attr("data-url_link");
	//   window.open(link,'_blank');
	//});

});