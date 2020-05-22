<div class="col-md-6" data-select2-id="15">
	<div class="card">
		<?php
		$attributes = array('class' => 'form-horizontal', 'id' => 'myform');
			echo form_open('/Manager/Subcategorias/grabar_sub_categorias',$attributes);
		?>
<!--		<form class="form-horizontal" action="/Manager/Contenidos/grabar_categorias" method="post">-->
			<div class="card-body">
				<h4 class="card-title">Nueva Sub-Categoría</h4>
				<div class="form-group row">
					<?php
						$data = array(
							'class' => 'col-sm-3 text-right control-label col-form-label',
						);
						echo form_label('Categoría:', 'categoria', $data);
					?>
					<div class="col-md-9">
						<select name="categoria" class="select2 form-control custom-select select2-hidden-accessible" style="width: 100%; height:36px;" data-select2-id="1" tabindex="-1" aria-hidden="true">
						<?php echo $select ?>
					</select>
					<span class="select2 select2-container select2-container--default select2-container--focus" dir="ltr" data-select2-id="2" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-v3bv-container"><span class="select2-selection__rendered" id="select2-v3bv-container" role="textbox" aria-readonly="true" title="Select"></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
					<div class="invalid-feedback is-invalid"></div>
					</div>
				</div>

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
						echo form_label('Detalle:', 'detalle', $data);
					?>
					<div class="col-sm-9">
						<?php

							$data = array(
								'name'  => 'detalle',
								'id'    => 'detalle',
								'class' => 'form-control',
								'value'	=> set_value('detalle')
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

<div class="col-md-12" data-select2-id="15">
	<div class="card">
		<div class="card-body">
			<h4 class="card-title">Sub-Categorías en tabla</h4>
			<div class="table-responsive">
				<div id="zero_config_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
					<table id="example" class="display" style="width:100%">
						<thead>
							<tr>
								<th>ID</th>
								<th>Nombre</th>
								<th>Categoria</th>
								<th>Estado</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>ID</th>
								<th>Nombre</th>
								<th>Categoria</th>
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

