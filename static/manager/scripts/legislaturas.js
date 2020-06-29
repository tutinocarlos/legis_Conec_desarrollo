
// Display an Editor form that allows the user to pick the CSV data to apply to each column
function selectColumns ( editor, csv, header ) {
    var selectEditor = new $.fn.dataTable.Editor();
    var fields = editor.order();
 
    for ( var i=0 ; i<fields.length ; i++ ) {
        var field = editor.field( fields[i] );
 
        selectEditor.add( {
            label: field.label(),
            name: field.name(),
            type: 'select',
            options: header,
            def: header[i]
        } );
    }
 
    selectEditor.create({
        title: 'Map CSV fields',
        buttons: 'Import '+csv.length+' records',
        message: 'Select the CSV column you want to use the data from for each field.'
    });
 
    selectEditor.on('submitComplete', function (e, json, data, action) {
        // Use the host Editor instance to show a multi-row create form allowing the user to submit the data.
        editor.create( csv.length, {
            title: 'Confirm import',
            buttons: 'Submit',
            message: 'Click the <i>Submit</i> button to confirm the import of '+csv.length+' rows of data. Optionally, override the value for a field to set a common value by clicking on the field below.'
        } );
 
        for ( var i=0 ; i<fields.length ; i++ ) {
            var field = editor.field( fields[i] );
            var mapped = data[ field.name() ];
 
            for ( var j=0 ; j<csv.length ; j++ ) {
                field.multiSet( j, csv[j][mapped] );
            }
        }
    } );
}


$(document).ready(function () {
	
	  $('.image-popup-vertical-fit').magnificPopup({type:'image'});
	
	// display data obtenida de la lectura de archivo csv
function displayHTMLTable(results){
	


console.log('results');


    var table = "<table class='table'>";
    var data = results.data;
//          alert(data.length);
    
    for(i=0;i<data.length;i++){
			if(i == 0){
			
        table+= "<tr style='font-weight: bold;'>";
				
			}else{
				
        table+= "<tr>";
				
			}
        var row = data[i];
//				row.splice(0,1);
        var cells = row.join(results.meta.delimiter).split(results.meta.delimiter);
        for(j=0;j<cells.length;j++){

        	//console.log(unescape(cells[j]));
            table+= "<td>";
            table+= cells[j].toUpperCase();
            table+= "</th>";
        }
        table+= "</tr>";
    }
    table+= "</table>";
	
    $("#cantReg").html(data.length-1);
    $("#parsed_csv_list").html(table);
		$("#delimitador").val(results.meta.delimiter);
}
	
	
	$("div#myModal").on("change","#csvfile" ,function(){ 
		
		$("#csvfile").parse({
			
        config: {
					beforeFirstChunk: function(){
					//	alert()
					},
//					header:true,
					delimitersToGuess: [',',';'],
//            delimiter: "auto",
						skipEmptyLines: 'greedy', 
//						skipEmptyLines: 'greedy', //or 'greedy',
//           
					complete: function(results){
						displayHTMLTable(results);
						console.log('results.meta.delimiter');
						console.log(results.meta.delimiter);
						
					},
        },
        before: function(file, inputElem)
        {
           //console.log("Parsing file...", file);
        },
        error: function(err, file)
        {
            //console.log("ERROR:", err, file);
        },
        complete: function(results)
        {
					$("#importSubmit, #msjPrev").removeClass('invisible');
//						$("#delimitador").val(results.meta.delimiter);
            console.log("Done with all files");
					console.log(results);
        }
    });
		

		
		
		
});
	

	
//	open modal
	$(".card-body").on("click", "i.import_csv", function () {
		$('#form_csv').trigger('reset');
		$('#parsed_csv_list').html('');
    $("#myModal").modal();
		
		$("input#id_legislatura").val($(this).data('id'));
		$("span#nombre_legis").html($(this).data('legis'));
		
  });
	
	$('#myModal').on('hidden.bs.modal', function(e){ 
		$("#importSubmit, #msjPrev").addClass('invisible');
		$('#form_csv').trigger('reset');
		$('#parsed_csv_list').html('');
    
	}) ;
	

	var tabla_legis = $('#example').DataTable({
		"pageLength": 50,
		"order": [],	
		"autoWidth": true,
		"columnDefs": [
			{
				targets: -1,
				className: 'dt-body-right',
				"width": "10%",
    	},
			{
				targets: 5,
				className: 'dt-body-center',
				"width": "1%",
    	},
			{
				targets:6,
				className: 'dt-head-center',
				className: 'dt-body-center',
				"width": "1%",

				
    	},
			{
				targets: 7,
				className: 'dt-head-center',
				className: 'dt-body-center',
				"width": "1%",
				"orderable": false
				
    	},
			{
				targets: 8,
				className: 'dt-head-center',
				"orderable": false
				
    	}
  	],
		language: {
			url: $("body").data('base_url') + 'static/manager/translate/spanish.json'
		},

		"ajax": {
			"url": $("body").data('base_url') + "Manager/Legislaturas/get_legislaturas",
			"type": "POST"
		}
	});

	$(".card-body").on("click", "i.borrar", function () {
		
		
		var id = $(this).data('id');
		var legislatura = $(this).data('legis');
		var total_publicaciones = $(this).data('total_publicaciones');
		
		
		$.confirm({
		 columnClass: 'medium',
			closeIcon: true,
			icon: 'fa fa-warning',
			title: 'Borrar Legislatura',
			content: 'Desea eliminar el id:'+id + '<br><strong>'+legislatura+'</strong><br>Publicaciones relacionadas: '+total_publicaciones,
			buttons: {

				confirm:{
					text: 'Proceder',
					btnClass: 'btn btn-green', 
					action: function () {

						var dato = new FormData();
						dato.append('id', id);
	

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
						url: $("body").data('base_url') + "Manager/Legislaturas/borrar_registro",
						success: function (result) {
							$(".preloader").fadeOut();
							console.log('result');
							console.log(result);
							if (result.estado == true) {
								
								toastr.success('Registro borrado correctamente!', 'Legislaturas');
								
								$('#example').DataTable().ajax.reload();
			
							} else {
								toastr.error('Registro no Borrado !', 'Legislaturas');
							}
//									location.reload();
						},
						error: function (xhr, errmsg, err) {
						console.log(xhr.status + ": " + xhr.responseText);
						}
						});



					}
				},
				cancel: {
					text: 'Cancelar',
					btnClass: 'btn btn-red', 
					action: function () {
						$.alert('Acción Cancelada, no se borrará el dato');
					}
				},
//								somethingElse: {
//									text: 'Something else',
//									btnClass: 'btn-blue',
//									keys: ['enter', 'shift'],
//									action: function () {
//										$.alert('Something else?');
//									}
//								}
			}
		});
	});
		
	$(".card-body").on("click", "a.acciones", function () {

		
		var dato = new FormData();
		dato.append('id', $(this).data('id'));
		dato.append('tabla', $(this).data('tabla'));
		dato.append('estado', $(this).data('estado'));

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
			url: $("body").data('base_url') + "Manager/Categorias/status_categoria",
			success: function (result) {
				console.log('result');
				console.log(result.estado);
				if (result.estado == true) {
					toastr.success('Registro Editado correctamente!', 'Categorías');
				} else {
					toastr.error('Registro no Actualizado!', 'Categorías');
				}
				location.reload();


			},
			error: function (xhr, errmsg, err) {
				console.log(xhr.status + ": " + xhr.responseText);
			}
		});
	});

	//	subir imagen principal
	$("#cargar_imagen").on('click', function (e) {
		
		e.preventDefault();
		var $fotos = $("#input_cargar_imagenes");
		
		var archivos = $fotos[0].files;

		var formData = new FormData();
		if (archivos.length > 0) {
			
			$.each( archivos, function( index, value ){
    		console.log('index -> '+ index+ 'value -> '+value.name)
				formData.append(index, value.name);
			});

//      var lector = new FileReader();
      //Ojo: En este caso 'foto' será el nombre con el que recibiremos el archivo en el servidor
      $.ajax({
        url: $("body").data('base_url')+"Manager/Legislaturas/upload_file_2",
        data: formData,
        type: 'POST',
        contentType: false,
        processData: false,
        success: function(resultados) {
					
          console.log("Petición terminada. Resultados", resultados);
        }

      });
    }

		


		if ($("#input_cargar_imagenes").val() == '') {
			alert('Seleccione un archivo');
			return false;
		}

		$.ajax({
			type: "POST",
			contentType: false,
			data: new FormData(this),
			processData: false,
			cache: false,
			beforeSend: function () {

			},
			url: $("body").data('base_url')+"Manager/Posassasast/upload_file_2",
			success: function (result) {

				console.log('result');
				console.log(result);

				$("#image_post").html('');
				$("#image_post").html(result);
				toastr.success('Registro Ingresao correctamente!', 'Carga de Imágenes');
			},
			error: function (xhr, errmsg, err) {
				console.log(xhr.status + ": " + xhr.responseText);
			}
		});

	});
	
	
	
	/// check selecciono imagen en el editor de legislatura

	$('input[name=logo]').change(function () {
		$("#nuevo_logo	").val('')
		$("#nuevo_logo	").val($(this).val())
	});


	$("a#borrar_video").click(function (e) {

		e.preventDefault();


		var id_video = $(this).data('id_video');

		var dato = new FormData();
		dato.append('id_video', $(this).data('id_video'));
		//		dato.append('tabla', $(this).data('tabla'));
		//		dato.append('estado', $(this).data('estado'));

		$.ajax({
			type: "POST",
			contentType: false,
			dataType: 'json',
			data: dato,
			processData: false,
			cache: false,
			beforeSend: function () {},
			url: $("body").data('base_url') + "Manager/Legislaturas/borrar_video",
			success: function (result) {
				$(".preloader").fadeOut();
				console.log('result');
				console.log(result.estado);
				if (result.estado == true) {

					toastr.success('Registro ' + id_video + ' Borrado correctamente!', 'Videos');

					$("div#video_" + id_video).remove();

				} else {
					toastr.error('Registro no borrado!', 'Videos');
				}
				//				location.reload();
			},
			error: function (xhr, errmsg, err) {
				console.log(xhr.status + ": " + xhr.responseText);
			}
		});

	});


	
	/* BORRAR IMENGES SLIDER */
	
		$("a.borrar_imagen_slider").click( function () {


		var url = $(this).data('url');
		var id_legis = $(this).data('legis');
	

		$.confirm({
			closeIcon: true,
			icon: 'fa fa-warning',
			title: 'Borrar Imagenes',
			content: 'Desea eliminar la imagen del Slider?',
			buttons: {

				confirm:{
					text: 'Proceder',
					btnClass: 'btn btn-green', 
					action: function () {

						var dato = new FormData();

						dato.append('url', url);
						dato.append('foto', 'slider');
						dato.append('id_legis', id_legis);

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
						url: $("body").data('base_url') + "Manager/Legislaturas/eliminar_imagen_slider",
						success: function (result) {
							$(".preloader").fadeOut();
							console.log('result');
							console.log(result);
							if (result.estado == true) {
	
								toastr.success(result.mensaje, 'Imágenes');
																	location.reload();

							} else {
							toastr.error('Registro no Borrado !', 'Imágenes');
							}
//									location.reload();
						},
						error: function (xhr, errmsg, err) {
						console.log(xhr.status + ": " + xhr.responseText);
						}
						});



					}
				},
				cancel: {
					text: 'Cancelar',
					btnClass: 'btn btn-red', 
					action: function () {
						$.alert('Acción Cancelada, no se borrará la imagen');
					}
				},
//								somethingElse: {
//									text: 'Something else',
//									btnClass: 'btn-blue',
//									keys: ['enter', 'shift'],
//									action: function () {
//										$.alert('Something else?');
//									}
//								}
			}
		});

	});

});


