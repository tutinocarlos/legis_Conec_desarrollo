<div class="" >
<div class="row">
<!-- Column -->
	<div class="col-sm-12 col-md-4">
	<a href="#" id="backup">
		<div class="card card-hover">
			<div class="box  text-center" style="background-color: #00b19d;">
				<h1 class="font-light text-white"><i class="mdi mdi-download"></i></h1>
				<h6 class="text-white">Realizar BackUp de Base de Datos</h6>
			</div>
		</div>
	</a>
</div>


<!-- Column -->

</div>

<div class="card">
		<div class="card-body">
			<h4 class="card-title m-b-0">BackUps Disponibles</h4>
		</div>
		<ul class="list-style-none" id="respaldos_legis">
			<style>

	a{
		font-size: 16;
		color: #3e5569;
	}
	.titulo{
		font-weight: bold;
	}
	.borrar{
		color: red;
/*		display: none;*/
	}
</style>
		

	<?php
				
		$archivos =  get_filenames('static/backup/');

		?>
		
		<?php foreach($archivos as $key=>$value):?>
			<li class="card-body  border-top" id="backup_<?= $key?>">
				<div class="row">
					<div class="col-md-1">
					<img src="<?= base_url('/static/manager/assets/images/zip.png')?>" alt="" class="img-responsive">
					</div>
					<div class="col-md-5 titulo">
	<a href="<?= base_url('static/backup/'.$value)?>" class="m-b-0 p-0" id="tutorial_1" download="<?= $value ?>">
						<?= $value ?>
		</a>
					</div>
					<div class="col-md-5">
					
					</div>
					
					<div class="col-md-1">
						<span>
								<i data-id="<?= $key?>" data-url="<?= 'static/backup/'.$value?>" class="fas fa-trash-alt borrar" title="Borrar"></i>
						</span>
					</div>
				</div>
		</li>
		<?php endforeach;?>
			</ul>
	</div>
	<div class="card">
	</div>
</div>



