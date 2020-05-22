	<!-- seccion leyes -->

	<div class="business-portfolio-1x" id="portfolio">
		<div class="row">
			<div class="col-md-12">
				<div class="bussiness-portfolio-light">

					<div class="col-md-12">
						<div class="business-title-middle">
							<h2>Últimos Proyectos</h2>
							<span class="title-border-middle"></span>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="padding-top-small"></div>

							<div class="portfolio-body">
								<ul class="simplefilter text-center">
									<li class="active" data-filter="all">Todos</li>
									<?php 
//									var_dump($categorias); die();
									foreach($categorias as $data){
										
												?>
									<li data-filter="<?= $data->id_cat?>"><?= $data->nombre_cat?></li>

									<?php
									
									 }?>

								</ul>
								<div class="padding-top-middle"></div>

<?php if(isset($pos)): ?>
								<div class="filtr-container">
									<?php
//									var_dump($post); die();
									foreach($post as $data){ ?>
									<div class="col-md-3 no-padding filtr-item hover01" data-category="<?= $data->id_cat ?>" data-sort="Luminous night">
										<figure><img class="img-responsive" src="<?= base_url().$data->publicaciones_foto;	?>" alt="sample image"></figure>
										
										<?php 
									$segments = array('Publicacion',url_title($data->publicaciones_titulo, 'underscore', TRUE),$data->id_publicaciones);

										?>
										<span class="item-desc"><a href="<?= base_url($segments) ?>"><?php echo $data->publicaciones_titulo; ?></a></span>
									</div>
									<?php }?>

	<?php endif;?>
								</div>

							</div>

						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	<!-- Seccion leyes -->
	<div class="padding-top-large"></div>
