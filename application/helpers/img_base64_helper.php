<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function img_base64($path) {

	// Extensión de la imagen
	$type = pathinfo($path, PATHINFO_EXTENSION);

	// Cargando la imagen
	$data = file_get_contents($path);

	// Decodificando la imagen en base64
	$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
	return  $base64;
}
