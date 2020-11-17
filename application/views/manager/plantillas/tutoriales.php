
<?php

if($tutoriales):?>
		

		<?php foreach($tutoriales as $data):?>

		<?php ($data->video == 1) ? $png = "youtube.png" : $png ="pdf.png"; ?>
			<li class="card-body  border-top" id="tutorial_<?= $data->id ?>">
				<div class="row">
					<div class="col-md-1">
			<a href="<?= base_url('Manager/Tutoriales/visor/'.$data->video.'/'.$data->url) ?>" class="m-b-0 p-0" >
					<img src="<?= base_url('static/manager/tutoriales/iconos/'.$png)?>" alt="" class="img-responsive">
		</a>
					</div>
					
					<div class="col-md-4">
			<a href="<?= base_url('Manager/Tutoriales/visor/'.$data->video.'/'.$data->url) ?>" class="m-b-0 p-0" >
					<strong>	<?= $data->titulo ?></strong>
						</a> 
					</div>			
					<div class="col-md-4">
			<a href="<?= base_url('Manager/Tutoriales/visor/'.$data->video.'/'.$data->url) ?>" class="m-b-0 p-0" >
						<?= $data->descripcion ?>
						</a>
							</div>
				
					
				
					<?php
						if($this->ion_auth->is_super()):
						?>
						<div class="col-md-1">
					<a style="color: white;" href="#" data-url="<?= $data->url?>" data-id="<?= $data->id ?>" data-video="<?= $data->video ?>"  class="borrar_tutorial btn btn-danger btn-xs"><i class="fas fa-trash-alt" title="Borrar"></i> </a>
							
						</div>
						<?php endif;?>

				</div>
		</li>
	<?php endforeach;?>
<?php endif;?>