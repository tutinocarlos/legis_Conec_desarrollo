<div class="business-app-present-2x invisible">
	<div class="app-present-content-2">
		<div class="container">
			<div class="row">

				<div class="col-md-12">
					<div class="business-title-middle">
						<h2>Descubrí los parlamentos de la Argentina</h2>
						<span class="title-border-middle"></span>
					</div>
				</div>
				<div class="col-md-12">
					<div class="margin-top-middle"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-7">
					<div class="app-present-left-2">
						<div id="map" class="" style="width: 600px; height: 700px"></div>
					</div>
				</div>
				<div class="col-md-5" id="legis_tab">
					<div class="app-present-right-2 ">
						<?php foreach($legislaturas as $legislatura){?>
						<div class="single-app-present">
							<div class="media">
								<span class="animatedhover pulse"><img src="<?= base_url($legislatura->logo) ?>" alt="" class=""></span>
								<div class="media-body">
									<h2><?php echo $legislatura->nombre ?></h2>
								</div>
							</div>
						</div>
						<?php }?>

					</div>
				</div>

			</div>
		</div>
	</div>
</div>


<div class="business-app-present-2x aca-se cambia el mapa">	
		<div class="app-present-content-2">	
			<div class="container">
				<div class="row">

					<div class="col-md-12">
						<div class="business-title-middle">
							<h2>Legislaturas Conectadas</h2>
							<h4> La red Digital del Foro de las Legislaturas Provinciales de la República Argentina </h4>
							<span class="title-border-middle"></span>
						</div>
					</div>
					<div class="col-md-12">
						<div class="margin-top-middle"></div>
					</div>
					
					<div class="col-md-7">				
						<div class="app-present-left-2">
							<img src="<?= base_url()?>static/web/images/argentina2.png" alt="" class="">
						</div>									
					</div>
					<div class="col-md-5">				
						<div class="app-present-right-2">
							<p>Legislaturas Conectadas es un emprendimiento comunicacional que busca comunicar los Poderes Legislativos Provinciales de Argentina entre sí y con la ciudadanía. Su principal objetivo es aportar a la visibilidad de cada parlamento y al fortalecimiento de las relaciones institucionales.</p>
							<p>Para hacerlo se gestiona una comunicación permanente focalizada en tres ejes principales:</p>
							<ul>
							<li>La plataforma virtual interactiva, en la cual se comparten contenidos comunes, además de los propios de cada Parlamento.</li>
							<li>Las Redes Sociales desde las que se difunden las actividades de Legislaturas Conectadas y se promocionan las RRSS de cada Parlamento.</li>
							<li>Breves en Imágenes, una síntesis visual de noticias de todos los parlamentos. </li>
							</ul>
						</div>		
					</div>
					
				</div>		
			</div>
		</div>
	</div>
