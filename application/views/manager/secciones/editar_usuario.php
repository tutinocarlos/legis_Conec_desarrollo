<?php 
//echo validation_errors();
//echo validation_errors();
?>
<div class="col-md-12 card">
	<?php
		$attributes = array('class' => 'form-horizontal',
												'id'           => 'myform',
												'autocomplete' => "off"
												
											 );
			echo form_open('/Manager/Usuarios/grabar_datos',$attributes);
		?>
	</div>
	<div class="card-body">
		<h5 class="card-title m-b-0">Edición de Usuario</h5>
		<div class="row">
			<div class="col-md-8">
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
			
	<div class="form-group col-md-4">
			<label class="">Tipo de Usuario</label>
			<div class="col-md-9">
			<?php foreach ($groups as $group):?>
				<div class=" mr-md-2">
					<input type="checkbox" class="custom-checkbox"  name="grupo[]" value="<?= $group['id']?>">
					<label class="" name="grupo" for=""><?= $group['description']?></label>
				</div>
					<?php endforeach ?>
					<?php 	echo form_error('grupo','<div class="invalid-feedback" style="display:block;">',"</div>"); ?>
			</div>
		</div>
	</div>
			<!--
			<div class="col-lg-8 col-md-12">
				<input type="text" class="form-control is-invalid" id="validationServer01">
				<div class="invalid-feedback">
					Please correct the error
				</div>
			</div>
-->

<!--

			<div class="col-md-4">
				<div class="form-group m-t-20">
					<label>Tipo Usuario:</label>
					<select name="grupo" class="select2 form-control custom-select select2-hidden-accessible" style="width: 100%; height:36px;" data-select2-id="1" tabindex="-1" aria-hidden="true">
						<option value="">-SELECCIONAR-</option>
						<?php //foreach ($groups as $group):?>
						<option name="grupo_usuario" value="<?php //echo $group['id'];?>"><?php //echo $group['description'];?></option>
						<?php //endforeach ?>
					</select>
					<?php
						//echo form_error('grupo','<div class="invalid-feedback" style="display:block;">',"</div>");
					?>
				</div>
			</div>
-->
		
		<style>
		
			.custom-checkbox{
				display: inline;
			}
		
		</style>


		
		<div class="row">
			<div class="col-md-4">

				<div class="form-group m-t-20">
					<label>Nombre</label>
					<input type="text" class="form-control" name="first_name" id="first_name" value="<?php  echo set_value('first_name');?>">
					<?php
						echo form_error('first_name','<div class="invalid-feedback" style="display:block;">',"</div>");
					?>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group m-t-20">
					<label>Apellido:</label>
					<input type="text" class="form-control date-inputmask" name="last_name" id="last_name" value="<?php  echo set_value('last_name');?>">
					<?php
						echo form_error('last_name','<div class="invalid-feedback" style="display:block;">',"</div>");
					?>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group m-t-20">
					<label>Email:</label>
					<input type="text" class="form-control phone-inputmask" name="email" id="email" value="<?php  echo set_value('email');?>">
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
					<input type="text" class="form-control " name="usuario" id="usuario" value="<?php  echo set_value('usuario');?>">
					<?php
						echo form_error('usuario','<div class="invalid-feedback" style="display:block;">',"</div>");
					?>
				</div>
			</div>
			<div class="col-md-8">
				<div class="form-group m-t-20">
					<label>Contraseña:</label>
					<input name="password" id="password" type="text" class="form-control" value="El campo NO es requerido por default es: password" readonly>
					<?php
						echo form_error('password','<div class="invalid-feedback" style="display:block;">',"</div>");
					?>
					<span class="aclaracion">Al primer ingreso del usuario se le pedirá que actualice su contraseña</span>
				</div>
			</div>
			<div class="col-md-4 invisible">
				<div class="form-group m-t-20">
					<label>Repetir Contraseña</label>
					<input name="re-password" id="re-password" type="password" class="form-control ">
					<?php
						echo form_error('re-password','<div class="invalid-feedback" style="display:block;">',"</div>");
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
<div class="card col-md-12">

	<br>
	<div class="col-md-12 " data-select2-id="15">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Datos Tabla</h4>
				<div class="table-responsive">
					<div id="zero_config_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
						<table id="example" class="display" style="width:100%">
							<thead>
								<tr>
									<th>ID</th>
									<th>Usuario</th>
									<th>Nombre</th>
									<th>Email</th>

									<th>Estado</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>ID</th>
									<th>Usuario</th>
									<th>Nombre</th>
									<th>Email</th>

									<th>Estado</th>
									<th>Acciones</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
