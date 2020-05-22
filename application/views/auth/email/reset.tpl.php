<html>

<body>
<!--	<img alt="Legislaturas Conectadas" src="http://www.legislaturasconectadas.gob.ar/static/web/images/logos/logo1.png" style="width: 80px; height: 33px;" />-->
	<p><? echo lang('email_forgot_password_link')?></p>
	<h2>
		<p> <?php echo  $nombre;?>, <?php echo $apellido; ?></p>
	</h2>
	<h2>

	</h2>
	<h3><?php printf(lang('email_forgot_password_heading'), $identity);?></h3>
	<h3><?php echo sprintf(lang('email_contraseña_temporal'), $temporal);?></h3>

	<p><?php echo anchor('auth/login_url?email='.$this->encryption->encrypt($identity).'&pass='.$this->encryption->encrypt($temporal), sprintf(lang('email_forgot_password_subheading'),$datoss),'style="text-decoration-line:none;border-radius:5px;padding:11px 23px;color:white;background-color:#2E64FE"');?></p>
<p></p>
<p></p>
<p></p>
	<p style="text-left: center;"><a href="http://www.legislaturasconectadas.gob.ar/">http://www.legislaturasconectadas.gob.ar/</a></p>

</body>

</html>
