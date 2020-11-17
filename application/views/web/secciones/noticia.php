<?php

//		echo '<br>--mevcy-<br>';
//		if($next_item){
////		echo '<br>si';
//			var_dump($tags);
//		}else{
//		echo '<br>no';
//		}		
//		echo '<br>--prev--<br>';
//if($prev_item){
//			var_dump($prev_item);
//		echo '<br>si';
//		}else{
//		echo '<br>no';
//		}

//echo $prev_item[0]->nom_tipo_pub;
//die();

//var_dump($publicacion);



//if($publicacion->estado == 0){
//	redirect(base_url('Noticias'));
//}
?>
<style>
	.blog-img-graph {
    position: absolute;
    top: 0;
    padding: 2px;
    background: rgba(0,0,0,0.42);
    width: 100%;
    text-align: right;
    box-shadow: azure;
    text-shadow: 2px 2px 1px 0px #f0f0f0;
    color: #ffffff;
    font-size: 12px;
}
.blog-content a {
    margin: 1px 0 5px 0 !important; 
    
}
	.project-quick-info ul li {
  
    word-break: break-word;
}
	
.video-responsive {
    height: 0;
    overflow: hidden;
    padding-bottom: 56.25%;
    padding-top: 30px;
    position: relative;
	}
.video-responsive iframe, .video-responsive object, .video-responsive embed {
    height: 100%;
    left: 0;
    position: absolute;
    top: 0;
    width: 100%;
}
</style>	
<div class="business-banner">
	<div class="hvrbox">
		<img src="<?= base_url('static/web/images/slider/banner_paginas.png')?>" alt="Mountains" class="hvrbox-layer_bottom">
		<div class="hvrbox-layer_top">
			<div class="container">
				<div class="overlay-text text-center">
					<h3>
						<?= $publicacion->leg_nombre?>
						<br><small>Noticias</small>
					</h3>
				
				</div>
			</div>
		</div>
	</div>
</div>
<div class="bussiness-about-company blog-list-layout">
	<div class="padding-top-middle"></div>
	<div class="container ">
		<div class="row">
			<div class="col-md-8">
				<div class="single-bolg-content">
					<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<?php for($a = 0; $a < count($fotos); $a++): ?>
							<?php if($a == 0){ $active = 'active'; }?>
							<li data-target="#carouselExampleIndicators" data-slide-to="<?= $a?>" class="<?= $active?>"></li>
							<?php endfor; ?>
						</ol>
						<div class="carousel-inner">
							<?php foreach($fotos as $data):?>
							<?php if($data === reset($fotos)) {$activse = 'active';}else{$activse = '';}?>
							<div class="carousel-item <?= $activse ?> ">
								<img class="img-thumbnail img-fluid  mx-auto d-block" src="<?= base_url($data->url)?>" alt="First slide">
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
					<div class="padding-top-small"></div>
					<div class="blog-content">
						<h2>
							<?= ucfirst($publicacion->pub_titulo)?>
						</h2>
					
						<span><i class="fa fa-clock-o"></i><?= fecha_es($publicacion->fecha, "d F a", false)	 ?></span>
						<span><i class="fa fa fa-globe"></i><?= $publicacion->ambito_nombre?></span>
						<span><i class="fa fa fa-info"></i><?= $publicacion->cat_nombre?></span>
					</div>
					<div class="blog-description">
						<?php

						$string = str_replace ('<p>','',$publicacion->cuerpo);
						$string = str_replace ('</p>','',$string);

						$string = str_replace ('"','',$string);
						$string = trim ($string);
						
						$caracter = substr($string, 0, 1);
						
						?>
<!--
						<p><span>
								<?php //$caracter ?></span>
							<?php //substr($string, 1)?>
						</p>
-->
						<blockquotes>
							<?= $publicacion->resumen?>
						</blockquotes>
<!--						quito la letamas grande 07/05/2020 pedido por Sil-->
							<p> <?php echo $publicacion->cuerpo  ?></p>
						<?php if(!empty($publicacion->extra )):?>
						<div class="promotion-box">
							<?= $publicacion->extra?>
						</div>
						<?php endif;?>
					</div>
				</div>

				<div class="row">
					<?php if(!empty($videos)):?>
					<?php foreach ($videos as $video):?>
					<div class="col-sm-12 col-md-12">
						<div class="video-responsive">
							<iframe  src="https://www.youtube.com/embed/<?= $video->url?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						</div>
					</div>
				
				<?php endforeach;?>
				<?php endif;?>
				</div>
				<!--				archivos adjuntos-->
				<?php if(!empty($adjuntos)):?>
				<div class="padding-top-middle"></div>
				<div class="row">
					<div class="col-sm-12">
						<h4>Archivos Adjuntos</h4>
							<?php //var_dump($adjuntos);?>
						<div class="">
						<ul style=" padding-left: 0;">
							<?php foreach($adjuntos as $adjunto):?>
							<?php
							// Obtenfo el nombre del archivo para mostrarlo en el front
							$nombre_archivo = explode('/', $adjunto->url);
							?>
							<li style="list-style: none;">
								<i class="fa fa-paperclip" aria-hidden="true" style="margin-right: 5px; color:#4f92b0;"></i>
								<a href="<?= base_url($adjunto->url)?>" target="_blank"><?= end($nombre_archivo); echo ' - '.$adjunto->detalle ?></a></li>
							<?php endforeach;?>
					</ul>
				</div>
					</div>
				</div>
				<?php endif;?>
<!--				FIN archivos adjuntos-->
				<div class="row">
					<div class="col-md-6">
<!--						<div>Tags:</div>-->
						<div class="blog-single-tag">
							<?php if(!empty($tags)):?>
							<div class="blog-post-tag">
								<ul>
									<li>Tag: </li>
									<?php foreach($tags as $data):?>
									<li>$data->texto</li>
									<?php endforeach;?>
								</ul>
							</div>
							<?php endif;?>
						</div>
					</div>
					<div class="col-md-6">

					</div>
				</div>

				<div class="padding-top-large"></div>

			</div>

			<div class="col-md-4">
				<div class="single-partner">
					<div class="media">
						<div class="project-quick-info">
							<ul>

								<?php
								$segments = array( 'Legislatura', $publicacion->leg_id, convert_accented_characters( url_title( $publicacion->leg_nombre ), 'underscore', TRUE ) );

								?>
								<li><span> <a href="<?= base_url($segments)?>"> <img class="img-fluid img-thumbnail mx-auto d-block" src="<?= base_url($publicacion->leg_foto)?>" alt=""> </a> </span> </li>
								<li> <strong>Temática:</strong> <span><?= @$publicacion->cat_nombre?> </span> </li>
								<?php if($publicacion->autor):?>
								<li> <strong>Autor:</strong> <span> <?= @$publicacion->autor?> </span> </li>
								<?php endif; ?>
								<li> <strong>Fecha:</strong> <span><?= fecha_es($publicacion->fecha,"d F a")	?></span> </li>
								<?php if($publicacion->pub_estado_articulo > 5):?>
								<li> <strong>Estado:</strong> <span> <?= $publicacion->pub_estado_articulo?> </span> </li>
								<?php endif;?>
								<li>
									Información de Contacto:
								</li>
								<li>
									<a style="font-size:15px" target="_blank" href="<?= $publicacion->leg_url?>">
								<i class="fa fa-globe"></i>	<?= $publicacion->leg_url?></a>
								
								</li>
								<li>
									<a style="font-size:15px" target="_blank" href="mailto:<?= $publicacion->leg_email?>">
								<i class="fa fa-envelope"></i>	<?= $publicacion->leg_email?></a>
								
								</li>
								<li>

									<i class="fa fa-phone"></i>
									<?= $publicacion->leg_telefono?>

								</li>
								<li>
									<i class="fa fa-map-marker"></i>
									<?= $publicacion->leg_direccion?>

								</li>
							</ul>

							<ul class="top-nav-social">
								<?php if(!empty($publicacion->facebook)): ?>
								<li><a href="<?= $publicacion->facebook ?>" class="facebook" target="_blank"> <i class="fa fa-facebook"></i> </a>
								</li>
								<?php endif;?>
								<?php if(!empty($publicacion->twitter)): ?>
								<li><a href="<?= $publicacion->twitter ?>" class="twitter" target="_blank"> <i class="fa fa-twitter"></i> </a>
								</li>
								<?php endif;?>
								<?php if(!empty($publicacion->instagram)): ?>
								<li><a href="<?= $publicacion->instagram ?>" class="instagram" target="_blank"> <i class="fa fa-instagram"></i> </a>
								</li>
								<?php endif;?>
								<?php if(!empty($publicacion->youtube)): ?>
								<li><a href="<?= $publicacion->youtube ?>" target="_blank" class="youtube">  <i class="fa fa-youtube" ></i> </a>
								</li>
								<?php endif;?>
							</ul>


						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
<section class="mas_noticias">
	<div class="container">

		<style>
			.customNavigation {
				/*				display: none;*/
			}
			
			.owl-nav {
				margin-top: 15px;
				text-align: center;
			}
			
			.owl-nav i {
				padding: 0 50px;
			}
		</style>

		<div class="">
			<h2>Noticias Relacionadas</h2>
		</div>
		<hr>
		
<!--		array(3) { [0]=> object(stdClass)#64 (7) { ["id_pub"]=> string(3) "325" ["titulo_pub"]=> string(37) "Homenaje a los Patriotas -25 de mayo " ["fecha_add"]=> string(19) "2020-06-03 13:59:21" ["id_tipo_pub"]=> string(1) "2" ["nom_tipo_pub"]=> string(7) "Noticia" ["nombre_cate"]=> string(13) "Comunicación" ["nombre_ambito"]=> string(8) "Nacional" } [1]=> object(stdClass)#65 (7) { ["id_pub"]=> string(3) "328" ["titulo_pub"]=> string(69) "Los Poderes Legislativos de Argentina sesionan durante la pandemia " ["fecha_add"]=> string(19) "2020-06-03 17:21:56" ["id_tipo_pub"]=> string(1) "2" ["nom_tipo_pub"]=> string(7) "Noticia" ["nombre_cate"]=> string(13) "Comunicación" ["nombre_ambito"]=> string(8) "Nacional" } [2]=> object(stdClass)#66 (8) { ["id_pub"]=> string(3) "329" ["titulo_pub"]=> string(24) "Legislaturas Conectadas " ["fecha_add"]=> string(19) "2020-06-03 17:25:12" ["id_tipo_pub"]=> string(1) "2" ["nom_tipo_pub"]=> string(7) "Noticia" ["nombre_cate"]=> string(13) "Comunicación" ["nombre_ambito"]=> string(8) "Nacional" ["foto"]=> string(48) "static/web/images/uploads/post/329_0_logo-lc.jpg" } }-->
		<?php if($mas_noticias):?>
		<?php //var_dump($mas_noticias)?>
		<div class="owl-carousel">
			<?php foreach($mas_noticias as $noticia):?>
			<div class=" single-bolg hover01" title="<?= $noticia->nombre_cate;?>">
					
			<?php if(!empty($noticia->foto)):?>
				<figure><img src="<?= base_url($noticia->foto)?>" class="img-thumbnail img-fluid " style=""></figure>
				<?php else:?>
				<figure><img src="<?= base_url('/static/web/images/uploads/post/logoconectadas.jpg"')?>" class="img-thumbnail img-fluid " style=""></figure>
				<?php endif;?>
				
				<div class="blog-img-graph"><span><?= $noticia->nombre_cate?></span></div>
				<div class="blog-content">
					<?php 
						$segments = array('Noticias',convert_accented_characters(url_title($noticia->titulo_pub), 'underscore', TRUE),$noticia->id_pub);
					?>

					<a href="<?= base_url($segments)?>"><?= $noticia->titulo_pub ?></a>
					<div class=" detalles">
						
						<div><i class="fa fa-globe"></i><strong>Ámbito: </strong>
							<?= $noticia->nombre_ambito?>
						</div>
						<div><i class="fa fa-comments"></i><strong>Temática: </strong>
							<?= $noticia->nombre_cate?>
						</div>
						<div><i class="fa fa-clock-o"></i>
							<?=  fecha_es($noticia->fecha_add,"d F a")?>
						</div>
						
					</div>
				</div>
			</div>
			<?php endforeach;?>
		</div>
		<div class="owl-nav ">
			<button class="am-next btn btn-outline-secondary">Siguiente</button>
			<button class="am-prev btn btn-outline-secondary">Anterior</button>
		</div>
		<?php endif; ?>
	</div>

</section>
<div class="padding-top-middle"></div>
<div class="blog-pagination">
	<nav>
		<?php //echo $this->pagination->create_links() ?>
	</nav>
</div>