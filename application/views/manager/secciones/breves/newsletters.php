
<?php

//			echo $this->fecha_now ;die();
?>

<style>
	
	.card-body{
		padding-left: 5xp!important;
		padding-right: 5xp!important;
		
	}
	.visible {
  visibility: visible;
}

.not-visible {
  visibility: hidden;
}

</style>


<div class="col-md-12" data-select2-id="15">
	<div class="card">
		<div class="card-body">
			<h4 class="card-title">Newsletters</h4>
			<div class="table-responsive">
				<div id="zero_config_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
					<table id="newsletters" class="display" style="width:100%">
						<thead>
							<tr>
								<th style="width:3%;">ID</th>
								<th>Subject</th>
								<th>Adjunto</th>
								<th>Suscriptores</th>
								<th>Enviados</th>
								<th>Fecha Creado</th>
								<th>Fecha Enviado</th>
								<th>Estado</th>
								<th>Usuario</th>
								<th>Acciones</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade bd-example-modal-lg" id="modal_enviar_newsletter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle"><span id="news_subject"></span></h5>

				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div>Publicaciones: <span id="cant_publicaciones"></span></div>
				<div>Remitentes Seleccionados : <span id="cant_remitentes"></span></div>
				<div>Remitentes Enviados : <span id="cant_enviado"></span></div>
				<div>Remitentes Error : <span id="cant_error"></span></div>

				<div id="enviando" class="alert alert-success text-center " style="visibility: hidden" role="alert"><h3 class="txt_enviado">enviando ...</h3></div>
				<section id="enviados">

				</section>
			</div>
				<div class="modal-footer ">
					<button id="cerrar_modal" type="button" style="display:none" class="btn-block btn btn-danger" data-dismiss="modal">Cerrar</button>
					<button data-id_news="" id="enviar_newsletter" type="button" class="btn-block btn btn-success " data-id_news="">Iniciar Envío</button>
			</div>
		</div>
	</div>

</div>
