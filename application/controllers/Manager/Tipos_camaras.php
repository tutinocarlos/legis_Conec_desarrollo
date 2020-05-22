<?php
//application/controllers/usuarios.php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Tipos_camaras extends MY_Controller {
 
    function __construct(){
        parent::__construct();
			
				if ($this->ion_auth->is_super() OR $this->ion_auth->is_admin())
		{

			if (!$this->ion_auth->logged_in())
				{
					redirect('auth/login');
				}
				}
			$this->load->helper('form','url');
			$this->load->library('form_validation');
		 	$this->load->model('/Manager/Ambitos_model');
		 	$this->load->model('/Manager/Categorias_model');
		 	$this->load->model('/Manager/Provincias_model');
		 	$this->load->model('/Manager/Tipos_camaras_model');
		 	$this->load->model('/Manager/Contenidos_model');
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
			
		if($this->input->is_ajax_request())
    {
			return $this->Provincias_model->get_datatable();
		}
			
			$seccion 		= $this->load->view('manager/secciones/provincias/provincias',$datos, TRUE);
			
			$panel = $this->load_panel();
			$scripts =  array(
					base_url().'static/manager/scripts/provincias.js?ver='.time(), 
					base_url().'static/manager/assets/libs/jquery-minicolors/jquery.minicolors.min.js?ver='.time(), 
					base_url().'static/manager/assets/libs/jquery-asColorPicker/dist/jquery-asColorPicker.min.js?ver='.time(), 
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
	
	function edit($id){
		
		
//		var_dump($_POST);	die();

		if (!$this->ion_auth->is_super() OR !$this->ion_auth->is_admin()){
				redirect('auth/logout');
		}
		
		if($this->input->post("botonSubmit")){
			
			
			$this->form_validation->set_rules('detalle', 'Detalle', 'required|min_length[3]');
			$this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]');
			$this->form_validation->set_rules('tipo_camara', 'Tipo de Cámara', 'required|callback_check');
			$this->form_validation->set_rules('color_provincia', 'Color de la Provincia', 'required|callback_check_color');
			$this->form_validation->set_rules('id', 'ID', 'required');

			if($this->form_validation->run() === true){
				
				// carga imagen
				
					$path = $_FILES['escudo']['name']; 
					$extension = "".".".pathinfo($path, PATHINFO_EXTENSION); 
					
					$nombre = limpiar_caracteres($this->input->post('nombre'));
					$nombre_archivo = url_title($nombre, 'underscore', TRUE).$extension;
					
				
					$config['file_name']          = $nombre_archivo;
					$config['upload_path']          = 'static/web/images/uploads/provincias/';
					$config['allowed_types']        = 'gif|jpg|png';
					$config['max_size'] = "50000";
					$config['max_width'] = "2000";
					$config['max_height'] = "2000";

					$this->load->library('upload', $config);

					if ( !$this->upload->do_upload('escudo')){
						
						$error = array('error' => $this->upload->display_errors());
			
						$mensaje_image = "<br>Ocurrio un error al carga la imagen:<br>".$error['error'];

					}else{
//					array (size=14)
							//  'file_name' => string 'escarapela4.jpg' (length=15)
							//  'file_type' => string 'image/jpeg' (length=10)
							//  'file_path' => string 'C:/Dropbox/htdocs/legislaturas_conectadas/static/web/images/uploads/provincias/' (length=79)
							//  'full_path' => string 'C:/Dropbox/htdocs/legislaturas_conectadas/static/web/images/uploads/provincias/escarapela4.jpg' (length=94)
							//  'raw_name' => string 'escarapela4' (length=11)
							//  'orig_name' => string 'escarapela.jpg' (length=14)
							//  'client_name' => string 'escarapela.jpg' (length=14)
							//  'file_ext' => string '.jpg' (length=4)
							//  'file_size' => float 156.85
							//  'is_image' => boolean true
							//  'image_width' => int 646
							//  'image_height' => int 657
							//  'image_type' => string 'jpeg' (length=4)
							//  'image_size_str' => string 'width="646" height="657"' (length=24)
						
						$mensaje_image = "<br>Se ac actualizado la imagen";
					}
				
				$data = array(
					'escudo'	=> 'static/web/images/uploads/provincias/'.$nombre_archivo,
					'nombre'		=> $this->input->post('nombre') ,
					'comentario' 	=> $this->input->post('comentario') ,
					'camara' 	=> $this->input->post('tipo_camara') ,
					'color' 	=> $this->input->post('color_provincia') ,
					'fecha_upd' => $this->fecha_now ,
					'user_upd'	=> $this->user->id,
				);
	
				if($this->Provincias_model->update_provincia($this->input->post('id'),$data )){
					
					$mensaje ="Se han actualizado los datos correctamente".$mensaje_image;
					$estado ="success";
					
				}else{
					
					$mensaje ="Ha ocurrido un error al actualizar los datos functio manager categorias->update_categoria".$mensaje_image;
					$estado ="error";
					
				}
				
				$grabar_datos_array = array(
					'seccion' => 'Actualizar Provincias',
					'mensaje' => $mensaje,
					'estado' => $estado,
						);

					$this->session->set_userdata('save_data', $grabar_datos_array);
					redirect('/Manager/Provincias', 'refresh');
				}
				
		}
		
		$provincia = $this->Provincias_model->get_provincia($id);
		
		$data = array(
			'provincia'=> $provincia,
			'tipo_camara'=> $this->Categorias_model->obtener_contenido_select('tipo_camara'),
		);
		
		
		$seccion 		= $this->load->view('manager/secciones/provincias/edit',$data, TRUE);
			
			$panel = $this->load_panel();
			$scripts =  array(
					base_url().'static/manager/assets/libs/jquery-minicolors/jquery.minicolors.min.js?ver='.time(), 
					base_url().'static/manager/assets/libs/jquery-asColorPicker/dist/jquery-asColorPicker.min.js?ver='.time(), 
					base_url().'static/manager/scripts/provincias.js?ver='.time(), 
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
		
		/// funciones call back de form_validation
	
		public function check($str){

		if($str == '0'){
			$this->form_validation->set_message('check','El campo <strong>%s</strong> es obligatorio');
			return FALSE;
		}else{
			return TRUE; 
		}
	}
		
public function check_color($str){

	if(preg_match("((#)[0-9a-fA-F]{6})",$str)){
		return TRUE;
	}else{
		$this->form_validation->set_message('check_color','Ingrese un color permitido.El campo <strong>%s</strong> es obligatorio');
		return FALSE;
	}

}
	
}

?>