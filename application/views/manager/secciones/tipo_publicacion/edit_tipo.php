<div class="card col-md-10">
		<?php
		$attributes = array('class' => 'form-horizontal', 'id' => 'myform');
			echo form_open('/Manager/Tipo_publicacion/update_tipo',$attributes);
		?>
<div class="card-body">
	<h5 class="card-title m-b-0">Editar Tipo de Publicación</h5>
	<div class="row">
	<div class="form-group col-md-1">
		
		<label>ID:</label>
		<input type="text" class="form-control date-inputmask" name="id_dato" value="<?= $data->id?> " disabled>
		<input type="hidden" class="form-control date-inputmask" name="id" value="<?= $data->id?> " >
	</div>
		<div class="form-group col-md-3">
		<label>Fecha Alta</label>
		<input type="text" class="form-control date-inputmask" name="fecha-alta"  value="<?= $data->fecha_ins?> " disabled>
	</div>
	
	<div class="form-group col-md-3">
		<label>Ultima Mod:</label>
		<input type="text" class="form-control phone-inputmask" name="fechaupd" value="<?= $data->fecha_upd?> "  disabled>
	</div>
	<div class="form-group col-md-3">
		<label>Usuario</label>
		<input type="text" class="form-control international-inputmask" name="usuarios"  value="<?= $data->first_name.','.$data->last_name?> " disabled>
	</div>
	</div>
	<div class="form-group">
		<label>Nombre </label>
		<input type="text" class="form-control xphone-inputmask" name="nombre"  value="<?= trim($data->nombre) ?>"  >
	</div>
	<div class="form-group">
		<label>Detalle </label>
		<input type="text" class="form-control purchase-inputmask" name="detalle"  value="<?= trim($data->detalle) ?>"  >
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

