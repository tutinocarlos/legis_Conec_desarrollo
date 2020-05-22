<?php

	if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * CodeIgniter PHPMailer Class
 *
 * Esta clase habilita el correo electrónico SMTP con PHPMailer
 *
 * @category Libraries
 * @author CodexWorld
 * @link https://www.codexworld.com
 */

use  PHPMailer\PHPMailer\PHPMailer ;
use  PHPMailer\PHPMailer\Exception ;

class  PHPMailer_Lib
 {
    public function  __construct() {
         log_message ( 'Debug' ,  'La clase PHPMailer está cargada.' );
    }

    public function  load() {
         // Incluir los archivos de la bibliotecaPHPMailer 
					require_once  APPPATH .'third_party/PHPMailer/Exception.php';
					require_once  APPPATH .'third_party/PHPMailer/PHPMailer.php';
					require_once  APPPATH .'third_party/PHPMailer/SMTP.php';
        
        $mail  = new PHPMailer(true) ;
        return	$mail ;
    }
}
