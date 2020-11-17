<?php
//application/controllers/usuarios.php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class MY_controller extends CI_Controller {
 
    function __construct(){
        parent::__construct();

//					phpinfo();
				$this->load->model('/Manager/contenidos_model');
				$this->load->model('/Manager/Legislaturas_model');
				$this->load->model('/Manager/Provincias_model');
				$this->load->model('/Manager/Tipos_camaras_model');
				date_default_timezone_set('America/Argentina/Buenos_Aires');
			 $this->fecha_now = date('Y-m-d H:i:s');	
				$this->user = $this->ion_auth->user()->row();
			
				$fecha = date("Y-m-d");
				$this->fecha = fecha_es($fecha, "L d F a"); //Resultado: dia 25 mes completo 2014
			
				$menu = $this->contenidos_model->nav_bar();
			
				$datos = array(
					'menu' => $menu,
					'legis_conectadas' => $this->Legislaturas_model->get_legislatura(91),
				);
			
				$this->nav = $this->load->view('web/secciones/nav', $datos, TRUE);
			
			
				$this->provincias 	 = $this->Provincias_model->get_provincias();
				$this->tipos_camaras = $this->Tipos_camaras_model->get_tipos_camaras();
			
			switch($_SERVER['REMOTE_ADDR']){
					
					
					case '127.0.0.1';
//					echo 'local';
//					die();
					break;
			}


		}
	
	
 function _enviar_email($data, $usr = false, $html = "consultas_nuevo")
  {
   
    $this->load->library('email');
    $this->load->helper('url');
    /* configuro el envio */

    $this->email->from('webmaster@legislaturasconectadas.gob.ar', 'Legislaturas Conectadas - Contacto web'); 

    if($usr)
    {
    
      $this->email->to($data["datos"]["email"]); 
    		$data["subject"] = 'Gracias por contactarnos, responderemos a la brevedad';
    }
    else
    {
      switch($_SERVER['REMOTE_ADDR']){
					
					
				case '127.0.0.1':
					$this->email->to('tutinocarlos@gmail.com',$data["datos"]["apellido"].', '.$data["datos"]["nombre"]);
					break;
				case '10.1.1.38':
					$this->email->to('soporte.lc@legislatura.gov.ar',$data["datos"]["apellido"].', '.$data["datos"]["nombre"]);
					break;
				case '10.1.1.77':
					$this->email->to('info@legislaturasconectadas.gob.ar',$data["datos"]["apellido"].', '.$data["datos"]["nombre"]);
					break;
					
					
			}
 
      $this->email->reply_to($data["datos"]["email"], $data["datos"]["apellido"].', '.$data["datos"]["nombre"]);
//      $this->email->cc('another@another-example.com');
    }
    
    $this->email->subject($data["datos"]["apellido"].', '.$data["datos"]["nombre"].'-'.$data["subject"]);

    /* Renderizo el html para enviar */
    $body = $this->load->view('emails/consultas_nuevo', $data, TRUE);

    $this->email->message($body);   

    if($this->email->send())
    {
        return TRUE;
    }

    return FALSE;
	}
   
	public function load_panel(){

		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}else{

			$user = $this->ion_auth->user()->row();
			$datos = array (
			'nav'=> $user->id,
			'user' => $this->user,
			);

			if($this->ion_auth->is_super() || ($this->ion_auth->is_admin() && $this->user->id_legislatura == 1)){
				
				$panel =  $this->load->view('manager/etiquetas/nav',$datos,TRUE);
				
			}elseif($this->ion_auth->is_admin() && $this->user->id_legislatura == 91){
				
				$panel =  $this->load->view('manager/etiquetas/nav_legis',$datos,TRUE);
				
			}elseif($this->ion_auth->is_admin() && $this->user->id_legislatura != 91){
				
				$panel =  $this->load->view('manager/etiquetas/nav_admin',$datos,TRUE);
				
			}elseif($this->ion_auth->is_members() && $this->user->id_legislatura == 91){
				
				$panel =  $this->load->view('manager/etiquetas/nav_legis',$datos,TRUE);

			}else{
				$panel =  $this->load->view('manager/etiquetas/nav_members',$datos,TRUE);
			}
			
			$data = array(
			'header' => $this->load->view('manager/etiquetas/header', $datos, TRUE),
			'panel' =>$panel
			);

			return $data;
		}
	}
	
	
	public function index(){
		
	

		}
		
}


?>
