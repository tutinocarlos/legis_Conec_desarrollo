<?php 
use PHPMailer\PHPMailer\PHPMailer ;
use PHPMailer\PHPMailer\Exception ;


function semdMailGmail($emailTo,$subject, $html,$attach=FALSE ){
	
require_once  APPPATH .'third_party/PHPMailer/Exception.php';
require_once  APPPATH .'third_party/PHPMailer/PHPMailer.php';
require_once  APPPATH .'third_party/PHPMailer/SMTP.php';
	$mail = new PHPMailer();
//Definir que vamos a usar SMTP
$mail->IsSMTP();
$mail->CharSet = 'UTF-8';
//Esto es para activar el modo depuración. En entorno de pruebas lo mejor es 2, en producción siempre 0
// 0 = off (producción)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug  = 0;
//Ahora definimos gmail como servidor que aloja nuestro SMTP
$mail->Host       = 'smtp.gmail.com';
//El puerto será el 587 ya que usamos encriptación TLS
$mail->Port       = 587;
//Definmos la seguridad como TLS
$mail->SMTPSecure = 'tls';
//Tenemos que usar gmail autenticados, así que esto a TRUE
$mail->SMTPAuth   = true;
//Definimos la cuenta que vamos a usar. Dirección completa de la misma
$mail->Username   = "legisconectadas.test@gmail.com";
//Introducimos nuestra contraseña de gmail
$mail->Password   = "chapazapata2021";
	
//Definimos el remitente (dirección y, opcionalmente, nombre)
$mail->SetFrom('legisconectadas.test@gmail.com', 'Legislaturas Conectadas');
//Esta línea es por si queréis enviar copia a alguien (dirección y, opcionalmente, nombre)
$mail->AddReplyTo('legislaturasconectadas.test@gmail.com','Legislaturas Conectadas');
//Y, ahora sí, definimos el destinatario (dirección y, opcionalmente, nombre)
$mail->AddAddress($emailTo, 'El Destinatario');
//Definimos el tema del email
$mail->Subject = $subject;
//Para enviar un correo formateado en HTML lo cargamos con la siguiente función. Si no, puedes meterle directamente una cadena de texto.
$mail->MsgHTML($html);
//Y por si nos bloquean el contenido HTML (algunos correos lo hacen por seguridad) una versión alternativa en texto plano (también será válida para lectores de pantalla)
$mail->AltBody = 'This is a plain-text message body';
//Enviamos el correo
if(!$mail->Send()) {
	$return  = array(
		"status"=> false,
		"error"=> $mail->ErrorInfo
	);
} else {
$retorno  = array(
		"status"=> true,
		"error"=> false
	);
}
	return $retorno;
}


function sendMail($emailTo,$subject, $html,$attach=FALSE ){


require_once  APPPATH .'third_party/PHPMailer/Exception.php';
require_once  APPPATH .'third_party/PHPMailer/PHPMailer.php';
require_once  APPPATH .'third_party/PHPMailer/SMTP.php';

	try{
	// Load PHPMailer library
	//$this->load->library('phpmailer_lib');

	// PHPMailer object
//	$mail = $this->phpmailer_lib->load();
 $mail  = new PHPMailer(true) ;
	$mail->CharSet = 'UTF-8';
		
	/*verifico que si es mail de legislatura los mande por smtp*/
	// List of allowed domains
	$allowed = [
		'legislatura.gov.ar'
	];

	$sendSMTP = true; //por default manda smtp

	if (filter_var($emailTo, FILTER_VALIDATE_EMAIL)){
		// Separate string by @ characters (there should be only one)
		$parts = explode('@', $emailTo);

		// Me quedo con el ultimo elemento del array del correo
		$domain = array_pop($parts);

		// me fijo si esta el dominio del correo en los permitidos
		if ( ! in_array($domain, $allowed))
		{
			// Not allowed
			$sendSMTP = false;
		}
	}

	if ($sendSMTP){
		$sale = "smtp";
		$mail->IsSMTP(); // tell the class to use SMTP
		//$mail->SMTPAuth = true; // enable SMTP authentication
		//$mail->SMTPSecure = "tls";
		$mail->Host = '10.1.1.62';
//		 $mail->SMTPAuth = true;
		$mail->Username = 'dirivero@legislatura.gov.ar';
		$mail->Password = 'D3loused';
//		$mail->Username = 'carlos.tutino@legislatura.gov.ar';
//		$mail->Password = 'xxxx';

		$mail->SMTPOptions = array(
		'ssl' => array(
		'verify_peer' => false,
		'verify_peer_name' => false,
		'allow_self_signed' => true
		)
		);

	}else{
		$sale = "sendmail";
		$mail->IsSendmail(); // tell the class to use Sendmail
		#$mail->Sendmail = '/usr/lib/sm.bin/sendmail';
	}

		// $mail->SMTPDebug = 1; //Alternative to above constant
	$mail->setFrom('dirivero@legislatura.gov.ar', 'legis conectadas test');
	$mail->addReplyTo('dirivero@legislatura.gov.ar','legis conectadas test');

	$mail->addAddress($emailTo);
		
	// Email subject
	$mail->Subject = $subject;

	// Set email format to HTML
	$mail->isHTML(true);

	// Email body content

	$mail->Body = $html;

	// Send email
	if(!$mail->send()){
		
		$status = false;
		$msg =  'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
		$metodo = $sale;

	}else{
		$status = true;
		$msg =  'Mensaje enviado ->';
		$metodo = $sale;
	}
	}catch ( phpmailerException $e ) {

		$msg = $translation->getTranslation('mail_not_sent').$e->errorMessage();
		$status = false;
	}

	return array('status'=>$status,'msg'=> $msg,'metodo'=>$metodo);
}



?>
