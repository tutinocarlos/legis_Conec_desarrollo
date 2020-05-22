<?php

//var_dump($legislatura);
?>
	
<style>
img {
margin-right: 3px;
border: 1px solid #000;
	padding: 15px;
}
	
.videos {
  border: 1px solid #949494;
}

.comment-widgets .comment-row {
		margin: 0!important;
	}
	

</style>


<div class="col-md-6 col-lg-2 col-xlg-3">
	<a href="<?= base_url()?>Manager/Legislaturas">
		<div class="card card-hover">
			<div class="box  text-center" style="background-color: #00b19d;">
				<h1 class="font-light text-white"><i class="fas fa-pencil-alt"></i></h1>
				<h6 class="text-white">Agregar Organismo</h6>
			</div>
		</div>
	</a>
</div>
<div class="col-md-6 col-lg-2 col-xlg-3">
	<a href="<?= base_url()?>Manager/Legislaturas/listado">
		<div class="card card-hover">
			<div class="box  text-center" style="background: #f7aa47;">
				<h1 class="font-light text-white"><i class="fas fa-building"></i></h1>
				<h6 class="text-white">Listar Organismo</h6>
			</div>
		</div>
	</a>
</div>
	<div class="col-md-12" data-select2-id="15">

	<div class="card ">
		<?php
		$keys = array('msj_update', 'class');
		$this->session->unset_userdata($keys);
$js = array(
	'class'=>'select2 form-control custom-select select2-hidden-accessible',
);


		
		$attributes = array('class' => 'form-horizontal ',
												'id' => 'myform',
												'enctype'=>"multipart/form-data"
											 );
			echo form_open('/Manager/legislaturas/edit/'.$legislatura->id,$attributes);
		?>
		<!--		<form class="form-horizontal" action="/Manager/Contenidos/grabar_categorias" method="post">-->
		<div class="card-body col-md-12 ">
			<h4 class="card-title">titulo</h4>
				<div class="row">
	<div class="form-group col-md-1">
		
		<label>ID:</label>
		<input type="hidden" class="form-control date-inputmask" name="id" value="<?= $legislatura->id ?> " >
		<input type="text" class="form-control date-inputmask" name="id_cat" value="<?= $legislatura->id ?> " disabled>
	</div>
	<div class="form-group col-md-3">
		<label>Fecha Alta:</label>
		<input type="text" class="form-control date-inputmask" name="fecha-alta"  value="<?= $legislatura->fecha_ins ?> " disabled>
	</div>
	<div class="form-group col-md-2">
		<label>Usuario Alta:</label>
		<input type="text" class="form-control international-inputmask" name="usuarios"  value="<?= $legislatura->nombre_add.','.$legislatura->ape_add?> " disabled>
	</div>
	
	<div class="form-group col-md-3">
		<label>Ultima Modificación:</label>
		<input type="text" class="form-control phone-inputmask" name="fechaupd" value="<?= $legislatura->fecha_upd ?> "  disabled>
	</div>
	<div class="form-group col-md-2">
		<label>Usuario  Modificación:</label>
		<input type="text" class="form-control international-inputmask" name="usuarios"  value="<?= $legislatura->nombre_upd.','.$legislatura->ape_upd?> " disabled>
	</div>
	
	</div>
		<div class="row">
	
			<div class="col-md-3">
				<label>Provincia: </label>

				<?= 	form_dropdown('provincia', $data_select_provincia, $legislatura->id_provincia, $js); ?>
				<?php echo form_error('provincia','<div class="invalid-feedback" style="display:block;">',"</div>");?>
			</div>
			
			
			<div class="col-md-3 ">
				<label>Tipo Organismo: </label>

				<?= 	form_dropdown('organismo', $data_select_tipo_organismo, $legislatura->id_organismo, $js); ?>
				<?php echo form_error('organismo','<div class="invalid-feedback" style="display:block;">',"</div>");?>
			</div>
			
		</div>
			
			<div class="row">

				<div class="col-md-6">

					<!--					<label for="fname" class="col-sm-3 text-right control-label col-form-label">Nombre</label>-->
					<?php
						$data = array(
							'class' => '',
						);
						echo form_label('Legislatura:', 'nombre', $data);
					?>
					<?php

							$data = array(
								'name'  => 'nombre',
								'id'    => 'nombre',
								'class' => 'form-control',
								'value' => $legislatura->nombre
//								'placeholder' =>	'Nombre categoría',
//								'required'    => 	'required'
							);

							echo form_input($data);	
							echo form_error('nombre','<div class="invalid-feedback" style="display:block;">',"</div>");
						?>
				</div>

				<div class="col-md-6">
					<?php
						$data = array(
							'class' => '',
						);
						echo form_label('Lema:', 'lema', $data);


							$data = array(
								'name'  => 'lema',
								'id'    => 'lema',
								'class' => 'form-control',
								'value' => $legislatura->lema
//								'placeholder' =>	'Detalle categoría',
//								'required'    => 	'required'
							);

							echo form_input($data);	

							echo form_error('lema','<div class="invalid-feedback" style="display:block;">',"</div>");
					?>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-3">
					<?php
						$data = array(
							'class' => '',
						);
						echo form_label('Dirección:', 'direccion', $data);

						$data = array(
							'name'  => 'direccion',
							'id'    => 'direccion',
							'class' => 'form-control',
							'value' => $legislatura->direccion
//								'placeholder' =>	'Detalle categoría',
//								'required'    => 	'required'
							);

						echo form_input($data);
						echo form_error('direccion','<div class="invalid-feedback" style="display:block;">',"</div>");
						?>
				</div>

				<div class="col-md-3">
					<?php
						$data = array(
							'class' => '',
						);
						echo form_label('Teléfono:', 'telefono', $data);
	
						$data = array(
							'name'  => 'telefono',
							'id'    => 'telefono',
							'class' => 'form-control',
							'value' => $legislatura->telefono
//									'placeholder' =>	'Detalle categoría',
//									'required'    => 	'required'
						);

						echo form_input($data);	
						echo form_error('telefono','<div class="invalid-feedback" style="display:block;">',"</div>");
						?>
					<!--						<input type="text" class="form-control" name="detalle" placeholder="Last Name Here">-->
				</div>
	

				<div class="col-sm-3">
					<?php
						$data = array(
							'class' => '',
						);
						echo form_label('URL:', 'url', $data);

					$data = array(
							'name'  => 'url',
							'id'    => 'url',
							'class' => 'form-control',
							'value' => $legislatura->url,
//						'placeholder' =>	'Detalle categoría',
//						'required'    => 	'required'
						);

					echo form_input($data);	
					echo form_error('url','<div class="invalid-feedback" style="display:block;">',"</div>");

						?>
				</div>
				<div class="col-sm-3">
					<?php
						$data = array(
							'class' => '',
						);
						echo form_label('Email:', 'email', $data);
						$data = array(
							'name'  => 'email',
							'id'    => 'email',
							'class' => 'form-control ',
							'value' => $legislatura->email
//						'placeholder' =>	'Detalle categoría',
//						'required'    => 	'required'
							);

							echo form_input($data);	
							echo form_error('email','<div class="invalid-feedback" style="display:block;">',"</div>");

						?>
					<!--						<input type="text" class="form-control" name="detalle" placeholder="Last Name Here">-->
				</div>
			</div>

		<div style="margin-top: 30px;"><h4>Redes Sociales</h4></div>
			<div class="row">
				<div class="col-sm-3">
					<?php
						$data = array(
							'class' => '',
						);
						echo form_label('Facebook:', 'telefono', $data);
	
						$data = array(
							'name'  => 'facebook',
							'id'    => 'facebook',
							'class' => 'form-control',
							'value' => $legislatura->facebook
//									'placeholder' =>	'Detalle categoría',
//									'required'    => 	'required'
						);

						echo form_input($data);	
						echo form_error('facebook','<div class="invalid-feedback" style="display:block;">',"</div>");
						?>
					<!--						<input type="text" class="form-control" name="detalle" placeholder="Last Name Here">-->
				</div>

				<div class="col-sm-3">
					<?php
						$data = array(
							'class' => '',
						);
						echo form_label('twitter:', 'url', $data);

					$data = array(
							'name'  => 'twitter',
							'id'    => 'twitter',
							'class' => 'form-control',
							'value' => $legislatura->twitter,
//						'placeholder' =>	'Detalle categoría',
//						'required'    => 	'required'
						);

					echo form_input($data);	
					echo form_error('twitter','<div class="invalid-feedback" style="display:block;">',"</div>");

						?>
				</div>
				<div class="col-sm-3">
					<?php
						$data = array(
							'class' => '',
						);
						echo form_label('Instagram:', 'instagram', $data);
						$data = array(
							'name'  => 'instagram',
							'id'    => 'instagram',
							'class' => 'form-control ',
							'value' => $legislatura->instagram
//						'placeholder' =>	'Detalle categoría',
//						'required'    => 	'required'
							);

							echo form_input($data);	
							echo form_error('instagram','<div class="invalid-feedback" style="display:block;">',"</div>");

						?>
					<!--						<input type="text" class="form-control" name="detalle" placeholder="Last Name Here">-->
				</div>
				<div class="col-sm-3">
					<?php
						$data = array(
							'class' => '',
						);
						echo form_label('Página de Perfil de YouTube:', 'youtube', $data);
						$data = array(
							'name'  => 'youtube',
							'id'    => 'youtube',
							'class' => 'form-control ',
							'value' => $legislatura->youtube,
//						'placeholder' =>	'Detalle categoría',
//						'required'    => 	'required'
							);

							echo form_input($data);	
							echo form_error('youtube','<div class="invalid-feedback" style="display:block;">',"</div>");
						?>
						<span class="aclaracion">Url del Perfil de la Legislatura en YouTube</span>
					<!--						<input type="text" class="form-control" name="detalle" placeholder="Last Name Here">-->
				</div>

			</div>
		<div class="row">
			
			<div class="form-group col-lg-6 col-sm-12">
				<div style="margin-top: 30px;"><h4>Logo Institucional</h4></div>
				
				<div class="col-lg-6">
					<img src="<?= base_url($legislatura->logo)?>" alt="">
				</div>
					<?php
						$data = array(
							'class' => 'col-lg-4',
						);
						echo form_label('Cambiar imagen logo:', 'logo', $data);

						$data = array(
							'type'  => 'file',
							'name'  => 'logo',
							'id'    => 'logo',
							'class' => 'form-control col-md-6 ',
							'value' => $legislatura->logo,
//						'placeholder' =>	'Detalle categoría',
//						'required'    => 	'required'
						);

						echo form_error('logo','<div class="invalid-feedback" style="display:block;">',"</div>");
						echo form_input($data);	

						?>
				<input type="hidden" class="form-control" id="mi_logo" name="mi_logo" value="<?= $legislatura->logo ?>" readonly>
				<input type="hidden" class="form-control" id="nuevo_logo" name="nuevo_logo" value="<?= $legislatura->logo ?>" readonly>

			</div>
			<div class="form-group col-lg-6 col-sm-12">
			
				<div style="margin-top: 30px;"><h4>Imágen para Slider de la Portada</h4></div>
							<div class="col-lg-6">
					<img src="<?= base_url($legislatura->slider)?>" alt="" class="img-fluid">
				</div>
					<?php
						$data = array(
							'class' => '',
						);
						echo form_label('Slider:', 'slider', $data);

						$data = array(
							'type'  => 'file',
							'name'  => 'slider',
							'id'    => 'slider',
							'class' => 'form-control col-md-6 ',
							'value' => set_value('slider'),
//						'label' =>	'Detalle categoría',
//						'required'    => 	'required'
						);
						echo form_error('Slider','<div class="invalid-feedback" style="display:block;">',"</div>");
						echo form_input($data);	

						?>
					<!--						<input type="text" class="form-control" name="detalle" placeholder="Last Name Here">-->
					
				
			</div>
			
			
			</div>
		<div class="row">
			<div class="form-group col-md-6 col-sm-12">
				<div style="margin-top: 30px;"><h4>Imágenes</h4></div>
			<div class="card-body widget-content">
				<div class="row el-element-overlay " id="fondo_imagen">
				<?php if(empty($imagenes)):?>
				
				<div class="alert alert-info col-sm-12" role="alert">
				<h4 class="alert-heading">Legislatura sin imágenes</h4>
				<hr>
				<p>Se mostrará el video por defecto del sistema</p>
			
				</div>
				<?php else:?>
				
					<?php foreach ($imagenes as $data):?>
					<div class="col-lg-3 col-md-6" id="file_<?= $data->id;?>">
						<div class="card" id="imagen_<?= $data->id;?>" data-imagen="<?= $data->id;?>">
							<div class="el-card-item">
								<div class="el-card-avatar el-overlay-1"> <img src="<?= base_url($data->url)?>" alt="">
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
												<a class="borrar_imagen btn default btn-outline el-link" data-legis="<?= $data->id_legis?>" data-foto="<?= $imagen[5]?>" data-url="<?= $data->url?>" data-imagen="<?= $data->id;?>" href="javascript:void(0);">
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
				<?php endif;?>
				</div>
				<div class="row">

					<div class="card col-sm-6">

							<div class="form-group">
								<label>Seleccione imágenes</label>
								<input type="file" class="form-control" id="userFiles[]" name="userFiles[]" multiple=""/>
							</div>
			
					</div>

				</div>
			</div>
			</div>
    
		</div>
					
			<?php if($videos):?>

			<div class="col-ls-6">
					<div style="margin-top: 30px;" class="col-lg-12">
						<h4>Videos cargados</h4>
					</div>
	
						<?php foreach($videos as $data):?>
				<div class="col col-lg-4" id="video_<?=$data->id?>">
					<div class="card ">
						<div class="videos comment-widgets  ps-container ps-theme-default" >
							<!-- Comment Row -->
							<div class="d-flex flex-row comment-row m-t-0">
								<div class="p-2"><iframe width="100%" height="130" src="https://www.youtube.com/embed/<?= $data->url_video?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe></div>
								<div class="comment-text w-100">
									<h6 class="font-medium"><?= $data->titulo_video?></h6>
									<span class="m-b-15 d-block"><?= $data->detalle_video?></span>
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
			<div class="row ">
				<div style="margin-top: 30px;" class="col-lg-12"><h4>Video Institucional</h4></div>
	
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




		</div>
	</div>
	<div class="border-top">
		<div class="card">
			<div class="card-body">
				<?php
					
					$data = array(
							
								'class'       => 	'btn btn-success',
							
								
							);
				
					 echo form_submit('botonSubmit', 'Enviar', $data);
				?>
				<!--					<button type="submit" class="btn btn-success ">Enviar</button>-->
			</div>
		</div>
	</div>
	<?php
			echo form_close();
		?>
		
</div>


<script>
var base_url  = '<?= base_url()?>';
var id_legis = 	'<?= $legislatura->id?>';
var nombre_legis = 	'<?= $legislatura->nombre?>';

</script>

