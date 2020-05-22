<?php
//application/controllers/usuarios.php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Contenidos extends MY_Controller {
 
    function __construct(){
        parent::__construct();
			
			$this->load->helper('form');
			$this->load->library('form_validation');
		 	$this->load->model('/Manager/Contenidos_model');
			
		}

	public function redirect(){
		

		$legis = $this->Contenidos_model->buscar_provincia($this->input->post('code'));
		
//		var_dump($legis);die();
		if( $legis){
			echo json_encode($legis);
		}else{
			echo false;
		}
		
	}
	public function jvectormapa(){
//	$code = $this->input->post('code'); die();
		$html_legis = 'Sin ingresar Dato';
		$legis = $this->Contenidos_model->buscar_provincia($this->input->post('code'));

		if( count($legis) > 0 ){
			$datos = array (
				'legis' =>$legis[0]
			);
			$html_legis = $this->load->view('web/secciones/templates/legis', $datos, TRUE);
			
		}
		echo $html_legis;
	}
	public function index(){
		
		if (!$this->ion_auth->logged_in())
    {
      redirect('auth/login');
    }else{
			 
			$user = $this->ion_auth->user()->row();

			$datos = array(
				'user' => $user,
			);

			// completo las meta etiquetas del html
			//header con perfil del usuario
			
			$seccion 		= $this->load->view('manager/secciones/categorias',$datos, TRUE);

			$header = $this->load->view('manager/etiquetas/header', $datos, TRUE);
			$data = array(
				'header' => $header,
				'panel' => $this->load_panel(),
				'content' => $seccion
			); 
			
			
			
			
			$this->load->view('manager/head');
			 
			$this->load->view('manager/index',$data);
			
			$this->load->view('manager/footer');
		 }
	}
	
	public function get_categorias(){
		
		if (!$this->ion_auth->logged_in())
    {
      redirect('auth/login');
    }else{
			$categorias =  $this->Contenidos_model->get_categorias();
			return $categorias ;
		}
	}
	
	public function grabar_categorias(){
	
		$this->form_validation->set_rules('detalle', 'Detalle', 'required|min_length[3]');
		$this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]');
			if($this->form_validation->run() === true){
				
		$datos = array(
			'nombre'=> $this->input->post('nombre') ,
			'detalle' => $this->input->post('detalle') ,
		);
				 echo  $consultas = $this->Contenidos_model->Guardar_categoria('categorias',$datos );

			}
		
			$user = $this->ion_auth->user()->row();

			$datos = array(
				'user' => $user,
			);
			$seccion 		= $this->load->view('manager/secciones/categorias',$datos, TRUE);

			$header = $this->load->view('manager/etiquetas/header', $datos, TRUE);
			$data = array(
				'header' => $header,
				'panel' => $this->load_panel(),
				'content' => $seccion,
			
			); 
		
		 $this->load->view('manager/head');
			 
			$this->load->view('manager/index',$data);
		
			$data = array(
			
				'script' => 'static/manager/scripts/categorias.js'
			);
			
			$this->load->view('manager/footer', $data);
		 		
		
	}
	
	public function sub_categorias(){
		
		if (!$this->ion_auth->logged_in())
    {
      redirect('auth/login');
    }else{
			$this->form_validation->set_rules('categoria', 'Categoría', 'required|min_length[3]');
			$this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]');
			$this->form_validation->set_rules('detalle', 'Detalle', 'required|min_length[3]');
				if($this->form_validation->run() === true){
				
						$datos = array(
							'categoria' => $this->input->post('categoria') ,
							'nombre'=> $this->input->post('nombre') ,
							'detalle' => $this->input->post('detalle') ,
						);
				 		 $consultas = $this->Contenidos_model->Guardar_categoria('categorias',$datos );

				}	
			
			
			$user = $this->ion_auth->user()->row();
			$datos = array(
				'user' => $user,
			);
			$seccion 		= $this->load->view('manager/secciones/sub_categorias',$datos, TRUE);

			$header = $this->load->view('manager/etiquetas/header', $datos, TRUE);
			$data = array(
				'header' => $header,
				'panel' => $this->load_panel(),
				'content' => $seccion,
			
			); 
		
		 $this->load->view('manager/head');
			 
			$this->load->view('manager/index',$data);
			
			
			$data = array(
			
				'script' => 'static/manager/scripts/categorias.js'
			);
			
			$this->load->view('manager/footer', $data);
		 		
			
		}
		
		
		
		
	}
	
	
}

?>
