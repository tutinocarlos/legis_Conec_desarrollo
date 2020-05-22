$(document).ready(function() {

	
	$('.minicolors-input_prov').minicolors({
//			control: $(this).attr('data-control') || 'hue',
//			position: $(this).attr('data-position') || 'bottom left',

			change: function(value, opacity) {
				console.log(value);
				$('span.provincia').css('background-color',value);
			},
			theme: 'bootstrap'
		
	});	
	
	$('.minicolors-input_camara').minicolors({
			control: $(this).attr('data-control') || 'hue',
			position: $(this).attr('data-position') || 'bottom left',

			change: function(value, opacity) {
				alert()
				$('span.minicolors-swatch-color_camara').css('background-color',value);
			},
			theme: 'bootstrap'
		
	});
	
	
	
    $('#example').DataTable( {
			columnDefs: [
					{
					targets: -1,
					className: 'dt-body-right'
    			},
					{
					"targets": [-1],
					"orderable": false
					},
					{
					targets: -1,
					className: 'dt-body-right'
					},
					{
					targets: 0,
					className: 'dt-body-left'
					}
			],
			language: {
        url: $("body").data('base_url')+'static/manager/translate/spanish.json'
    },
			 "pageLength": 25,
       
        "ajax": {
            "url": $("body").data('base_url')+"Manager/Tipos_camaras",
            "type": "GET"
        }
    } );
	

} );