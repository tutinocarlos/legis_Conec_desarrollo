
<?php if($tutoriales):?>
		

		<?php foreach($tutoriales as $data):?>

		<?php ($data->video == 1) ? $png = "youtube.png" : $png ="pdf.png"; ?>
			<li class="card-body  border-top" id="tutorial_<?= $data->id ?>">
			<a href="<?= base_url('Manager/Tutoriales/visor/'.$data->video.'/'.$data->url) ?>" class="m-b-0 p-0" >
				<div class="row">
					<div class="col-md-1">
					<img src="<?= base_url('static/manager/tutoriales/iconos/'.$png)?>" alt="" class="img-responsive">
					</div>
					<div class="col-md-5 titulo">
						<?= $data->titulo ?> 
					</div>
					<div class="col-md-5">
						<?= $data->descripcion ?>
					
					</div>
					
					<div class="col-md-1 borrar" data-id="<?= $data->id ?>" data-video="<?= $data->video ?>" data-url="<?= $data->url ?>"	 >
					<?php
						if(!$this->ion_auth->is_members() && ($this->user->id_legislatura == 1 && $this->user->id_legislatura == 91) || $this->ion_auth->is_admin() && ($this->user->id_legislatura == 1 || $this->user->id_legislatura == 91)|| $this->ion_auth->is_super()):
						?>
						<i  class="fas fa-trash-alt borrar" title="Borrar" ></i>
						<?php endif;?>
					</div>
				</div>
		</a>
		</li>
	<?php endforeach;?>
<?php endif;?>