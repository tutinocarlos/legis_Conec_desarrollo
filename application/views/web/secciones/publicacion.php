<!--								<li> <strong>Fecha:</strong> <span><?php //echo fecha_es($publicacion->fecha, "d F a", false)	 ?></span> </li>-->

<?php
//echo '<pre>';
////var_dump($publicacion); 
//echo '</pre>';
//die;

if($publicacion->estado == 0){
	redirect(base_url('Publicaciones/1/Normativas'));
}
?>
<div class="business-banner">
	<div class="hvrbox">
		<img src="<?= base_url('static/web/images/slider/banner_paginas.png')?>" alt="Mountains" class="hvrbox-layer_bottom">
		<div class="hvrbox-layer_top">
			<div class="container">
				<div class="overlay-text text-center">
					<h3>
						<?= $publicacion->leg_nombre?>
						<br>
						<small><?= $titulo_seccion?></small>
						
					</h3>
				

				</div>
			</div>
		</div>
	</div>
</div>

<div class="padding-top-medium" style="padding-top:15px"></div>
<div class="bussiness-project-details">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-8">

						<div class="project-details">
							<h2><?= ucfirst($publicacion->pub_titulo) ?></h2>
							<p>
								<?= $publicacion->resumen ?>
							</p>
						</div>

						<div class="project-details">
							<h2>Información</h2>
							<p>
								<?= $publicacion->cuerpo?>
							</p>

							<p>
								<?= $publicacion->extra?>

							</p>
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
<!--				FIN archivos adjuntos--
					</div>
					<div class="col-md-4">
						<div class="project-quick-info">
							<ul>

								<?php
								//print_r($publicacion);
								$segments = array( 'Legislatura', $publicacion->leg_id, convert_accented_characters( url_title( $publicacion->leg_nombre ), 'underscore', TRUE ) );

								?>
								<li><span> <a href="<?= base_url($segments)?>"> <img class="img-fluid img-thumbnail mx-auto d-block" src="<?= base_url($publicacion->leg_foto)?>" alt=""> </a> </span> </li>
								<li> <strong>Temática:</strong> <span><?= @$publicacion->cat_nombre?> </span> </li>
								<li><strong>Ámbito:</strong> <span><?= $publicacion->ambito_nombre?></span>
								</li>
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
<div class="padding-top-large"></div>