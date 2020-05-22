<?php
//echo phpversion();
////
//var_dump($post);
////
//echo $post->id_legislatura;
//die();
?>
<?php
		$keys = array('msj_update', 'class');
		$this->session->unset_userdata($keys);
$js = array(
	'class'=>'select2 form-control custom-select select2-hidden-accessible',
   
);


//var_dump($this->session->userdata()); exit;
?>

<?php if($this->session->userdata('msj_update') != NULL): ?>
<div class="alert <?= $this->session->userdata('class')?> col col-md-12" role="alert">
	 <?= $this->session->userdata('msj_update')?>
</div>
<?php endif; ?>
<div id="accordian-4" class="col col-md-12">
	<div class="card m-t-30 edit_post">
		<a class="card-header link" data-toggle="collapse" data-parent="#accordian-4" href="#Toggle-1" aria-expanded="true" aria-controls="Toggle-1">
			<i class="mdi mdi-grease-pencil" aria-hidden="true"></i>
			<span class="titulos_accordian">Editar Textos </span>
		</a>
		<div id="Toggle-1" class="collapse  multi-collapse">
			<div class="card-body widget-content">
				<div class="card col-md-12" id="publicacion">
					<form action="<?= base_url()?>Manager/Post/index/<?php echo $post->id ?>" method="post">
						<!-- Nav tabs -->
						<!-- Tab panes -->
						<div class="tab-content tabcontent-border">
							<div class="tab-pane active" id="home" role="tabpanel">
								<div class="p-20">
									<div class="card">
										<div class="card-body">
											<input type="hidden" id="id_post" name="id_post" value="<?php echo $post->id ?>">
											<input type="hidden" id="id_user_login" name="id_user_login" value="<?php echo $post->id_user_login ?>">
											<!--							<input type="hidden" id="id_legislatura" name="id_legislatura" value="<?php //echo $user->id_legislatura ?>">-->
											<div class="row">

												<div class="col-md-5">
												<div class="form-group ">
													<label>Publicación de Legislatura:</label>
													<?= 	form_dropdown('id_legislatura', $legislatura, $post->id_legislatura, $js); ?>
												</div>
												<?php echo form_error('id_legislatura','<div class="invalid-feedback" style="display:block;">',"</div>");?>
	

												</div>
												<div class="col-md-5">
													<div class="form-group  ">
													<label>Autor :</label>

													<input type="text" class="form-control " id="autor" name="autor" value="<?= $post->autor;?>">
													</div>

													<?php echo form_error('autor','<div class="invalid-feedback" style="display:block;">',"</div>");?>

												</div>
											</div>
							<div class="row">
								<div class="form-group m-t-20 col-md-3 ">
									<label>Ámbito: </label>
									<?= 	form_dropdown('ambito', $data_select_ambito, $post->id_ambito, $js); ?>
				
									<?php echo form_error('ambito','<div class="invalid-feedback" style="display:block;">',"</div>");?>
								</div>
								<div class="form-group m-t-20 col-md-3">
									<label>Temática: </label>

									<?= 	form_dropdown('tematica', $data_select_cate, $post->id_categoria, $js); ?>
									<?php echo form_error('tematica','<div class="invalid-feedback" style="display:block;">',"</div>");?>
								</div>
								<div class="form-group m-t-20 col-md-3">
									<label>Tipo de publicación: </label>
									<?= 	form_dropdown('tipo', $data_select_tipo,$post->id_tipo, $js); ?>

									<?php echo form_error('tipo','<div class="invalid-feedback" style="display:block;">',"</div>");?>
								</div>

								<div id="estado_art" class="form-group m-t-20 col-md-3 ">
									<label>Estado: </label>
									<select id="estado_art" name="estado_art" class=" select2 form-control custom-select select2-hidden-accessible" style="width: 100%; height:36px;" data-select2-id="1" tabindex="-1" aria-hidden="true">
										<option value="">-SELECCIONAR-</option>
										<option value="1">Sancionada</option>
										<option value="2">Presentada</option>
									</select>


									<?php echo form_error('estado_art','<div class="invalid-feedback" style="display:block;">',"</div>");?>
								</div>

							</div>
											<div class="form-group m-t-20">
												<label>Título: </label>
												<?php echo form_error('titulo','<div class="invalid-feedback" style="display:block;">',"</div>");?>
												<input type="text" class="form-control date-inputmask" id="titulo" name="titulo" value="<?= $post->titulo ?> ">
											</div>
											<div class="form-group">
												<label>Resumen:</label>
												<?php echo form_error('resumen','<div class="invalid-feedback" style="display:block;">',"</div>");?>
												<textarea name="resumen" id="resumen" cols="30" rows="10"><?= $post->resumen ?></textarea>
											</div>
											<div class="form-group">
												<label>Cuerpo:</label>
												<?php echo form_error('cuerpo','<div class="invalid-feedback" style="display:block;">',"</div>");?>
												<textarea name="cuerpo" id="cuerpo" cols="30" rows="10"><?= $post->cuerpo ?></textarea>
											</div>
											<div class="form-group">
												<label>Descripción Extra: </label>
												<textarea name="extra" id="extra" cols="30" rows="10"><?= $post->extra ?></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="border-top">
							<div class="card-body">
								<?php
					
									$data = array(
										'class'       => 	'btn btn-success',
									);
				
									echo form_submit('botonSubmit_edit', 'Enviar', $data);
								?>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<a class="card-header link border-top" data-toggle="collapse" data-parent="#accordian-4" href="#Toggle-2" aria-expanded="true" aria-controls="Toggle-2">
			<i class="fas fa-file-image" aria-hidden="true"></i>
			<span class="titulos_accordian">Editar Imágenes</span>
		</a>
		<div id="Toggle-2" class="multi-collapse collapse" style="">
			<div class="card-body widget-content">
				<div class="row el-element-overlay " id="fondo_imagen">
				<?php if(empty($imagenes)):?>
				
				<div class="alert alert-danger" role="alert">
				<h4 class="alert-heading">Publicación sin imágenes</h4>
				<hr>
				<p>Se mostrará la imagen por defecto del sistema</p>
			
				</div>
				<?php endif;?>
					<?php foreach ($imagenes as $data):?>
					<div class="col-lg-3 col-md-6" id="file_<?= $data->id;?>">
						<div class="card" id="imagen_<?= $data->id;?>" data-imagen="<?= $data->id;?>">
							<div class="el-card-item">
								<div class="el-card-avatar el-overlay-1"> <img src="<?= base_url($data->url)?>" alt="user">
									<div class="el-overlay">
										<ul class="list-style-none el-info">
											<li class="el-item">
												<a class="btn default btn-outline image-popup-vertical-fit el-link" href="<?= base_url($data->url)?>">
													<i class="mdi mdi-magnify-plus"></i>
												</a>
											</li>
											<li class="el-item">
											<?php 
												$imagen= explode('/',$data->url);
												?>
												<a class="borrar_imagen btn default btn-outline el-link" data-post="<?= $post->id?>" data-foto="<?= $imagen[5]?>" data-url="<?= $data->url?>" data-imagen="<?= $data->id;?>" href="javascript:void(0);">
													<i class="fas fa-trash-alt"></i>
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php endforeach;?>
				</div>
				<?php //print_r($imagenes);?>
				<div class="row">

					<div class="card col-sm-6">

						<form enctype="multipart/form-data" action="<?= base_url()?>Manager/Post/upload_file_2" method="post">
						<div class="invisible">
							
							<input type="text" name="id_post" value="<?php echo  $post->id ?>">
							<input type="text" name="titulo" value="<?php echo  $post->titulo ?>">
							<input type="text" name="usuario" value="<?php  echo  $user->id ?>">
							<input type="text" name="editar_post" value="1">
						</div>
							<div class="form-group">
								<label>Seleccione imágenes</label>
								<input type="file" class="form-control" name="userFiles[]" multiple />
							</div>
							<div class="form-group">
								<input id="cargar_imagen" class="form-control btn btn-cyan" type="submit" name="fileSubmit" value="Subir Fotos" disabled />
							</div>
						</form>
					</div>


				</div>
			</div>
		</div>

	</div>
</div>

