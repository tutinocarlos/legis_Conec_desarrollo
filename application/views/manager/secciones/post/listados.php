<?php 	//var_dump($this->user);?>


<style>


</style>
<div class="row">
<!-- Column -->
	<?php if (!$this->ion_auth->is_members	()):?>
<div class="col-md-3 col-lg-2 col-xlg-3">
	<a href="<?= base_url('Manager/Post')?>">
		<div class="card card-hover">
			<div class="box  text-center" style="background-color: #00b19d;">
				<h1 class="font-light text-white"><i class="mdi mdi-pencil"></i></h1>
				<h6 class="text-white">Agregar Publicación</h6>
			</div>
		</div>
	</a>
</div>
<?php endif;	?>
<?php if ($this->ion_auth->is_super()):?>
<div class="col-md-3 col-lg-2 col-xlg-3">
	<a href="<?= base_url('Manager/Usuarios')?>">
		<div class="card card-hover">
			<div class="box  text-center bg-danger">
				<h1 class="font-light text-white"><i class="mdi mdi-account-multiple"></i></h1>
				<h6 class="text-white">Usuarios</h6>
			</div>
		</div>
	</a>
</div>
<?php endif;	?>

<!-- Column -->

</div>
<div class="col-md-12" data-select2-id="15">
	<div class="card">
		<div class="card-body">
			<h4 class="card-title">Publicaciones</h4>
			<?php 	echo $this->config->item('mi_variable');?>
			<div class="table-responsive">
				<div id="zero_config_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
					<table id="listados_post" class="display" style="width:100%">
						<thead>
							<tr>
								<th style="width:3%;">ID</th>
								<th>Tipos</th>
								<th style="width:400px;">Titulo</th>
								<th>Legislatura:</th>
								<th>Usuario:</th>
								<th>Editado:</th>
								<th>Estado:</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>ID</th>
								<th>Tipo</th>
								<th>Titulo</th>
								<th>Legislatura:</th>
								<th>Usuario:</th>
								<th>Editado:</th>
								<th>Estado:</th>
								<th>Acciones</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
