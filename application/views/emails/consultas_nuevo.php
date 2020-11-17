
<div style="background: #f6f6f6; font-family: sans; padding: 20px 40px; width:100%;">
	<div style="padding: 5px; margin: 0;background-color: #FFF;text-align: center;"><img src="http://www.legislaturasconectadas.gob.ar/static/web/images/logos/LC_logo_email.jpg" alt="Legislaturas Conectadas " width="100px" /></div>
	<div style=" font-family:'myriad-pro',Arial,Helvetica,sans-serif;text-align:center;margin: 0; background-color: #0074c1; padding: 5px 10px; border-bottom: 1px #f3f3f3 solid; color: #FFF; font-weight: bold;">
	<h3><?php echo $subject; ?></h3>
	</div>
	<div style="font-family:'myriad-pro',Arial,Helvetica,sans-serif;background: #FFF; margin: 0; padding: 10px;">
		<?php foreach($datos as $key => $val ): ?>
		<p><strong><?php echo strtoupper($key);?> : </strong><?php echo  utf8_decode($val);?></p>
		<?php endforeach; ?>
	</div>
	<div style="text-align:center; font-family:'myriad-pro',Arial,Helvetica,sans-serif;padding:10px 0;">
	<p>nuestras redes sociales</p>
	
	<div style="display: inline-block;"><a href="https://www.facebook.com/legislaturas.conectadas.arg">
		<img src="http://www.legislaturasconectadas.gob.ar/static/web/images/logos/redes/facebook.png" alt="Facebook">
		</a></div>
	<div style="display: inline-block;"><a href="https://twitter.com/lconectadas?lang=es">
		<img src="http://www.legislaturasconectadas.gob.ar/static/web/images/logos/redes/twitter.png" alt="twitter">
		</a></div>
	<div style="display: inline-block;"><a href="https://www.instagram.com/legislaturasconectadas/?hl=es-la">
		<img src="http://www.legislaturasconectadas.gob.ar/static/web/images/logos/redes/instagram.png" alt="instagram">
		</a></div>
	<div style="display: inline-block;"><a href="https://www.youtube.com/channel/UC5ACdrMW0Q8GubYtDoD2Gqg">
		<img src="http://www.legislaturasconectadas.gob.ar/static/web/images/logos/redes/youtube.png" alt="youtube">
		</a></div>
	</div>
		<div style="font-family:'myriad-pro',Arial,Helvetica,sans-serif;text-align:center;margin: 0; background-color: #0074c1; padding: 5px 10px; color: #FFF; font-weight: bold;"><a style="color:#fff" href="mailto:info@legislaturasconectadas.gob.ar">info@legislaturasconectadas.gob.ar</a></div>

		<div style="font-family:'myriad-pro',Arial,Helvetica,sans-serif;text-align:center;margin: 0; background-color: #0074c1; padding: 5px 10px; border-bottom: 1px #f3f3f3 solid; color: #FFF; font-weight: bold;">
		<div>
		<a style="color:#fff" href="http://www.legislaturasconectadas.gob.ar">www.legislaturasconectadas.gob.ar</a>
		</div>
	</div>
</div>