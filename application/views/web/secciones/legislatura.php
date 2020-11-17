<?php
//echo '<pre>';
////var_dump($videos);
//echo '</pre>';

?>
<style>
	.project-quick-info ul {
		/*   padding-left: 30px;*/
	}


	/* estilos para botones de exportar */

	.buttons-html5 {
		color: #404040 !important;
		background-color: #f5f5f5 !important;
		border-color: #404040 !important;
		padding: 10px !important;
		text-align: left !important;
	}

	div.html5buttons {
		text-align: left !important;
	}
	

	
	}

</style>
<div class="business-banner">
	<div class="hvrbox">
		<img src="<?= base_url('static/web/images/slider/banner_paginas.png')?>" alt="Banner" class="hvrbox-layer_bottom">
		<div class="hvrbox-layer_top">
			<div class="container">
				<div class="overlay-text text-center">
					<h3><?= $legislatura->nombre?></h3>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="bussiness-project-details blog-list-layout">
	<div class="padding-top-middle"></div>
	<div class="container fuid-xs">
		<div class="row">
			<div class="col-md-12">
				<div class="row">

					<div class="col-md-4">
						<div class="single-partner">
							<div class="project-quick-info">
								<div class="media-body ">
									<figure><img src="<?= base_url($legislatura->logo)?>" alt="" class="img-fluid img-thumbnail mx-auto d-block">
									</figure>
									<ul>
										<li>
											<i class="fa fa-globe"></i> <a style="font-size:15px" target="_blank" href="<?= $legislatura->url?>"><?= $legislatura->url?></a>
										</li>
										<li>
											<i class="fa fa-envelope"></i> <a style="font-size:15px" target="_blank" href="mailto:<?= strtolower($legislatura->email)?>"><?= strtolower($legislatura->email)?></a>
										</li>
										<li>
											<i class="fa fa-phone"></i>
											<?= $legislatura->telefono?>

										</li>
										<li>
											<i class="fa fa-map-marker"></i>
											<?= $legislatura->direccion?>

										</li>
									</ul>
									<ul class="top-nav-social">
										<?php if($legislatura->facebook != ''): ?>
										<li><a href="<?= $legislatura->facebook ?>" class="facebook" target="_blank"> <i class="fa fa-facebook"></i> </a>
										</li>
										<?php endif;?>
										<?php if($legislatura->twitter!= ''): ?>
										<li><a href="<?= $legislatura->twitter ?>" class="twitter" target="_blank"> <i class="fa fa-twitter"></i> </a>
										</li>
										<?php endif;?>
										<?php if($legislatura->instagram!= ''): ?>
										<li><a href="<?= $legislatura->instagram ?>" class="instagram" target="_blank"> <i class="fa fa-instagram"></i> </a>
										</li>
										<?php endif;?>
										<?php if($legislatura->linkedin!= ''): ?>
										<li><a href="<?= $legislatura->linkedin ?>" class="linkedin" target="_blank"> <i class="fa fa-linkedin"></i> </a>
										</li>
										<?php endif;?>										
										<?php if($legislatura->youtube!= ''): ?>
										<li><a href="<?= $legislatura->youtube ?>" class="youtube" target="_blank"> <i class="fa fa-youtube"></i> </a>
										</li>
										<?php endif;?>
									</ul>


								</div>
							</div>
						</div>
					</div>
					<div class="col-md-8">

						<?php if(!empty($imagenes)):?>

						<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
							<ol class="carousel-indicators">
								<?php for($a = 0; $a < count($imagenes); $a++): ?>
								<?php if($a == 0){ $active = 'active'; }?>
								<li data-target="#carouselExampleIndicators" data-slide-to="<?= $a?>" class="<?= $active?>"></li>
								<?php endfor; ?>
							</ol>
							<div class="carousel-inner" style="max-height: 450px;">
								<?php foreach($imagenes as $data):?>
								<?php if($data === reset($imagenes)) {$active = 'active';}else{$active = '';}?>
								<div class="carousel-item <?= $active ?> ">
									<img class="d-block w-100" src="<?= base_url($data->url)?>" alt="<?= $legislatura->nombre?>">
								</div>
								<?php endforeach;?>
							</div>
							<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
								<span class="carousel-control-prev-icon" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
								<span class="carousel-control-next-icon" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
						</div>
						<?php else: ?>

						<div class="text-center">

							<video controls autoplay muted loop id="video">
								<source src="<?= base_url('static/web/video/legislaturas_conectadas.webm')?>" type="video/webm">
								<source src="<?= base_url('static/web/video/legislaturas_conectadas.mp4')?>" type="video/mp4">
								<source src="<?= base_url('static/web/video/legislaturas_conectadas.ogg')?>" type="video/ogg">
								Tu navegador no implementa el elemento <code>video</code>.
							</video>
							<!--
					 <a href="https://www.youtube.com/watch?v=gwinFP8_qIM" class="video"><span><i class="fa fa-play"></i></span></a> 
						<iframe width="100%" height="400" src="https://www.youtube.com/embed/SDtXPOaFpD8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
-->
						</div>
						<?php endif; ?>
					</div>

				</div>

			</div>
		</div>
<!--		SECCION VIDEOS CARGADOS -->
	<div class="padding-top-middle"></div>
		<section class="videos">
			<div class="row">
				
		<?php if(!empty($videos)):?>
		<?php foreach($videos as $data):?>
	<div class="col col-md-12">
			<h2><?= $data->titulo_video ?></h2>
		
	</div>
	<div class="col col-md-8 offset-md-4">
		
			<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?= $data->url_video ?>" allowfullscreen></iframe>
	</div>
</div>
		<?php endforeach;?>
		<?php endif; ?>
			</div>
			
		</section>
		<?php if($legislatura->id != 91):?>
	<div class="padding-top-middle"></div>
		<section class="representantes">
			<h2>Representantes</h2>

			<div class="table-responsive  text-center" style="font-size: 12px;">
				<div id="zero_config_wrapper tabla-representantes" class="fuid-xs dataTables_wrapper container-fluid dt-bootstrap4">
					<table id="representantes" class="display" style="width: 100%;">
						<thead>
							<tr>
								<th>Apellido</th>
								<th>Nombre</th>
								<th>Bloque</th>
								<th>Preríodo</th>
							</tr>
						</thead>

					</table>
				</div>
			</div>
		</section>
		<section class="normativas">


			<style>
				.owl-nav {
					margin-top: 15px;
					text-align: center;
				}

				.owl-nav i {
					padding: 0 50px;
				}

			</style>

			<div class="">
				<h2>Normativas</h2>
				<?php //var_dump($publicaciones)?>
			</div>
			<?php 
			if(!empty($normativas)):
			?>
			<hr>
			<?php //var_dump($mas_noticias)?>
			<div class="owl-carousel" id="normativas">
				<?php foreach($normativas as $normativa):?>
				<div class="single-bolg hover01 ">

					<div class="blog-content">
						<?php 
							$segments = array('Publicacion',convert_accented_characters(url_title($normativa->titulo), 'underscore', TRUE),$normativa->id);
						?>

						<a href="<?= base_url($segments)?>"><?= $normativa->titulo ?></a>
						<div class=" detalles">
							<div><i class="fa fa-globe"></i><strong>Ámbito: </strong>
								<?= $normativa->nombre_ambito?>
							</div>
							<div><i class="fa fa-comments"></i><strong>Temática: </strong>
								<?= $normativa->nombre_categoria?>
							</div>
							<div><i class="fa fa-clock-o"></i>
								<?=  fecha_es($normativa->fecha_add,"d F a")?>
							</div>
						</div>
					</div>
				</div>
				<?php endforeach;?>
			</div>
			<div class="owl-nav ">
				<button class="am-prev-normativa btn btn-outline-secondary">Anterior</button>
				<button class="am-next-normativa btn btn-outline-secondary">Siguiente</button>
			</div>
			<?php 
		else:
			echo '<hr>Sin información por el momento<hr>';
		endif; 
		?>


		</section>
		<?php endif; ?>


		<section class="mas_noticias">


			<style>
				.owl-nav {
					margin-top: 15px;
					text-align: center;
				}

				.owl-nav i {
					padding: 0 50px;
				}

			</style>

			<div class="">
				<h2>Noticias</h2>
				<?php //var_dump($publicaciones)?>
			</div>
			<?php 
			if(!empty($publicaciones)):
			
			//var_dump($mas_noticias)?>
			<hr>
			<div class="owl-carousel" id="noticias">
				<?php foreach($publicaciones as $publicacion):?>
				<div class="single-bolg hover01 ">
					<figure style="    background: url(<?php echo base_url(); ?>/static/web/images/slider/banner_paginas.png) center;  height: 26.652452025586353vh;
  display: flex;
  align-items: center;
  justify-content: center;"><img src="<?= base_url($publicacion->foto)?>" class="img-responsive ig-thumbnail" tyle=" position: relative;margin: auto;top: 0;left: 0;right: 0;bottom: 0;">
					</figure>
					<div class="blog-content">
						<?php 
								$segments = array('Noticias',convert_accented_characters(url_title($publicacion->titulo), 'underscore', TRUE),$publicacion->id);
							?>

						<a href="<?= base_url($segments)?>"><?= $publicacion->titulo ?></a>
						<div class=" detalles">
							<div><i class="fa fa-globe"></i><strong>Ámbito: </strong>
								<?= $publicacion->nombre_ambito?>
							</div>
							<div><i class="fa fa-comments"></i><strong>Temática: </strong>
								<?= $publicacion->nombre_categoria?>
							</div>
							<div><i class="fa fa-clock-o"></i>
								<?=  fecha_es($publicacion->fecha_add,"d F a")?>
							</div>
						</div>
					</div>
				</div>
				<?php 
	
				
				endforeach;
					?>
			</div>
			<div class="owl-nav ">
				<button class="am-prev btn btn-outline-secondary">Anterior</button>
				<button class="am-next btn btn-outline-secondary">Siguiente</button>
			</div>
			<?php 
			else:
					echo '<hr>Sin información por el momento<hr>';
			
			endif; ?>


		</section>


	</div>
</div>
<div class="padding-top-middle"></div>

<script>
	var id_legis = <?= $legislatura->id?>;


	/*paso la imagen en base64 al archivo legislatura.js*/
	//var img_base64 = '<?php //echo img_base64('http://10.1.1.77/'.$legislatura->logo)?>';
	var img_base64 = '<?php echo img_base64(base_url($legislatura->logo))?>';
	/*paso el nombre del organismo  al archivo legislatura.js*/
	var organismo = '<?= $legislatura->nombre?>';

</script>
