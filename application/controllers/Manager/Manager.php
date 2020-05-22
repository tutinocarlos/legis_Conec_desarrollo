<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager extends MY_Controller {

	public function index()
	{
			

	 	if (!$this->ion_auth->logged_in())
    {
      redirect('/auth/login');
    }else{
			 
			$user = $this->ion_auth->user()->row();

			if($user->re_password == 0){
				redirect('reset_password');
			}
			$datos = array(
				'user' => $user,
			);

			// completo las meta etiquetas del html
			//header con perfil del usuario
		
			//barra de navegacion
	
			$tab_profile 		= $this->load->view('manager/secciones/profile',$datos, TRUE);

			$panel = $this->load_panel();
			$data = array(
				'header' => $panel['header'],
				'panel' => $panel['panel'],
				'content' => $tab_profile,
				'script' => base_url().'static/manager/scripts/categorias.js'
			); 
		 	
			$this->load->view('manager/head');
			 
			$this->load->view('manager/index',$data);
			
			$this->load->view('manager/footer',$data);
			
		 }
  
	}
	
	
	public function profile(){
		
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
			$header = $this->load->view('manager/etiquetas/header', $datos, TRUE);
			
			$profile 		= $this->load->view('manager/secciones/profile',$datos, TRUE);
			
			$panel = $this->load_panel();
			$data = array(
				'header' => $panel['header'],
				'panel' => $panel['panel'],
				'content' => $profile,
				'script' => base_url().'static/manager/scripts/profile.js'
			); 
		 	
			$this->load->view('manager/head');
			 
			$this->load->view('manager/index',$data);
			
			$this->load->view('manager/footer',$data);
		 }
		
	}
	
	public function formulario(){
//		$data = array(
// 'subject' =>'DATO1',
// 'dato1' =>'DATO1',
// 'dato2' =>'DATO2',
// 'dato3' =>'DATO3',
// );
//
// $email_data = array(
// 'datos' => $data,
// 'subject' => 'Consulta Online'
// );
//
// /* Quito el uri para enviar el email */
//
// // unset($email_data["datos"]["uri"]);
//
// /* function enviar_email */
// if ( $this->_enviar_email( $email_data ) )
// {
// echo 'si encio';
// }else{
// echo 'no envio';
// }
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
			$header = $this->load->view('manager/etiquetas/header', $datos, TRUE);
			
			$profile 		= $this->load->view('manager/secciones/post/formulario',$datos, TRUE);
			
			$panel = $this->load_panel();
			$scripts =  array(
					base_url().'static/manager/scripts/formulario.js',
					base_url().'static/manager/assets/libs/jquery-steps/build/jquery.steps.min.js', 
					base_url().'static/manager/assets/libs/jquery-validation/dist/jquery.validate.min.js',
				);
			$data = array(
				'header' => $panel['header'],
				'panel' => $panel['panel'],
				'content' => $profile,
				'script' => $scripts
			); 
		 	
			$this->load->view('manager/head');
			 
			$this->load->view('manager/index',$data);
			
			$this->load->view('manager/footer',$data);
		 }
		
	}
	
	
}
