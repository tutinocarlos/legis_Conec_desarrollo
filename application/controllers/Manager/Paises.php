<?php
//application/controllers/usuarios.php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Paises extends MY_Controller {
 
    function __construct(){
        parent::__construct();
			
			$this->load->helper('form','url');
			$this->load->library('form_validation');
		 	$this->load->model('/Manager/Ambitos_model');
		 	$this->load->model('/Manager/Paises_model');
		}

	
	function get_legis_pais(){
		
			$query = $this->db->select('legislaturas.id as id_legis, legislaturas.nombre as nombre_legis, provincias.id_pais as prov_id, _paises.*')
		->join('provincias', 'provincias.id_pais = '.$_POST['id'])
		->join('legislaturas', 'legislaturas.id_provincia = provincias.id')
		->where('_paises.id_pais',$_POST['id'])
		->where('legislaturas.estado',1)
		->get('_paises');
		
//	echo $this->db->last_query();
//		var_dump($query->result());die();
		$select ='<option value="0">-SELECCIONAR-</option>';
		foreach($query->result() as $data){

			$select .= '<option value="'.$data->id_legis.'">'.$data->nombre_legis.'</option>';
		}
		
//		echo $select;die();
		if($query->num_rows() > 0){
			$estado = true;
		}
		$response = array(
			'estado' =>$estado,
			'select' =>$select
		);
		echo $select;

	}
	function status(){
//		var_dump($this->input->post());
		$data = $this->input->post();
		$id = $this->input->post('id');
		unset($data['tabla']);
		unset($data['id']);
		$data = array(
			'estado_pais' => $this->input->post('estado'),
		);

		if($this->db->where('id_pais', $id)->update('_paises', $data)){
			$estado = true;
		}else{
			$estado = false ;
			
		}
		$response = array(
			'estado' => $estado
		);
		
		echo json_encode($response);
	}
	
		
	function buscar_provincias(){
		$estado = false;
		$query = $this->db->select('provincias.*')->where('provincias.id_pais',$_POST['id_pais'])
//		->join('_paises', '_paises.id_pais = _limitrofes.pais_limitrofe')
		->get('provincias');
//		$data = $query->result();
		if($query->num_rows() > 0){
			$estado = true;
		}
		$response = array(
			'estado' =>$estado,
			'datos' =>$query->result()
		);
		echo json_encode($response);
		
		
	}
	function buscar_item($id){
			
			$this->form_validation->set_rules('nombre_pais', 'Nombre Pais', 'required');	
			$this->form_validation->set_rules('color_pais', 'Color requerido', 'required');	
			
				if($this->form_validation->run() === true){
					
					if($this->input->post('botonSubmit')){
						$id_pais = $this->input->post('id');
						unset($_POST['id']);
						unset($_POST['botonSubmit']);
						unset($_POST['detalles']);
						if($this->Paises_model->update_pais($id_pais, $this->input->post(), '_paises')){
							
							echo 'actualiza';
						}else{
							
							echo 'NO actualiza';
						}
//						die();
					}
//					echo 'valida';
				}
		
				$item = $this->Paises_model->buscar_item($id);

//			$newDate = date("d-m-Y H:i:s", strtotime($item->fecha_ins));
//			$item->fecha_ins = $newDate;
//			$newDate = date("d-m-Y H:i:s", strtotime($item->fecha_upd));
//			$item->fecha_upd = $newDate;
				$data = array(
					'data'=>$item,
					'limitrofes'=>$this->Paises_model->get_limitrofes($id),
					'idiomas'=>$this->Paises_model->get_idiomas($id),
					'monedas'=>$this->Paises_model->get_monedas($id),
				);
		
				$seccion = $this->load->view('manager/secciones/paises/editar',$data, TRUE);
				
				$scripts =  array(
				base_url().'static/manager/assets/libs/jquery-minicolors/jquery.minicolors.min.js?ver='.time(), 
				base_url().'static/manager/assets/libs/jquery-asColorPicker/dist/jquery-asColorPicker.min.js?ver='.time(), 
				base_url().'static/manager/ckeditor/ckeditor.js?ver='.time(), 
				base_url().'static/manager/ckeditor/adapters/jquery.js?ver='.time(),
				base_url().'static/manager/ckeditor/config.js?ver='.time(), 
				base_url().'static/manager/scripts/paises/paises.js',
				base_url().'static/manager/scripts/paises/editar.js',
				);
				$panel = $this->load_panel();
					
				$data = array(
					'content' => $seccion,
					'header' => $panel['header'],
					'panel' => $panel['panel'],
					'script' => $scripts,
				);
		
				$this->load->view('manager/head',$data);
				$this->load->view('manager/index',$data);
				$this->load->view('manager/footer', $data);
					
//			die();
//			echo 'aca';
//			echo '<pre>';	
//				var_dump($_POST);
//			echo '</pre>';	
//		}

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
			


			$seccion 		= $this->load->view('manager/secciones/paises/index',$datos, TRUE);
			
			$panel = $this->load_panel();
			$scripts =  array(
			 
				base_url().'static/manager/assets/libs/pais/jquery-jvectormap-2.0.3.min.js?ver='.time(), 
				base_url().'static/manager/assets/libs/pais/sudamerica1.js?ver='.time(), 
				base_url().'static/manager/scripts/paises/paises.js?ver='.time(), 
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
	
	public function list_paises(){
		
		if($this->input->is_ajax_request())
    {
			return $this->Paises_model->get_paises();
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
	
	public function grabar_ambito(){
			

		$this->form_validation->set_rules('detalle', 'Detalle', 'required|min_length[3]');
		$this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]');
		if($this->form_validation->run() === true){

			$datos = array(
				'nombre'=> $this->input->post('nombre') ,
				'detalle' => $this->input->post('detalle') ,
				'estado' => 1,
			);

			if($this->Ambitos_model->Guardar_datos('ambito',$datos )){
				
				$mensaje ="Se ha Grabado correctamente";
				$estado ="success";
			}else{
				$mensaje ="Ha ocurrido un error al actualizar los datos function manager grabar_ambitos()";
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

		$panel = $this->load_panel();
		$seccion 		= $this->load->view('manager/secciones/ambitos/ambitos',$datos, TRUE);

		$data = array(
			'content' => $seccion,
			'header' => $panel['header'],
			'panel' => $panel['panel'],
		);

	 	$this->load->view('manager/head');

		$this->load->view('manager/index',$data);

		$data = array(
			'script' => 'static/manager/scripts/ambitos.js'
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