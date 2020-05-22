<?php
//application/controllers/usuarios.php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Subcategorias extends MY_Controller {
 
    function __construct(){
        parent::__construct();
			
			$this->load->helper('form','url');
			$this->load->library('form_validation');
		 	$this->load->model('/Manager/Subcategorias_model');
		 	$this->load->model('/Manager/Categorias_model');
		}

	
	function buscar_item($id){
		
					
			if (!$this->ion_auth->is_super() ){
				redirect('auth/logout');
			}
				$item = $this->Categorias_model->buscar_item($id);
		
//		echo $item->fecha_upd;
			$newDate = date("d-m-Y H:i:s", strtotime($item->fecha_ins));
			$item->fecha_ins = $newDate;
			$newDate = date("d-m-Y H:i:s", strtotime($item->fecha_upd));
			$item->fecha_upd = $newDate;
				
				$seccion = $this->load->view('manager/secciones/sub_categorias/editar_ambito',$item, TRUE);
				
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

	public function index(){

		if (!$this->ion_auth->logged_in())
    {
      redirect('auth/login');
    }else{
			 
			$user = $this->ion_auth->user()->row();

			$datos = array(
				'user' => $user,
			);
			
			$data_select = $this->Categorias_model->obtener_listados('categorias');
			
      $select_data = array(
            'elementos' => $data_select,
            'value'     => 'id',
            'option'    => 'nombre'
          );
       
			
			$datos = array(
				'user' => $user,
				'select' =>$this->load->view('manager/plantillas/select', $select_data, TRUE)
			);

			$seccion 		= $this->load->view('manager/secciones/sub_categorias/sub_categorias',$datos, TRUE);
			
			$panel = $this->load_panel();
			$scripts =  array(
					base_url().'static/manager/scripts/sub_categorias.js', 
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
	
	public function sub_categorias(){
		
		if($this->input->is_ajax_request())
    {
			return $this->Subcategorias_model->get_sub_categorias();
		}
		
		if (!$this->ion_auth->logged_in())
    {
      redirect('auth/login');
    }else{
			$this->form_validation->set_rules('categoria', 'Categoría', 'required');
			$this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]');
			$this->form_validation->set_rules('detalle', 'Detalle', 'required|min_length[3]');
				if($this->form_validation->run() === true){
				
						$datos = array(
							'id_categoria' => $this->input->post('categoria') ,
							'nombre'=> $this->input->post('nombre') ,
							'detalle' => $this->input->post('detalle') ,
						);
					
				 		if($this->Contenidos_model->Guardar_datos('ambito',$datos )){
							redirect($_SERVER['REQUEST_URI'], 'refresh');
						}
				}	
			
			
			$user = $this->ion_auth->user()->row();
			
			$data_select = $this->Contenidos_model->obtener_listados('categorias');
			
			
     
      $select_data = array(
            'elementos' => $data_select,
            'value'     => 'id',
            'option'    => 'nombre'
          );
       
//      $datos['select']     = $this->load->view('Manager/plantillas/select', $select_data, TRUE);
			
			$datos = array(
				'user' => $user,
				'select' =>$this->load->view('manager/plantillas/select', $select_data, TRUE)
			);
			
			$seccion 		= $this->load->view('manager/secciones/sub_categorias',$datos, TRUE);

			$panel = $this->load_panel();
			$scripts =  array(
					base_url().'static/manager/scripts/sub_categorias.js', 
				);
			$data = array(
				'content' => $seccion,
				'header' => $panel['header'],
				'panel' => $panel['panel'],
				'script' => $scripts
				); 
		
			$this->load->view('manager/head');
			 
			$this->load->view('manager/index',$data);

			$this->load->view('manager/footer', $data);

		 		
		}

	}
	
	
	public function grabar_sub_categorias(){
			
			
//			var_dump($_POST);die();
	
			// quitado la validacion de categira 07/10/2019 cambio en las subcategoria
//		$this->form_validation->set_rules('categoria', 'Categoría', 'required');
		$this->form_validation->set_rules('detalle', 'Detalle', 'required|min_length[3]');
		$this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]');
		if($this->form_validation->run() === true){

			$datos = array(
				'nombre'=> $this->input->post('nombre') ,
//				'id_categoria' => $this->input->post('categoria') ,
				'detalle' => $this->input->post('detalle') ,
				'estado' => 1,
			);

			if($this->Categorias_model->Guardar_datos('ambito',$datos )){
				
				$mensaje ="Se ha Grabado correctamente";
				$estado ="success";
			}else{
				$mensaje ="Ha ocurrido un error al actualizar los datos functio manager grabar_sub_categorias()";
				$estado ="error";
			}
			
			$grabar_datos_array = array(
				'seccion' => 'Ámbito de publicación',
				'mensaje' => $mensaje,
				'estado' => $estado,
				);
					
			$this->session->set_userdata('save_data', $grabar_datos_array);
			redirect('Manager/Ambito/', 'refresh');
		}
		
		$user = $this->ion_auth->user()->row();

		$datos = array(
			'user' => $user,
		);

		$data_select = $this->Categorias_model->obtener_listados('categorias');	
		$select_data = array(
					'elementos' => $data_select,
					'value'     => 'id',
					'option'    => 'nombre'
				);

//      $datos['select']     = $this->load->view('Manager/plantillas/select', $select_data, TRUE);
			
		$datos = array(
			'user' => $user,
			'select' =>$this->load->view('manager/plantillas/select', $select_data, TRUE)
		);
		$panel = $this->load_panel();
		$seccion 		= $this->load->view('manager/secciones/sub_categorias/sub_categorias',$datos, TRUE);

		$data = array(
			'content' => $seccion,
			'header' => $panel['header'],
			'panel' => $panel['panel'],
		);

	 	$this->load->view('manager/head');

		$this->load->view('manager/index',$data);

		$data = array(
			'script' => 'static/manager/scripts/sub_categorias.js'
		);

		$this->load->view('manager/footer', $data);
		 		
		
	}
	
	
	function update_categoria(){

		if (!$this->ion_auth->is_super() ){
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
}

?>