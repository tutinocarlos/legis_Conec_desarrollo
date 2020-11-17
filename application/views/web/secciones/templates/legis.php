<?php 

//var_dump($legis);

?>

<div class="single-app-present">

	<div class="media">
		<span class="animatedhover pulse"><img src="<?= base_url().$legis->logo ?>" alt="" class=""></span>
		<div class="media-body">
			<h2><?= $legis->nombre?></h2>
		</div>
	</div>
</div>



<style>
	div.login_curso label{
		display: block;
	}
</style>
	
<div class="container login_curso">
	<form action="" method="post">
		<div class="col-md-6"> <label for="usuario"><b>Usuario</b></label>
			<input type="text" placeholder="Enter usuario" name="usuario" required>
			<label for="contraseña"><b>Contraseña</b></label>
			<input type="password" placeholder="Enter Password" name="contraseña" required>
			<button type="submit">Acceder al material del curso</button></div>
		<div class="col-md-6">2</div>
	</form>
</div>

