<?php
//application/controllers/usuarios.php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Links extends MY_Controller {
 
	function __construct(){
			parent::__construct();

			$this->load->helper('form','url');
			$this->load->library('form_validation');
			$this->load->model('/Manager/Links_model');
//		$this->output->enable_profiler(TRUE);
		
			if(!$this->ion_auth->user()->row()){
				redirect('auth/login');
			};
	}



	public function index(){
		
	$l='http://living-sun.com/es/php/645021-validate-url-in-php-php-validation.html';	

		if (!$this->ion_auth->logged_in())
			{
				redirect('auth/login');
			}

		if($this->input->is_ajax_request()){
			$listado_links =  $this->Links_model->get_links_ajax_dt();
			return $listado_links;
		}
		/* si llega el boton paso por la validacion */
//		if($this->input->post("cargar_dato")){
			
			$this->form_validation->set_rules('titulo_link', 'Titulo', 'required');
			$this->form_validation->set_rules('detalle_link', 'Descripción', 'required');
			$this->form_validation->set_rules('url_link', 'Url', 'required|callback_check_url');
		
			$data = $this->input->post();
		
			unset($data['cargar_dato']);
			
			if($this->form_validation->run() === true){

				if($data['id_link'] != ''){
					
					$this->form_validation->set_rules('link_link', 'Url', 'required');
					
					$id_link = $data['id_link'];
//					unset($data['id_link']);
					unset($data['orden_link']);
					
					if($this->db->update('links', $data, "id_link =".$id_link)){
						$mensaje = 'Datos Editados correctamente';
						$estado ='success';
					}else{
						$mensaje = 'Ocurrió un error al editar datos';
						$estado ='error';
					}
					
				}else{
					
					if($this->db->insert('links', $data)){
						
						$mensaje = 'Datos Guardados correctamente';
						$estado ='success';
					}else{
						$mensaje = 'Ocurrió un error al guardar los datos';
						$estado ='error';
					}
				}
				
				$grabar_datos_array = array(
					'seccion' => 'Links de Interes',
					'mensaje' => $mensaje,
					'estado'  => $estado,
					);
				$this->session->set_userdata('save_data', $grabar_datos_array);
				redirect(base_url('Manager/Links'));
			}
		 
//		}
		/*busco el maximo orden para cargar el siguiente */
		$this->db->select_max('orden_link');
		$query = $this->db->get('links');
		$orden = intval($query->row('orden_link'))+1;
		
		$datos = array(
			'data' =>'data',
			'page_title' =>'Links de interés',
			'orden' => $orden
		);

		$seccion = $this->load->view('manager/secciones/links/listado',$datos, TRUE);

		$panel = $this->load_panel();
		
		$css =  array(
			base_url().'static/manager/assets/extra-libs/DataTables/rowReorder.dataTables.min.css', 
			base_url().'static/manager/assets/extra-libs/DataTables/dataTables.min.css', 
		);			
		$scripts =  array(
			base_url().'static/manager/assets/extra-libs/DataTables/dataTables.rowReorder.min.js?ver='.time(), 
			base_url().'static/manager/assets/extra-libs/DataTables/dataTables.select.min.js?ver='.time(), 
			base_url().'static/manager/scripts/links.js?ver='.time(), 
			);
		
			$data = array(
				'css' => $css,
				'content' => $seccion,
				'header' => $panel['header'],
				'panel' => $panel['panel'],
				'script' => $scripts,

			);

			$this->load->view('manager/head',$data);
			$this->load->view('manager/index',$data);
			$this->load->view('manager/footer',$data);
	

	}
	
	
	public function buscar_link(){
		if($this->input->is_ajax_request()){
		 	$query = $this->db->select('*')
							->where('id_link',$this->input->post('id'))
							->get('links');
			
			if ($query->result() > 0){
				$result = $query->row();
				
				$response = array(
					'response'=>$result
				);
			};
			echo json_encode($result);
		}
		
	}
	
	public function ordenar(){
		$data = json_decode($_POST['array']);
		$this->db->update_batch('links', $data, 'id_link');
		
		if ($this->db->affected_rows() > 0){
			
		$result = array(
			'status'=>true
		);
		}
				echo json_encode($result);
	}
		
	function check_url($srt){
		if(filter_var(trim($srt), FILTER_VALIDATE_URL)) {
			return true;
		} else {
			$mensaje ='Formatos validos permitidos:<br>';
			$mensaje .='http://www.google.com <br>';
			$mensaje .='http://google.com';
			$this->form_validation->set_message('check_url',$mensaje);
			return false;
		}
	}

	function cambiar_estado(){
		
		$data = array(
			'estado_link' =>$this->input->post('estado')
		);
		if($this->db->update('links', $data, "id_link =".$this->input->post('id'))){
			$estado = true;
			$mensaje = 'El registro se ha Modificado !!!';
		}else{
			$estado = false;
			$mensaje = 'Ocurrió un error al Modificar el registro';
		}
		
		$result = array(
			'estado'=>$estado,
			'mensaje'=>$mensaje,
		);
		
		echo json_encode($result);

	}

	
	function borrar(){
		
		if($this->db->delete('links', array('id_link' => $this->input->post('id')))){
			$estado = true;
			$mensaje = 'El registro se ha eliminado !!!';
		}else{
			$estado = false;
			$mensaje = 'Ocurrió un error al eliminar el registro';
		}
		
		$result = array(
			'estado'=>$estado,
			'mensaje'=>$mensaje,
		);
		
		echo json_encode($result);
		
	}
	
}


?>
