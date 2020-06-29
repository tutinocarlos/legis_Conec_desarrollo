<?php
//application/controllers/usuarios.php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Backup extends MY_Controller {
 
    function __construct(){
        parent::__construct();
								$this->load->library('zip');

		}
	
	public function index(){
		
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}else{

		$user = $this->ion_auth->user()->row();

		$datos = array(
			'user' => $user,
			'page_title' => 'Respaldo de Base de Datos',
		);

		$seccion = $this->load->view('manager/secciones/backup/backup',$datos, TRUE);

		$panel = $this->load_panel();
		$scripts = array(
			base_url().'static/manager/scripts/backup.js',
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
	function respaldo_db_ajax(){

		$this->load->dbutil();
		
		$db_format = array(
			'format'   => 'zip',
			'filename' => 'lc_db_backup.sql'
		);
		$html = '';
		$backup = $this->dbutil->backup($db_format);
		$db_name = $this->user->id.'-back_up_LC_db_'.date('m-d-Y').'-'.random(3).'.zip';
		$save = 'static/backup/'.$db_name;
		
		
		if(write_file($save, $backup)){
			
		//	$this->load->helper('download');
			
			//force_download($db_name, $backup);
			
			$mensaje = 'Se ha grabado el archivo en disco, descargue el respaldo';
			$estado = true;
			
			$id = random(2);
			
			$html = '<li id="backup_'.$id.'" class="card-body  border-top"><div class="row"><div class="col-md-1"><img src="'.base_url('/static/manager/assets/images/zip.png').'" alt="" class="img-responsive"></div><div class="col-md-5 titulo">	<a href="'.base_url($save).'" class="m-b-0 p-0" id="archivo_1" download="'.$db_name.'">'.$db_name.'</a></div><div class="col-md-5"></div><div class="col-md-1"><i data-id="'.$id.'" data-url="'.$save.'" class="fas fa-trash-alt borrar" title="Borrar"></i></div></div></li>';


		}else{
			
			$mensaje = 'Ocurrió un error al intentar realizar el Respando de Datos<br> No pudo grabar el archivo en disco';
			$estado = false;

		}

		$response = array(
			'archivo'=>$save,
			'estado'=>$estado,
			'mensaje'=>$mensaje,
			'html'=>$html,
			'id'=>$id
		);
		
		echo json_encode($response);
	}	
	
	function respaldo_db(){

		$this->load->dbutil();
		
		$db_format = array(
			'format'   => 'zip',
			'filename' => 'lc_db_backup.sql'
		);
		
		$backup = $this->dbutil->backup($db_format);
		$db_name = $this->user->id.'-back_up_legis_conectadas_db_'.date('m-d-Y').'.zip';
		$save = 'static/backup/'.$db_name;
		
		
		if(write_file($save, $backup)){
			
			$this->load->helper('download');
			
			force_download($db_name, $backup);
			
			$mensaje = 'Se ha grabado el archivo en disco, descargue el respaldo';
			$estado = 'success';
			$grabar_datos_array = array(
				'seccion' => 'Respaldo de Base de Datos',
				'mensaje' => $mensaje,
				'estado' => $estado,
			);
				
			$this->session->set_userdata('save_data', $grabar_datos_array);
			redirect('Manager/Backup');

		}else{
			
			$mensaje = 'Ocurrió un error al intentar realizar el Respando de Datos<br> No pudo grabar el archivo en disco';
			$estado = 'error';
			$grabar_datos_array = array(
				'seccion' => 'Respaldo de Base de Datos',
				'mensaje' => $mensaje,
				'estado' => $estado,
			);
				
			$this->session->set_userdata('save_data', $grabar_datos_array);
		}
			redirect('Manager/Backup');

	}
	
	function borrar_archivo(){
		
		if(unlink($this->input->post('url'))){
			$estado = true;
			$mensaje ='Se ha eliminado el Archivo';
		}else{
			$estado =false;
			$mensaje ='No se ha eliminado el Archivo';
		};
		$response =array(
			'estado'=>$estado,
			'mensaje'=>$mensaje,
			'id'=>$this->input->post('id'),
		);
		echo json_encode($response);
	}
}

?>