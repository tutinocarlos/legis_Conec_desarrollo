<?php 
use PHPMailer\PHPMailer\PHPMailer ;
use PHPMailer\PHPMailer\Exception ;



function sendemails($emailTo,$subject, $html,$attach=FALSE ){
	
	
require_once  APPPATH .'third_party/PHPMailer/Exception.php';
require_once  APPPATH .'third_party/PHPMailer/PHPMailer.php';
require_once  APPPATH .'third_party/PHPMailer/SMTP.php';

	try{

 $mail  = new PHPMailer(true) ;
	$mail->CharSet = 'UTF-8';

		$emailLegis = true;
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
			$emailLegis = false;
			$sendSMTP = false;
		}
	}

	if ($sendSMTP){
		
			$mail->IsSMTP(); // tell the class to use SMTP
		if($emailLegis){
echo 'tiene que xenciar legislatura'; die();
			$sale = "smtp";
			//$mail->SMTPAuth = true; // enable SMTP authentication
			//$mail->SMTPSecure = "tls";
			$mail->Host = '10.1.1.62';
	//		 $mail->SMTPAuth = true;
			$mail->Username = 'carlos.tutino@legislatura.gov.ar';
			$mail->Password = '1826';
		// $mail->SMTPDebug = 1; //Alternative to above constant
	$mail->setFrom('carlos.tutino@legislatura.gov.ar', 'legis conectadas test');
	$mail->addReplyTo('carlos.tutino@legislatura.gov.ar','legis conectadas test');

			$mail->SMTPOptions = array(
			'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true
			)
			);
		}else{
echo 'tiene que enciar de aca s'; die();
		$mail->Host = 'mail.carlostutino.com';
		$mail->SMTPAuth = true;
		$mail->SMTPKeepAlive = true; // SMTP connection will not close after each email sent, reduces SMTP overhead
		$mail->Port = 25;
		$mail->Username = 'no-reply@carlostutino.com';
		$mail->Password = 'Barbara2020';
		$mail->setFrom('no-reply@carlostutino.com', 'List manager');
		$mail->addReplyTo('no-reply@carlostutino.com', 'List manager');
		$mail->Subject = 'PHPMailer Simple database mailing list test';

			
		}
	}else{
		
		echo 'tiene que enciar por otro lado'; die();
		$sale = "sendmail";
		$mail->IsSendmail(); // tell the class to use Sendmail
		$mail->Host = 'mail.carlostutino.com';
		$mail->SMTPAuth = true;
		$mail->SMTPKeepAlive = true; // SMTP connection will not close after each email sent, reduces SMTP overhead
		$mail->Port = 25;
		$mail->Username = 'no-reply@carlostutino.com';
		$mail->Password = 'Barbara2020';
		$mail->setFrom('no-reply@carlostutino.com', 'List manager');
		$mail->addReplyTo('no-reply@carlostutino.com', 'List manager');
		$mail->Subject = 'PHPMailer Simple database mailing list test';
		#$mail->Sendmail = '/usr/lib/sm.bin/sendmail';
	}


		
//	foreach($emailTo as $email => $name){
//			$mail->addAddress($email, $name);
//	}	

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

	return array('status'=>$status,'msg'=> $msg,'metodo'=>$metodo,'emaillegis'=>$emailLegis);
}



?>
