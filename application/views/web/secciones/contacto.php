<?php //var_dump($legis_conectadas)?>

<?php
 $this->load->library( 'recaptcha' );

 ?>

<div class="business-banner">
	<div class="hvrbox">
		<img src="<?= base_url('static/web/images/slider/banner_paginas.png')?>" alt="Mountains" class="hvrbox-layer_bottom">
		<div class="hvrbox-layer_top">
			<div class="container">
				<div class="overlay-text text-center">
					<h3>
						<?= $titulo_seccion?>
					</h3>

				</div>
			</div>
		</div>
	</div>
</div>
<div class="bussiness-contact-form">
	<div class="container">
		<div class="business-title-left">
			<h2>Contactanos</h2>
			<span class="title-border-left"></span>
			<p>Hacenos llegar tu consulta a través del siguiente formulario. La misma será respondida a la brevedad. ¡Gracias por escribirnos!</p>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="single-partner">
					<div class="media">
						<div class="media-body">

							<div class="row">
								<div class="col-md-4"><img style="width: 150px" lass="img-fluid " src="<?php echo base_url()?>static/web/images/logos/LC_logo2.jpg" alt="Logo" style="padding: 10px"> </div>
								<div class="col-md-8"><strong> la RED interparlamentaria ABIERTA a la participación CIUDADANA.</strong>
								</div>
							</div>
							<p>
								<a style="font-size:15px" target="_blank" href="<?= base_url();?>"><?= $legis_conectadas->url?></a>
							</p>
							<p>
								<a style="font-size:15px" target="_blank" href=""><?= $legis_conectadas->email?></a>
							</p>
							<p>
								<r style="font-size:16px" target="_blank" href="#">
									<?= $legis_conectadas->telefono ?>
								</r>
							</p>
							<p>
								<r style="font-size:16px" target="_blank" href="#">
									<?= $legis_conectadas->direccion ?>
								</r>
							</p>


							<ul class="top-nav-social">
								<?php if(!empty($legis_conectadas->facebook)): ?>
								<li><a href="<?= $legis_conectadas->facebook ?>" class="facebook" target="_blank"> <i class="fa fa-facebook"></i> </a>
								</li>
								<?php endif;?>
								<?php if(!empty($legis_conectadas->twitter)): ?>
								<li><a href="<?= $legis_conectadas->twitter ?>" class="twitter" target="_blank"> <i class="fa fa-twitter"></i> </a>
								</li>
								<?php endif;?>
								<?php if(!empty($legis_conectadas->instagram)): ?>
								<li><a href="<?= $legis_conectadas->instagram ?>" class="instagram" target="_blank"> <i class="fa fa-instagram"></i> </a>
								</li>
								<?php endif;?>
								<?php if(!empty($legis_conectadas->youtube)): ?>
								<li><a href="<?= $legis_conectadas->youtube ?>" target="_blank" class="youtube"> <i class="fa fa-youtube"></i> </a>
								</li>
								<?php endif;?>
							</ul>



							<div class="padding-top-small"></div><br clear="all">

						</div>
					</div>
				</div>
			</div>
			<div class="col-md-8">

				<style>
					form#form_cantacto_legis label {
						color: red;
						font-size: 11px;
					}

				</style>
				<form action="" method="post" id="form_cantacto_legis">

					<div class="col-md-12">
						<div class="form-group">
							<input type="text" class="form-control" name="nombre" id="id_nombre" placeholder="Nombre" required>
							<div id="nombre_error"></div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<input type="text" class="form-control" name="apellido" id="id_apellido" placeholder="Apellido" required>
							<div id="apellido_error"></div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<input type="email" class="form-control" name="email" id="id_email" placeholder="E-mail" required>
							<div id="email_error"></div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<select class="form-control" name="legislatura" id="id_legislatura" required>
								<option value="">¿A qué Legislatura querés contactar?</option>
								<?php foreach ($legislaturas as $legislatura):?>
								<option value="<?= $legislatura->nombre_legis?>">
									<?= $legislatura->nombre_legis?>
								</option>
								<?php endforeach;?>

							</select>
							<div id="legislatura_error"></div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<textarea class="form-control" id="exampleFormControlTextarea15" rows="3" placeholder="Escribí aquí tu mensaje..." name="mensaje" id="id_mensaje" required></textarea>
							<div id="mensaje_error"></div>
						</div>
					</div>
					<div class="col-md-6">
							<div id="captcha_errorss" for=""><span style="color:red"></span></div>
						<?php $attr=array(
							'name'=> 'g-recaptcha-response'
						)?>
						<div class="form-group">
							<?php echo $this->recaptcha->getWidget($attr); 
						
						?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<button href="javascript:void(0)" class="btn btn-block bussiness-btn-larg" onclick="enviar_formulario();" id="enviar_correo">Enviar mensaje</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

</div>
<div class="padding-top-large"></div>
<div class="bussiness-our-address">
	<div class="container">
		<div class="row">

			<style>
				table {
					table-layout: fixed;
				}

				table td {
					word-wrap: break-word;
					max-width: 400px;
				}

				#grid td {
					white-space: inherit;
				}

				table#table_contacto,
				div#example_wrapper {
					font-size: 12px !important;
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

			</style>
			<div class="table-responsive  text-center" style="font-size: 12px;">
				<div id="zero_config_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
					<table id="table_contacto" class="display" style="width:100%">
						<thead>
							<tr>
								<th width="10%"></th>
								<th>Organismo</th>
								<th>Provincia</th>
								<th>Dirección</th>
								<th>Teléfono</th>
								<th>Email</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="padding-top-large"></div>
<?php echo $this->recaptcha->getScriptTag();?>
<script>
	/*paso la imagen en base64 al archivo legislatura.js*/
	//var img_base64 = '<?php //echo img_base64('http://10.1.1.77/static/web/images/logos/LC_logo.png')?>';
		var img_base64 = '<?php echo img_base64( base_url('static/web/images/logos/LC_logo.png'))?>';


	var base_url = '<?= base_url()?>';

	function enviar_formulario() {
		$("#form_cantacto_legis").submit()
	}

</script>
