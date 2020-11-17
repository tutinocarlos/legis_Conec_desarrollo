<!--

object(stdClass)[35]
  public 'id' => string '1' (length=1)
  public 'nombre' => string 'Buenos Aires' (length=12)
  public 'zona' => string 'AR-B' (length=4)
  public 'estado' => string '1' (length=1)
  public 'comentario' => null
  public 'color' => string '#7DBDEC' (length=7)
  public 'camara' => string 'Bicameral' (length=9)
  public 'user_add' => string '1' (length=1)
  public 'fecha_add' => string '2019-10-29 12:58:40' (length=19)
  public 'user_upd' => string '0' (length=1)
  public 'fecha_upd' => null
  public 'nombre_upd' => null
  public 'ape_upd' => null
  public 'nombre_add' => string 'Carlos' (length=6)
  public 'ape_add' => string 'Tutino' (length=6)
  public 'id_provincia' => string '1' (length=1)
  public 'nom_provicia' => string 'Buenos Aires' (length=12)
  public 'id_camara' => string '2' (length=1)
-->

<?php
//
//var_dump($tipo_camara);
//echo '<pre>';
//var_dump($provincia);
//echo '</pre>';

?>
<div class="row">
	
	<div class="col-md-4 ">
		<a href="<?= base_url('Manager/Provincias/')?>">
			<div class="card card-hover">
				<div class="box  text-center" style="background-color: #00b19d;">
					<h1 class="font-light text-white"><i class="fas fa-list"></i></h1>
					<h6 class="text-white">listado Provincias / Departamentos</h6>
				</div>
			</div>
		</a>
	</div>
</div>
<div class="card col-md-12">
		<?php
		$attributes = array(
			'class' => 'form-horizontal', 
			'id' => 'myform',
			'autocomplete' => 'off',
		);
			echo form_open_multipart('/Manager/Provincias/edit/'. $provincia->id,$attributes);
		?>
	<div class="card-body">
		<h5 class="card-title m-b-0">Editar Provincia</h5>
		<div class="row">
		<div class="form-group col-md-1">

			<label>ID:</label>
			<input type="hidden" class="form-control date-inputmask" name="id" value="<?= $provincia->id?> " >
			<input type="text" class="form-control date-inputmask" name="id_cat" value="<?= $provincia->id?> " disabled>
			</div>
			<div class="form-group col-md-2">
				<label>Usuario Alta</label>
				<input type="text" class="form-control international-inputmask" name="user_add"  value="<?= $provincia->nombre_add.','.$provincia->ape_add?> " disabled>
			</div>
			<div class="form-group col-md-2">
			<label>Fecha Alta</label>
			<input type="text" class="form-control date-inputmask" name="fecha-alta"  value="<?= fecha_es($provincia->fecha_add, "d F a",TRUE)?> " disabled>
		 </div>

			<div class="form-group col-md-2">
				<label>Modificado por:</label>
				<input type="text" class="form-control international-inputmask" name="user_upd"  value="<?= $provincia->nombre_upd.','.$provincia->ape_upd?>" disabled>
			</div>
		<div class="form-group col-md-2">
			<label>Ultima Mod:</label>
			<input type="text" class="form-control phone-inputmask" name="fechaupd" value="<?= $provincia->fecha_upd?> "  disabled>
		</div>
		</div>
		<div class="row">

			<div class="form-group col-md-3">
				<label>Pais </label>
				<?php 
					$atributos =array(
						'class'=>'select2 form-control select2-hidden-accessible'
					)
				?>
					<?= 	form_dropdown('pais', $data_select_pais,$provincia->id_pais, $atributos); ?>
				<?php echo form_error('pais','<div class="invalid-feedback" style="display:block;">',"</div>");?>
				<span class="aclaracion">* Campo requerido</span>
			</div>
			<div class="form-group col-md-1">
				<label>ZONA </label>
				<input type="text" class="form-control purchase-inputmask" name="detalle" value="<?= $provincia->zona ?>">
			</div>

			<div class="form-group col-md-3">
				<label>Nombre </label>
				<input type="text" class="form-control xphone-inputmask" name="nombre" value="<?= $provincia->nombre ?>">
				<span class="aclaracion">* Campo requerido</span>
				<?php echo form_error('nombre','<div class="invalid-feedback" style="display:block;">',"</div>");?>
			</div>
			<div class="form-group col-md-2">
				<label for="position-bottom-left">Color Provincia</label>
				<div class="minicolors minicolors-theme-bootstrap minicolors-position-bottom minicolors-position-left">
					<input name="color_provincia" type="text" id="position-bottom-left" class="form-control demo minicolors-input_prov" data-position="bottom left" value="<?= $provincia->color?>" size="7">
						<span class="minicolors-swatch minicolors-sprite minicolors-input-swatch">
						<span class="minicolors-swatch-color provincia" style="background-color: <?= $provincia->color?>; opacity: 1;"></span></span>
					<div class="minicolors-panel minicolors-slider-hue" style="display: none;">
						<div class="minicolors-slider minicolors-sprite">
							<div class="minicolors-picker" style="top: 66.6667px;"></div>
						</div>
						<div class="minicolors-opacity-slider minicolors-sprite">
							<div class="minicolors-picker"></div>
						</div>
						<div class="minicolors-grid minicolors-sprite" style="background-color: <?= $provincia->color?>;">
							<div class="minicolors-grid-inner"></div>
							<div class="minicolors-picker" style="top: 30px; left: 150px;">
								<div></div>
							</div>
						</div>
					</div>
				</div>
				<span class="aclaracion">* Campo requerido</span>
				<?php echo form_error('color_provincia','<div class="invalid-feedback" style="display:block;">',"</div>");?>
			</div>

			<?php
			$atributos = array(
			'class'=>'select2 form-control select2-hidden-accessible',
			);
			?>
			<div class="form-group col-md-2 ">
				<label>Tipo Cámara:</label>
				<?= 	form_dropdown('tipo_camara', $tipo_camara,$provincia->id_camara, $atributos); ?>
				<?php echo form_error('tipo_camara','<div class="invalid-feedback" style="display:block;">',"</div>");?>
				<span class="aclaracion">* Campo requerido</span>
			</div>

			<div class="form-group col-md-2">
				<label for="position-bottom-left">Color Tipo Cámara</label>
				<div class="minicolors minicolors-theme-bootstrap minicolors-position-bottom minicolors-position-left"><input type="text" name="color" id="position-bottom-left" class="form-control demo minicolors-input_camara" data-position="bottom left" value="<?= $provincia->camara_color?>" size="7" readonly disabled><span class="minicolors-swatch minicolors-sprite minicolors-input-swatch"><span class="minicolors-swatch-color" style="background-color: <?= $provincia->camara_color?>; opacity: 1;"></span></span>

				</div>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-3">
				<label>Habitantes: </label>
				<input type="text" class="form-control purchase-inputmask" name="habitantes" value="<?= $provincia->habitantes?>" >
			</div>
			<div class="form-group col-md-3">
				<label>Superficie: </label>
				<input type="text" class="form-control purchase-inputmask" name="superficie" value="<?= $provincia->superficie?>" >
			</div>			
			<div class="form-group col-md-3">
			<label>Latitud: </label>
				<input type="text" class="form-control purchase-inputmask" name="latitud" value="<?= $provincia->latitud?>" >
			</div>			
			<div class="form-group col-md-3">
				<label>Longitud: </label>
				<input type="text" class="form-control purchase-inputmask" name="longitud" value="<?= $provincia->longitud?>" >
			</div>
			
		</div>
		<div class="row">

			<div class=" col-lg-6">
			<div class="form-group col-lg-6">

				<div class="col-lg-6">
					<img class="img-thumbnail" src="<?= base_url($provincia->escudo)?>" alt="">
				</div>

			</div>
			<div class="form-group ">
				<?php
					$data = array(
						'class' => '',
					);
					echo form_label('Cambiar Escudo:', 'escudo', $data);

					$data = array(
						'type'  => 'file',
						'name'  => 'escudo',
						'id'    => 'escudo',
						'class' => 'form-control ',
						'value' => $provincia->escudo,
		//						'placeholder' =>	'Detalle categoría',
		//						'required'    => 	'required'
					);
					echo form_input($data);	
					echo form_error('escudo','<div class="invalid-feedback" style="display:block;">',"</div>");
					?>
				<input type="hidden" class="form-control" id="mi_escudo" name="mi_escudo" value="<?= $provincia->escudo ?>" readonly>
				<input type="hidden" class="form-control" id="nuevo_escudo" name="nuevo_escudo" value="<?= $provincia->escudo ?>" readonly>
			</div>
			</div>
	</div>
	<div class="row">

	<div class="form-group col-md-12 ">
		<label style="display: block;">Comentario </label>
		<textarea rows="6"   style="width: 100%;" name="comentario" id="comentario"><?= $provincia->comentario?> </textarea>
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
<script>
var inicial = false;
</script>
