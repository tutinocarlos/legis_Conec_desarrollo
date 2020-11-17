<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function get_ip_address() {

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {

        $ip = $_SERVER['HTTP_CLIENT_IP'];

    } else {

        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {

            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];

        } else {

            $ip = $_SERVER['REMOTE_ADDR'];
        }
    }
	
return $ip;
}

	function format_dates($date) {
		$CI = & get_instance();
		$date = new DateTime($date);
		return $date->format('d/m h:m');
	}

function randon_password($cant_digitos){
	$random=substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, $cant_digitos);
	return $random;
}

function limpiar_caracteres($value=''){

$value = str_replace (' ','_',$value );
$textoLimpio = strtolower (preg_replace('([^A-Za-z0-9-_])', '', $value));	
	
	$textoLimpio = utf8_encode($textoLimpio);
	   $textoLimpio = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $textoLimpio
    );

    $textoLimpio = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $textoLimpio );

    $textoLimpio = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $textoLimpio );

    $textoLimpio = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $textoLimpio );

    $textoLimpio = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $textoLimpio );

    $textoLimpio = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç'),
        array('n', 'N', 'c', 'C'),
        $textoLimpio
    );
      return $textoLimpio;


}

function limpiar_url($cadena) {
$no_permitidas= array ("Nº","Ñ","ñ","á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹","[","]");
$permitidas= array ("Nro","N","ñ","a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E","_","_");
$texto = str_replace($no_permitidas, $permitidas ,$cadena);
return $texto;
}

function random($cantidad){

	return	$randomNum=substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, $cantidad);
	
}
