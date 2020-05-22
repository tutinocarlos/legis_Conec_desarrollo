<?php

// if($noticias){
// 	echo "string";
// }else{
// 	echo 'capireo';
// }
// die;
?>
<style>
.single-bolg img {

	max-height: inherit !important; 
}
.blog-img-graph {
	position: absolute;
	top: 0;
	padding: 2px;
	background: rgba(0,0,0,0.42);
	width: 90.5%;
	text-align: right;
	box-shadow: azure;
	text-shadow: 2px 2px 1px 0px #f0f0f0;
	color: #ffffff;
	font-size: 12px;
}
.blog-content a {
	margin: 1px 0 5px 0 !important; 

}
</style>
<div class="business-banner">
	<div class="hvrbox">
		<img src="<?= base_url('static/web/images/slider/banner_paginas.png')?>" alt="Legislaturas Conectadas" class="hvrbox-layer_bottom">
		<div class="hvrbox-layer_top">
			<div class="container">
				<div class="overlay-text text-center">
					<h3>
						Resultados	para : <br> <?= $cadena?>				</h3>

					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="padding-top-middle"></div>
	<div class="bussiness-about-company">
		<div class="business-title-middle">
			<h2>Noticias</h2>
			<span class="title-border-middle"></span>
		</div>
		<div class="container">
			<?php if(!$noticias):?>
				<div class="alert alert-info text-center " role="alert">
					No se han encotrado <strong>Noticias</strong> para el término de búsqueda
				</div>
			<?php endif;?>
			<div class="row">

				<?php foreach($noticias as $noticia):?>
					<div class="col-md-4 single-bolg hover01" title="<?= $noticia->titulo ?>">
						<div class="blog-img">
							<figure style="    background: url(http://legis-conectadas//static/web/images/slider/banner_paginas.png) center;  height: 26.652452025586353vh;
							display: flex;
							align-items: center;
							justify-content: center;">
							<img src="<?= base_url(). $noticia->foto ?>" class="img-responsive ig-thumbnail" tyle=" position: relative;margin: auto;top: 0;left: 0;right: 0;bottom: 0;">

						</figure>
						<div class="blog-img-graph"><span><?= $noticia->legislatura ?></span></div>
					</div>
					<div class="blog-content">
						<?php 
						$segments = array('Noticias',convert_accented_characters(url_title($noticia->titulo), 'underscore', TRUE ),$noticia->id);
						?>
						<a href="<?= base_url($segments) ?>" target="_blank"><?= $noticia->titulo ?> </a>
						<div class=" detalles"><?= $noticia->resumen ?></div>
					</div>
				</div>
			<?php endforeach;?>
		</div>
		<div class="business-title-middle">
			<h2>Normativas</h2>
			<span class="title-border-middle"></span>
		</div>
		<?php if(!$normativas):?>
			<div class="alert alert-info text-center " role="alert">
				No se han encotrado <strong>Normativas</strong> para el término de búsqueda
			</div>
		<?php endif;?>
		<div class="row">
			<?php foreach($normativas as $normativa):?>
				<div class="col-md-4 single-bolg hover01" title="<?= $noticia->titulo ?>">


					<div class=""><span><h3><?= $normativa->legislatura ?></h3></span></div>

					<div class="blog-content">
						<?php 
						$segments = array('Publicacion',convert_accented_characters(url_title($normativa->titulo), 'underscore', TRUE),$normativa->id);
						?>
						<a href="<?= base_url($segments) ?>" target="_blank"><?= $normativa->titulo ?> </a>
						<div class=" detalles"><?= $normativa->resumen ?></div>
					</div>
				</div>
			<?php endforeach;?>
		</div>
		<div class="business-title-middle">
			<h2>Legislaturas</h2>
			<span class="title-border-middle"></span>
		</div>
		<?php if(!$legislaturas):?>
			<div class="alert alert-info text-center " role="alert">
				No se han encotrado <strong>Legislaturas</strong> para el término de búsqueda
			</div>
		<?php endif;?>
		<div class="row">
			<?php foreach($legislaturas as $legislatura):?>

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
										<li><a href="<?= $legislatura->linkedin ?>" class="linkedin" target="_blank"> <i class="fa fa-linkedin" ></i> </a>
										</li>
									<?php endif;?>
								</ul>


							</div>
								<?php 
									$segments = array('Legislatura',$legislatura->id,convert_accented_characters(url_title($legislatura->nombre), 'underscore', TRUE));
								?>
								<a href="<?= base_url($segments) ?>" target="_blank">
									<div class="alert alert-info text-center" role="alert">
										visitar
									</div>
							</a>
						</div>
					</div>

				</div>

			<?php endforeach;?>
		</div>
	</div>
</div>
<?php
// echo 'PUBLICACIONES<pre>';
// var_dump($noticias);
// echo '</pre>';

?>

