<?php
//application/controllers/usuarios.php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Usuarios extends MY_Controller {
 
	function __construct(){
			parent::__construct();

			$this->load->helper('form','url');
			$this->load->library('form_validation');
			$this->load->model('/Manager/Ion_auth_model');
			$this->load->model('/Manager/Usuarios_model');
			$this->load->model('/Manager/Categorias_model');
			$this->load->model('/Manager/Post_model');
//		$this->output->enable_profiler(TRUE);
		
		if(!$this->ion_auth->user()->row()){
						redirect('auth/login');
				};
	}
	


	public function reset_password(){
/*
1826
$2y$12$gWqvtPfUkpGtI9zQBUuCGeVz7HmG6BwFpR6J/J/X/69DmSrSAZEzO
*/

		$forgotten = $this->ion_auth->reset_password('tutinocarlos@gmail.com', 'porroporro');

	 	if ($forgotten) { //if there were no errors

		 	$result['estado'] = true;
		 	$result['mensaje'] = $this->ion_auth->messages();

			$data = array(
			'subject' =>'DATO1',
			'dato1' =>'DATO1',
			'dato2' =>'DATO2',
			'dato3' =>'DATO3',
			);
		
			$email_data = array(
			'datos' => $data,
			'subject' => 'Consulta Online'
			);
//
// /* Quito el uri para enviar el email */
//
// // unset($email_data["datos"]["uri"]);
//
// /* function enviar_email */
if ( $this->_enviar_email( $email_data, 'tutinocarlos@gmail.com' ) ){

}
	      //  $this->session->set_flashdata('message', $this->ion_auth->messages());
	       // redirect("auth/login", 'refresh'); //we should display a confirmation page here instead of the login page
	  }else{
			$result['estado'] = FALSE;
			$result['mensaje'] =$this->ion_auth->errors();
	        
	  }



		echo json_encode($result);
	}


	public function index(){

		if ($this->ion_auth->is_super())
		{

			if (!$this->ion_auth->logged_in())
				{
					redirect('auth/login');
				}
		
			$datos = array(
				'data' =>'data'
			);
			
			$data_select = $this->Categorias_model->obtener_listados('legislaturas');

			$select_data = array(
			'elementos' => $data_select,
			'value' => 'id',
			'option' => 'nombre'
			);


			$datos = array(
				'select' =>$this->load->view('manager/plantillas/select', $select_data, TRUE),
				'groups' =>$this->ion_auth->groups()->result_array()
			);
			
//			echo '<pre>';
//print_r($this->ion_auth->groups()->result_array());die();
//			echo '</pre>';
			
			$seccion = $this->load->view('manager/secciones/usuarios/usuarios',$datos, TRUE);

			$panel = $this->load_panel();
			
			$scripts =  array(
					base_url().'static/manager/scripts/usuarios.js?ver='.time(), 
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
		
	public function editar($edit_user = false){

		if ($this->ion_auth->is_super())
		{

			if (!$this->ion_auth->logged_in())
				{
					redirect('auth/login');
				}

			if($this->input->post("botonSubmit")){
			$usuario = $this->ion_auth->user($this->input->post('id_usuario'))->result();
			$usuario = $usuario[0];
				$this->form_validation->set_rules('first_name', 'Nombre', 'required|min_length[3]');
				$this->form_validation->set_rules('last_name', 'Apellido', 'required|min_length[3]');
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_email');
				$this->form_validation->set_rules('grupo', 'Tipo Usuario', 'callback_check_grupo');
				$this->form_validation->set_rules('usuario', 'Username', 'min_length[5]|callback_check_username');

				if($this->form_validation->run() === true){

					if($this->Usuarios_model->actualizar_usuario($this->input->post())){
						$mensaje = "Datos Actualizados con éxito";
						$estado = 'success';
					}else{
						$mensaje = "Ha ocurrido un error";
						$estado = 'error';
					}

					/* retorno mensajes de operacion */
					$grabar_datos_array = array(
                'seccion' => 'Actualizar datos Usuarios',
                'mensaje' => $mensaje,
                'estado' => $estado,
            );
					
						$this->session->set_userdata('save_data', $grabar_datos_array);
						
						redirect(base_url('Manager/Usuarios/'));
					
				}

			}else{

				/* datos del Usuario */
				$usuario = $this->ion_auth->user($edit_user)->result();
				$usuario = $usuario[0];

			}
		
			$datos = array(
				'data' =>'data'
			);

			/*Grupos del Usuario */
 			$grupos_usuario = $this->ion_auth->get_users_groups($edit_user)->result_array();
		
			$data_select = $this->Categorias_model->obtener_listados('legislaturas');

			/* armo el select con los datos de legislaturas */
			$select_data = array(
			'elementos' => $data_select,
			'value' => 'id',
			'option' => 'nombre',
			'selected' => $usuario->id_legislatura
			);

			
			$grupos = $this->ion_auth->groups()->result_array();

	foreach ($grupos as $key=>$value){
			$grupos[$key]['label']= $grupos[$key]['description'];
			$grupos[$key]['name']= 'grupo[]';
			$grupos[$key]['value']= $grupos[$key]['id'];
//			$grupos[$key]['value']= 'custom-control-input col-lg-3';
		
		if(in_array($grupos[$key]['id'],array_column($grupos_usuario, 'id') )){
//			echo '<br>----key'.$grupos[$key]['id'].'<br>algo paso'.$grupos[$key]['name'].'<br>';
			$grupos[$key]['checked']= true;
			
		}
		$datos = array(
			'select' =>$this->load->view('manager/plantillas/select', $select_data, TRUE),
			'groups' =>$this->ion_auth->groups()->result_array(),
			'grupos' =>$grupos,
			'grupos_usuario' => $grupos_usuario,
			'usuario' => $usuario
		);
//$key = array_search($data['id'], array_column($user_groups, 'id'));
//
// if($key){
//
// echo '<br>key'.$key.'<br>algo paso'.$data['name'].'<br>';
// }
	
		
		
	}		
			
// foreach ($groups as $ky => $value):
//
//if(in_array($groups[$ky]['id'], $grupos_usuario)):
//
//echo 'si';
//else:
//echo 'no';
//endif;
//endforeach;
// foreach($grupos as $grupo){
// echo form_label($grupo['label'], $grupo['name']);
// echo form_radio($grupo) ;
//
// }	
// die();

			$seccion = $this->load->view('manager/secciones/usuarios/editar_usuario',$datos, TRUE);

			$panel = $this->load_panel();
			
			$scripts =  array(
					// base_url().'static/manager/scripts/usuarios.js', 
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
	
/* funcion para chequear que no se repita el username cuando edito al usuario*/

	public function check_username($str){

		$data = array(
			'id_usuario'=>$this->input->post('id_usuario'),
			'username' =>$str
		);

		if($this->Usuarios_model->check_username($data)){
			$this->form_validation->set_message('check_username', 'El nombre de usuario ya se encuentra registrado para otro usuario');
			return false;
		}else{
			return true;
		}

	}
/* funcion para chequear que no se repita el email cuando edito al usuario*/

	public function check_email($str){

		$data = array(
			'id_usuario'=>$this->input->post('id_usuario'),
			'email' =>$str
		);

		if($this->Usuarios_model->check_email($data)){
			$this->form_validation->set_message('check_email', 'El email ya se encuentra registrado para otro usuario');
			return false;
		}else{
			return true;
		}

	}

	/*function para checkear que me envíe al menos 1 grupo de usuario*/
	public function check_grupo($str){

		
		if (count($this->input->post('grupo')) == 0) {
			$this->form_validation->set_message('check_grupo', 'Seleccione un tipo de Usuario');
			return false;
		}else{
			return true;
		}

	}
	public function get_usuario_id(){
		
		if($this->input->is_ajax_request()){
			
			
			$data_select = $this->Usuarios_model->get_usuario_legisltatura($this->input->post('id'));
			
//			var_dump($data_select); die();
			if($data_select){
				foreach($data_select as $data){
					
					echo $data['last_name'];
					echo $data['first_name'];
				}
//				die();
				$select_data = array(
            'elementos' => $data_select,
            'value'     => 'id',
            'option'    => 'name'
          );
       
				echo $select = $this->load->view('manager/plantillas/select', $select_data, TRUE);
			}else{
				
				echo 'false';
			}
      
		}
	}
	
	public function grabar_datos(){


		if ($this->ion_auth->is_super()){
	
			if($this->input->post("botonSubmit")){
				$this->form_validation->set_rules('legislatura', 'Legislatura', 'required');
				$this->form_validation->set_rules('grupo', 'Tipo de Usuario', 'required');
				$this->form_validation->set_rules('first_name', 'Nombre', 'required|min_length[3]');
				$this->form_validation->set_rules('last_name', 'Apellido', 'required|min_length[3]');
				$this->form_validation->set_rules('email', 'Email', 'required|min_length[3]|callback_email_check');
				$this->form_validation->set_rules('usuario', 'Nombre de usuario', 'required|min_length[5]|callback_user_check');

				
				if($this->form_validation->run() === true){	

					$username = $this->input->post('usuario');
					
					$password = randon_password(5);
					
					$email 			= $this->input->post('email'); 
						
					$user 				= $this->ion_auth->user()->row();
						
					$additional_data = array(
											'first_name' => $this->input->post('first_name'),
											'last_name' => $this->input->post('last_name'),
											'id_legislatura' => $this->input->post('legislatura'),
											'user_ins' =>$user->id,
											're_password' =>0,
											);
					
					$group				= array($this->input->post('grupo')); // Sets user to admin.
					
					if($this->ion_auth->register($username, $password, $email, $additional_data, $group))
					{

						$estado = 'success';
						$mensaje = 'El usuario a sido dado de alta correctamente';
					}else{
						
						$estado = 'error';
						$mensaje = 'Ha ocurido un error el intentar ingresar un usuario';
						
					}
//						MENSAJES DE GRABACION Y MODIFICACIN DE DATOS
							$grabar_datos_array = array(
							'seccion' => 'Alta Usuarios',
							'mensaje' => $mensaje,
							'estado' => $estado,
							);
					
						$this->session->set_userdata('save_data', $grabar_datos_array);
						redirect('Manager/Usuarios', 'refresh');
				}
				
				$data_select = $this->Categorias_model->obtener_listados('legislaturas');
			
				$select_data = array(
            'elementos' => $data_select,
            'value'     => 'id',
            'option'    => 'nombre'
          );
			
				$datos = array(
					'select' =>$this->load->view('manager/plantillas/select', $select_data, TRUE),
					'groups' =>$this->ion_auth->groups()->result_array()
				);
		
				$seccion = $this->load->view('manager/secciones/usuarios/usuarios',$datos, TRUE);
		
				
				$panel = $this->load_panel();
				$scripts =  array(
					base_url().'static/manager/scripts/usuarios.js?ver='.time(), 
					
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

		}else{
			redirect('auth/login');
		}
		
	}
	
	public function email_check($str){
		if(!$this->ion_auth->email_check($this->input->post('email'))){
			return TRUE; 
		}else{
			$this->form_validation->set_message('email_check','El email ya se encuentra registrado');
			return FALSE;
		}
	}	
	
	public function user_check($str){
		if(!$this->ion_auth->username_check($this->input->post('usuario'))){
			return TRUE; 
		}else{
			$this->form_validation->set_message('user_check','El usuario ya se encuentra registrado');
			return FALSE;
		}
	}
	public function psw_check($str){
		if($str == $this->input->post('password')){
			return TRUE; 
		}
			$this->form_validation->set_message('psw_check','Las contraseñas no coinciden');
			return FALSE;
	}

	public function get_usuarios(){
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
		if($this->input->is_ajax_request())
		{
			$usuarios = $this->Usuarios_model->get_usuarios();
			
			foreach($usuarios as $data){
				
				
			}
			
			return $usuarios ;
		}
	}

	function cambiar_estado(){
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}


		if ($this->ion_auth->is_super()){

			if($this->Usuarios_model->cambiar_estado()){

				$result = array(
					'estado' => true,
				);

			}else{
				$result = array(
					'estado' => false,
				);

			}

			
		}else{
			echo 'Necesita permisos de super usuario para realizar esta acción';
		}

		echo json_encode($result);
	}

	function desactivado(){

		$seccion = $this->load->view('manager/secciones/usuario_desactivado', 'dada',TRUE);
 
		
		$data = array(
				'nav' => $this->nav,
				'fecha' => $this->fecha,
				'content' => $seccion,
				'script' => ''
		);

		$this->load->view('web/head',$data);
		$this->load->view('web/index',$data);
		$this->load->view('web/footer',$data);


	}
	
	function cambiar_pwd(){
		
		$password = randon_password(5);
		
		$usuario = $this->ion_auth->user($this->input->post('id_user'))->row();

		$data = array(
          're_password' =>0,
          'password' =>$password,
		);
		$message = '';
		$status = false;
		if ($this->ion_auth->update($this->input->post('id_user'), $data)){
				$status = true;
				$messages = $this->ion_auth->messages_array();
						foreach ($messages as $message)
      {
        $message .=  $message;
      }
			$data = array(
				"nombre" => $usuario->first_name,
				"apellido" => $usuario->last_name,
				"identity" => $usuario->email,
				"temporal" => $password,
				'datoss'=> 'completar el proceso'
			);
			
				$html = $this->load->view($this->config->item('email_templates', 'ion_auth').$this->config->item('reset_pwd', 'ion_auth'), $data, true);
			
				$subject = 'Cambio de contraseña - Legislaturas Conectadas';
			
				$set_pass = semdMailGmail($usuario->email,$subject, $html,$attach=FALSE );

    }
    else
    {
      $errors = $this->ion_auth->errors_array();
      foreach ($errors as $error)
      {
        $message .= $error;
      }
    }

		$response = array(
				'estado'=>$status,
				'password'=>$password,
				'message'=>$message,
				'message'=>$message,
				'html'=>$html
			);
		echo json_encode($response);
	}
	
	
	/* deja de ser utilizada para no borrar los usuarios */
	function borrar_usuario(){
		$borra = $this->input->post('borrar');
		$status = true;
		$message = '';
		
		switch ($borra) {
    case 1:
			 
						try {
							$result =  $this->ion_auth->delete_user($this->input->post('id_user'));
								if ($result){
									$message .= '<br>Usuario Borado';
								}
							}catch (\Exception $e){
									$status = false;

							$message .= $e->getMessage();
						}
        break;
			case 0:
				

					if($this->Usuarios_model->borrar_usuario()){
						$message .= '<br>Usuario Removido';
					}else{
						$message .= '<br>ERROR Usuario DESVINCULADO';
						$status = false;
        break;
						
		}
		}
		

		$response = array(
			'estado'=>$status,
			'message'=>$message,
		);
		echo json_encode($response);
		
	}

	
}


?>
