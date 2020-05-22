<?php
//application/controllers/usuarios.php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Testm extends MY_Controller {
 
	function __construct(){
		parent::__construct();
	}
	
	
		public function index(){
			
			
// sendMail($emailTo,$Subject, $html,$attach=FALSE )
			
			$result = sendMail('tutinocarlos@gmail.com','pipimi', 'hola');
			
			
			var_dump($result);
			
			
			// correo a enviar
//			$enviarA = array(
//				'tutinocarlos@gmail.com',
//				'carlos.tutino@legislatura.gov.ar'
//			
//			);
//
//				foreach($enviarA as $emailTo){
//			// Load PHPMailer library
//			$this->load->library('phpmailer_lib');
//
//			// PHPMailer object
//			$mail = $this->phpmailer_lib->load();
//
//					
//			/*verifico que si es mail de legislatura los mande por smtp*/
//			// List of allowed domains
//			$allowed = [
//				'legislatura.gov.ar'
//			];
//			
//			$sendSMTP = true; //por default manda smtp
//			
//			if (filter_var($emailTo, FILTER_VALIDATE_EMAIL)){
//			// Separate string by @ characters (there should be only one)
//			$parts = explode('@', $emailTo);
//
//			// Me quedo con el ultimo elemento del array del correo
//			$domain = array_pop($parts);
//
//			// me fijo si esta el dominio del correo en los permitidos
//			if ( ! in_array($domain, $allowed))
//			{
//				// Not allowed
//				$sendSMTP = false;
//			}
//		}
//			
//		if ($sendSMTP){
//	$sale = "smtp";
//			$mail->IsSMTP();                           // tell the class to use SMTP
//			//$mail->SMTPAuth   = true;                  // enable SMTP authentication
//			//$mail->SMTPSecure = "tls";
////			$mail->SMTPDebug = 1; //Alternative to above constant
//			$mail->Host     = '10.1.1.62';
////        $mail->SMTPAuth = true;
//			$mail->Username = 'dirivero@legislatura.gov.ar';
//			$mail->Password = 'D3loused';
//			
//			$mail->SMTPOptions = array(
//				'ssl' => array(
//					'verify_peer' => false,
//					'verify_peer_name' => false,
//					'allow_self_signed' => true
//				)
//			);
//			
//
//		}else{
//		$sale = "sendmail";
//			$mail->IsSendmail(); // tell the class to use Sendmail	
//			#$mail->Sendmail = '/usr/lib/sm.bin/sendmail';
//		}
//
//					
//				
//			$mail->setFrom('dirivero@legislatura.gov.ar', 'legis conectadas test');
//			$mail->addReplyTo('dirivero@legislatura.gov.ar','legis conectadas test');
//			
//			$mail->addAddress($emailTo);
//        
//			// Email subject
//			$mail->Subject = 'Send Email via SMTP using PHPMailer in CodeIgniter';
//        
//			// Set email format to HTML
//			$mail->isHTML(true);
//        
//			// Email body content
//			$mailContent = "<h1>11".$emailTo."</h1>
//							<p>This is a test email sending using SMTP mail server with PHPMailer.</p>";
//			$mail->Body = $mailContent;
//        
//				// Send email
//				if(!$mail->send()){
//
//				echo 'Message could not be sent.';
//				echo 'Mailer Error: ' . $mail->ErrorInfo;
//				echo '---->' . $ale;
//
//				}else{
//				echo 'Message has been sent --->'.$sale;
//				}
//
//			}
//		}
			
}
}

	

?>
