
<div class="card col-md-10">
		<?php
		$attributes = array('class' => 'form-horizontal', 'id' => 'myform');
			echo form_open('/Manager/Categorias/update_categoria',$attributes);
		?>
<div class="card-body">
	<h5 class="card-title m-b-0">Editar Temática</h5>
	<div class="row">
	<div class="form-group col-md-1">
		
		<label>ID:</label>
		<input type="hidden" class="form-control date-inputmask" name="id" value="<?= $id?> " >
		<input type="text" class="form-control date-inputmask" name="id_cat" value="<?= $id?> " disabled>
	</div>
		<div class="form-group col-md-3">
		<label>Fecha Alta</label>
		<input type="text" class="form-control date-inputmask" name="fecha-alta"  value="<?= $fecha_ins?> " disabled>
	</div>
	
	<div class="form-group col-md-3">
		<label>Ultima Mod:</label>
		<input type="text" class="form-control phone-inputmask" name="fechaupd" value="<?= $fecha_upd?> "  disabled>
	</div>
	<div class="form-group col-md-3">
		<label>Usuario</label>
		<input type="text" class="form-control international-inputmask" name="usuarios"  value="<?= $first_name.','.$last_name?> " disabled>
	</div>
	</div>
	<div class="form-group">
		<label>Nombre </label>
		<input type="text" class="form-control xphone-inputmask" name="nombre"  value="<?= $nombre ?> "  >
	</div>
	<div class="form-group">
		<label>Detalle </label>
		<input type="text" class="form-control purchase-inputmask" name="detalle"  value="<?= $detalle?> "  >
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
