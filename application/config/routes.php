<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['403_override'] = 'errors/forbidden';

$route['default_controller'] 					= 'home';
$route['Manager/formulario'] 							= 'Manager/manager/formulario';


$route['Legislaturas'] 								= 'home/legislaturas';
$route['Noticias'] 										= 'home/noticias';
$route['Noticias/(:num)$'] 						= 'home/noticias/$1';
$route['Noticias/(:any)/(:num)$'] 		= 'home/noticia/$1/$2';
$route['get_noticias/(:num)/(:num)'] 	= 'home/get_noticias/$1/$2';
$route['Publicaciones/(:num)/(:any)'] 				= 'home/publicaciones/$1/$2';
$route['Publicacion/(:any)/(:num)'] 	= 'home/publicacion/$1/$2';
$route['Provincias/(:any)/(:any)'] 	= 'home/legislaturas/$1/$2';
$route['Legislatura/(:num)/(:any)']					= 'home/get_legislatura_id/$1/$2';
$route['Legislaturas_conectadas/(:num)/(:any)']					= 'home/get_legislatura_id/$1/$2';
//$route['auth/login_url/(:any)/(:any)'] 	= 'Auth/login_url/$1/$2/';
//$route['auth/login_url/] 	= 'Auth/login_url';

// link listado noticias por categoria
$route['Categorias/(:any)/(:num)/(:any)/(:num)'] 	= 'home/categorias/$1/$2/$3/$4';

$route['Contacto'] 													= 'home/contacto';
$route['Links'] 													= 'home/links';

$route['reset_password'] 							= 'auth/change_password';
$route['Manager/login']									= 'Auth/login';
$route['Manager'] 														= 'Manager/Post/post_listados';
$route['Manager/Legislaturas'] 	= 'Manager/Legislaturas/grabar_datos';
$route['Manager/Post/add_media/([0-9]+)/([a-z_-]+)'] = 'Manager/Post/add_media';
$route['Manager/Post/Listados'] 	= 'Manager/Post/post_listados';
$route['Manager/profile'] 							= 'Manager/manager/profile';
$route['Manager/sub_categorias'] = 'Manager/Contenidos/sub_categorias';
$route['Manager/Ambito'] 								= 'Manager/Ambitos';
$route['Manager/Tematicas'] 					= 'Manager/Categorias';
$route['Manager/Paises'] 					= 'Manager/Paises';
$route['Manager/Tutoriales/visor/(:any)/(:any)'] 					= 'Manager/Tutoriales/visor/$1/$2';
$route['404_override'] 										= 'errors/error_404';
$route['translate_uri_dashes'] 		= FALSE;

