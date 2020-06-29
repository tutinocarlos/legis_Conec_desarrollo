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


 		}
	
	
	function _enviar_email($data, $usr = false, $html = "consultas")
  {
    
    $this->load->library('email');
    $this->load->helper('url');
    /* configuro el envio */
 
    $this->email->from('no-reply@mysetup.com.ar', 'Legislaturas Conectadas'); 
 
    if($usr)
    {
     
      $this->email->to('tutinocarlos@gmail.com'); 
     
    }
    else
    {
       
//      $this->email->to('dirivero@legislatura.gov.ar');
      $this->email->to('tutinocarlos@gmail.com'); 
      $this->email->bcc('tutinocarlos@gmail.com'); 
      $this->email->reply_to('tutinocarlos@gmail.com', 'jose luis');
       
    }
     
   $this->email->subject($data["subject"]);
 
    /* Renderizo el html para enviar */
    $body = $this->load->view('emails/'.$html, $data, TRUE); 
 
    $this->email->message($body);   
 
    if($this->email->send(FALSE))
    {
        return TRUE;
    }
//
		//var_dump($this->email->print_debugger());
//		die();
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
