<?php
if(!$this->ion_auth->is_members() && ($this->user->id_legislatura == 1 && $this->user->id_legislatura == 91) || $this->ion_auth->is_admin() && ($this->user->id_legislatura == 1 || $this->user->id_legislatura == 91)|| $this->ion_auth->is_super()):
?>
	<div class="card-body">
		<div class="row">
			<div class="col-md-6">
				<div class="card">

					<form class="form-horizontal" id="form_alta_archivo" enctype="multipart/form-data" >
						<div class="card-body">
							<h4 class="card-title">Información Archivo PDF</h4>
							<div class="form-group row">
								<label class="col-md-3" for="disabledTextInput">Título</label>
								<div class="col-md-9">
									<input type="text" id="titulo" name="titulo" class="form-control" placeholder="" value="" >
									<span id="titulo_error" class="text-danger"></span>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3" for="disabledTextInput">Descripción</label>
								<div class="col-md-9">
									<textarea class="form-control" name="descripcion" id="descripcion" ></textarea>
								<span id="descripcion_error" class="text-danger"></span>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-md-3">Archivo:</label>
								<div class="col-md-9">
									<div class="custom-file">
										<span id="userfile_pdf" class="custom-file-label " for="validatedCustomFile">Seleccione el Archivo PDF</span>
										<input type="file" class="custom-file-input" name="userfile_pdf" id="userfile_pdf"  accept=".pdf">
									</div>
								</div>
							</div>
						</div>
						<div class="border-top">
							<div class="card-body">
								<button type="submit" id="enviar" class="btn btn-success">Emviar</button>
							</div>
						</div>
					</form>
				</div>
			</div>

			<!--					video -->
			<div class="col-md-6">
				<div class="card">
					<form class="form-horizontal"  id="video_youtube">
					<div class="card-body">
						<h4 class="card-title">Información video YouTube</h4>
						<div class="form-group row">
							<label class="col-md-3" for="titulo">Titulo</label>
							<div class="col-md-9">
								<input type="text" id="titulo" name="titulo" class="form-control" placeholder="" >
									<span id="you_tube_titulo_error" class="text-danger"></span>
							</div>
						</div>						<div class="form-group row">
							<label class="col-md-3" for="url_video">URL video YouTube</label>
							<div class="col-md-9">
								<input type="text" id="url_video" name="url_video" class="form-control" placeholder="" >
									<span id="you_tube_url_error" class="text-danger"></span>
							</div>
						</div>
						<div class="form-group row">
								<label class="col-md-3" for="detalle_video">Descripción</label>
								<div class="col-md-9">
									<textarea class="form-control" name="detalle_video"id="detalle_video" ></textarea>
									<span class="aclaracion">Si deja vacío toma los datos de Youtube al mostrarlo</span>
										<span id="you_tube_descripcion_error" class="text-danger"></span>
								</div>
							</div>			
							<div class="form-group row">
								<label class="col-md-3" for="disabledTextInput"></label>
								<div class="col-md-9">
									<button id="checkTouTube" onclick="buscar_video($('#url_video').val());" type="button" class="btn btn-secondary">Obtener datos del Video automáticamente</button>
								</div>
							</div>
							<div class=" ">
							<label for="video_post" class="">Captura del video:</label>				
								<div class="text-center" id="video_post"></div>
						</div>
					</div>
					<div class="border-top">
						<div class="card-body">
							<button type="submit" id="enviar" class="btn btn-success">Enviar</button>
						</div>
					</div>
					
					</form>
				</div>
			</div>
		</div>
	</div>
<?php endif;?>
<!--	lsitado de tutoriales-->
<style>

	a{
		font-size: 16;
		color: #3e5569;
	}
	.titulo{
		font-weight: bold;
	}
	.borrar{
		color: red;
		display: none;
	}
</style>
	<div class="card" id="tutos">
		<div class="card-body">
			<h4 class="card-title m-b-0">Tutoriales</h4>
		</div>
		<ul class="list-style-none" id="tutoriales_legis">
			<?= $tutoriales?>
		</ul>
	</div>

