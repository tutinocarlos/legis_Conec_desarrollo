<?php
//var_dump($noticias);
?>
<style>
	/*30/04/2020
	CAT CAMBIO CSS DE MEDIDA DE BLOQUE DE NOTICIA
	*/
	div.detalles{
		max-height: 80px;
		overflow: hidden;
	}
	
	.bussiness-about-company .single-bolg {
    padding-bottom: 25px!important;
}
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
		<img src="<?= base_url('static/web/images/slider/banner_paginas.png')?>" alt="Mountains" class="hvrbox-layer_bottom">
		<div class="hvrbox-layer_top">
			<div class="container">
				<div class="overlay-text text-center">
					<h3>
						<?= $titulo_seccion ?>
					</h3>

				</div>
			</div>
		</div>
	</div>
</div>
<div class="padding-top-middle"></div>
<div class="bussiness-about-company">
	<div class="container">

		<div class="row">

			<?php foreach($noticias as $data){?>
			
				<div class="col-md-4 single-bolg hover01" title="<?= $data->nombre_legis;?>">
					<div class="blog-img">
						<figure style="    background: url(<?php echo base_url(); ?>/static/web/images/slider/banner_paginas.png) center;  height: 26.652452025586353vh;
  display: flex;
  align-items: center;
  justify-content: center;">
							<img src="<?= base_url(). $data->foto ?>" class="img-responsive ig-thumbnail" tyle=" position: relative;margin: auto;top: 0;left: 0;right: 0;bottom: 0;">
						
						</figure>
						<div class="blog-img-graph"><span><?= $data->nombre_legis?></span></div>
					</div>
					<div class="blog-content">
						<?php 
							$segments = array('Noticias',convert_accented_characters(url_title($data->titulo), 'underscore', TRUE),$data->id);
						?>
						<a href="<?= base_url($segments) ?>"><?php echo $data->titulo?></a>
						<div class=" detalles">
						<?php
							if(strip_tags($data->resumen)== ''){
							 echo strip_tags($data->cuerpo);
						}else{
							 echo strip_tags($data->resumen);
							}
							?>
						<!-- <div><i class="fa fa-building"></i><?= $data->nombre_legis?></div>
						<div><i class="fa fa-globe"></i><?= $data->nombre_ambito?></div>
						<div><i class="fa fa-info"></i><?= $data->nombre_tematica?></div>
						<div><i class="fa fa-clock-o"></i><?=  fecha_es($data->fecha_add,"d F a")?></div>
						-->
						</div>
					</div>
				</div>
			
			<?php } ?>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="padding-top-middle"></div>
				<div class="blog-pagination">
					<nav>
						<?php echo $this->pagination->create_links() ?>
					</nav>
				</div>
			</div>
		</div>
	</div>
</div>
<!--
<div class="padding-top-large"></div>
<div class="business-cta-2x">
	<div class="business-cta-2-content">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="business-cta-left-2">
						<h2>Looking for an excelent business solution ?</h2>
					</div>
				</div>
				<div class="col-md-4">
					<div class="business-cta-right-2">
						<a href="#" class=" btn bussiness-btn-larg">Get a Quote <i class="fa fa-angle-right"></i> </a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
-->
<div class="padding-top-large"></div>
