	<?php
	//application/controllers/usuarios.php
	if (!defined('BASEPATH')) exit('No direct script access allowed');

	class Front extends MY_Controller {
	 
	  function __construct(){
	      parent::__construct();
			
			$this->load->helper('form','url');
			$this->load->library('form_validation');
//				$this->output->enable_profiler(TRUE);
		 	
			$this->user = $this->ion_auth->user()->row();
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

				$seccion 		= $this->load->view('manager/secciones/front/textos',$datos, TRUE);

				$panel = $this->load_panel();
				$scripts =  array(
					base_url().'static/manager/scripts/front.js?ver='.time(), 
					);
				$data = array(
					'content' => $seccion,
					'header' => $panel['header'],
					'panel' => $panel['panel'],
					'script' => $scripts
					);
				 
				$this->load->view('manager/head');
				$this->load->view('manager/index',$data);
				
				$this->load->view('manager/footer',$data);
			 }

		}
	


}
		

	?>
