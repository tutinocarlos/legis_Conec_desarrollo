<?php
//application/controllers/usuarios.php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Categorias extends MY_Controller {
 
    function __construct(){
        parent::__construct();
			
			$this->load->helper('form','url');
			$this->load->library('form_validation');
		 	$this->load->model('/Manager/Categorias_model');
		 	
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

			$seccion 		= $this->load->view('manager/secciones/categorias/categorias',$datos, TRUE);

			$panel = $this->load_panel();
			$scripts =  array(
					base_url().'static/manager/scripts/categorias.js', 
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
	
	public function get_categorias(){
		
		if (!$this->ion_auth->logged_in())
    {
      redirect('auth/login');
    }else{
			
			$categorias =  $this->Categorias_model->get_categorias();
			return $categorias ;
		}
	}
	
	public function grabar_categorias(){

		
		if($this->input->post("botonSubmit")){
			$this->form_validation->set_rules('detalle', 'Detalle', 'required|min_length[3]');
			$this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]');

			if($this->form_validation->run() === true){

				$datos = array(
					'nombre'=> $this->input->post('nombre') ,
					'detalle' => $this->input->post('detalle') ,
					'user_upd' => $this->user->id ,
					'user_id' => $this->user->id ,
				);
	
				if($this->Categorias_model->Guardar_datos('categorias',$datos )){
					redirect('Manager/Categorias', 'refresh');
				}
			}
		}
		$user = $this->ion_auth->user()->row();

		$datos = array(
			'user' => $user,
		);

		$seccion 		= $this->load->view('manager/secciones/categorias/categorias',$datos, TRUE);


		$panel = $this->load_panel();
		$data = array(
			'content' => $seccion,
			'header' => $panel['header'],
			'panel' => $panel['panel'],
		);

	 	$this->load->view('manager/head');

		$this->load->view('manager/index',$data);

		$data = array(
			'script' => base_url().'static/manager/scripts/categorias.js'
		);

		$this->load->view('manager/footer', $data);
		 		
		
	}
	
	function buscar_item($id){

			// cambiado a pedido de SIl - Eli 07/08/2020 poder adm categorias(tematicas)
//			if ((!$this->ion_auth->is_super() )|| ($this->ion_auth->is_members() )){
//		
//				redirect('auth/logout');
//			}
		$item = $this->Categorias_model->buscar_item($id);

//		echo $item->fecha_upd;
			$newDate = date("d-m-Y H:i:s", strtotime($item->fecha_ins));
			$item->fecha_ins = $newDate;
			$newDate = date("d-m-Y H:i:s", strtotime($item->fecha_upd));
			$item->fecha_upd = $newDate;
				
				$seccion = $this->load->view('manager/secciones/categorias/edit',$item, TRUE);
				
				$panel = $this->load_panel();
				$data = array(
				'content' => $seccion,
				'header' => $panel['header'],
				'panel' => $panel['panel'],
				);
				$this->load->view('manager/head');

				$this->load->view('manager/index',$data);

				$data = array(
					'script' => base_url().'static/manager/scripts/categorias.js'
				);

				$this->load->view('manager/footer', $data);
		
	}
	
	function update_categoria(){
// cambiado a pedido de SIl - Eli 07/08/2020 poder adm categorias(tematicas)
//		if (!$this->ion_auth->is_super() || $this->ion_auth->is_admin() ){
//			
//				redirect('auth/logout');
//		}

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
	
				if($this->Categorias_model->update_categoria('categorias',$data )){
					$mensaje ="Se han actualizado los datos correctamente";
					$estado ="success";
				}else{
					$mensaje ="Ha ocurrido un error al actualizar los datos functio manager categorias->update_categoria";
					$estado ="error";
					
				}
			}
				
			$grabar_datos_array = array(
				'seccion' => 'Actualizar datos Temáticas',
				'mensaje' => $mensaje,
				'estado' => $estado,
					);
					
				$this->session->set_userdata('save_data', $grabar_datos_array);
				redirect('/Manager/Tematicas', 'refresh');
		}

	}
	
	function status_categoria(){
		if($this->input->is_ajax_request())
    {

			if($this->Categorias_model->check($this->input->post())){
				$result = array(
					'estado'=>true
				);
				
				echo  json_encode($result);
//				redirect($_SERVER['REQUEST_URI'], 'refresh');
			}else{
				$result = array(
					'estado'=> false
				);
				echo  json_encode($result);
			}
		}
			
	}
		
	function borrar_tematica(){
		$data = array(
			'es_borrado' => 1
		);
		
		if($this->db->update('categorias', $data, "id =".$this->input->post('id'))){
			$estado = true;
			$mensaje = 'El registro Modificado !!!';
		}else{
			$estado = false;
			$mensaje = 'Ocurrió un error al mofificar el registro';
		}
		
		$result = array(
			'estado'=>$estado,
			'mensaje'=>$mensaje,
		);
		
		echo json_encode($result);
		
	}
}

?>