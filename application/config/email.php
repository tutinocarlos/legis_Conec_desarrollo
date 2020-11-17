<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config['protocol'] = 'smtp';
// $config['mail_path'] = 'mail.mysetup.com.ar';
 $config['smtp_host'] = 'smtp.zoho.com';
// $config['smtp_port'] = 465;
 $config['smtp_port'] = 587;
 $config['smtp_user'] = 'webmaster@legislaturasconectadas.gob.ar';
 $config['smtp_pass'] = '_@4RoKTn';
 $config['charset'] = "utf-8";
 $config['mailtype'] = "html";
	$config['smtp_crypto'] = 'tls';
//	$config['smtp_crypto'] = 'ssl';
 $config['newline'] = "\r\n";