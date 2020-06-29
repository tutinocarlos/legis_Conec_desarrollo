<?php
//var_dump($imagenes); die();


?>
<h3><?php echo  $post_titulo ?></h3>
<div id="accordian-4" class="col col-md-12">

	<div class="card m-t-30">
		<a class="card-header link" data-toggle="collapse" data-parent="#accordian-4" href="#Toggle-2" aria-expanded="true" aria-controls="Toggle-2">
			<i class="fas fa-file-image" aria-hidden="true"></i>
			<span class="titulos_accordian">Agregar Imágenes</span>
		</a>
		<div id="Toggle-2" class="multi-collapse collapse " style="">
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
												<a class="borrar_imagen btn default btn-outline el-link" data-post="<?= $data->id_post?>" data-foto="<?= $imagen[5]?>" data-url="<?= $data->url?>" data-imagen="<?= $data->id;?>" href="javascript:void(0);">
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
				<div class="row">

					<div class="card col-sm-6">

						<form enctype="multipart/form-data" action="<?= base_url()?>Manager/Post/upload_file_2" method="post">
							<input type="hidden" name="id_post" value="<?php echo  $post_id ?>">
							<input type="hidden" name="titulo" value="<?php echo  $post_titulo ?>">
							<input type="hidden" name="usuario" value="<?php echo  $user->id ?>">
							<div class="form-group">
								<label>Seleccione imágenes</label>
								<input type="file" class="form-control" name="userFiles[]" multiple />
							</div>
							<div class="form-group">
								<input id="cargar_imagen" class="form-control btn btn-cyan" type="submit" name="fileSubmit" value="Subir Fotos" disabled/>
							</div>
						</form>
					</div>

				</div>
			</div>
		</div>
		<a class="card-header link border-top collapsed" data-toggle="collapse" data-parent="#accordian-4" href="#Toggle-3" aria-expanded="false" aria-controls="Toggle-3">
			<i class=" fab fa-youtube" aria-hidden="true"></i>
			<span class="titulos_accordian">Agregar Video AAA </span>
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
						<div class="col col-lg-12" id="video_<?=$data->id?>">
							<div class="card ">
								<div class="videos comment-widgets  ps-container ps-theme-default">
									<!-- Comment Row -->
									<div class="d-flex flex-row comment-row m-t-0">
										<div class="p-2 col-lg-6"><iframe width="100%" height="130" src="https://www.youtube.com/embed/<?= $data->url?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe></div>
										<div class="comment-text w-100">
											<h6 class="font-medium">
												<?= $data->titulo?>
											</h6>
											<span class="m-b-15 d-block">
												<?= $data->descripcion?></span>
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
			<div class="card ">
					<?php
							$attributes = array('class' => 'form-horizontal',
								'id' => 'my_form_2',
								'enctype'=>"multipart/form-data"
						);
						echo form_open('/Manager/Post/add_video',$attributes);
						?>
					<input type="text" name="id_post"id="id_post" value="<?php echo  $post_id ?>">
					<input type="text" name="titulo" value="<?php echo  $post_titulo ?>">
					<input type="text" name="usuario" value="<?php echo  $user->id ?>">
					<div class="card-body">
						<div class="form-group row">
							<div class="col-sm-6">
								<?php
						$data = array(
							'class' => '',
						);
						echo form_label('Url del video:', 'mi_video', $data);

						$data = array(
							'type'  => 'text',
							'name'  => 'mi_video',
							'id'    => 'mi_video',
							'class' => 'form-control ',
//							'value' => set_value('mi_video'),
//						'placeholder' =>	'Detalle categoría',
//						'required'    => 	'required'
						);

						echo form_error('mi_video','<div class="invalid-feedback" style="display:block;">',"</div>");
						echo form_input($data);	

						?>
								<div class="card-body"><button id="checkTouTube" onclick="buscar_video($('#mi_video').val());" type="button" class="btn btn-secondary">Obtener datos del Video automaticamente</button></div>
															<div class="col-sm-12">
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
							</div>
							<div class="col-sm-12">
								<?php
						$data = array(
							'class' => '',
						);
						echo form_label('Destalle del video:', 'detalle_video', $data);

						$data = array(
							'type'  => 'textarea',
							'name'  => 'detalle_video',
							'id'    => 'detalle_video',
							'class' => 'form-control ',
//						'value' => set_value('detalle_video'),
//						'placeholder' =>	'Detalle categoría',
//						'required'    => 	'required'
						);

						echo form_textarea($data);	
						echo form_error('detalle_video','<div class="invalid-feedback" style="display:block;">',"</div>");

						?>
							</div>
							</div>


				<div class="card col-sm-6 ">
					<div class="align-self-center " id="video_post"></div>
				</div>
						</div>

					</div>
					<div class="border-top">
						<div class="card-body">
							<button type="submit" id="enviar_video" class="btn btn-success">Enviar</button>
						</div>
					</div>
					<?php echo  form_close();?>
				</div>


			</div>
		</div>
				
		<a class=" card-header link border-top" data-toggle="collapse" data-parent="#accordian-4" href="#Toggle-4" aria-expanded="true" aria-controls="Toggle-4">
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
							<input type="hidden" name="id_post" id="id_post" value="<?= $post_id ?>" />
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
<!--
		<a class="card-header link border-top collapsed" data-toggle="collapse" data-parent="#accordian-4" href="#Toggle-4" aria-expanded="false" aria-controls="Toggle-4">
			<i class="fa fa-times" aria-hidden="true"></i>
			<span>Toggle, Closed by default</span>
		</a>
		<div id="Toggle-4" class="multi-collapse collapse" style="">
			<div class="card-body widget-content">
				This box is now open
			</div>
		</div>
-->
	</div>
</div>

<!--
<a href="images/image-1.jpg" data-lightbox="image-1" data-title="My caption">Image #1</a>
<section>
	<h3>Two Individual Images</h3>
	<div>
		<a class="example-image-link" href="http://lokeshdhakar.com/projects/lightbox2/images/image-1.jpg" data-lightbox="example-1">

			<img class="example-image" src="http://lokeshdhakar.com/projects/lightbox2/images/thumb-1.jpg" alt="image-1">
		</a>
		<a class="example-image-link" href="http://lokeshdhakar.com/projects/lightbox2/images/image-2.jpg" data-lightbox="example-2" data-title="Optional caption."><img class="example-image" src="http://lokeshdhakar.com/projects/lightbox2/images/thumb-2.jpg" alt="image-1"></a>
	</div>

	<hr>

	<h3>A Four Image Set</h3>
	<div>
		<a class="example-image-link" href="http://lokeshdhakar.com/projects/lightbox2/images/image-3.jpg" data-lightbox="example-set" data-title="Click the right half of the image to move forward."><img class="example-image" src="http://lokeshdhakar.com/projects/lightbox2/images/thumb-3.jpg" alt=""></a>

		<a class="example-image-link" href="http://lokeshdhakar.com/projects/lightbox2/images/image-4.jpg" data-lightbox="example-set" data-title="Or press the right arrow on your keyboard."><img class="example-image" src="http://lokeshdhakar.com/projects/lightbox2/images/thumb-4.jpg" alt=""></a>
		<a class="example-image-link" href="http://lokeshdhakar.com/projects/lightbox2/images/image-5.jpg" data-lightbox="example-set" data-title="The next image in the set is preloaded as you're viewing."><img class="example-image" src="http://lokeshdhakar.com/projects/lightbox2/images/thumb-5.jpg" alt=""></a>
		<a class="example-image-link" href="http://lokeshdhakar.com/projects/lightbox2/images/image-6.jpg" data-lightbox="example-set" data-title="Click anywhere outside the image or the X to the right to close."><img class="example-image" src="http://lokeshdhakar.com/projects/lightbox2/images/thumb-6.jpg" alt=""></a>
	</div>
</section>-->
