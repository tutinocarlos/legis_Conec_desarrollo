<?php
//application/controllers/usuarios.php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class MY_HomeController extends CI_Controller {
 
    function __construct(){
        parent::__construct();
//			$this->load->helper('html');
			
			 	$this->fecha_now = date('Y-m-d H:i:s');	
				$this->user = $this->ion_auth->user()->row();
			
				$fecha = date("Y-m-d");
				$this->fecha = fecha_es($fecha, "L d F a"); //Resultado: dia 25 mes completo 2014
			
			
				$datos = array(
					'menu' => 'nemu',
				);
				$this->nav = $this->load->view('web/secciones/nav', $datos, TRUE);

 		}
		
	
	public function index(){

		}
		
}

?>
