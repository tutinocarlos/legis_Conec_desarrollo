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
//		echo '<pre>';
//		var_dump($post);
//		echo '</pre>';

?>
<div class="row">
	<div class="col-md-3 ">
		<a href="<?= base_url('Manager/Provincias/')?>">
			<div class="card card-hover">
				<div class="box  text-center" style="background-color:  #f7aa47;">
					<h1 class="font-light text-white"><i class="fas fa-list"></i></h1>
					<h6 class="text-white">Listar Provincias / Departamentos</h6>
				</div>
			</div>
		</a>
	</div>
	<div class="col-md-6 col-lg-3">
	<a href="<?= base_url('Manager/Legislaturas/')?>">
		<div class="card card-hover">
			<div class="box  text-center" style="background-color: #00b19d;">
				<h1 class="font-light text-white"><i class="fas fa-pencil-alt"></i></h1>
				<h6 class="text-white">Agregar Organismos</h6>
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
			echo form_open_multipart('/Manager/Provincias/agregar/',$attributes);
		?>
				<input type="hidden" class="" name="estado" value="1">
				<input type="hidden" class="" name="user_add" value="<?= $this->user->id?>">
	<div class="card-body">
		<h5 class="card-title m-b-0">Agregar Provincia</h5>
		<div class="row">

			<div class="form-group col-md-2">
				<label>ZONA </label>
				<input onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control purchase-inputmask" name="zona" value="<?= set_value('zona')?>">
				<span class="aclaracion"> (tipo AR-U para Chubut)</span>
				<span class="aclaracion">* Campo requerido</span>
				<?php echo form_error('zona','<div class="invalid-feedback" style="display:block;">',"</div>");?>
			</div>

			<div class="form-group col-md-3">
				<label>Nombre Provincia / Región </label>
				<input type="text" class="form-control xphone-inputmask" name="nombre" value="<?= set_value('nombre')?>">
				<span class="aclaracion">* Campo requerido</span>
				<?php echo form_error('nombre','<div class="invalid-feedback" style="display:block;">',"</div>");?>
			</div>


			<?php
			$atributos = array(
			'class'=>'select2 form-control custom-select select2-hidden-accessible',
			);
			?>
			<div class="form-group col-md-2 ">
				<label>Pais:</label>
				<?= 	form_dropdown('id_pais', $data_select_pais,set_value('id_pais'), $atributos); ?>
				<?php echo form_error('id_pais','<div class="invalid-feedback" style="display:block;">',"</div>");?>
				<span class="aclaracion">* Campo requerido</span>
			</div>
			<div class="form-group col-md-2 ">
				<label>Tipo Cámara:</label>
				<?= 	form_dropdown('camara', $camara,set_value('camara'), $atributos); ?>
				<?php echo form_error('camara','<div class="invalid-feedback" style="display:block;">',"</div>");?>
				<span class="aclaracion">* Campo requerido</span>
			</div>

		</div>
		<div class="row">
			<div class="form-group col-md-2">
				<label for="position-bottom-left">Color Provincia</label>
				<div class="minicolors minicolors-theme-bootstrap minicolors-position-bottom minicolors-position-left">
					<input  autocomplete="off" name="color" type="text" id="position-bottom-left" class="form-control demo minicolors-input_prov" data-position="bottom left" value="" size="7" value="<?= set_value('color')?>">
					<span class="minicolors-swatch minicolors-sprite minicolors-input-swatch">
						<span class="minicolors-swatch-color color" style="background-color:<?= set_value('color')?> ; opacity: 1;"></span></span>
					<div class="minicolors-panel minicolors-slider-hue" style="display: none;">
						<div class="minicolors-slider minicolors-sprite">
							<div class="minicolors-picker" style="top: 66.6667px;"></div>
						</div>
						<div class="minicolors-opacity-slider minicolors-sprite">
							<div class="minicolors-picker"></div>
						</div>
						<div class="minicolors-grid minicolors-sprite" style="background-color:<?= set_value('color')?> ;">
							<div class="minicolors-grid-inner"></div>
							<div class="minicolors-picker" style="top: 30px; left: 150px;">
								<div></div>
							</div>
						</div>
					</div>
				</div>
				<span class="aclaracion">* Campo requerido</span>
				<?php echo form_error('color','<div class="invalid-feedback" style="display:block;">',"</div>");?>
			</div>
			<div class="form-group col-md-3">
				<label>Habitantes: </label>
				<input type="text" class="form-control purchase-inputmask" name="habitantes" value="<?= set_value('habitantes')?>">
			</div>
			<div class="form-group col-md-3">
				<label>Superficie: </label>
				<input type="text" class="form-control purchase-inputmask" name="superficie" value="<?= set_value('superficie')?>">
			</div>
			<div class="form-group col-md-2">
			<label>Latitud: </label>
				<input type="text" class="form-control purchase-inputmask" name="latitud" value="<?= set_value('latitud')?>" >
			</div>			
			<div class="form-group col-md-2">
				<label>Longitud: </label>
				<input type="text" class="form-control purchase-inputmask" name="longitud" value="<?= set_value('longitud')?>" >
			</div>

		</div>
		<div class="row">

			<div class=" col-lg-6">
				<div class="form-group ">
					<?php
					$data = array(
						'class' => '',
					);
					echo form_label('Agregar Escudo:', 'escudo', $data);

					$data = array(
						'type'  => 'file',
						'name'  => 'escudo',
						'id'    => 'escudo',
						'class' => 'form-control ',
		//						'placeholder' =>	'Detalle categoría',
		//						'required'    => 	'required'
					);
					echo form_input($data);	
					echo form_error('escudo','<div class="invalid-feedback" style="display:block;">',"</div>");
					?>
				</div>
			</div>
		</div>
		<div class="row">

			<div class="form-group col-md-12 ">
				<label style="display: block;">Comentario </label>
				<textarea rows="6" style="width: 100%;" name="comentario" id="comentario"></textarea>
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