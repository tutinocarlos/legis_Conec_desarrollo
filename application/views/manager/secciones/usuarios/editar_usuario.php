<?php
		$attributes = array('class' 				=> 'form-horizontal',
												'id'           	=> 'myform',
												'autocomplete' 	=> "off"
												
											 );

			echo form_open('/Manager/Usuarios/editar',$attributes);
		?>

<div class="card-body">
	<h5 class="card-title m-b-0">Edición de Usuario</h5>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group m-t-20">
				<label>Legislatura:</label>

				<select id="legislatura" name="legislatura" class="select2 form-control custom-select select2-hidden-accessible" style="width: 100%; height:36px;" data-select2-id="1" tabindex="-1" aria-hidden="true">
					<?php echo $select ?>
				</select>
			</div>

			<?php
						echo form_error('legislatura','<div class="invalid-feedback" style="display:block;">',"</div>");
					?>

		</div>

		<div class="col-md-4 ">
			<div class="form-group ">
				<h5></h5>
				<label class="">Tipo de Usuario</label>
				<div>
					<?php
				 foreach($grupos as $grupo){
				 echo form_label($grupo['label'], $grupo['name']);
				 echo form_radio($grupo) ;

				 }
				?>
					<?php 	echo form_error('grupo','<div class="invalid-feedback" style="display:block;">',"</div>"); ?>
				</div>
			</div>
		</div>
	</div>



	<style>
		.custom-checkbox {
			display: inline;
		}

	</style>



	<div class="row">
		<div class="col-md-3">
			<div class="form-group m-t-20">
				<label>ID de Usuario</label>
				<input type="text" class="form-control" name="id_usuario" id="id_usuario" readonly="readonly" value="<?php  echo $usuario->id;?>">
			</div>
		</div>
		<div class="col-md-3">

			<div class="form-group m-t-20">
				<label>Nombre</label>
				<input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo $usuario->first_name; echo set_value($usuario->first_name);?>">
				<?php
						echo form_error('first_name','<div class="invalid-feedback" style="display:block;">',"</div>");
					?>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group m-t-20">
				<label>Apellido:</label>
				<input type="text" class="form-control date-inputmask" name="last_name" id="last_name" value="<?php echo $usuario->last_name;  ?>">
				<?php
						echo form_error('last_name','<div class="invalid-feedback" style="display:block;">',"</div>");
					?>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group m-t-20">
				<label>Email:</label>
				<input type="text" class="form-control phone-inputmask" name="email" id="email" value="<?php echo $usuario->email; ?>">
				<?php
						echo form_error('email','<div class="invalid-feedback" style="display:block;">',"</div>");
					?>

			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">

			<div class="form-group m-t-20">
				<label>Usuario:</label>
				<input type="text" class="form-control " name="usuario" id="usuario" value="<?php echo $usuario->username; ?>">
				<?php
						echo form_error('usuario','<div class="invalid-feedback" style="display:block;">',"</div>");
					?>
			</div>
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
		</div>
	</div>
	<?php
	echo form_close();
?>
</div>
