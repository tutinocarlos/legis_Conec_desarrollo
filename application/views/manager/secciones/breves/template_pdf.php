<table width="500" border="0" cellspacing="5" align="center">
	<tr>
		<td colspan="3" height="50"><img width="690" src="<?= base_url('static/manager/breves/pdf/copete.png');?>" alt="Legislaturas Conectadas"></td>
	</tr>
	<tr>
		<td colspan="3" align="left" height="10" style="padding:10px 0;font-size:12px; text-align:left;"><?php echo  $this->fecha ?></td>
	</tr>
		<tr>
		<td colspan="3" align="left" height="10" style="font-size:20px;"><h2 style="padding: 0 10px 0 0;"><?php echo  $titulo ?></h2></td>
	</tr>
	
	<?php 
  foreach($publicaciones as $data){
		
  ?>
	<tr>
		<td width="138" rowspan="1" valign="top" align="center">
		<img style="padding:5px;border-style: solid;
border-width: 2px 2px 2px 2px;
border-color: #599bb354;" 
	src="<?= base_url($data->imagen)?>" width="200" height="154" alt="Legislaturas Conectadas" />
	</td>
		<td width="337" height="10" colspan="2" valign="top" style="padding: 0 10px"><strong><?= $data->titulo ?></strong><br><?= word_limiter($data->cuerpo, 40)?>
		
		
			<?php
				if($data->id_tipo == 1){
					$segments = array('Publicacion',convert_accented_characters(url_title($data->titulo), 'underscore', TRUE),$data->fk_idpost);
				}else{
					$segments = array('Noticias',convert_accented_characters(url_title($data->titulo), 'underscore', TRUE),$data->fk_idpost);
				}
				?>
			<p><a href="	<?= base_url($segments)?>">Leer más</a></p>
		</td>
	</tr>
	<tr>
	
		<td colspan="3">
			<hr>
		</td>
	</tr>
	<?php
  };
  ?>
	<tr>
		<td colspan="3" ><img width="690" src="<?= base_url('static/manager/breves/pdf/pie.png')?>" alt="Legislaturas Conectadas"></td>
	</tr>
	
	<tr>
		<td colspan="3" align="center">
		<a style="font-size: 25px;" href="http://www.legislaturasconectadas.gob.ar/">www.legislaturasconectadas.gob.ar</a>
		</td>
	</tr>	
	<tr>
		<td colspan="3" align="center">
		<a style="
			background-color:#599bb3;
			display:inline-block;
			cursor:pointer;
			color:#ffffff;
			font-family:Arial;
			font-size:17px;
			padding:10px 10px;
			text-decoration:none;
			text-shadow:0px 0px 0px #3d768a;" 
	href="<?= base_url($adjunto)?>">Descargar versión PDF </a>
	</td>
	</tr>
	<tr>
		<td></td>
	</tr>
	<tr >
		<td colspan="3" align="center">Por favor, NO responda a este mensaje, es un envío automático.</td>
	</tr>
</table>
