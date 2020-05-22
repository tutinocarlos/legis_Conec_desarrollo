<?php
//application/controllers/usuarios.php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Tipo_normativa extends MY_Controller {
 
    function __construct(){
        parent::__construct();
			
			$this->load->helper('form','url');
			$this->load->library('form_validation');
		 	$this->load->model('/Manager/Tipo_normativa_model');
		 	$this->load->model('/Manager/Categorias_model');
		}


	public function index(){
		
		if (!$this->ion_auth->logged_in())
    {
      redirect('auth/login');
    }else{
			if($this->input->is_ajax_request())
    {
				
		
			return $data_select = $this->Tipo_normativa_model->get_tipo_normativa();
		} 
			
			$user = $this->ion_auth->user()->row();

			$datos = array(
				'user' => $user,
			);
			
			$seccion 		= $this->load->view('manager/secciones/tipo_normativa/tipos_normativa',$datos, TRUE);
			
			$panel = $this->load_panel();
			
			$data = array(
				'content' => $seccion,
				'header' => $panel['header'],
				'panel' => $panel['panel'],
				'script' => base_url().'static/manager/scripts/tipos_normativas.js'
				);
			 
			$this->load->view('manager/head');
			$this->load->view('manager/index',$data);
			$this->load->view('manager/footer',$data);
		 }
	}
	
	public function editar_datos($id){
		
		
		if (!$this->ion_auth->logged_in())
    {
      redirect('auth/login');
    }
			
			$data = $this->Tipo_normativa_model->get_edit_normativa($id);
			$user = $this->ion_auth->user()->row();

			$datos = array(
				'user' => $user,
				'data' => $data
			);
			
			$seccion 		= $this->load->view('manager/secciones/tipo_normativa/edit_normativa',$datos, TRUE);
			
			$panel = $this->load_panel();
			
			$data = array(
				'content' => $seccion,
				'header' => $panel['header'],
				'panel' => $panel['panel'],
				'script' => base_url().'static/manager/scripts/tipos_normativas.js'
				);
			 
			$this->load->view('manager/head');
			$this->load->view('manager/index',$data);
			
			$this->load->view('manager/footer',$data);
		 
	}
	public function grabar_datos(){
		
//		if($this->input->is_ajax_request())
//    {
//			return $this->Subcategorias_model->get_sub_categorias();
//		}
		
		if (!$this->ion_auth->logged_in())
    {
      redirect('auth/login');
    }else{
			$this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]');
			$this->form_validation->set_rules('detalle', 'Detalle', 'required|min_length[3]');
				if($this->form_validation->run() === true){
				
						$datos = array(
							'nombre'=> $this->input->post('nombre') ,
							'detalle' => $this->input->post('detalle') ,
							'user_ins' => $this->user->id ,
						);
					
				 		if($this->Tipo_normativa_model->Guardar_datos('tipo_normativa',$datos )){
							
							$grabar_datos_array = array(
                'seccion' => 'Grabar Tipo Publicación',
                'mensaje' => 'Se ha ingresado correctamente',
                'estado' => 'success',
            	);
				

						}else{
						$grabar_datos_array = array(
                'mensaje' => 'ha ocurido un error el graba del tipo de publicacion',
                'estado' => 'error',
            	);
							
						}
					
							$this->session->set_userdata('save_data', $grabar_datos_array);
							
							redirect('Manager/Tipo_normativa', 'refresh');
				}	
			$user = $this->ion_auth->user()->row();

		$datos = array(
			'user' => $user,
		);

		$seccion 		= $this->load->view('manager/secciones/tipo_normativa/tipos_normativa',$datos, TRUE);

		$panel = $this->load_panel();

		$data = array(
			'content' => $seccion,
			'header' => $panel['header'],
			'panel' => $panel['panel'],
		);

	 	$this->load->view('manager/head');

		$this->load->view('manager/index',$data);

		$data = array(
			'script' => base_url().'static/manager/scripts/tipos_normativa.js'
		);

		$this->load->view('manager/footer', $data);
		}

	}
	
	function status_normativa(){
		if($this->input->is_ajax_request())
    {

			if($this->Tipo_normativa_model->check($this->input->post())){
				$result = array(
					'estado'=>true
				);
				
				echo  json_encode($result);
			}else{
				$result = array(
					'estado'=> false
				);
				echo  json_encode($result);
			}
		}
			
	}
	
	function update_tipo(){

		if (!$this->ion_auth->is_admin() ){
				redirect('auth/logout');
		}
		
		if($this->input->post("botonSubmit")){
			
			$this->form_validation->set_rules('detalle', 'Detalle', 'required|min_length[3]');
			$this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]');
			$this->form_validation->set_rules('id', 'ID', 'required');

			if($this->form_validation->run() === true){
				$data = array(
					'id'=> $this->input->post('id') ,
					'nombre'=> $this->input->post('nombre') ,
					'detalle' => $this->input->post('detalle') ,
					'fecha_upd' => $this->fecha_now ,
					'user_upd' => $this->user->id,
				);
	
				if($this->Tipo_normativa_model->update_tipo_pub('tipo_publicacion',$data )){
					$mensaje ="Se han actualizado los datos correctamente";
					$estado ="success";
				}else{
					$mensaje ="Ha ocurrido un error al actualizar los datos Tipo_publicacion ->update_tipo";
					$estado ="error";
				}
			}
		}
		
			$grabar_datos_array = array(
				'seccion' => 'Actualizar datos Tipo de publicación',
				'mensaje' => $mensaje,
				'estado' => $estado,
			);

			$this->session->set_userdata('save_data', $grabar_datos_array);
			redirect('/Manager/Tipo_normativa', 'refresh');
	}
}

?>