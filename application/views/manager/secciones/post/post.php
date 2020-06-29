	<style>


</style>


<?php
		
$js = array(
	'class'=>'select2 form-control custom-select select2-hidden-accessible',
   
);

?>
<div class="col-md-6 col-lg-2 col-xlg-3">
	<a href="<?= base_url('Manager/Post/Listados')?>">
		<div class="card card-hover">
			<div class="box  text-center" style="background: #f7aa47;">
				<h1 class="font-light text-white"><i class="mdi mdi-pencil"></i></h1>
				<h6 class="text-white">Listar Publicaciones</h6>

			</div>
		</div>
	</a>
</div>
<div class="card col-md-12" id="publicacion">
	<form action="<?= base_url()?>Manager/Post" method="post" onKeypress="if(event.keyCode == 13) event.returnValue = false; " id="send_post">
		<!-- Nav tabs -->

		<!-- Tab panes -->
		<div class="tab-content tabcontent-border">
			<div class="tab-pane active" id="home" role="tabpanel">
				<div class="p-20">
					<div class="card">
						<div class="card-body">
							<input type="hidden" id="id_user_login" name="id_user_login" value="<?php echo $user->id ?>">
							<?php echo form_error('id_user_login','<div class="invalid-feedback" style="display:block;">',"</div>");?>
							<!--							<input type="hidden" id="id_legislatura" name="id_legislatura" value="<?php //echo $user->id_legislatura ?>">-->
							<?php
								if ($this->ion_auth->is_super()){
							?>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group ">
										<label>Publicacióna de Legislaturas Conectadas:</label>
										<?php 
												$data = array(
													'name'          => 'is_legis_conectadas',
													'id'            => 'is_legis_conectadas',
													'value'         => 1,
													'checked'       => set_checkbox('is_legis_conectadas',1),
													'style'         => 'width: 20px; height: 20px;margin: 0 15px;'
												);
											?>
										<?= form_checkbox($data);?>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group ">
										<label>Publicación destacada:</label>
										<?php 
												$data = array(
													'name'          => 'destacada',
													'id'            => 'destacada',
													'value'         => 1,
													'checked'       => set_checkbox('destacada',1),
													'style'         => 'width: 20px; height: 20px;margin: 0 15px;'
												);
											?>
										<?= form_checkbox($data);?>
									</div>
								</div>


							</div>
							<?php } ?>
							<div class="row">

								<div class="form-group col-md-4">
									<!--								<h5 class="card-title m-b-0">Publicación de <?php echo $user->nombre_legislatura;?><br>Autor: <?php echo $user->last_name.', '.$user->first_name;?></h5>-->
									<label>Legislatura:</label>
									<?= 	form_dropdown('id_legislatura', $data_select_legi, $user->id_legislatura, $js); ?>
									<?php echo form_error('id_legislatura','<div class="invalid-feedback" style="display:block;">',"</div>");?>
									<span class="aclaracion">* Campo requerido
										<?php	if ($this->ion_auth->is_super() && $this->ion_auth->is_admin() ):?>
										, <strong>en caso de ser publicación de Legislaturas conectadas este campo no es obligatorio.</strong>
										<?php endif;?>
									</span>
								</div>
								<div class="form-group col-md-2">
									<label>Tipo de publicación: </label>
									<?= 	form_dropdown('tipo', $data_select_tipo, set_value('tipo'), $js); ?>

									<?php echo form_error('tipo','<div class="invalid-feedback" style="display:block;">',"</div>");?>
									<span class="aclaracion">* Campo requerido</span>
								</div>
								<div class="form-group  col-md-3 ">
									<label>Tipo de Normativa: </label>
									<?= 	form_dropdown('normativa', $data_select_normativa, set_value('normativa'), $js); ?>
									<?php echo form_error('normativa','<div class="invalid-feedback" style="display:block;">',"</div>");?>
									<span class="aclaracion">* Campo requerido, <strong>si el tipo de Publicación es 'Normativa'</strong></span>
								</div>
								<!--
									<div id="estado_art" class="form-group  col-md-2 ">
									<label>Estado: </label>
									<select id="estado_art" name="estado_art" class=" select2 form-control custom-select select2-hidden-accessible" style="width: 100%; height:36px;" data-select2-id="1" tabindex="-1" aria-hidden="true">
										<option value="">-SELECCIONAR-</option>
										<option value="1">Sancionada</option>
										<option value="2">Presentada</option>
									</select>

									<?php //echo form_error('estado_art','<div class="invalid-feedback" style="display:block;">',"</div>");?>
								</div>
-->

								<!--
								<div class="col-md-5 invisible">
								<h5 class="card-title m-b-0">Publicación de <?php //echo $user->nombre_legislatura;?><br>Autor: <?php //echo $user->last_name.', '.$user->first_name;?></h5>
										<div class="form-group  ">
											<label>Publicación a nombre de :</label>

											<select id="id_user" name="id_user" class="select2 form-control custom-select select2-hidden-accessible" style="width: 100%; height:36px;" data-select2-id="1" tabindex="-1" aria-hidden="true">
												<?php //echo $select_legislatura ?>
											</select>
										</div>

								<?php //echo form_error('id_user','<div class="invalid-feedback" style="display:block;">',"</div>");?>

								</div>
-->

							</div>
							<div class="row">

								<div class="form-group m-t-20 col-md-2">
									<label>Ámbito: </label>

									<?= 	form_dropdown('ambito', $data_select_ambito, set_value('ambito'), $js); ?>

									<?php echo form_error('ambito','<div class="invalid-feedback" style="display:block;">',"</div>");?>
									<span class="aclaracion">* Campo requerido</span>
								</div>
								<div class="form-group m-t-20 col-md-2 ">
									<label>Temática: </label>

									<?= 	form_dropdown('tematica', $data_select_cate, set_value('tematica'), $js); ?>
									<?php echo form_error('tematica','<div class="invalid-feedback" style="display:block;">',"</div>");?>
									<span class="aclaracion">* Campo requerido</span>
								</div>
								<div class="col-md-4">
									<!--								<h5 class="card-title m-b-0">Publicación de <?php echo $user->nombre_legislatura;?><br>Autor: <?php echo $user->last_name.', '.$user->first_name;?></h5>-->
									<div class="form-group m-t-20   ">
										<label>Autor :</label>

										<input type="text" class="form-control " id="autor" name="autor" value="<?php  echo set_value('autor');?>">
									</div>

									<?php echo form_error('autor','<div class="invalid-feedback" style="display:block;">',"</div>");?>

								</div>
							</div>
							<div class="form-group m-t-20">
								<label>Título: </label>
								<input type="text" class="form-control date-inputmask" id="titulo" name="titulo" value="<?php  echo set_value('titulo');?>">
								<?php echo form_error('titulo','<div class="invalid-feedback" style="display:block;">',"</div>");?>
								<span class="aclaracion">* Campo requerido</span>
							</div>
							<div class="form-group">
								<label>Resumen:</label>
								<?php echo form_error('resumen','<div class="invalid-feedback" style="display:block;">',"</div>");?>
								<textarea name="resumen_prev" id="resumen_prev" cols="30" rows="10"><?= set_value('resumen')?></textarea>
								<textarea name="resumen" id="resumen" cols="100" rows="10"><?= set_value('resumen')?></textarea>
							</div>
							<div class="form-group">
								<label>Cuerpo:</label>
								<textarea name="cuerpo_prev" id="cuerpo_prev" cols="30" rows="10"><?= set_value('cuerpo')?></textarea>
								<?php echo form_error('cuerpo','<div class="invalid-feedback" style="display:block;">',"</div>");?>
								<textarea name="cuerpo" id="cuerpo" cols="100" rows="10"><?= set_value('resumen_prev')?></textarea>
								<span class="aclaracion">* Campo requerido</span>
							</div>
							<div class="form-group">
								<label>Descripción Extra: </label>
								<textarea name="extra_prev" id="extra_prev" cols="30" rows="10"><?= set_value('extra')?></textarea>
								<textarea name="extra" id="extra" cols="100" rows="10"><?= set_value('extra')?></textarea>
							</div>
							<div class="form-group">
								<textarea style="display:none;" name="text_tags" id="text_tags" cols="30" rows="10"><?= set_value('text_tags')?></textarea>
								<style>
									.business-tag {
										color: #1e87f0;
										display: inline-block;
										font-size: 17px;
										font-weight: 400;
										margin-right: 5px;
										border: 1px solid #7a7a7a;
										padding: 5px 8px;
										margin-bottom: 8px;
									}

								</style>
								<label>Tags: </label>
								<div id="nube_tags"></div>
								<input onkeyup="if(event.keyCode == 13) crear_tags()" type="text" id="tags" class="form-control " placeholder="nube de tags">
								<span class="aclaracion">Ingrese las palabras relacionadas y presione Enter. Para eliminar click cobre el elemento a borrar</span>
							</div>

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

		<div class="border-top ">
			<div class="card-body">
				<button type="button" id="cargar_datos" class="btn btn-success">Enviar</button>
			</div>
		</div>
		<div class="border-top invisible">
			<div class="card-body">
				<?php
					$data = array(
						'class'       => 	'btn btn-success',
					);
				
					 echo form_submit('a', 'Enviar', $data);
				?>
			</div>
		</div>
	</form>
</div>
