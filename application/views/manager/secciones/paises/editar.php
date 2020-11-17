	<?php
//				echo '<pre>';
//	var_dump($this->input->post());
//echo '</pre>';
?>
	<div class="col-md-6 col-lg-2 col-xlg-3">
	<a href="<?= base_url('Manager/Paises')?>">
		<div class="card card-hover">
			<div class="box  text-center" style="background: #f7aa47;">
				<h1 class="font-light text-white"><i class="fas fa-list"></i></h1>
				<h6 class="text-white">Listado de Paises</h6>

			</div>
		</div>
	</a>
</div>

	<div class="card col-md-12">
		<?php
		$attributes = array(
			'class' => 'form-horizontal', 
			'id' => 'myform',
			'autocomplete' => 'off',
		);
			echo form_open_multipart('/Manager/Paises/buscar_item/'. $data->id_pais,$attributes);
		?>
		<div class="card-body">
			<h5 class="card-title m-b-0">Editar País: <?=$data->nombre_pais?> </h5>
			<div class="row" style="display:none;">
				<div class="form-group col-md-1">

					<label>ID:</label>
					<input type="text" class="form-control date-inputmask" name="id" value="<?= $data->id_pais?> " readonly>
				</div>
				<div class="form-group col-md-2">
					<label>Usuario Alta</label>
					<input type="text" class="form-control international-inputmask" name="user_add" value="" disabled>
				</div>
				<div class="form-group col-md-2">
					<label>Fecha Alta</label>
					<input type="text" class="form-control date-inputmask" name="fecha-alta" value="" disabled>
				</div>

				<div class="form-group col-md-2">
					<label>Modificado por:</label>
					<input type="text" class="form-control international-inputmask" name="user_upd" value="" disabled>
				</div>
				<div class="form-group col-md-2">
					<label>Ultima Mod:</label>
					<input type="text" class="form-control phone-inputmask" name="fechaupd" value=" " disabled>
				</div>
			</div>
			<div class="row">

				<div class="form-group col-md-2">
					<label>Código </label>
					<input type="text" class="form-control purchase-inputmask" name="codigo_pais" value="<?= $data->codigo_pais?> " >
				</div>

				<div class="form-group col-md-3">
					<label>Nombre </label>
					<input type="text" class="form-control xphone-inputmask" name="nombre_pais" value="<?= trim($data->nombre_pais) ?>">
					<span class="aclaracion">* Campo requerido</span>
					<?php echo form_error('nombre_pais','<div class="invalid-feedback" style="display:block;">',"</div>");?>
				</div>		
				<div class="form-group col-md-3">
					<label>Capital </label>
					<input type="text" class="form-control xphone-inputmask" name="capital_pais" value="<?= trim($data->capital_pais) ?>">
					<span class="aclaracion">* Campo requerido</span>
					<?php echo form_error('capital_pais','<div class="invalid-feedback" style="display:block;">',"</div>");?>
				</div>
				<div class="form-group col-md-2">
					<label for="position-bottom-left">Color identificator</label>
					<div class="minicolors minicolors-theme-bootstrap minicolors-position-bottom minicolors-position-left">
						<input name="color_pais" type="text" id="position-bottom-left" class="form-control demo minicolors-input_prov" data-position="bottom left" value="<?= $data->color_pais?>" size="7">
						<span class="minicolors-swatch minicolors-sprite minicolors-input-swatch">
							<span class="minicolors-swatch-color provincia" style="background-color: <?= $data->color_pais?>; opacity: 1;"></span></span>
						<div class="minicolors-panel minicolors-slider-hue" style="display: none;">
							<div class="minicolors-slider minicolors-sprite">
								<div class="minicolors-picker" style="top: 66.6667px;"></div>
							</div>
							<div class="minicolors-opacity-slider minicolors-sprite">
								<div class="minicolors-picker"></div>
							</div>
							<div class="minicolors-grid minicolors-sprite" style="background-color: <?= $data->color_pais?>;">
								<div class="minicolors-grid-inner"></div>
								<div class="minicolors-picker" style="top: 30px; left: 150px;">
									<div></div>
								</div>
							</div>
						</div>
					</div>
					<span class="aclaracion">* Campo requerido</span>
					<?php echo form_error('color_pais','<div class="invalid-feedback" style="display:block;">',"</div>");?>
				</div>

				<?php
					$atributos = array(
						'class'=>'select2 form-control custom-select select2-hidden-accessible',
					);
				?>
				<div class="form-group col-md-2">
					<img class="img-thumbnail" src="<?= base_url($data->bandera_pais)?>" alt="">
					
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-2">
					<?php
						$format_habitantes = trim($data->habitantes_pais);
					?>
					<label>Habitantes: </label>
					<input type="text" class="form-control xphone-inputmask" name="habitantes_pais" value="<?= $format_habitantes ?> ">
				</div>
				<div class="form-group col-md-2">
					<label>Superficie M2: </label>
						<?php
							$format_superficie  = trim($data->superficie_pais);
						?>
					<input type="text" class="form-control xphone-inputmask" name="superficie_pais" value="<?= $format_superficie ?>">
				</div>
				<div class="form-group col-md-2">
					<label>Latitud </label>
						<?php
							$latitud  = trim($data->lat_pais);
						?>
					<input type="text" class="form-control xphone-inputmask" name="lat_pais" value="<?= $latitud ?>">
				</div>
				<div class="form-group col-md-2">
					<label>Longitud </label>
						<?php
							$longitud  = trim($data->long_pais);
						?>
					<input type="text" class="form-control xphone-inputmask" name="long_pais" value="<?= $longitud ?>">
				</div>
				
			<div class="form-group col-md-12 " id="texto_detalle">
				<label>Países Limítrofes:</label>
			</div>
			</div>
			<div class="row">
				<?php foreach($limitrofes as $data):?>
				<div class="form-group col-md-4 ">
				<div class="alert alert-primary alert-dismissible fade show" role="alert">
  <strong><?= $data->nombre_pais?></strong>
<!--
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
-->
</div>
				</div>
				<?php endforeach;?>
			</div>
						<div class="row">
				<div class="form-group col-md-12 " id="texto_detalle">
				<label>Moneda Oficial:</label>
			</div>
							<?php foreach($monedas as $data):?>
				<div class="form-group col-md-4 ">
				<div class="alert alert-primary alert-dismissible fade show" role="alert">
  <strong><?= $data->moneda_nombre?></strong>
<!--
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
-->
</div>
				</div>
				<?php endforeach;?>
			</div>
			<div class="row">
				<div class="form-group col-md-12 " id="texto_detalle">
				<label>Idiomas:</label>
			</div>
							<?php foreach($idiomas as $data):?>
				<div class="form-group col-md-4 ">
				<div class="alert alert-primary alert-dismissible fade show" role="alert">
  <strong><?= $data->idioma_nombre?></strong>
<!--
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
-->
</div>
				</div>
				<?php endforeach;?>
			</div>
				<div class="row">
			<div class="form-group col-md-12 " id="texto_detalle">
				<label>Detalles:</label>
				<textarea name="detalle_pais" id="detalle_pais" cols="30" rows="10"><?= set_value('detalle_pais')?></textarea>
				<textarea name="detalles" id="detalles" cols="100" rows="10"><?= set_value('detalle_pais')?></textarea>
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
					<!--					<button type="submit" class="btn btn-success ">Enviar</button>-->
				</div>
			</div>
			<?php echo form_close()?>
		</div>
	</div>