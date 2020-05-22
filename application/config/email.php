<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

switch (gethostname()) {
		case "mysetup-PC":
		//			mail, sendmail, or smtp
			$config['protocol'] = 'smtp';
			$config['smtp_host'] = 'mail.mysetup.ar';
			$config['smtp_user'] = 'no-reply@mysetup.ar'; // correo sin espacio
			$config['smtp_pass'] = 'BwrR29p*M2';
        break;
		
		case "C303965":
//mail, sendmail, or smtp
			$config['protocol'] = 'smtp';
			$config['smtp_host'] = 'mail.mysetup.ar';
			$config['smtp_user'] = 'no-reply@mysetup.ar'; // correo sin espacio
			$config['smtp_pass'] = 'BwrR29p*M2';
        break;
			
		default:
			$config['protocol'] = 'sendmail';
			$config['smtp_host'] = '10.1.1.62';
			$config['smtp_user'] = 'dirivero@legislatura.gov.ar'; // correo sin espacio
			$config['smtp_pass'] = 'D3lolused';
			
	}





$config['smtp_debug']       = 1;// PHPMailer's SMTP debug info level: 0 = off, 1 = commands, 2 = commands and data, 3 = as 2 plus connection status, 4 = low level data output.
$config['debug_output']     = 'echo';   

$config['smtp_port'] = 25;
$config['smtp_timeout'] = '25'; // es lo minimo que puedo poner para que no de error de envio del correo
$config['charset'] = 'utf-8';
$config['newline'] = "\r\n";
$config['mailtype'] = 'html'; // or html
$config['validation'] = TRUE; // bool whether to validate email or not
 $config['smtp_crypto'] = 'tls';
 $config['dns'] = TRUE;
