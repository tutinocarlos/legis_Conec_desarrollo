<?php

//		var_dump($legislatura);
?>
<div class="padding-top-large"></div>
<div class="bussiness-about-company ">
	<div class="container">
		<div class="row">
			<div class="col-md-9">

				<div class="row">
				
			<?php foreach($noticias as $data){?>
			<div class="col-md-4">
				<div class="single-bolg hover01">
					<figure><img src="<?= base_url(). $data->foto ?>" class="" style=""></figure>
					<div class="blog-content">
						<?php 
							$segments = array('Noticias',convert_accented_characters(url_title($data->titulo), 'underscore', TRUE),$data->id);
						?>
						<a href="<?= base_url($segments) ?>"><?= $data->titulo ?></a>
						<span><i class="fa fa-clock-o"></i><?= $data->fecha_add ?></span>
					</div>
				</div>
			</div>
			<?php } ?>
					<div class="col-md-12">
						<div class="padding-top-middle"></div>
						<div class="blog-pagination">
							<nav>
							</nav>
						</div>
					</div>
				</div>
				<div class="padding-top-large"></div>

				<div class="row">
					<div class="col-md-6">
						<div class="blog-single-tag">
						</div>
					</div>
					<div class="col-md-6">

					</div>
				</div>

				<div class="padding-top-middle"></div>

				<div class="blog-post-author">
					<div class="media">
						<img src="<?= base_url(). $legislatura->logo ?>" alt="<?= $legislatura->nombre?>">
						<div class="media-body">
							<a href="#"><?= ucfirst($legislatura->nombre) ?></a>
							<div class="blog-single-social">
								<div class="footer-info-right">
										<ul>
										<?php if(isset($legislatura->facebook)): ?>
											<li><a href="<?= $legislatura->facebook ?>" target="_blank"> <i class="fa fa-facebook"></i> </a></li>
										<?php endif;?>
										<?php if(isset($legislatura->twitter)): ?>
											<li><a href="<?= $legislatura->twitter ?>" target="_blank"> <i class="fa fa-twitter"></i> </a></li>
										<?php endif;?>
										<?php if(isset($legislatura->instagram)): ?>
											<li><a href="<?= $legislatura->instagram ?>" target="_blank"> <i class="fa fa-instagram"></i> </a></li>
										<?php endif;?>
										<?php if(isset($legislatura->youtube)): ?>
											<li><a href="<?= $legislatura->youtube ?>"> <i class="fa fa-youtube" target="_blank"></i> </a></li>
										<?php endif;?>
										</ul>
								</div>
						</div>
						</div>
					</div>
				</div>



				<div class="padding-top-large"></div>

			</div>

			<div class="col-md-3">
				<div class="about-company-right">

					<div class="right-search-box">
						<form>
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Buscar...">
								<div class="input-group-append">
									<button class="btn search-button"><i class="fa fa-search"></i></button>
								</div>
							</div>
						</form>
					</div>

					<div class="padding-top-middle"></div>
<!--					barra lateral de categorias -->
					
<?php if(isset($datos_barra_lateral)):?>
					<div class="right-menubar">
						<h3>Temáticas</h3>
						<ul>
							<?php foreach($datos_barra_lateral as $data):?>
							<?php 
							$segments = array('Categorias',convert_accented_characters(url_title($data->nombre_legis), 'underscore', TRUE),$data->id_legis,convert_accented_characters(url_title($data->nombre_cat), 'underscore', TRUE),$data->id_cat);
							?>
							<li><a href="<?= base_url($segments)?>"><?= $data->nombre_cat?></a></li>
							<?php endforeach;?>
						</ul>
					</div>
	<?php endif;?>

					<div class="padding-top-middle"></div>

				</div>
			</div>
		</div>
	</div>
</div>	