<?php if(!$this->ion_auth->is_members()):?>
<div class="col-md-6" data-select2-id="15">
	<div class="card">
		<?php
		$attributes = array('class' => 'form-horizontal', 'id' => 'myform');
			echo form_open('/Manager/Tipo_publicacion/grabar_datos',$attributes);
		?>
		<!--		<form class="form-horizontal" action="/Manager/Contenidos/grabar_categorias" method="post">-->
		<div class="card-body">
			<h4 class="card-title"> Tipo de Publicación</h4>
			<div class="form-group row">

				<!--					<label for="fname" class="col-sm-3 text-right control-label col-form-label">Nombre</label>-->
				<?php
						$data = array(
							'class' => 'col-sm-3 text-right control-label col-form-label',
						);
						echo form_label('Nombre:', 'nombre', $data);
					?>
				<div class="col-sm-9">
					<?php

							$data = array(
								'name'  => 'nombre',
								'id'    => 'nombre',
								'class' => 'form-control',
								'value' => set_value('nombre')
//								'placeholder' =>	'Nombre categoría',
//								'required'    => 	'required'
							);

								echo form_input($data);	

						?>
					<div class="invalid-feedback is-invalid">

					</div>
				</div>

			</div>
			<div class="form-group row">
				<?php
						$data = array(
							'class' => 'col-sm-3 text-right control-label col-form-label',
						);
						echo form_label('Nombre en Plural:', 'prulal', $data);
					?>
				<div class="col-sm-9">
					<?php

							$data = array(
								'name'  => 'detalle',
								'id'    => 'detalle',
								'class' => 'form-control',
								'value' => set_value('nombre')
//								'placeholder' =>	'Detalle categoría',
//								'required'    => 	'required'
							);

								echo form_input($data);	

						?>
					<!--						<input type="text" class="form-control" name="detalle" placeholder="Last Name Here">-->
				</div>
			</div>


			<span>

				<?php

								echo validation_errors('<span style="color:red;">', '</span><br>');
							?>
			</span>
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
		<?php
			echo form_close();
		?>
	</div>
</div>

<?php endif;?>
<div class="col-md-12" data-select2-id="15">
	<div class="card">
		<div class="card-body">
			<h4 class="card-title">Tipo de Publicación</h4>
			<div class="table-responsive">
				<div id="zero_config_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
					<table id="example" class="display" style="width:100%">
						<thead>
							<tr>
								<th style="width:3%;">ID</th>
								<th>Nombre</th>
								<th>Detalle</th>
								<th>Estado</th>
								<th style="text-align: right;">Acciones</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th style="width:3%;">ID</th>
								<th>Nombre</th>
								<th>Detalle</th>
								<th>Estado</th>
								<th style="text-align: right;">Acciones</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
