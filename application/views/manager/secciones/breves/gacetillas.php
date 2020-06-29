<?php
//var_dump($this->user); 
?>
<style>
	#send_gacetilla{
		cursor: pointer;
	}
</style>
<div class="card ">
	<div class="card-body">
		<div class="row">
			<div class="col-md-3">
				<div class="card card-hover">
					<div class="box  box bg-info text-center" style="background: #f7aa47;">
						<h1 class="font-light text-white"><i class=" far fa-file-alt"></i></h1>
						<h6 class="text-white"><span class="publicaciones_seleccionadas">0</span> Publicaciones Seleccionadas</h6>
					</div>
				</div>
			</div>
			<div class="col-md-3 ">
				<div class="card card-hover">
					<div class="box bg-info text-center">
						<h1 class="font-light text-white"><i class="fas fa-users"></i></h1>
						<h6 class="text-white"><span class="suscriptores_seleccionados">0</span> Suscriptores Seleccionados</h6>
					</div>
				</div>
			</div>
			<div class="col-md-3" id="send_gacetilla">
				<div class="card card-hover">
					<div class="box bg-success text-center">
						<h1 class="font-light text-white"><i class=" far fa-newspaper"></i></h1>
						<h6 class="text-white">Generar Newsletters</h6>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="card ">
	<div class="card-body">
		<div class="row" id="response_ajax">
			<?php // var_dump($_SESSION)?>
		</div>
	</div>
</div>

<?php

$attributes = array('class' => 'form-horizontal',
	'id' => 'myform',

);
echo form_open('/Manager/Breves/addGacetilla',$attributes);
?>
<div class="row">

	<div class="col-md-12 col-xl-12">
		<div class="card ">
			<div class="card-body">
				<h4 class="card-title">Asunto de la Gacetilla</h4>


				<!--					<label for="fname" class="col-sm-3 text-right control-label col-form-label">Nombre</label>-->
				<?php
				$data = array(
					'class' => '',
				);
				echo form_label('Asunto:', 'asunto', $data);
				?>
				<?php

				$data = array(
					'name'  => 'asunto',
					'id'    => 'asunto',
					'class' => 'form-control',
					'value' => set_value('asunto')
//								'placeholder' =>	'Nombre categoría',
//								'required'    => 	'required'
				);

				echo form_input($data);	
				?>
				<span id="asunto_error" class="invalid-feedback" style="display:block;"></span>
				<span class="aclaracion">* Campo requerido</span>
			</div>
		</div>
	</div>


</div>
<div class="row">
	<div class="col-md-12 col-xl-6">
		<div class="card">
			<form class="form-horizontal">
				<div class="card-body">
					<h4 class="card-title">Seleccione las publicaciones a incluir en la gecetilla</h4>
					<span id="publicaciones_error" class="invalid-feedback" style="display:block;"></span>
					<table id="dataTable_publicaciones" class="display">
						<thead>
							<tr>
								<th><input type="checkbox" id="selectAllPost" class="select-checkbox" data-tabla="dataTable_publicaciones"></th>
								<th>ID</th>
								<th style="width:400px;">Titulo</th>
								<th>Tipo</th>
								<th>Provincia</th>
							</tr>
						</thead>
						<tfoot>
						</tfoot>
					</table>
				</div>

			</form>
		</div>
	</div>

	<div class="col-md-12 col-xl-6">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Seleccione los suscriptores a incluir en la gecetilla</h4>
				<span id="suscriptores_error" class="invalid-feedback" style="display:block;"></span>
				<table id="dataTable_suscriptores" class="display" style="width:100%">
					<thead>
						<tr>
							<th><input type="checkbox" id="selectAllSuscriptores" class="select-checkbox" data-tabla="dataTable_suscriptores"></th>
							<th style="width:400px;">Nombre</th>
							<th>Email</th>
						</tr>
					</thead>
					<tfoot>
					</tfoot>
				</table>

			</div>
		</div>
	</div>

</div>

<?php
echo form_close();
?>
