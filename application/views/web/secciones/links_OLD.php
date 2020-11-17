<a href=""></a>
<?php /*
object(stdClass)#98 (9) {
    ["nombre_legis"]=>
    string(34) "Honorable Legislatura  de Tucumán"
    ["logo_legis"]=>
    string(41) "/static/web/images/logos_/103_tucuman.png"
    ["direccion_legis"]=>
    string(64) "Ildefonso de las Muñecas 951 - San Miguel de Tucumán (CP 4000)"
    ["telefono_legis"]=>
    string(16) "+54 381 450 5200"
    ["email_legis"]=>
    string(41) "parlamentaria@legislaturadetucuman.gob.ar"
    ["url_normativas"]=>
    string(22) "https://bit.ly/2Dl9wLB"
    ["nombre_provincia"]=>
    string(9) "Tucumán "
    ["color_camara"]=>
    string(7) "#CBE7F7"
    ["organismo"]=>
    string(11) "Legislatura"
	*/
//echo '<pre>';
//var_dump($links);
//echo '</pre>';
//die();
?>
<style>
	.add_border {
		border-top: 2px solid #7f8386 !important;
		padding-top: 15px;
	}
	.business-title-left{
		padding-bottom: 5px!important;
	}
	.nombre_legis{
		font-size: 16px;
		font-weight: bold;
	}
	.padding{
			padding: 10px 0 10px 0;
	}

</style>
<div class="business-banner">
	<div class="hvrbox">
		<img src="<?= base_url('static/web/images/slider/banner_paginas.png')?>" alt="Mountains" class="hvrbox-layer_bottom">
		<div class="hvrbox-layer_top">
			<div class="container">
				<div class="overlay-text text-center">
					<h3>
						<?= $titulo_seccion?>
					</h3>

				</div>
			</div>
		</div>
	</div>
</div>
<div class="bussiness-contact-form">
	<div class="container">
		<div class="">
			<!--		-->
				<div class="single-partners	" style="text-align: left;">
				<div class="padding-top-large"></div>
<!--
				  object(stdClass)#88 (5) {
    ["url"]=>
    string(5) "link4"
    ["titulo"]=>
    string(5) "link4"
    ["nombre legis"]=>
    string(50) "Legislatura de la Ciudad Autónoma de Buenos Aires"
    ["provincia"]=>
    string(42) "Ciudad Autónoma de Buenos Aires          "
    ["organismo"]=>
    string(11) "Legislatura"
  }
-->
				<?php 
					$legis ='';
					$prov ='';
					$border = ''; 
					$borderDetail = '';
						
							foreach($links as $link){
								
							$headerProv = 	'<div class="business-title-left padding">
								<h2 class= "'.$border.'">'.	$link->provincia.' </h2>
							
							</div>';

								if ($link->provincia == $prov){
									$headerProv ='';
								}else{
									
									$border = 'add_border';
								};

								echo $headerProv;
								
								$nlegis = $link->nombre_legis;
								if($link->nombre_legis == $legis){
									$nlegis ='';
								}

								echo '<div class="media-body nombre_legis ">'.$nlegis.'</div>';
								
							//	echo '<div class="row"><div class="col-md-6 ">'.$link->titulo.'</div><div class="col-md-6 ">'.$link->url.'</div></div>';
								echo '<div class="row"><div class="col-md-6 "><a href="'.$link->url.'" target="_blank"	>'.$link->titulo.'</a></div></div>';

								$legis = $link->nombre_legis; 
								$prov = $link->provincia; 
							};// fin loop legislaturas
				?>
				</div>
				
				

			<!--		-->
		</div>
	</div>

</div>
			<div class="padding-top-large"></div>
<script>
	var base_url = '<?= base_url()?>';
</script>