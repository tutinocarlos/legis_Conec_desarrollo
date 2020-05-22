<html>

<body>
<!--	<img alt="Legislaturas Conectadas" src="http://www.legislaturasconectadas.gob.ar/static/web/images/logos/logo1.png" style="width: 80px; height: 33px;" />-->
	<p>Se ha creado un cuenta en el sitio Legislaturas Conectadas</p>
	<h2>
		<p>Bienvenido <?php echo  $nombre;?>, <?php echo $apellido; ?></p>
	</h2>
	<h2>
		<p>
			Organismo: <?php echo $legislatura ?>
		</p>
	</h2>
	<h3><?php echo sprintf(lang('email_activate_heading'), $identity);?></h3>
	<h3><?php echo sprintf(lang('email_contraseña_temporal'), $temporal);?></h3>

	<p><?php echo anchor('auth/activate/'. $id .'/'. $activation, lang('email_activate_link'),'style="text-decoration-line:none;border-radius:5px;padding:11px 23px;color:white;background-color:#2E64FE"');?></p>

	<p style="text-left: center;"><a href="http://www.legislaturasconectadas.gob.ar/">http://www.legislaturasconectadas.gob.ar/</a></p>

</body>

</html>
