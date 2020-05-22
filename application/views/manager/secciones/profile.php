<div class="col-md-8">
	<div class="card">
		<div class="card-body">
			<h5 class="card-title m-b-0">Datos del Usuario</h5>
			<div class="row">
				<div class="col-md-4">

					<div class="form-group m-t-20">
						<label>ID Usuario </label>
						<input type="text" class="form-control " id="date-mask" disabled value="<?=  $user->id; ?>">
					</div>
					<div class="form-group m-t-20">
						<label>Nombre y Apellido </label>
						<input type="text" class="form-control " id="date-mask" disabled value="<?=  $user->last_name .', '.$user->first_name; ?>">
					</div>

					<div class="form-group">
						<label>Username </label>
						<input type="text" class="form-control " id="phone-mask" value="<?= $user->username; ?>" disabled>
					</div>
				</div>
				<div class="col-md-6">

					<div class="form-group m-t-20">
						<label>Legislatura</label>
						<input type="text" class="form-control " name="legislatura" disabled value="<?=  $user->nombre_legislatura ?>">
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="text" class="form-control " name="email" disabled value="<?=  $user->email ?>">
					</div>
					<div class="form-group">
						<label>Teléfono <small class="text-muted"></small></label>
						<input type="text" class="form-control purchase-inputmask" id="purchase-mask" value="<?=  $user->phone ?>">
					</div>

				</div>
			</div>

		</div>
	</div>
</div>

<?php
	    $user_groups = $this->ion_auth->get_users_groups($user->id)->result();
//var_dump($user);
// echo $user->first_name;
?>
