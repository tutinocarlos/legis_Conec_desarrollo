		<div class="bussiness-main-menu-1x">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="business-main-menu">
							<nav class="navbar navbar-expand-lg navbar-light bg-light btco-hover-menu">
								<a class="navbar-brand" href="<?= base_url()?>home">
									<img src="<?= base_url()?>static/web/images/logos/LC_logo.png" class="d-inline-block align-top" alt="">
								</a>
								<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
									<span class="navbar-toggler-icon"></span>
								</button>

								<div class="collapse navbar-collapse" id="navbarSupportedContent">

									<ul class="navbar-nav ml-auto business-nav">

										<li class="nav-item ">
											<a class="nav-link" href="<?= base_url()?>home">Inicio <span class="sr-only">(current)</span></a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="<?= base_url('Legislaturas')?>">Legislaturas</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="<?= base_url('Publicaciones/1/Normativas')?>">Normativas</a>
										</li>


										<li class="nav-item">
											<a class="nav-link" href="<?= base_url('Noticias')?>">Noticias</a>
										</li>
										<!--
									<li class="nav-item">
										<a class="nav-link" href="#">Breves en Imágenes</a>
									</li>
-->

										<li class="nav-item">
											<a class="nav-link" href="<?= base_url('Contacto')?>">Contacto</a>
										</li>									
										<li class="nav-item">
											<a class="nav-link" href="<?= base_url('Links')?>">Links de Interes</a>
										</li>
									</ul>

									<div class="business-cart">
										<div class="box">
											<div class="container-2">
												<span class="icon"><i class="fa fa-search"></i></span>
												<form action="<?= base_url('Home/buscador_ajax')?>" id="form_search" method="POST" target="blank">
													<input type="search" id="search" name="search" data-base_url="<?= base_url();?>" placeholder="Buscar..." />
												</form>
											</div>
										</div>
									</div>

								</div>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
