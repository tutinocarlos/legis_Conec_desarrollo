<?php


//var_dump($this->user); 

?>
<div class="col-md-6 col-lg-2 col-xlg-3">
	<a href="<?= base_url('Manager/Legislaturas/listado')?>">
		<div class="card card-hover">
			<div class="box  text-center" style="background: #f7aa47;">
				<h1 class="font-light text-white"><i class="mdi mdi-pencil"></i></h1>
				<h6 class="text-white">Envios Anteriores</h6>
			</div>
		</div>
	</a>
</div>
<div class="col-md-6 col-lg-2 col-xlg-3">
	<a href="<?= base_url('Manager/Breves/suscriptores')?>">
		<div class="card card-hover">
			<div class="box bg-info text-center" >
				<h1 class="font-light text-white"><i class="mdi mdi-pencil"></i></h1>
				<h6 class="text-white">Suscriptores</h6>
			</div>
		</div>
	</a>
</div>

	<div class="col-md-12" data-select2-id="15">
	<div class="card ">

		<?php
		
		$attributes = array('class' => 'form-horizontal',
												'id' => 'myform',
												'enctype'=>"multipart/form-data"
											 );
			echo form_open('/Manager/Breves',$attributes);
		?>
		<div class="card-body col-md-12 ">
			<h4 class="card-title"></h4>
			<div class="row">

				<div class="col-md-6">

					<!--					<label for="fname" class="col-sm-3 text-right control-label col-form-label">Nombre</label>-->
					<?php
						$data = array(
							'class' => '',
						);
						echo form_label('Título:', 'titulo', $data);
					?>
					<?php

							$data = array(
								'name'  => 'titulo',
								'id'    => 'titulo',
								'class' => 'form-control',
								'value' => set_value('titulo')
//								'placeholder' =>	'Nombre categoría',
//								'required'    => 	'required'
							);

							echo form_input($data);	
							echo form_error('titulo','<div class="invalid-feedback" style="display:block;">',"</div>");
						?>
						<input type="text" name="fecha_ins" value="<?= $this->fecha_now	 ?>">
						<span class="aclaracion">* Campo requerido</span>
				</div>

				<div class="col-md-3">
					<?php
						$data = array(
							'class' => '',
						);
						echo form_label('Fecha:', 'fecha', $data);


							$data = array(
								'name'  => 'fecha',
								'id'    => 'fecha',
								'class' => 'form-control',
								'value' => fecha_es($this->fecha_now),
								'readonly' => 'readonly'
							
//								'placeholder' =>	'Detalle categoría',
//								'required'    => 	'required'
							);

							echo form_input($data);	

							echo form_error('fecha','<div class="invalid-feedback" style="display:block;">',"</div>");
					?>
				</div>				
				<div class="col-md-3"></div>
			</div>

		<div style="margin-top: 30px;"><h4>Archivo (formato PDF)</h4></div>
			<div class="form-group row">

				<div class="col-sm-6">
					<?php
						$data = array(
							'class' => '',
						);
						echo form_label('archivo:', 'archivo', $data);

						$data = array(
							'type'  => 'file',
							'name'  => 'archivo',
							'id'    => 'archivo',
							'class' => 'form-control ',
							'value' => set_value('archivo'),
							'accept' =>'application/pdf',
//						'placeholder' =>	'Detalle categoría',
//						'required'    => 	'required'
						);

						echo form_error('archivo','<div class="invalid-feedback" style="display:block;">',"</div>");
						echo form_input($data);	

						?>
	<!-- <input type="text" class="form-control" name="detalle" placeholder="Last Name Here">-->
							<span class="aclaracion">Archivo requerido en formato PDF</span>
				</div>
			</div>

		</div>
	</div>
	<div class="border-top">
		<div class="card">
			<div class="card-body">
				<?php
					$data = array(
								'class'       => 	'btn btn-success',
							);
				
					 echo form_submit('botonSubmit', 'Enviar', $data);
				?>
				<!--					<button type="submit" class="btn btn-success ">Enviar</button>-->
			</div>
			<input type="hidden" id="iduser_ad" name="iduser_ad" value="<?= $this->user->id?>">
		</div>
	</div>
	<?php
			echo form_close();
		?>
</div>


