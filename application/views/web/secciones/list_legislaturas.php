<div class="business-banner">
	<div class="hvrbox">
		<img src="<?= base_url('static/web/images/slider/banner_paginas.png')?>" alt="Legislaturas Conectadas" class="hvrbox-layer_bottom">
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

<?php 

//$url = substr("http://www.example.com/elderly-care-advocacy/mental-capacity-act-advance-medical-directive.html", 7);
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";	
$url = substr($actual_link, 7);
// split the URL in parts
$parts = explode("/", $url);

// The second part (offset 1) is the part we look for
$segment = '';			 


// sitio remo 38
//	$segment = $parts[2];


//sitio local y 10.1.1.77
//$segment = $parts[1];

	switch ($_SERVER['SERVER_ADDR']) {
		case "127.0.0.1":
			if (count($parts) > 1) {
    		$segment = $parts[1];
			} else {
    		throw new Exception("Full URLs please!");
			}
      break;

    case "10.1.1.77":
			if (count($parts) > 1) {
    		$segment = $parts[1];
			} else {
    		throw new Exception("Full URLs please!");
			}
      break;
			
    case "10.1.1.38":
			if (count($parts) > 1) {
    		$segment = $parts[2];
			} else {
    		throw new Exception("Full URLs please!");
			}
      break;
		
		default:
			if (count($parts) > 1) {
		    $segment = $parts[1];
			} else {
    	throw new Exception("Full URLs please!");
			}			
	}

//transformo en objeto array no stdsclass			 
$legislaturas2 = json_decode(json_encode($legislaturas), true);			 
$provincias2 = json_decode(json_encode($provincias), true);			 

		 
$filterZona = '';
$filterTitleReload = '';			 
$urlLegis = '';
$filterColor = '';			 
if ($segment=='Provincias'){

	// sitio remo 38
	// $filterZona = $parts[3];
	// $filterProv = $parts[4];	

	//sitio local y 10.1.1.77
	//$filterZona = $parts[2];
	//$filterProv = $parts[3];

	switch ($_SERVER['SERVER_ADDR']) {
    
		case "127.0.0.1":
			$filterZona = $parts[2];
			$filterProv = $parts[3];
	
    	break;
					
		case "10.1.1.77":
			$filterZona = $parts[2];
			$filterProv = $parts[3];
	
    	break;
				
		case "10.1.1.38":
			$filterZona = $parts[3];
			$filterProv = $parts[4];
	
    	break;
			
		default:
		 $filterZona = $parts[2];
		 $filterProv = $parts[3];	
			
	}
	

	
	if (!empty($filterZona)){
		
		$offsetKey = 1; //<--- The offset you need to grab
		$filteredZone = search($provincias2, 'zona_provincia', $filterZona);
		/*
		echo '<pre>';
		print_r(search($legislaturas2, 'zona', $filterZona));
		echo '</pre>';		
		*/
		if (is_array($filteredZone)){
			$n = array_keys($parts); //<---- Grab all the keys of your actual array and put in another array
			$count = array_search($offsetKey, $n); //<--- Returns the position of the offset from this array using search
			$new_arr = array_slice($parts, 0, $count + 1, true);//<--- Slice it with the 0 index as start and position+1 as the length parameter.
			$filterColor = $filteredZone[0]['color_provincia'];
			//$new_arr = array_push($new_arr,'Legislaturas');
			$urlLegis = implode("/",$new_arr);
			$urlLegis = $urlLegis.'/Legislaturas';
			$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://";
			$filterTitleReload = '<div id="filterAlert" class="alert alert-info">Mostrando Organismos Parlamentarios de <strong>'.str_replace('-',' ',$filteredZone[0]['nombre_provincia']) .' </strong> <a id="clearFilter" class="btn btn-sm btn-warning pull-right" data-url="'.$protocol.$urlLegis.'" title="Limpiar Filtro y Mostrar Todas"><i class="fa fa-undo"></i></a></div>';
		}
		//saco provincias para reemplazar por Legislaturas
		
		
		
	}	
	//defino la url para cuando no quiero m
	
}			 
			 
//informacion de provincias para el mapa
$names = '';
$labels = '';	
$colors_regions = '';			 
$colors_camaras = '';	
$marker = "";			 
foreach ($provincias2 as $provincia){
	
	//marker para caba
	if ($provincia["zona_provincia"]=="AR-C"){
		$marker = "
		name: '".$provincia["nombre_provincia"]."',
		labels: '".$provincia["nombre_camara"]."',
		code: '".$provincia["zona_provincia"]."',
		style: {fill: '".$provincia["color_camara"]."', r:15}
		";
		
	}
	
	// maker para Islas Malvinas
	if ($provincia["zona_provincia"]=="AR-I"){
		$marker_1 = "
		name: '".$provincia["nombre_provincia"]."',
		labels: '".$provincia["nombre_camara"]."',
		code: '".$provincia["zona_provincia"]."',
		style: {fill: '".$provincia["color_camara"]."', r:15}
		";
		
	}
	
	
	$names .= "'".$provincia["zona_provincia"]."': '".$provincia["nombre_provincia"]."',
	";
	
	$labels .= "'".$provincia["zona_provincia"]."': '".$provincia["nombre_camara"]."',	
	";
	
	$colors_regions .= "'".$provincia["zona_provincia"]."': '".$provincia["color_provincia"]."',
	";
	
	$colors_camaras .= "'".$provincia["zona_provincia"]."': '".$provincia["color_camara"]."',
	";
}
			 
//var_dump($parts);			 
/*
echo '<pre>';
//print_r($parts);
print_r($new_arr);
echo '</pre>';
*/
function array_count($array, $key, $value = NULL) {
    // count($array[*][$key])
	//$array = get_object_vars($array);
	//if (!is_array($array)) continue;
    $c = 0;
    if (is_null($value)) {
        foreach ($array as $i=>$subarray) {
            $c += ($subarray[$key]!='');
        }
    } else {
        foreach ($array as $i=>$subarray) {
            $c += ($subarray[$key]==$value);
        }
    }
    return $c;
}	
			 

function to_lower_and_without_tildes( $str, $encoding = "UTF-8" ) {
	$str = preg_replace( '/&([^;])[^;]*;/', "$1", htmlentities( mb_strtolower( $str, $encoding ), null, $encoding ) );
	return $str;
}

			 
function search($array, $key, $value)
{
    $results = array();

    if (is_array($array)) {
        if (isset($array[$key]) && $array[$key] == $value) {
            $results[] = $array;
        }

        foreach ($array as $subarray) {
            $results = array_merge($results, search($subarray, $key, $value));
        }
    }

    return $results;
}

		 
			 
function cleanString($string) {
	// Tranformamos todo a minusculas	
	$string = mb_strtolower(trim($string),'UTF-8');
	//die($url);
	//Rememplazamos caracteres especiales latinos	
	$find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');	
	$repl = array('a', 'e', 'i', 'o', 'u', 'n');	
	$string = str_replace ($find, $repl, $string);
	
	// Añadimos los guiones	
	$find = array(' ', '&', '\r\n', '\n', '+');
	$string = str_replace ($find, '-', $string);
	
	// Eliminamos y Reemplazamos el resto de caracteres especiales	
	$find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');	
	$repl = array('','-','');
	
	$string = preg_replace ($find, $repl, $string);
	
	return $string;

}

$total = count((array)$legislaturas);
//echo $total;			 
//get_object_vars($legislaturas);
 
?>


<style>
	.business-title-left {
		padding-bottom: 0px;
		text-align: left;
	}

	.add_border {
		border-top: 2px solid #7f8386 !important;
		padding-top: 15px;
	}

	.add_border_detail {
		border-top: 1px dotted #e6e4e4 !important;
		padding-top: 25px;
		padding-bottom: 15px;
	}

	.clear_border {
		border-top: 0px solid #eee !important;
	}

	div.datos_legislatura {
		margin-left: 40px;
	}

/*
	div.map_container {
		height: 100%;
	}
*/

	.smart_map {
		width: 100%;
		height: 100%;
	}

</style>
<input type="hidden" id="filterto" value="<?php echo $filterZona ?>" />
<input type="hidden" id="filtercolor" value="<?php echo $filterColor ?>" />
<div class="padding-top-small"></div>
<div class="bussiness-about-company">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="col-md-12 listado">

					<?php 
					//var_dump($tipos_camaras);
					echo $filterTitleReload;
					$prov = '';
					$border = ''; 
			 		$borderDetail = '';
					$a = 0;	
					$countOrg = 0; //contador para dentro de la misma legis
					/*
					echo '<pre>';
			 		print_r($provincias);
			 		//echo '<hr>';
			 		//print_r(array_count_values($legislaturas['provincia']));
			 		echo '</pre>';
					*/
			 		$headerOrganismo = '';
			 		//echo array_count(json_decode($legislaturas,true),'provincia');
// echo array_search(91, array_keys($legislaturas, "id_legis"));

// die();
// echo '<pre>';
// var_dump($legislaturas);
// echo '</pre>';
			 		foreach($legislaturas as $legislatura){

			 			if($legislatura->id_legis != 91){   /// if para que no me muestr legislaturas conectadas como organismo de la Ciudad Autónoma de BSAS

						$organismos =  array_count($legislaturas2,'provincia',$legislatura->provincia);
						
						//echo $legislatura->provincia .' '.$organismos;
						//if ($organismos == $a) echo 'Ya esta.<hr>';
						
						$filterTitle = $legislatura->provincia;
						
						if ($legislatura->provincia == $prov){ //ya se guardo la enterior
								//nada
							$countOrg++;
							//if ($countOrg<$organismos) $borderDetail = '';
							if ($countOrg=$organismos) $borderDetail = 'add_border_detail'; 

							
							$headerOrganismo = '';
							
						}else{

							$border = 'add_border'; //son distintas agrego linea separadora
							$borderDetail = '';
							if($a == 0 ){//es la primera no lleva marcador
								$border = '';
							}

							++$a;
							
							$headerOrganismo = '
							<div class="business-title-left">
								<h2 class= "'.$border.'">'.	$legislatura->provincia	.' </h2>
								<span class="title-border-left"></span>
							</div>
							';
						
						}
				?>
					<div class="detalles_legis " data-filter2="<?php echo $legislatura->zona ; ?>" data-filter="<?php echo cleanString(to_lower_and_without_tildes($filterTitle)) ;?>">
						<div class="single-partner	">
							<?php 
							echo $headerOrganismo;
							?>
							<div class="media datos_legislatura <?php echo $borderDetail; ?> ">
								<div class="hover01">
									<?php 
									$segments = array('Legislatura',$legislatura->id_legis,convert_accented_characters(url_title($legislatura->nombre_legis), 'underscore', TRUE));
									?>
									<figure><a href="<?= base_url($segments) ?>"><img style="width:150px" class="img-fluid img-thumbnail" src="<?= base_url($legislatura->logo_legis)?>" alt="<?= $legislatura->nombre_legis?>"> <?php //echo $countOrg; ?></a>
									</figure>
								</div>
								<div class="media-body">
									<a href="<?= base_url($segments) ?>"><?= $legislatura->nombre_legis?></a>
									<p>
										<?= @$legislatura->lema_legis ?>
									</p>
									<p>Tipo de organismo: <strong><?= $legislatura->organismo ?> </strong>
									</p>
									<?php if ($legislatura->representantes > 0): ?>
										<p>
											<a href="<?= base_url($segments) ?>" style="font-size: 16px;">
												<div class="alert alert-info" role="alert">
                       		<i class="fa fa-users" style="color: #5a89a9; margin: 0 10px 0 0"></i>Ver <?= $legislatura->representantes?> Representantes
                      	</div>
                      </a>
										</p>
										
									<?php endif;?>

									<ul class="top-nav-social">
											<?php if($legislatura->facebook_legis != ''): ?>
											<li><a href="<?= $legislatura->facebook_legis ?>" class="facebook" target="_blank"> <i class="fa fa-facebook"></i> </a>
											</li>
											<?php endif;?>
											<?php if($legislatura->twitter_legis!= ''): ?>
											<li><a href="<?= $legislatura->twitter_legis ?>" class="twitter" target="_blank"> <i class="fa fa-twitter"></i> </a>
											</li>
											<?php endif;?>
											<?php if($legislatura->instagram_legis!= ''): ?>
											<li><a href="<?= $legislatura->instagram_legis ?>" class="instagram" target="_blank"> <i class="fa fa-instagram"></i> </a>
											</li>
											<?php endif;?>
											<?php if($legislatura->linkedin_legis!= ''): ?>
											<li><a href="<?= $legislatura->linkedin_legis ?>" class="linkedin" target="_blank"> <i class="fa fa-linkedin" ></i> </a>
											</li>
											<?php endif;?>
											<?php if($legislatura->youtube_legis != ''): ?>
													<li><a href="<?= $legislatura->youtube_legis ?>" class="youtube" target="_blank"> <i class="fa fa-youtube"></i> </a>
										</li>
										<?php endif;?>
										</ul>
									

								</div>
							</div>
						</div>
					</div>

					<?php 
						$countOrg = 0;
						$prov = $legislatura->provincia; 
						
					} // fin if si es legis conectadas id 91
				}//fin loop legislaturas
					?>


				</div>

			</div>

			<div class="col-md-4 text-center fixed">



				<div class="map_container">
					<div id="map" class="smart_map" style=""></div>
					<!--<div id="map_malvinas" class="smart_map" style="width:100%;height:100%"></div>-->
				<?php 
				$tipoCamara = '';
				foreach($tipos_camaras as $camara){
					
					$tipoCamara .= '
					<div class="row" style="margin-top: 30px ">
						<div class="col-md-2" style="background: '.$camara["color"].'"></div>
						<div class="col-md-10"> '.$camara["detalle"].'</div>
					</div>
					';
					
				}
				echo $tipoCamara;
				?>


				<div class="row" style="margin-top: 10px ">
					<div class="small"><i class="fa fa-info-circle"></i> <i>Puede pasar el puntero del mouse para interactuar con el mapa</i>
					</div>
				</div>
				</div>
<!--
				<div class="row " style="margin-top: 30px " id="alert-map">
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Holy guacamole!</strong> You should check in on some of those fields below.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				</div>
-->
				<!--					<img src="/static/web/images/argentina2.png" alt="" class="">-->
			</div>

		</div>
	</div>
</div>


<div class="padding-top-large"></div>




<script>
	<?php 
	
	// MArker_1 es el de las Islas Malvinas
	echo '
	var markers = [{
		latLng: [-34.67507287396606, -58.48608696658111],
		'.$marker.'	
		},{latLng: [-52.339707374582574, -57.83394451360341],
		'.$marker_1.'
		}
	];'
		;
	
	echo '
	var names = {
		'.$names.'  
	};
	';
	
	echo '
	var labels = {
		'.$labels.'
	};
	';
		
	echo '
	var colors_camaras = {
		'.$colors_camaras.'
	};
	';	
	
	echo '
	var colors_regions = {
		'.$colors_regions.'
	};
	';	
?>

</script>
