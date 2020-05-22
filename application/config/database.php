<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;


	switch ($_SERVER['REMOTE_ADDR']) {

    case "127.0.0.1":
			
			$db_database = 'proyecto';
			$db_server = 'localhost';
			$db_user = 'root';
			$db_pass = '';
    break;

		case "10.1.1.38":
			$db_database = 'proyecto';
			$db_server = 'localhost';
			$db_user = 'admin';
			$db_pass = 'admin@!';
    break;
			
		case "10.1.1.77":
			$db_database = 'legis_conectadas';
			$db_server = 'localhost';
			$db_user = 'webdesa';
			$db_pass = 'W3bD3s@!';
    break;
						
		default:
			$db_database = 'proyecto';
			$db_server = '10.1.1.38';
			$db_user = 'admin';
			$db_pass = 'admin';
			
	}

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => $db_server,
	'username' => $db_user,
	'password' => $db_pass,
	'database' => $db_database,
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
