$(document).ready(function() {

    $('#example').DataTable( {
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
            "url": $("body").data('base_url')+"Manager/Subcategorias/sub_categorias",
            "type": "GET"
        }
    } );
	
	
		$(".card-body").on("click",":button.acciones",function(){	

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
				url : $("body").data('base_url')+"Manager/Categorias/status_categoria",
				success : function (result) {
					console.log('result');
					console.log(result.estado);
					if(result.estado == true){
					toastr.success('Registro Editado correctamente!', 'Categorías');
					}else{
					toastr.error('Registro no Actualizado!', 'Categorías');
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