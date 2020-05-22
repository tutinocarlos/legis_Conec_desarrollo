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
					<form action="<?= base_url()?>Manager/Post/index/<?php echo $post->id ?>" method="post" onkeypress="if(event.keyCode == 13) event.returnValue = false;">
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
												<div class="col-md-4">
													<div class="form-group ">
															<label>Publicación de Legislaturas Conectadas:</label>
															<?php 
																$data = array(
																	'name'          => 'is_legis_conectadas',
																	'id'            => 'is_legis_conectadas',
																	'value'         => 1,
																	'checked'       => set_checkbox('is_legis_conectadas',$post->is_legis_conectadas, boolval($post->is_legis_conectadas)),
																	'style'         => 'width: 20px; height: 20px;margin: 0 15px;'
																);
															?>
															<?= form_checkbox($data);?>
														</div>
												</div>

												<div class="col-md-4">
													<div class="form-group ">
															<label>Publicación destacada:</label>
															<?php 
																$data = array(
																	'name'          => 'destacada',
																	'id'            => 'destacada',
																	'value'         => 1,
																	'checked'       => set_checkbox('destacada',$post->is_destacado, boolval($post->is_destacado)),
																	'style'         => 'width: 20px; height: 20px;margin: 0 15px;'
																);
															?>
															<?= form_checkbox($data);?>
														</div>
												</div>


											</div>
											<div class="row">

												<div class="col-md-4">
												<div class="form-group ">
													<label>Publicación de Legislatura:</label>
													<?= 	form_dropdown('id_legislatura', $legislatura, $post->id_legislatura, $js); ?>
												</div>
													<?php echo form_error('id_legislatura','<div class="invalid-feedback" style="display:block;">',"</div>");?>
												</div>
												<div class="form-group col-md-2">
												<label>Tipo de publicación: </label>
													<?= 	form_dropdown('tipo', $data_select_tipo,$post->id_tipo, $js); ?>

													<?php echo form_error('tipo','<div class="invalid-feedback" style="display:block;">',"</div>");?>
												</div>
												<div class="form-group  col-md-2 ">
													<label>Tipo de Normativa: </label>
													<?= 	form_dropdown('normativa', $data_select_normativa, $post->id_tipo_normativa, $js); ?>
													<?php echo form_error('normativa','<div class="invalid-feedback" style="display:block;">',"</div>");?>
													<span class="aclaracion">* Campo requerido, <strong>si el tipo de Publicación es 'Normativa'</strong></span>
												</div>
												<div id="estado_art" class="form-group col-md-3 ">
													<label>Estado: </label>
													<select id="estado_art" name="estado_art" class=" select2 form-control custom-select select2-hidden-accessible" style="width: 100%; height:36px;" data-select2-id="1" tabindex="-1" aria-hidden="true">
														<option value="">-SELECCIONAR-</option>
														<option value="1">Sancionada</option>
														<option value="2">Presentada</option>
													</select>


												<?php echo form_error('estado_art','<div class="invalid-feedback" style="display:block;">',"</div>");?>
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
	
										<div class="col-md-5  m-t-20 ">
													<div class="form-group  ">
													<label>Autor :</label>

													<input type="text" class="form-control " id="autor" name="autor" value="<?= $post->autor;?>">
													</div>

													<?php echo form_error('autor','<div class="invalid-feedback" style="display:block;">',"</div>");?>

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
												<textarea name="resumen_prev" id="resumen_prev" cols="30" rows="10"><?= $post->resumen ?></textarea>
												<textarea name="resumen" id="resumen" cols="100" rows="10"><?= $post->resumen ?></textarea>
											</div>
											<div class="form-group">
												<label>Cuerpo:</label>
												<?php echo form_error('cuerpo','<div class="invalid-feedback" style="display:block;">',"</div>");?>
												<textarea name="cuerpo_prev" id="cuerpo_prev" cols="30" rows="10"><?= $post->cuerpo ?></textarea>
												<textarea name="cuerpo" id="cuerpo" cols="100" rows="10"><?= $post->cuerpo ?></textarea>
											</div>
											<div class="form-group">
												<label>Descripción Extra: </label>
												<textarea name="extra_prev" id="extra_prev"  cols="30" rows="10"><?= $post->extra ?></textarea>
												<textarea name="extra" id="extra" cols="100" rows="10"><?= $post->extra ?></textarea>
											</div>
							<div class="form-group">
								<textarea  style="display:none;" name="text_tags" id="text_tags" cols="30" rows="10"><?= set_value('text_tags')?></textarea>
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
								<input onkeyup = "if(event.keyCode == 13) crear_tags()"  type="text" id = "tags" class="form-control " placeholder="nube de tags" >
								<span class="aclaracion">Ingrese las palabras relacionadas y presione Enter. Para eliminar click cobre el elemento a borrar</span>
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
												<a class="borrar_imagen_post btn default btn-outline el-link" data-post="<?= $post->id?>" data-foto="<?= $imagen[5]?>" data-url="<?= $data->url?>" data-imagen="<?= $data->id;?>" href="javascript:void(0);">
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
		
		<a class="card-header link border-top" data-toggle="collapse" data-parent="#accordian-4" href="#Toggle-3" aria-expanded="true" aria-controls="Toggle-3">
			<i class="fas fa-file-video" aria-hidden="true"></i>
			<span class="titulos_accordian">Editar Videos</span>
		</a>
		<div id="Toggle-3" class="multi-collapse collapse" style="">
			<div class="card-body widget-content">
				<div class="row">
					<?php if($videos):?>

					<div class="col-ls-6">
						<div style="margin-top: 30px;" class="col-lg-12">
							<h4>Videos cargados</h4>
						</div>

						<?php foreach($videos as $data):?>
						<div class="col col-lg-4" id="video_<?=$data->id?>">
							<div class="card ">
								<div class="videos comment-widgets  ps-container ps-theme-default">
									<!-- Comment Row -->
									<div class="d-flex flex-row comment-row m-t-0">
										<div class="p-2"><iframe width="100%" height="130" src="https://www.youtube.com/embed/<?= $data->url_video?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe></div>
										<div class="comment-text w-100">
											<h6 class="font-medium">
												<?= $data->titulo_video?>
											</h6>
											<span class="m-b-15 d-block">
												<?= $data->detalle_video?></span>
											<div class="comment-footer">
												<a type="button" id="borrar_video" data-id_video="<?= $data->id?>" class="btn btn-danger btn-sm" style="color:white;">Borrar</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php endforeach;?>

					</div>
					<?php endif;?>
				</div>
				<div class="row ">
				<div style="margin-top: 30px;" class="col-lg-12"><h4>Agregar Video </h4></div>
	
				<div class="col-sm-3">
					<?php
						$data = array(
							'class' => '',
						);
						echo form_label('Url del video Institucional:', 'url_video', $data);

						$data = array(
							'type'  => 'text',
							'name'  => 'url_video',
							'id'    => 'url_video',
							'class' => 'form-control ',
//							'value' => set_value('mi_video'),
//						'placeholder' =>	'Detalle categoría',
//						'required'    => 	'required'
						);

						echo form_error('url_video','<div class="invalid-feedback" style="display:block;">',"</div>");
						echo form_input($data);	
						?>
						<span class="aclaracion">Cargue la url del video de YouTube</span>
					<div class="card-body">
						<button id="checkTouTube" onclick="buscar_video($('#url_video').val());" type="button" class="btn btn-secondary">Obtener datos del Video automaticamente</button>
					</div>
				</div>
				<div class="col-sm-3">
					<?php
						$data = array(
							'class' => '',
						);
						echo form_label('Título del video:', 'titulo_video', $data);

						$data = array(
							'type'  => 'text',
							'name'  => 'titulo_video',
							'id'    => 'titulo_video',
							'class' => 'form-control ',
//							'value' => set_value('titulo_video'),
//						'placeholder' =>	'Detalle categoría',
//						'required'    => 	'required'
						);

						echo form_error('titulo_video','<div class="invalid-feedback" style="display:block;">',"</div>");
						echo form_input($data);	
						?>
						<span class="aclaracion">Si deja vacío toma los datos de Youtube al mostrarlo</span>
					<?php
						$data = array(
							'class' => '',
						);
						echo form_label('Detalle del video:', 'detalle_video', $data);

						$data = array(
							'type'  => 'textarea',
							'name'  => 'detalle_video',
							'id'    => 'detalle_video',
							'class' => 'form-control ',
//							'value' => set_value('detalle_video'),
//						'placeholder' =>	'Detalle categoría',
//						'required'    => 	'required'
						);

						echo form_textarea($data);	
						echo form_error('detalle_video','<div class="invalid-feedback" style="display:block;">',"</div>");
						?>
						<span class="aclaracion">Si deja vacío toma los datos de Youtube al mostrarlo</span>
				</div>
				<div class=" col-sm-4  ">
				<?php
					$data = array(
					'class' => '',
					);
					echo form_label('Captura del video:', 'video_post', $data);
				?>
				<div class="text-center" id="video_post"></div>
				</div>
	
	
			</div>
						<div class="border-top">
							<div class="card-body">
								<?php
					
									$data = array(
										'class'       => 	'btn btn-success',
										'id'       => 	'post_addVideo',
										'data-post'       => $post->id ,
									);
				
									echo form_submit('botonSubmit_addVideo', 'Enviar', $data);
								?>
							</div>
						</div>

			</div>
		</div>
		
		<a class="card-header link border-top" data-toggle="collapse" data-parent="#accordian-4" href="#Toggle-4" aria-expanded="true" aria-controls="Toggle-4">
			<i class="fas fa-paperclip" aria-hidden="true"></i>
			<span class="titulos_accordian">Archivos Adjuntos </span>
		</a>
		<div id="Toggle-4" class="multi-collapse collapse" style="">
			<div class="card-body widget-content">

				<div class="row">
					<div style="margin-top: 30px;" class="col-lg-4">
					<h4>Agregar Archivos </h4>
					<form method="post" id="upload_file" action="<?= base_url('Manager/Post/add_archivo_adjunto')?>" enctype="multipart/form-data">
						<div class="form-group ">
							<label>Seleccione el  Archivo</label>
							<input type="file" class="form-control" name="userfile" id="userfile" >
						</div>
						<div class="form-group m-t-20">
							<input type="hidden" name="id_post" id="id_post" value="<?= $post->id ?>" />
							<label>Comentario del archivo: </label>
							<input type="text" class="form-control date-inputmask" id="detalle" name="detalle" value="">
						</div>
						<div class="form-group">
							<input id="subir_archivos" class="form-control btn btn-cyan" type="submit" name="fileSubmit" value="Subir Archivo" disabled>
						</div>
					</form>
					</div>
					<div style="margin-top: 30px;" class="ml-4 col-lg-6">
					
					<style>
						.comment-row{
							border: 1px solid #eeeeee!important;
						}					
					</style>
					
					<h4>Archivos Adjuntos </h4>
					<?php if(empty($adjuntos)):?>
					<div class="comment-widgets scrollable ps-container ps-theme-default" data-ps-id="c4013b20-5d9f-0d42-96ba-42f2c25f9628">
			
					</div>
					<?php else :?>
					<div class="comment-widgets scrollable ps-container ps-theme-default" data-ps-id="c4013b20-5d9f-0d42-96ba-42f2c25f9628">

					<?php
							foreach($adjuntos as $data):?>
					<?php 
						$array_archivo = explode('/', $data->url);
						$user = $this->ion_auth->user($data->id_user_add)->row()
					?>		
						<div class="d-flex flex-row comment-row" id="adjunto_<?= $data->id ?>">
							<div class="comment-text w-100">
								<h6 class="font-medium"><a href="<?= base_url($data->url)?>" target="_blank"><?= $array_archivo[4]?></a></h6>
								<span class="m-b-15 d-block"><?= $data->detalle ?></span>
								<div class="comment-footer">
									<span class="text-muted float-right">Subido el:	<?= fecha_es($data->fecha_add, "d F a", false)?>, por:<?= $user->last_name.', '. $user->first_name ?></span>
									<button type="button" class="btn btn-danger btn-sm borrar_adjunto" data-id="<?= $data->id ?>" data-archivo="<?= $array_archivo[4] ?>">Borrar</button>
								</div>
							</div>
						</div>
					<?php endforeach;?>
					</div>
					<?php endif;?>
				</div>
			</div>
				
					
					
<!--
						<div class="border-top">
							<div class="card-body">
							<p>Archivos adjuntos</p>
							<label for="title">Title</label>
							<input type="text" name="detalle" id="detalle" width="450" />
							<br>
							<label for="userfile">File</label>
							<input type="file" name="userfile" id="userfile" size="20" />
							<br>
							<input type="submit" name="submit" id="submit" />
							<p>Files</p>
							<div id="files"></div>
							</div>
						</div>
-->

			</div>
		</div>



	</div>
</div>



<script>

var base_url = '<?= base_url()?>';
</script>

