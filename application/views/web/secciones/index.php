		<?php
//
 echo '<pre>';
 var_dump($notificacion_emergente);
////// var_dump($this->provincias);
 echo '</pre>';
//
//	$prov_nombre_actual= '';
//
//foreach($slider as $slide){
//
//	if($prov_nombre_actual == $slide->nombre_prov){
//		$prov_nombre_actual='';
//	}else{
//		$prov_nombre_actual= $slide->nombre_prov;
////		echo '<br>-->> '.$prob;
//	}
//	
//}
 


// inicio la variable para no repetir organimsos de bicamerales
	$prov_nombre_actual= '';
?>


	<style type="text/css">
		.jvectormap-legend-inner {
  margin-bottom: 3px;
}

.jvectormap-legend-cnt-h .jvectormap-legend-tick {
  width: auto;
  margin-right: 10px;
}

.jvectormap-legend-cnt-h .jvectormap-legend-tick-text {
  display: inline-block;
  vertical-align: middle;
  line-height: 13px;
}

.jvectormap-legend-cnt-h .jvectormap-legend-tick-sample {
  width: 32px;
  height: 32px;
  display: inline-block;
  vertical-align: middle;
}


	</style>
			
<?php 

//echo anchor('news/local/123', 'My News', array('title' => 'The best news!'));

//echo '<pre>'.var_dump($slider).'</pre>';
$provincias2 = json_decode(json_encode($this->provincias), true);	
			 
//informacion de provincias para el mapa
$names = '';
$labels = '';	
$colors_regions = '';			 
$colors_camaras = '';	
$marker = "";			 
foreach ($provincias2 as $provincia){
	
	//marker para caba
	if ($provincia["zona_provincia"]=="AR-C"){
		$marker = "
		name: '".$provincia["nombre_provincia"]."',
		labels: '".$provincia["nombre_camara"]."',
		code: '".$provincia["zona_provincia"]."',
		style: {fill: '".$provincia["color_camara"]."', r:15}
		";
		
	}
	
	$names .= "'".$provincia["zona_provincia"]."': '".$provincia["nombre_provincia"]."',
	";
	
	$labels .= "'".$provincia["zona_provincia"]."': '".$provincia["nombre_camara"]."',	
	";
	
	$colors_regions .= "'".$provincia["zona_provincia"]."': '".$provincia["color_provincia"]."',
	";
	
	$colors_camaras .= "'".$provincia["zona_provincia"]."': '".$provincia["color_camara"]."',
	";
}
?>
<style>
	div.overlay-text 
	{
		margin-top: 8%!important;
	}
	div.overlay-text h2 
	{
		letter-spacing: -5px!important;
		font-weight: 400!important;
	}
	div.detalles_legislaturas_conectadas
	{
		margin-top: 60px;
		width: 
	}
	
	
 .tp-rightarrow {
  background: url("<?=base_url('static/manager/assets/libs/revolution/css/revolution/arror_right.png')?>") no-repeat center center/cover;
  border-radius: 100%;
  height: 72px;
  width: 72px;
  -webkit-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}	
 .tp-rightarrow:hover {
  background: url("<?=base_url('static/manager/assets/libs/revolution/css/revolution/arror_right_hover.png')?>") no-repeat center center/cover;
  border-radius: 100%;
  height: 72px;
  width: 72px;
  -webkit-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}
	
	 .tp-leftarrow {
  background: url("<?=base_url('static/manager/assets/libs/revolution/css/revolution/arror_left.png')?>") no-repeat center center/cover;
  border-radius: 100%;
  height: 72px;
  width: 72px;
  -webkit-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}
		 .tp-leftarrow:hover {
  background: url("<?=base_url('static/manager/assets/libs/revolution/css/revolution/arror_left_hover.png')?>") no-repeat center center/cover;
  border-radius: 100%;
  height: 72px;
  width: 72px;
  -webkit-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}
	
	
	div.tp-caption{
		/*font-family: "Myriad-Pro"; */ 
/*		font-family: "Times New Roman", Times, serif;*/
	}
	.tp-parallax-wrap{

		margin-top: 50px!important;
	}
	
/*
	.tp-mask-wrap{
		
		height: 195px!important;
	}
	
*/
</style>
<header>
	<?php 
//	echo '<pre>';
//	var_dump($slider[0]);
//	echo '</pre>';
//	
//	die();
	?>
<?php 
	


	
	if(empty($slider)):?>
 
 
 <?php 
	?>
<div class="business-main-slider hidden-xs">
	<div class="owl-carousel main-slider">
	 <div class="item">
			<div class="hvrbox">
					<img src="<?= base_url();?>static/web/images/slider/banner_1.png" alt="Legislaturas Conectadas" class="hvrbox-layer_bottom">
			</div>
		</div>	
	</div>
            
	<?php else:?>
	
	
<div class="rev_slider_wrapper d-none d-sm-block">
 
        <!-- the ID here will be used in the JavaScript below to initialize the slider -->
        <div id="rev_slider_1" class=" slider  rev_slider" data-version="5.4.5" style="" >
 
            <ul> 
		<?php foreach($slider as $slide):?>
                
			<?php
				$color_fondo ='';
				if($slide->slider != 'static/web/images/slider/banner_1.png'){

							$color_fondo = 'background: rgb(245 245 245 / 74%);';

				}

													
			// inicio del if para no repetir las provincia
			if($prov_nombre_actual == 'cas'){ 
				
					$prov_nombre_actual='';
			}else{
				
				$prov_nombre_actual= $slide->nombre_prov;
						
				// segun si el tipo de camara es unicameral o bicameral armo el enlace 
				if($slide->id_camara == 1){

					$segments = array('Legislatura',$slide->id_legis,convert_accented_characters(url_title($slide->nombre_legis), 'underscore', TRUE));

				}else{

					$segments = array('Provincias',convert_accented_characters(url_title($slide->zona_prov),'underscore', TRUE),convert_accented_characters(url_title($slide->nombre_prov),'underscore', TRUE));

				}
				// FIN segun si el tipo de camara es unicameral o bicameral armo el enlace 
			?>               
				<li data-transition="fade" data-link="<?=  base_url($segments) ?>" data-target="">
                        <!-- BEGIN TEXT LAYER -->
<div class=" tp-caption sfr font-extra-bold tp-resizeme letter-space-4 header-1 title-line-2" data-x="center" data-hoffset="0" data-y="center" data-voffset="-100" data-frames="[{&quot;delay&quot;:800,&quot;speed&quot;:1000,&quot;frame&quot;:&quot;0&quot;,&quot;from&quot;:&quot;x:[175%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:1;&quot;,&quot;mask&quot;:&quot;x:[-100%];y:0;s:inherit;e:inherit;&quot;,&quot;to&quot;:&quot;o:1;&quot;,&quot;ease&quot;:&quot;Power3.easeOut&quot;},{&quot;delay&quot;:&quot;wait&quot;,&quot;speed&quot;:300,&quot;frame&quot;:&quot;999&quot;,&quot;to&quot;:&quot;auto:auto;&quot;,&quot;ease&quot;:&quot;Power3.easeInOut&quot;}]" style="<?= $color_fondo?>z-index: 6; font-size: 50px; color: #005e83; text-transform: ; font-family: myriad-pro, sans-serif; white-space: nowrap; font-weight: 700; visibility: inherit; transition: none 0s ease 0s; text-align: inherit; line-height: 50px; border-width: 0px; margin: 0px; padding: 10px; letter-spacing: 0px;  min-width: 0px; max-height: none; max-width: none; opacity: 1; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); transform-origin: 50% 50% 0px;" id="layer-<?= $slide->id_legis ?>"
>

							<?php
							// diferenciar entre las legislaturas y legis conectadas
								if($slide->id_legis == 1){

								//	echo  'Poder Legislativo de la '.wordwrap($slide->nombre_prov, 23, "<br>" ,FALSE); 
									echo  'Poder Legislativo de la '.$slide->nombre_prov; 

								}else if($slide->id_legis == 91 ){

//									echo  'Legislaturas Conectadas '; 
									echo '<img id="image_slider" src="'.base_url('static/web/images/logos/logo-LC-originalcontagline.png').'" width="200" height="239" alt="Legislaturas Conectadas">';
								}else{
									
								//echo  wordwrap('Poder Legislativo de la Provincia de '.$slide->nombre_prov, 35, "<br>" ,FALSE); 
									echo  'Poder Legislativo de la Provincia de '.$slide->nombre_prov; 

								}
							//FIN diferenciar entre las legislaturas y legis conectadas
								?>
</div>
<!-- END TEXT LAYER --> 
       
			<img src="<?= base_url($slide->slider);?>"  alt="Poder Legislativo de la Provincia de <?= $slide->nombre_prov ?>" class="rev-slidebg" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat">
                </li>
           					<?php 
																			}
																// fin del if para no repetir las provincias
																?>
                <?php endforeach;?>

           	<?php endif;?>
            </ul>
        </div>
    </div>
    </div>

</header>
<!--
	<div class="business-main-slider">
	<div class="owl-carousel main-slider">
	<?php if(empty($slider)):?>
		<div class="item">
			<div class="hvrbox">
					<img src="<?= base_url();?>static/web/images/slider/banner_1.png" alt="Legislaturas Conectadas" class="hvrbox-layer_bottom">
			</div>
		</div>	
	<?php else:?>
	<?php foreach($slider as $slide):?>
		<div class="item">
			<div class="hvrbox">
			<?php 
				$segments = array('Legislatura',$slide->id_legis,convert_accented_characters(url_title($slide->nombre_legis), 'underscore', TRUE));
			?>
			
			<a href="<?= base_url($segments) ?>" title="The best news!">
				<img src="<?= base_url($slide->slider);?>" alt="Legislaturas Conectadas" class="hvrbox-layer_bottom">
			</a>
				
			</div>
		</div>
		<?php endforeach;?>
	<?php endif;?>
	</div>
</div>	
-->

<div class="business-app-present-2x ">
	<div class="app-present-content-2">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="business-title-middle">
				<div class="padding-top-middle"></div>
						<h2>Parlamentos de la Argentina</h2>
						<p class="d-block d-sm-none">Seleccione la provincia para más info</p>
						<span class="title-border-middle"></span>
					</div>
				</div>

			</div>
			<div class="row">
<style>
	div.map_container{
		height: 700px;
	}	
	.smart_map{
	width: 100%; 
	height: 100%;  
}
</style>
				<div class="col-md-6">
					<div class="map_container" >
						<div id="map" class="smart_map" style="width:100%;height:100%" ></div>
					</div>					<div class="map_container" >
						<div id="map2" class="smart_map" style="width:100%;height:100%" ></div>
					</div>
					<?php 
					$tipoCamara = '';
					foreach($this->tipos_camaras as $camara){

						$tipoCamara .= '
						<div class="row container-fluid" style="margin-top: 30px ">
							<div class="col-1 col-md-1" style="background: '.$camara["color"].'; height:30px"></div>
							<div class="col-10 col-md-11"> '.$camara["detalle"].'</div>
						</div>
						<div class="d-block d-sm-none"><p></p></div>
						';

					}
					echo $tipoCamara;
					/*
					<div class="row" style="margin-top: 30px ">
						<div class="col-md-1" style="background: #7DBDEC"></div><div class="col-md-11"> PODERES LEGISLATIVOS BICAMERALES</div>
					</div>	
					<div class="row" style="margin-top: 10px ">
						<div class="col-md-1" style="background: #CBE7F7"></div><div class="col-md-11"> PODERES LEGISLATIVOS UNICAMERALES</div>
                		
					</div>	
					*/
					?>
					
					<div class="row  d-none d-sm-block" style="margin-top: 10px ">
						<div class="small"><i class="fa fa-info-circle"></i> <i>Puede pasar el puntero del mouse para interactuar con el mapa</i></div>
					</div>
				</div>

				<div class="col-md-6" id="legis_tab">
					<div class="text-center">
					
<!--
						<video controls autoplay muted loop id="video">
						<source src="<? //echo  base_url('static/web/video/legislaturas_conectadas.webm')?>" type="video/webm">
						<source src="<? //echo  base_url('static/web/video/legislaturas_conectadas.mp4')?>" type="video/mp4">
						<source src="<? //echo  base_url('static/web/video/legislaturas_conectadas.ogg')?>" type="video/ogg">
						Tu navegador no implementa el elemento <code>video</code>.
						</video>
-->
					<iframe width="100%" height="315" src="https://www.youtube.com/embed/Lv5cHWEbxjg?controls=0&autoplay=1&showinfo=0&rel=0" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen ></iframe>
					</div>
					<!--
					<div class="detalles_legislaturas_conectadas">
						<p>Legislaturas Conectadas es una red interactiva, que busca comunicar a los Poderes Legislativos de Argentina entre sí y con la ciudadanía.</p>
						<p>Contamos con tres medios de comunicación:</p>

						<div class="blog-single-social">
							<div class="footer-info-right" style="text-align: left;">
								<ul>
									<li><a href="https://www.facebook.com/legislaturas.conectadas.arg/"   target="_blank" > <i class="fa fa-facebook"></i> </a></li>										
									<li><a href="https://twitter.com/legisenred"  target="_blank"> <i class="fa fa-twitter" ></i> </a></li>											
									<li><a href="https://www.instagram.com/legislaturasconectadas/?hl=es-la"  target="_blank" > <i class="fa fa-instagram"></i> </a></li>									
								</ul>					
							</div>
						</div>
					</div>
					-->
					<div class="detalles_legislaturas_conectadas">
						<p>Legislaturas Conectadas es una red interactiva, que busca comunicar a los Poderes Legislativos de Argentina entre sí y con la ciudadanía.
						<br>Contamos con tres medios de comunicación
						<ol>	
							<li>La plataforma interactiva www.legislaturasconectadas.gob.ar que elaboramos entre todos.</li>
							<li>Nuestras RRSS:
								<ul>
									<li>INSTAGRAM @legislaturasconectadas</li><li> FB @legislaturas.conectadas.arg </li><li> TWITTER @lconectadas</li>
								</ul>
							</li>
							<li>Una síntesis digital de noticias: “Breves en Imágenes”</li>
						</ol>
						<div class="row">
						 <div class="col-md-3"><img style="width: 150px" class="img-fluid " src="<?php echo base_url()?>static/web/images/logos/LC_logo2.jpg" alt="Logo" style="padding: 10px"> </div><div class="col-md-9"><strong> la RED interparlamentaria ABIERTA a la participación CIUDADANA.</strong></div>
						</div>
						</p>
						<!--
						<div class="blog-single-social">
							<div class="footer-info-right" style="text-align: left;">
								<ul>
									<li><a href="https://www.facebook.com/legislaturas.conectadas.arg/"   target="_blank" > <i class="fa fa-facebook"></i> </a></li>										
									<li><a href="https://twitter.com/legisenred"  target="_blank"> <i class="fa fa-twitter" ></i> </a></li>											
									<li><a href="https://www.instagram.com/legislaturasconectadas/?hl=es-la"  target="_blank" > <i class="fa fa-instagram"></i> </a></li>									
								</ul>					
							</div>
						</div>
						-->
					</div>
				</div>
			</div>
		</div>
	</div>
<div class="padding-top-large"></div>
	
																																	
<?php	if (!empty($noticias_destacadas)): ?>
		<section id="noticias">
<div class="business-cta-1x">
	<div class="cta-content">
<!--		<h2>Últimas Noticias</h2>-->
	<a href="<?= base_url('Noticias')?>" class="bussiness-btn-larg">IR A NOTICIAS PROVINCIALES Y DE LA CABA </a>
<div class="padding-top-middle"></div>
		<?php echo $noticias ?>

	</div>
</div>
</section>
		<?php endif;?>


<!--ECA ESTA EL TITULO ULTIMOS PROYECTOS-->
<?php //echo $post?>

<div class="padding-top-middle"></div>

<?php echo $faqs?>

<div class="business-cta-1x">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="cta-content">
					<h3>Te invitamos a interiorizarte sobre las leyes y proyectos y las actividades de las Legislaturas</h3>
					<a href="<?= base_url('Contacto')?>" class="bussiness-btn-larg">Quiero saber más &raquo;</a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="padding-top-large"></div>


<script>
	
	var base_url = '<?= base_url()?>';
<?php 
	echo '
	var markers = [{
		latLng: [-34.67507287396606, -58.48608696658111],
		'.$marker.'
	}];'
		;
	
	echo '
	var names = {
		'.$names.'  
	};
	';
	
	echo '
	var labels = {
		'.$labels.'
	};
	';
		
	echo '
	var colors_camaras = {
		'.$colors_camaras.'
	};
	';	
	
	echo '
	var colors_regions = {
		'.$colors_regions.'
	};
	';	
?>	
</script>


<?php
if(!empty($notificacion_emergente)){


$segments = array('Noticias',url_title($notificacion_emergente[0]->titulo, 'underscore', TRUE),$notificacion_emergente[0]->id);

?>
<!--MODAL-->
<!-- Modal -->
<div class="modal fade" id="nodal_notificaciones" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
<!--			<h3><?= $notificacion_emergente[0]->titulo?></h3>-->
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<a href="<?= base_url($segments)?>">
					<img src="<?= base_url($notificacion_emergente[0]->foto)?>" alt="" style="width: 800px;">
				</a>
			</div>
<!--
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
-->
		</div>
	</div>
</div>

<?php
}

?>