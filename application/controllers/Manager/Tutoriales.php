<?php
//application/controllers/usuarios.php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Tutoriales extends MY_Controller {
 
	function __construct(){
			parent::__construct();

			$this->load->helper('form','url');
			$this->load->library('form_validation');
			$this->load->library('encryption');

			$this->load->model('/Manager/Tutoriales_model');
//		$this->output->enable_profiler(TRUE);
		
		if(!$this->ion_auth->user()->row()){
						redirect('auth/login');
				};
		
	}

	public function index(){
		
//		$rx = '~
//  ^(?:https?://)?(?:www[.])? (?:youtube[.]com/watch[?]v=|youtu[.]be/)([^&]{11}) ~x';
//$url = 'https://www.youtubse.com/watch?v=OVs5-vmDv_Usasassa';
//echo $has_match = preg_match($rx, $url, $matches);die();

			if (!$this->ion_auth->logged_in())
				{
					redirect('auth/login');
				}
		$data = array(
			'tutoriales'=>$this->Tutoriales_model->get_tutoriales()
		);
		$tutoriales = $this->Tutoriales_model->get_tutoriales();
	 $tutoriales = $this->load->view('manager/plantillas/tutoriales',$data, TRUE);
		
		if(!$tutoriales){
			$tutoriales = '<div class="text-center">No se encontraron resultados</div>';
		}
		
		$datos = array(
			'page_title' =>'Tutoriales utilización Backend Legislaturas Conectadas',
			'tutoriales'=> $tutoriales
		);

		$seccion = $this->load->view('manager/secciones/tutoriales/altas',$datos, TRUE);

		$panel = $this->load_panel();

		$scripts =  array(
				base_url().'static/manager/scripts/tutoriales.js?ver='.time(), 
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
	
//	
//	$id_barco =	$this->encryption->decrypt($id);

	public function visor($tipo,$url){
		
		

//		die(base_url($url2));
		if($tipo == 0){

//			'<embed src="archiv.pdf#toolbar=0&navpanes=0&scrollbar=0" type="application/pdf" width="100%" height="1000px" />';
			$tutorial = '<embed src="'.base_url('static/manager/tutoriales/'.$url).'" type="application/pdf" width="100%" height="1000px" />';
		}else{
			$tutorial = '<iframe class="centrado" width="800" height="450" src="https://www.youtube.com/embed/'.$url.'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
			
		}
		
		$datos = array(
			'page_title' =>'Tutoriales utilización Backend Legislaturas Conectadas',
			'tutorial'=>$tutorial
		);


		$seccion = $this->load->view('manager/secciones/tutoriales/visor',$datos, TRUE);

		$panel = $this->load_panel();

		$scripts =  array(
				base_url().'static/manager/scripts/tutoriales.js?ver='.time(), 
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
	
	public function grabar_video(){
		
		if($this->input->is_ajax_request()){
			
			$this->form_validation->set_rules('titulo', 'Titulo', 'required');
			$this->form_validation->set_rules('url_video', 'url Video', 'required');
			$this->form_validation->set_rules('detalle_video', 'Descripción', 'required');
			
			if($this->form_validation->run() === true){
				$url_video = str_replace('https://www.youtube.com/watch?v=','',$this->input->post('url_video'));
				$data = array(
					'titulo'=> $this->input->post('titulo'),
					'descripcion'=> $this->input->post('detalle_video'),
					'url'=> $url_video,
					'video'=>1,
					'user_add'=> $this->user->id
				);
				
					if($this->Tutoriales_model->Guardar_datos('tutoriales',$data)){
						$last_id = $this->db->insert_id();
						


					$html = '<li class="card-body  border-top"><a id="tutorial_'.$last_id.'" href="'.base_url().'Manager/Tutoriales/visor/1/'.$url_video.'" class="m-b-0 p-0"><div class="row"><div class="col-md-1 text-center"><img src="'. base_url('static/manager/tutoriales/iconos/youtube.png').'" alt="" class="img-responsive"></div><div class="col-md-5 titulo">'.$this->input->post('titulo').'</div><div class="col-md-5">'.$this->input->post('detalle_video').'</div><div class="col-md-1" class="borrar" data-id='.$last_id.' data-video="1"><i class="fas fa-trash-alt borrar" title="Borrar"></i></div></div></a></li>';
						
						
						$html ='<li class="card-body  border-top" id="tutorial_'.$last_id.'"><div class="row"><div class="col-md-1"><a href="'.base_url().'Manager/Tutoriales/visor/0/'.$url_video.'" class="m-b-0 p-0" ><img src="'. base_url('static/manager/tutoriales/iconos/youtube.png').'" alt="" class="img-responsive"></a></div><div class="col-md-4">
			<a href="'.base_url().'Manager/Tutoriales/visor/0/'.$url_video.'" class="m-b-0 p-0" >
					<strong>'.$this->input->post('titulo').'</strong></a></div><div class="col-md-4"><a href="'.base_url().'Manager/Tutoriales/visor/0/'.$url_video.'" class="m-b-0 p-0" >'.$this->input->post('detalle_video').'</a></div><div class="col-md-1">
					<a style="color: white;" href="#" data-url="'.$url_video.'" data-id="'.$last_id.'" data-video="1"  class="borrar_tutorial btn btn-danger btn-xs"><i class="fas fa-trash-alt" title="Borrar"></i> </a></div>
						<?php endif;?>

				</div>
		</li>';

						
						$response = array(
						'mensaje' => 'Se han guardado los datos del video en la base de datos',
						'status' => 'success',
						'estado' => true,
						'html' => $html,
						'archivo' => $this->input->post('url_video')	,
						);
					}else{
						$response = array(
						'mensaje' => 'Ocurrió un error al guardar los datos del video en la base de datos',
						'estado'=> false,
						'status'=> 'error',
						);
					}
				
			}else{
				
				$status = 'error';
				$estado = false;

				$response = array(
				'mensaje'=>'Complete los campos requeridos',
				'status'=>$status,
				'estado'=>$estado,
				'titulo_error'=>form_error('titulo'),
				'url_error'=>form_error('url_video'),
				'descripcion_error'=>form_error('detalle_video'),
				);
			}
			
			echo json_encode($response);
		}
	}
		
	public function grabar_archivo(){

		if($this->input->is_ajax_request()){
			
			$nombre_archivo = '';
			
			$this->form_validation->set_rules('titulo', 'Titulo', 'required');
			$this->form_validation->set_rules('descripcion', 'Descripción', 'required');
			$this->form_validation->set_rules('file', '', 'callback_file_check');
			
			
			if($this->form_validation->run() === true){
			
				$file = $_FILES['userfile_pdf']['name'];

				$extension = "".".".pathinfo($file, PATHINFO_EXTENSION);

				$nombre_archivo = strtolower(url_title(limpiar_caracteres(pathinfo($file, PATHINFO_FILENAME)), 'underscore', TRUE).$extension);

				//configuración del archivo a subir
				$config['file_name'] = $nombre_archivo;
				$config['upload_path'] ='static/manager/tutoriales/';
				$config['allowed_types'] = 'pdf';

				//Se pueden configurar aun mas parámetros.
				//Cargamos la librería de subida y le pasamos la configuración
				$this->load->library('upload', $config);

				if(!$this->upload->do_upload('userfile_pdf')){
					/*Si al subirse hay algún error lo meto en un array para pasárselo a la vista*/
					$error=array('error' => $this->upload->display_errors());
//						var_dump($error);
					$estado = false;
					$status = 'error';
					$mensaje = $error['error'];
				}else{

					$estado = true;
					$status = 'success';
					$mensaje = 'Archivo subido correctamente';



					$data = array(
						'titulo'=> $this->input->post('titulo'),
						'descripcion'=> $this->input->post('descripcion'),
						'url'=> $this->upload->data('file_name'),
						'user_add'=> $this->user->id,
						
					);

					if($this->Tutoriales_model->Guardar_datos('tutoriales',$data)){
						$last_id = $this->db->insert_id();
						
						//href="http://http://ci2/Manager/Tutoriales/visor/0/presupuesto_1.pdf"
					 //	http://ci2/Manager/Tutoriales/visor/0/presupuesto_1.pdf
						
						$html = '<li class="card-body  border-top"><a id="tutorial_'.$last_id.'" href="'.base_url().'Manager/Tutoriales/visor/0/'.$this->upload->data('file_name').'" class="m-b-0 p-0"><div class="row"><div class="col-md-1 text-center"><img src="'. base_url('static/manager/tutoriales/iconos/pdf.png').'" alt="" class="img-responsive"></div>
						<div class="col-md-5 titulo">'.$this->input->post('titulo').'</div><div class="col-md-5">'.$this->input->post('descripcion').'</div><div class="col-md-1" class="borrar" data-id='.$last_id.' data-video="1" data-url="'.$nombre_archivo.'"><i class="fas fa-trash-alt borrar" title="Borrar"></i></div></div></a></li>';
						
						$html ='<li class="card-body  border-top" id="tutorial_'.$last_id.'"><div class="row"><div class="col-md-1"><a href="'.base_url().'Manager/Tutoriales/visor/0/'.$this->upload->data('file_name').'" class="m-b-0 p-0" ><img src="'. base_url('static/manager/tutoriales/iconos/youtube.png').'" alt="" class="img-responsive"></a></div><div class="col-md-4">
			<a href="'.base_url().'Manager/Tutoriales/visor/0/'.$this->upload->data('file_name').'" class="m-b-0 p-0" >
					<strong>'.$this->input->post('titulo').'</strong></a></div><div class="col-md-4"><a href="'.base_url().'Manager/Tutoriales/visor/0/'.$this->upload->data('file_name').'" class="m-b-0 p-0" >'.$this->input->post('detalle_video').'</a></div><div class="col-md-1">
					<a style="" href="#" data-url="'.$this->upload->data('file_name').'" data-id="'.$last_id.'" data-video="0"  class="borrar_tutorial btn btn-danger btn-xs"><i class="fas fa-trash-alt" title="Borrar"></i> </a></div>
						<?php endif;?>

				</div>
		</li>';
						
						$mensaje .= '<br> Se han guardado los datos en la base de datos';
					}else{
						$mensaje .= '<br> Ocurrió un error al guardar los datos en la base de datos';
						$estado = false;
						$status = 'error';
					}

				}
				$response = array(
				'status'=>$status,
				'estado'=>$estado,
				'mensaje'=>$mensaje,
				'archivo'=>$nombre_archivo,
				'html'=> $html
				);
				echo json_encode($response);
			}else{
				$status = 'error';
				$estado = false;

				$response = array(
				'mensaje'=>'Complete los campos requeridos',
				'status'=>$status,
				'estado'=>$estado,
				'titulo_error'=>form_error('titulo'),
				'descripcion_error'=>form_error('descripcion'),
				'archivo_error'=>form_error('file'),
				'archivo_nombre'=>$_FILES['userfile_pdf']['name']
				);
				echo json_encode($response);
			}
		}
	}
	
	public function file_check($str){
		$allowed_mime_type_arr = array('application/pdf');
		$mime = get_mime_by_extension($_FILES['userfile_pdf']['name']);
		if(isset($_FILES['userfile_pdf']['name']) && $_FILES['userfile_pdf']['name']!=""){
						if(in_array($mime, $allowed_mime_type_arr)){
										return true;
						}else{
										$this->form_validation->set_message('file_check', 'Seleccione un Archivo tipo PDF');
										return false;
						}
		}else{
						$this->form_validation->set_message('file_check', 'Seleccione un archivo a Grabar');
						return false;
		}
	}

	public function borrar(){

	
$mensaje ='<br>Tutoriales';
		if($this->input->is_ajax_request()){
				
				if($this->input->post('video') == '1'){

					if( $this->db->delete('tutoriales', array('id' => $this->input->post('id')))){
						$mensaje .= 'Video Tutorial eliminado con exito';
						$estado = true;
					}else{
						$mensaje .= 'Ocurrió un error al eliminar el Video Tutorial.';
						$estado = false;
					}
						
				}else{
					
					$url = 'static/manager/tutoriales/'.$this->input->post('url');
					
						if(unlink($url) && $this->db->delete('tutoriales', array('id' => $this->input->post('id')))){
							$estado = true;
							$mensaje .= '<br> Se borro registro <br>Se elimino el archivo Tutorial';
						}else{
							
						$estado = false;
							$mensaje .= '<br> Ocurrió un error al eliminar el archivo';
						}
				}
				
				$response = array(
					'mensaje'=>$mensaje,
					'estado'=>$estado,
					'id'=>$this->input->post('id'),
				);
				
				echo json_encode($response);
				
			};
		
	}
}
?>