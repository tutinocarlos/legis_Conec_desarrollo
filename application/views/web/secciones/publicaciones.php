</div>
<?php 
	//var_dump($provincias);
	//var_dump($tematicas);
	//var_dump($tipo_normativas);
	//var_dump($ambitos);

?>

<style>
	
	li.borrar-filtros{
		background-color: aqua;
	}
	.img-thumbnail{
/*		max-width: 70%!important;	*/
	}
	table#example, div#example_wrapper{
		font-size: 12px!important;
	}
	div.portfolio-header-menu h4{
		color:#4f92b0!important;
		 
	}
	
	ul.simplefilter li:hover{
		color: #4f92b0!important;
		background-color: #fdfdfd!important;
	}
	ul.simplefilter {
		padding: 0 !important;
	}
	.simplefilter li{
		padding: 5px!important;
		font-size: 12px!important;
		text-transform:none!important;
		
	}
	.simplefilter li:not(.active) {
		margin-bottom: 5px;
		background-color: #f5f5f5!important;
	}


	/* estilos para botones de exportar */

/*	div.dt-publicaciones_home  .btn-primary {
    color: #117a8b!important;
    background-color: #f5f5f5!important;
    border-color: #007bff!important;	
  }*/


  .buttons-html5{
  	color: #404040!important;
    background-color: #f5f5f5!important;
    border-color: #404040!important;
    padding: 10px!important;
  }

</style>
<!--aca corto-->
<div class="business-banner">
	<div class="hvrbox">
		<img src="<?= base_url('static/web/images/slider/banner_paginas.png')?>" alt="Mountains" class="hvrbox-layer_bottom">
		<div class="hvrbox-layer_top">
			<div class="container">
				<div class="overlay-text text-center">
					<h3>
						<?= $titulo_seccion?>
					</h3>

				</div>
			</div>
		</div>
	</div>
</div>

<div id="tablaDetalle_wrapper">
	<div id="tablaDetalle_filter"></div>
</div>
<div class="padding-top-small"></div>
				<div class="container">
					
					<div class=" row portfolio-header-menu " >
							<div class="col-md-1">
								<strong>Provincia:</strong>
							</div>
							<div class="col-md-11">
		
								<ul class="simplefilter " id="provincias">
									<?php foreach($provincias as $provincia):?>
										<li  data-row="provincia" class="filter btn btn-success"  data-filter="<?= $provincia->id_provincias?>"><?= $provincia->nombre?></li>
									<?php endforeach;?>
								</ul>
							</div>

					</div>
					<div class=" row portfolio-header-menu " >
							<div class="col-md-1">
								<strong>Temática:</strong>
							</div>
							<div class="col-md-11">
								<ul class="simplefilter " id="tamaticas">
									<?php foreach($tematicas as $tematica):?>
										<li  data-row="tematica" class="filter btn btn-warning" data-filter="<?= $tematica->id_categorias?>"><?= $tematica->nombre?></li>
									<?php endforeach;?>
								</ul>
							</div>

					</div>
					
					<div class=" row portfolio-header-menu ">
						<div class="col-md-1">
							<strong>Tipo:</strong>
						</div>
						<div class="col-md-5 ">		
							<ul class="simplefilter text-left " id="tipo_normativa">
								<?php foreach($tipo_normativas as $normativa):?>
									<li data-row="normativa"  class="filter btn btn-primary" data-filter="<?= $normativa->id_tipo_normativa?>"><?= $normativa->nombre?></li>
								<?php endforeach;?>
							</ul>
						</div>
						
						<div class="col-md-1">
							<strong>Ámbito:</strong>
						</div>
						<div class="col-md-5">
							
							<ul class="simplefilter  text-left " id="ambito">
								<?php foreach($ambitos as $ambito):?>
									<li data-row="ambito"  class="filter btn btn-info" data-filter="<?= $ambito->id_ambito?>"><?= $ambito->nombre?></li>
								<?php endforeach;?>
							</ul>
						</div>
					</div>
					<div class=" row portfolio-header-menu ">
						<div class="col-md-6 text-right">
							<ul class="simplefilter ">
								<li  class="active aplicar-filtros btn btn-info btn-block" data-filter=""><i class="fa fa-tasks"></i> FILTRAR SEGÚN SELECCIÓNES</li>
								
							</ul>
						</div>												
						<div class="col-md-6 text-right">
							<ul class="simplefilter ">
								<li  class="active borrar-filtros btn btn-light btn-block" data-filter=""><i class="fa fa-list"></i>  BORRAR FILTROS</li>
								
							</ul>
						</div>
					</div>
						
				</div>
<div class="business-portfolio-1x" id="portfolio">
	<div class="container">
		<div class="bussiness-portfolio-light ">
			<div class="portfolio-body">
				<div class="col-md-12">
				</div>
				<div class="table-responsive publicaciones_home">
					<div id="zero_config_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
						<table id="publicaciones" class="display" style="width:100%">
							<thead>
								<tr>
									<th width="10%">logo</th>
									<th width="40%" >Título</th>
									<th width="40%" >Temática</th>
									<th>Organismo</th>
									<th width="5%">Tipo</th>
									<th>Ámbito</th>
								</tr>
							</thead>
							<tbody></tbody>
						<tfoot>

						</tfoot>

						</table>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<div class="padding-top-large"></div>

<!--aca corto-->
<div class="container">

<?php
// Nombre de la imagen
$path = base_url('static/web/images/logos/logo1.png');
 
// Extensión de la imagen
$type = pathinfo($path, PATHINFO_EXTENSION);
 
// Cargando la imagen
$data = file_get_contents($path);
 
// Decodificando la imagen en base64
$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
 
// // Mostrando la imagen
// echo '<img src="'.$base64.'"/>';
 
// // Mostrando el código base64
// echo $base64;


 ?>

	<script type="text/javascript">
		
var img_base64 = '<?php echo $base64 ?>';

	</script>