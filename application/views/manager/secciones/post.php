<?php
//var_dump($user);die();
?>
<form action="/Manager/Post" method="post">
	<div class="card col-md-12" id="publicacion">
		<!-- Nav tabs -->

		<!-- Tab panes -->
		<div class="tab-content tabcontent-border">
			<div class="tab-pane active" id="home" role="tabpanel">
				<div class="p-20">
					<div class="card">
						<div class="card-body">

							<h5 class="card-title m-b-0">Publicación deD <?php echo $user->nombre_legislatura;?><br>Autor: <?php echo $user->last_name.', '.$user->first_name;?></h5>
							<input type="text" id="id_user" name="id_user" value="<?php echo $user->id ?>">
							<input type="text" id="id_legislatura" name="id_legislatura" value="<?php echo $user->id_legislatura ?>">
							<div class="row">
								<div class="form-group m-t-20 col-md-4">
									<label>Tipo de publicación: </label>
									<select name="tipo" class="select2 form-control custom-select select2-hidden-accessible" style="width: 100%; height:36px;" data-select2-id="1" tabindex="-1" aria-hidden="true">
										<?php echo $select_tipo ?>
									</select>
									<span class="select2 select2-container select2-container--default select2-container--focus" dir="ltr" data-select2-id="2" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-v3bv-container"><span class="select2-selection__rendered" id="select2-v3bv-container" role="textbox" aria-readonly="true" title="Select"></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
									<?php echo form_error('tipo','<div class="invalid-feedback" style="display:block;">',"</div>");?>
								</div>

								<div class="form-group m-t-20 col-md-4 ">
									<label>Categoraía: </label>
									<select id="categorias" data-base_url="<?= base_url();?>" name="categoria" class="select2 form-control custom-select select2-hidden-accessible" style="width: 100%; height:36px;" data-select2-id="1" tabindex="-1" aria-hidden="true">
										<?php echo $select_categoria ?>
									</select>
									<span class="select2 select2-container select2-container--default select2-container--focus" dir="ltr" data-select2-id="2" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-v3bv-container"><span class="select2-selection__rendered" id="select2-v3bv-container" role="textbox" aria-readonly="true" title="Select"></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
									<?php echo form_error('categoria','<div class="invalid-feedback" style="display:block;">',"</div>");?>
								</div>
								<div class="form-group m-t-20 col-md-4">
									<label>Sub Categoría: </label>
									<select id="sub_categoria" name="sub_categoria" class="select2 form-control custom-select select2-hidden-accessible" style="width: 100%; height:36px;" data-select2-id="1" tabindex="-1" aria-hidden="true">
										<span id="selectcategoria"></span>
									</select>
									<span class="select2 select2-container select2-container--default select2-container--focus" dir="ltr" data-select2-id="2" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-v3bv-container"><span class="select2-selection__rendered" id="select2-v3bv-container" role="textbox" aria-readonly="true" title="Select"></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>

									<?php echo form_error('sub_categoria','<div class="invalid-feedback" style="display:block;">',"</div>");?>
								</div>

							</div>
							<div class="form-group m-t-20">
								<label>Título: </label>
								<?php echo form_error('titulo','<div class="invalid-feedback" style="display:block;">',"</div>");?>
								<input type="text" class="form-control date-inputmask" id="titulo" name="titulo">
							</div>
							<div class="form-group">
								<label>Resumen:</label>
								<?php echo form_error('resumen','<div class="invalid-feedback" style="display:block;">',"</div>");?>
								<textarea name="resumen" id="resumen" cols="30" rows="10"></textarea>
							</div>
							<div class="form-group">
								<label>Cuerpo:</label>
								<?php echo form_error('cuerpo','<div class="invalid-feedback" style="display:block;">',"</div>");?>
								<textarea name="cuerpo" id="cuerpo" cols="30" rows="10"></textarea>
							</div>
							<div class="form-group">
								<label>Descripción Extra: </label>
								<textarea name="extra" id="extra" cols="30" rows="10"></textarea>
							</div>


							<h5 class="card-title m-b-0">Publicación de <?php echo $user->nombre_legislatura;?></h5>

						</div>
					</div>
				</div>
			</div>
			<?php 
		if ($this->ion_auth->is_admin())
		{
		?>
			<div class="tab-pane  p-20" id="profile" role="tabpanel">
				<div class="p-20">
					seteos
				</div>
			</div>
			<?php 
		}
		?>
			<div class="tab-pane p-20" id="messages" role="tabpanel">
				<div class="p-20 col-md-12">
					imagenes
				</div>
			</div>
		</div>
		<div class="border-top">
			<div class="card-body">
				<?php
					
					$data = array(
							
								'class'       => 	'btn btn-success',
							
								
							);
				
					 echo form_submit('botonSubmit', 'Enviar', $data);
				?>
			</div>
		</div>
	</div>


</form>
