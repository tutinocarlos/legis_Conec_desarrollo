$(document).ready(function() {
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
			 "pageLength": 10,
       
        "ajax": {
            "url": $("body").data('base_url')+"Manager/Tipo_publicacion/",
            "type": "GET"
        }
    } );
	
			$(".card-body").on("click","a.acciones",function(){	

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
				url : $("body").data('base_url')+"Manager/Tipo_publicacion/status_categoria",
				success : function (result) {
					console.log('result');
					console.log(result.estado);
					if(result.estado == true){
					toastr.success('Registro Editado correctamente!', 'Tipos');
					}else{
					toastr.error('Registro no Actualizado!', 'Tipos');
					}
//					 location.reload();
										
					setTimeout(function(){
					$(".preloader").fadeOut();
 						location.reload();
					}, 2000);

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
} );