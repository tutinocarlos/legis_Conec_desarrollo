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
				
				<div class="alert alert-info" role="alert">
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
								<input type="file" class="form-control" name="userFiles[]" multiple id="cargar_imagenes" accept="image/x-png, image/gif, image/jpeg"/>
							</div>
							<div class="form-group">
								<input id="cargar_imagen" class="form-control btn btn-success" type="submit" name="fileSubmit" value="Subir Fotos" disabled/>
							</div>
						</form>
					</div>

				</div>
			</div>
		</div>		
		<a class="card-header link" data-toggle="collapse" data-parent="#accordian-4" href="#Toggle-3" aria-expanded="true" aria-controls="Toggle-2">
			<i class="fas fa-file-image" aria-hidden="true"></i>
			<span class="titulos_accordian">Agregar Documentos</span>
		</a>
		<div id="Toggle-3" class="multi-collapse collapse " style="">
			<div class="card-body widget-content">
			<div class="row el-element-overlay " id="fondo_imagen">
				<?php if(empty($documentos)):?>
				
				<div class="alert alert-info" role="alert">
				<h4 class="alert-heading">Publicación sin documentos Adjuntos</h4>
				<hr>
			
			
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

						<form enctype="multipart/form-data" action="<?= base_url()?>Manager/Post/upload_file_docs" method="post">
							<input type="hidden" name="id_post" value="<?php echo  $post_id ?>">
							<input type="hidden" name="titulo" value="<?php echo  $post_titulo ?>">
							<input type="hidden" name="usuario" value="<?php echo  $user->id ?>">
							<div class="form-group">
								<label>Seleccione Documentos</label>
								<input id="cargar_documento" type="file" class="form-control" name="userdocs[]" multiple  accept=" application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,
text/plain, application/pdf, application/vnd.ms-powerpoint, application/pdf" />
							</div>
							<div class="form-group">
								<input id="subir_documento" class="form-control btn btn-success" type="submit" name="fileSubmit" value="Subir Docuentos" disabled/>
							</div>
						</form>
					</div>

				</div>
			</div>
		</div>
		<a class="card-header link border-top collapsed" data-toggle="collapse" data-parent="#accordian-4" href="#Toggle-4" aria-expanded="false" aria-controls="Toggle-3">
			<i class=" fab fa-youtube" aria-hidden="true"></i>
			<span class="titulos_accordian">Agregar Video </span>
		</a>
		<div id="Toggle-4" class="multi-collapse collapse" style="">
			<div class="card-body widget-content">

				<div class="card col-sm-6">
					<?php
$attributes = array('class' => 'form-horizontal',
'id' => 'my_form_2',
'enctype'=>"multipart/form-data"
);
echo form_open('/Manager/Post/add_video',$attributes);
?>
					<input type="text" name="id_post" value="<?php echo  $post_id ?>">
					<input type="text" name="titulo" value="<?php echo  $post_titulo ?>">
					<input type="text" name="usuario" value="<?php echo  $user->id ?>">
					<div class="card-body">
						<div class="form-group row">
							<div class="col-sm-12">
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
							</div>
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

					</div>
					<div class="border-top">
						<div class="card-body">
							<button type="submit" id="enviar_video" class="btn btn-primary">Enviar</button>
						</div>
					</div>
					<?php echo  form_close();?>
				</div>


				<div class="card col-sm-6 ">

					<div class="card-body col-md-6 col align-self-center " id="video_post">

					</div>


				</div>
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
