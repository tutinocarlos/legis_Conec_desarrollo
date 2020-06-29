<?php
//application/controllers/usuarios.php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Post extends MY_Controller {
 
	function __construct(){
		parent::__construct();
		$this->load->helper('form','url');
		$this->load->library('form_validation');
		$this->load->model('/Manager/Usuarios_model');
		$this->load->model('/Manager/Categorias_model');
		$this->load->model('/Manager/Legislaturas_model');
		$this->load->model('/Manager/Subcategorias_model');
		$this->load->model('/Manager/Post_model');
		$this->load->model('/Manager/Contenidos_model');
		
		$this->page_title = 'Publicaciones';
// 		$this->output->enable_profiler(TRUE);
//		$this->user = $this->ion_auth->user()->row();
// var_dump($this->user);
// if($this->user->re_password == "0"){
// redirect('reset_password');
// }
		
		
	}
	
		 function send(){
        $this->load->library('email');
   //Indicamos el protocolo a utilizar
        $config['protocol'] = 'smtp';
         
       //El servidor de correo que utilizaremos
        $config["smtp_host"] = 'smtp.legislatura.gov.ar';
         
       //Nuestro usuario
        $config["smtp_user"] = 'dirivero@legislatura.gov.ar';
         
       //Nuestra contraseña
        $config["smtp_pass"] = 'D3loused';   
        $config["SMTPCrypto"] = 'ssl';   
         
       //El puerto que utilizará el servidor smtp
//        $config["smtp_port"] = '587';
        
       //El juego de caracteres a utilizar
        $config['charset'] = 'utf-8';
 
       //Permitimos que se puedan cortar palabras
        $config['wordwrap'] = TRUE;
         
       //El email debe ser valido 
       $config['validate'] = true;
       
        
      //Establecemos esta configuración
        $this->email->initialize($config);

 $from_email = "dirivero@legislatura.gov.ar";
        $to_email = "tutinocarlos@gmail.com";
        //Load email library
        $this->email->from($from_email, 'Identification');
        $this->email->to($to_email);
        $this->email->subject('Send Email Codeigniter');
        $this->email->message('The email send using codeigniter library');
        //Send mail
        if($this->email->send()){
									
            echo "email_sent Congragulation Email Send Successfully";
								}else{
									
         echo "email_sent You have encountered an error";
								}
        echo 'fin'; die;
				
				
				echo 'funciton send';
        // Load PHPMailer library
        $this->load->library('phpmailer_lib');
        
        // PHPMailer object
        $mail = $this->phpmailer_lib->load();
        
        // SMTP configuration
				/*
			define('SMTP_MAIL','dirivero@legislatura.gov.ar');
define('SMTP_PASS','D3loused');
define('SMTP_IP','10.1.1.62');
				*/
        $mail->isSMTP();
        $mail->Host     = 'mail.legislatura.gov.ar';
        $mail->SMTPAuth = true;
        $mail->Username = 'catutino@legislatura.gov.ar';
        $mail->Password = '1826';
								$mail->Port = 25; 
        
        $mail->setFrom('info@example.com', 'Programacion.net');
        $mail->addReplyTo('info@example.com', 'Programacion.net');
        
        // Add a recipient
        $mail->addAddress('tutinocarlos@gmail.com');
        
        // Add cc or bcc 
        $mail->addCC('cc@example.com');
        $mail->addBCC('bcc@example.com');
        
        // Email subject
        $mail->Subject = 'Send Email via SMTP using PHPMailer in CodeIgniter';
        
        // Set email format to HTML
        $mail->isHTML(true);
        
        // Email body content
        $mailContent = "<h1>Send HTML Email using SMTP in CodeIgniter</h1>
            <p>This is a test email sending using SMTP mail server with PHPMailer.</p>";
        $mail->Body = $mailContent;
        
        // Send email
        if(!$mail->send()){
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }else{
            echo 'Message has been sent';
        }
    }
		
		
	
	public function edit_post($id){
		


		$publicacion = $this->Post_model->get_post($id);
		$imagenes = $this->Post_model->get_images($id);
		$videos = $this->Post_model->get_videos($id);
		$adjuntos = $this->Post_model->get_adjuntos($id);
		
		$data_select_tipo     = $this->Categorias_model->obtener_contenido_select('tipo_publicacion');

		$data_select_cate     = $this->Categorias_model->obtener_contenido_select('categorias');
		
		$select_data_ambito = $this->Categorias_model->obtener_contenido_select('ambito');

		$data_select_legi     = $this->Legislaturas_model->obtener_contenido_select();
		
		$data_select_normativa = $this->Categorias_model->obtener_contenido_select('tipo_normativa');
	
		$data = array(
			'user' 									=> $this->user,
			'post' 									=> $publicacion,
			'imagenes' 							=> $imagenes,
			'legislatura' 					=> $data_select_legi,
			'data_select_tipo'			=> $data_select_tipo,
			'data_select_cate'			=> $data_select_cate,
			'data_select_normativa'	=> $data_select_normativa,
			'data_select_ambito'		=> $select_data_ambito,
			'videos'								=> $videos ,
			'adjuntos'							=> $adjuntos ,
		);
					
		$seccion = $this->load->view('manager/secciones/post/edit_post',$data, TRUE);
		
		$panel = $this->load_panel();
		
		$script = array(
			base_url().'static/manager/ckeditor/ckeditor.js?ver='.time(), 
			base_url().'static/manager/ckeditor/adapters/jquery.js?ver='.time(), 
			base_url().'static/manager/scripts/edit_post.js?ver='.time(),
			base_url().'static/manager/scripts/borrar_imagen.js?ver='.time(),
		
		);
	
		$data = array(
			'page_title'	=> 'Editar Publicación:'. $publicacion->titulo,
			'content' 		=> $seccion,
			'header'	 		=> $panel['header'],
			'panel'	 			=> $panel['panel'],
			'script'			=> $script
		);

		$this->load->view('manager/head');
		$this->load->view('manager/index',$data);
		$this->load->view('manager/footer',$data);
		
	}
	

	public function post_listados(){
		
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}

		
//		var_dump($this->user);
//		if($this->user->re_password == "0"){
//				redirect('reset_password');
//			}
			
			$seccion = $this->load->view('manager/secciones/post/listados','$datos', TRUE);
			$panel = $this->load_panel();
		
		
			$data = array(
				'page_title' => $this->page_title ,
				'content' => $seccion,
				'header' => $panel['header'],
				'panel' => $panel['panel'],
				'script' =>  base_url().'static/manager/scripts/listados_post.js?ver='.time()
			);

			$this->load->view('manager/head');
			$this->load->view('manager/index',$data);
			$this->load->view('manager/footer',$data);
		
		}
		
	function status_post(){
		if($this->input->is_ajax_request())
    {

			if($this->Post_model->check($this->input->post())){
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
	function borrar_post(){
		if($this->input->is_ajax_request())
    {

			if($this->Post_model->borrar($this->input->post())){
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
	
	public function get_listados_ajax(){

		
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}else{

			$listado_post =  $this->Post_model->get_post_ajax();

			return $listado_post;
		}
	}    
	
	public function index($id_post=null){


		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}

		if($this->input->post()){

			$this->form_validation->set_rules('id_user_login', 'Usuario', 'required');	
			$this->form_validation->set_rules('id_legislatura', 'Legislatura', 'required|callback_check');
			
			// si la publicacion no es de Legislaturas conectadas el parametro Legislatura es obligatorio
			if(!isset($_POST['is_legis_conectadas'])){
				
				$is_legis_comenctadas = 0;
				
				
			}else{
				$is_legis_comenctadas =  $this->input->post('is_legis_conectadas');
			}
			if($this->input->post('tipo') == '1'){
		
				$this->form_validation->set_rules('normativa', 'Tipo Normativa', 'required|callback_check');
			}			
			if($this->input->post('tipo') === 2){
//				$this->form_validation->set_rules('autor', 'Autor', 'required');
			}
			if($this->input->post('tipo') != 2){
//				$this->form_validation->set_rules('estado_art', 'Estado', 'required|callback_check');	
			}
			
			$this->form_validation->set_rules('tematica', 'Temática', 'required|callback_check');	
			$this->form_validation->set_rules('ambito', 'Ámbito', 'required|callback_check');	
			$this->form_validation->set_rules('tipo', 'Tipo Publicación', 'required|callback_check');	
			$this->form_validation->set_rules('titulo', 'Titulo', 'required');	
			$this->form_validation->set_rules('cuerpo', 'Cuerpo ', 'required');	
//			$this->form_validation->set_rules('resumen', 'Resumen ', 'required');	
			
		}
		if($this->form_validation->run() === true){
			
			
			
			$datos = array(
				'is_legis_conectadas' => $is_legis_comenctadas ,
				'id_legislatura' => $this->input->post('id_legislatura') ,
				'id_tipo_normativa' => $this->input->post('normativa') ,
				'id_tipo' => $this->input->post('tipo') ,
				'is_destacado' => $this->input->post('destacada') ,
				'id_usuario' => $this->input->post('id_user_login') ,
				'id_categoria' => $this->input->post('tematica') ,
				'id_ambito' => $this->input->post('ambito') ,
				'autor' => $this->input->post('autor') ,
				'estado_art' => $this->input->post('estado_art') ,
				'titulo'=> $this->input->post('titulo') ,
				'resumen' => $this->input->post('resumen_prev',FALSE) ,
				'cuerpo' => $this->input->post('cuerpo_prev',FALSE) ,
				'extra' => $this->input->post('extra_prev',FALSE) ,
//				'id_user_login' => $this->user->id ,
			);
			
			if($this->input->post('botonSubmit_edit')){
				
				unset($datos['id_usuario']);
				
				$datos['user_upd'] = $this->user->id;
				$datos['fecha_upd'] = $this->fecha_now;
	
				// parametos 1-id publicacion, 2-array de datos, 3-tabla
				if($this->Post_model->update_post($id_post, $datos, 'publicaciones')){
					
					$array_session_data = array(
        		'msj_update'  => 'La publicación se Actualizó con éxito',
        		'class'     => 'alert-success',
					);
				
					redirect('Manager/Post/edit_post/'.$id_post, 'refresh');
					
				}else{
					
					$array_session_data = array(
        		'msj_update'  => 'Ha ocurrido un error al actualizar la publicación',
        		'class'     => 'alert-danger',
					);
					
					$this->session->set_userdata($array_session_data);
					
					redirect('Manager/Post/edit_post/'.$id_post, 'refresh');
				}
				
			}
			
			if($this->Post_model->Guardar_datos('publicaciones',$datos )){
				$datosultimoId = $this->db->insert_id(); 
				
				if($this->input->post('tags')){

				$data = array();
				foreach($this->input->post('tags') as $key => $value){
					$data[$key]['texto'] = trim($value);
					$data[$key]['id_post'] = $datosultimoId;
		
				}
			
					if($this->Post_model->put_tag('tags',$data )){

					}
				}
				// guardo en session
				$session_reg = array(
					'id_user_login' => $this->user->id,
					'user_id' => $this->input->post('id_user_login'),
					'post_id' => $datosultimoId,
					'post_titulo' => limpiar_caracteres($this->input->post('titulo')),
				);
				
				$estado = "success";
				$mensaje = "Se ha Ingresado Correctamente";
				$grabar_datos_array = array(
                'seccion' => 'Cargar Publicación',
                'mensaje' => $mensaje,
                'estado' => $estado,
            );
				
				
				$this->session->set_userdata($session_reg);

			}else{
				$grabar_datos_array['estado']= "error";
				$grabar_datos_array['mensaje']= "A ocurrido un error el intentar actializar  ->index()";
			}
				$this->session->set_userdata('save_data', $grabar_datos_array);
				redirect('Manager/Post/add_media/', 'refresh');
		}
		
			$data_select_tipo = $this->Categorias_model->obtener_contenido_select('tipo_publicacion');
			$data_select_cate = $this->Categorias_model->obtener_contenido_select('categorias');
			$data_select_ambito = $this->Categorias_model->obtener_contenido_select('ambito');
			$data_select_normativa = $this->Categorias_model->obtener_contenido_select('tipo_normativa');
			$data_select_legi = $this->Legislaturas_model->obtener_contenido_select();

			$datos = array(
				'user' 									=> $this->user,
				'groups' 								=> $this->ion_auth->groups()->result_array(),
				'data_select_tipo'    	=> $data_select_tipo,
				'data_select_cate'    	=> $data_select_cate,
				'data_select_legi'    	=> $data_select_legi,
				'data_select_ambito'  	=> $data_select_ambito,
				'data_select_normativa' => $data_select_normativa,
			);

			$seccion = $this->load->view('manager/secciones/post/post',$datos, TRUE);

			$panel = $this->load_panel();
		
			$scripts =  array(
//					base_url().'static/manager/editor2/plugins/link/dialogs/link.js?ver='.time(), 
//					base_url().'static/manager/editor2/plugins/table/dialogs/table.js?ver='.time(), 
//					base_url().'static/manager/editor2/plugins/specialchar/dialogs/specialchar.js?ver='.time(), 
//					base_url().'static/manager/editor2/plugins/pastefromword/filter/default.js?ver='.time(), 
					base_url().'static/manager/ckeditor/ckeditor.js?ver='.time(), 
					base_url().'static/manager/ckeditor/config.js?ver='.time(), 
					base_url().'static/manager/ckeditor/adapters/jquery.js?ver='.time(), 
					base_url().'static/manager/scripts/post.js?ver='.time(),
					
				);
		
			$data = array(
				'page_title' => $this->page_title,
				'content' => $seccion,
				'header' => $panel['header'],
				'panel' => $panel['panel'],
				'script' => $scripts
			);

			$this->load->view('manager/head');
			$this->load->view('manager/index',$data);
			$this->load->view('manager/footer',$data);
	}
	
	
	/*BORRAR ADJUNTOS*/
	
	public function borrar_adjunto(){
		
		
		if($this->Post_model->borrar_adjunto($this->input->post('id'))){
			
			$status = 'true';
		}else{
			$status = 'false';
		}
		
		$result = array(
			'estado' => $status
		);
		echo json_encode($result);
	}
	
	/* AGREGAR ARCHIVOS ADJUNTOS */
	public function add_archivo_adjunto(){

//		var_dump($_POST);
//		var_dump($_FILES);
//		die();
		
		$status = "";
		$msg = "";
		$file_element_name = 'userfile';
  
    if ($status != "error"){
        $config['upload_path'] = 'static/web/uploads/adjuntos';
        $config['allowed_types'] = '*';
        $config['max_size'] = 1024 * 8;
        $config['encrypt_name'] = FALSE;
 
        $this->load->library('upload', $config);
 
        if (!$this->upload->do_upload($file_element_name))
        {
          $status = 'error';
          $msg = $this->upload->display_errors('', '');
        }
        else
        {
						$data = $this->upload->data();
					
						$url = $config['upload_path'].'/'.$data['file_name'];
						
						$datos = array(
							'id_post' => $this->input->post('id_post'),
							'id_user_add' => $this->user->id,
							'detalle ' => $this->input->post('detalle'),
							'url' => $url,
						);
					
							$file_id = $this->Post_model->insert_adjunto($datos);
					
							if($file_id) {
							
							$file = $this->Post_model->get_adjunto($file_id);
							
//							var_dump($file);
					
							$user_add = $this->ion_auth->user($file->id_user_add)->row();
//							var_dump($user_add);
							
//							die();
                $status = "success";
                $msg = "Archivo agregado correctamente";
							
							
							$html = '<div class="d-flex flex-row comment-row" id="adjunto_'.$file->id.'"><div class="comment-text w-100"><h6 class="font-medium"><a href="'.base_url($file->url).'" target="_blank">'.$data['file_name'].'</a></h6><span class="m-b-15 d-block"></span><div class="comment-footer"><span class="text-muted float-right">Subido el:
									'.fecha_es($file->fecha_add, "d F a", false).', por:'.$user_add->last_name.', '.$user_add->first_name.'</span><button type="button" class="btn btn-danger btn-sm borrar_adjunto" data-id="'.$file->id.'" data-archivo="'.$data['file_name'].'">Borrar</button></div></div></div>';
							
							
            }
            else
            {
                unlink($data['full_path']);
                $status = "error";
                $msg = "Ocurrión un error al intentar adjuntar un archivo.";
            }
        }
			
			
			
			$response = array(
				"status"=>$status,
				"msg" =>$msg,
				"html" =>$html
			);

    }
    echo json_encode($response);
		
	}
	
	public function add_media(){
		

		$this->session->userdata('post_id');
		$this->session->userdata('post_titulo');
		$imagenes = $this->Post_model->get_images($this->session->userdata('post_id'));
		
		
	
		if($this->session->userdata('post_id') && $this->session->userdata('post_titulo')){
														
		if (!$this->ion_auth->logged_in())
		{
				redirect('auth/login');
		}
		
		$datos = array(
			'user' 				=> $this->user,
			'post_id' 		=> $this->session->userdata('post_id'),
			'post_titulo' => $this->session->userdata('post_titulo'),
			'imagenes' 		=> $imagenes,
			'videos' 		=> $this->Contenidos_model->buscar_videos($this->session->userdata('post_id')),
		);
			
			$seccion = $this->load->view('manager/secciones/post/add_media',$datos, TRUE);
			$panel = $this->load_panel();
			
			$scripts =  array(
					base_url().'static/manager/assets/libs/magnific-popup/dist/jquery.magnific-popup.min.js',
					base_url().'static/manager/assets/libs/magnific-popup/meg.init.js',
					base_url().'static/manager/scripts/add_media.js',
					base_url().'static/manager/scripts/borrar_imagen.js',
				);
			
			$data = array(
				'page_title' => $this->page_title .' - Agregar Multimedia',
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
	public function borrar_video(){
	
		if($this->db->delete('post_videos', array('id' => $this->input->post('id_video')))){
			$status = true;
			$estado = "success";
			$mensaje = "Se ha Borrado Correctamente";
		}else{
			$estado = "error";
			$mensaje = "Ocurrió un error al borrar el video";
			$status = false;
		}
		$grabar_datos_array = array(
				'seccion' => 'Publicaciones Videos',
				'mensaje' => $mensaje,
				'estado' => $estado,
				'open_video' => true,
			);
		$this->session->set_userdata('save_data', $grabar_datos_array);

		$response = array(
			'status'=>$status
		);
	 	echo json_encode($response);
}
	public function add_video(){
		
		if($this->input->post('url_video') == ''){
			$response = array(
				'status'   =>false,
				'mensaje' =>'EL campo URL es Obligatorio '
			);
			echo json_encode($response);
			die();
		}
		

	/*
	array(4) {
  ["id_post"]=>
  string(3) "294"
  ["titulo_video"]=>
  string(68) "Subir Archivos (Imágenes) con CodeIgniter y Ajax - Librería Upload"
  ["detalle_video"]=>
  string(0) ""
  ["url_video"]=>
  string(43) "https://www.youtube.com/watch?v=OVs5-vmDv_U"
}
*/

		
//		if($this->session->userdata('post_id') && $this->session->userdata('post_titulo')){

														
		if (!$this->ion_auth->logged_in())
		{
				redirect('auth/login');
		}
			
			$data = array(
			 'id_post'=> $this->input->post('id_post'),
			 'titulo'=> $this->input->post('titulo_video'),
			 'descripcion'=> $this->input->post('detalle_video'),
			 'url'=> str_replace('https://www.youtube.com/watch?v=','',$this->input->post('url_video')),
				'user_add'=>$this->user->id
			);
			
			if($this->Post_model->Guardar_datos('post_videos', $data)){
				
				$status = true;
				$estado = "success";
				$mensaje = "Se ha Grabado Correctamente";
			
			}else{
				
				$estado = "error";
				$mensaje = "Ocurrió un error al Cargar el video";
				$status = false;
				
			}
			$response = array(
				'status' =>$status	
				);
		
		$grabar_datos_array = array(
				'seccion' => 'Publicaciones Videos',
				'mensaje' => $mensaje,
				'estado' => $estado,
				'open_video' => true,
			);
		$this->session->set_userdata('save_data', $grabar_datos_array);
		
		echo json_encode($response);
			exit();
//		}
		
	}
	
	public function upload_file(){
		
		if (!$this->ion_auth->logged_in())
		{
				redirect('auth/login');
		}
		
		if($this->input->is_ajax_request())
		{
			if(isset($_FILES['mi_archivo']['name'])){
				$nombre_archivo = $this->session->userdata('post_id').'_'.limpiar_caracteres($this->session->userdata('post_titulo'));
        $mi_archivo = 'mi_archivo';
				$file_ext = pathinfo($_FILES["mi_archivo"]["name"], PATHINFO_EXTENSION);
        $config['upload_path'] = "static/web/images/uploads/post";
      	$config['file_name'] = $nombre_archivo;	
        $config['allowed_types'] = "jpg|jpeg|png|gif|bmp";
        $config['max_size'] = "50000";
        $config['max_width'] = "2000";
        $config['max_height'] = "2000";

        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload($mi_archivo)) {
					
            //*** ocurrio un error
            $data['uploadError'] = $this->upload->display_errors();
            echo $this->upload->display_errors();
            return;
        }
				
				$data = array(
					'foto'=> "static/web/images/uploads/post/".$nombre_archivo.'.'.$file_ext.'?param='.rand(3, 15)
				);
				
				$this->db->where('id',$this->session->userdata('post_id'));
				$this->db->update('publicaciones', $data);
				
        $data['uploadSuccess'] = $this->upload->data();
				
				echo '<a class="example-image-link" href="/static/web/images/uploads/post/'.$nombre_archivo.'.'.$file_ext.' data-lightbox="example-1"><img class="img-fluid example-image" src="/static/web/images/uploads/post/'.$nombre_archivo.'.'.$file_ext.'?data=12515" alt="image-1"></a>';
			}
			
		}
		
	}
	
	public function upload_file_2(){


		$data = array();
		$nombre_archivo = array();
		if($this->input->post('fileSubmit') && !empty($_FILES['userFiles']['name'])){
			
			$cantidad_fotos = $cantidad = $this->Post_model->contar_fotos($this->input->post('id_post'));
			
			$filesCount = count($_FILES['userFiles']['name']);
			
			for($i = 0; $i < $filesCount; $i++){
				
				$total = $i + $cantidad_fotos;
//echo '<br>'.$this->input->post('id_post');
////			die();
				$nombre_archivo=$this->input->post('id_post').'_'.$total.'_'. limpiar_caracteres($_FILES['userFiles']['name'][$i]);
				$total = 0;
				$file_ext = pathinfo($_FILES['userFiles']['name'][$i], PATHINFO_EXTENSION);
				$nombre_archivo = str_replace($file_ext,'',$nombre_archivo);
				
				$_FILES['userFiles']['name'][$i] = $nombre_archivo.'.'.$file_ext;
				$_FILES['userFile']['name'] = $_FILES['userFiles']['name'][$i];
				$_FILES['userFile']['type'] = $_FILES['userFiles']['type'][$i];
				$_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
				$_FILES['userFile']['error'] = $_FILES['userFiles']['error'][$i];
				$_FILES['userFile']['size'] = $_FILES['userFiles']['size'][$i];

				$uploadPath = 'static/web/images/uploads/post';
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'gif|jpg|png|jpeg';

				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
				

				if($this->upload->do_upload('userFile')){
//					echo 'si';

				$fileData = $this->upload->data();

				$uploadData[$i]['url'] = $uploadPath .'/'.$nombre_archivo.'.'.$file_ext;
				// $uploadData[$i]['modified'] = date("Y-m-d H:i:s");
				$uploadData[$i]['id_post'] = $this->input->post('id_post');
				}else{
//					echo 'no';
//					
//					 echo $this->upload->display_errors(); die();
				}
				
				
			}


			if(!empty($uploadData)){
				//Insert file information into the database
				$insert = $this->Post_model->insert_file($uploadData);
			
				switch ($this->input->post('editar_post')) {
					case 1:
						$grabar_datos_array['seccion']= "Agregar imágenes";
						$grabar_datos_array['estado']= "success";
						$grabar_datos_array['mensaje']= "Se ha cargado la imagen";
						$grabar_datos_array['open_imagen']= 'active';
		
						$this->session->set_userdata('save_data', $grabar_datos_array);
						redirect(base_url('Manager/Post/edit_post/'.$this->input->post('id_post')));
        	break;
    			
					default:
						redirect(base_url().'Manager/Post/add_media');
					break;
				}

			}
		}
	}
		public function upload_file_docs(){

		$data = array();
		$nombre_archivo = array();
		if($this->input->post('fileSubmit') && !empty($_FILES['userdocs']['name'])){
			
			$cantidad_fotos = 4;
//			$cantidad_fotos = $cantidad = $this->Post_model->contar_fotos($this->input->post('id_post'));
			
			$filesCount = count($_FILES['userdocs']['name']);
			
			for($i = 0; $i < $filesCount; $i++){ 
//echo '<br>'.gettype ($filesCount);
//echo '<br>'.gettype ($cantidad_fotos);
//echo '<br>'.gettype ($i);
//
				
				$total = $i + $cantidad_fotos;
//echo '<br>'.$this->input->post('id_post');
////			die();
				$nombre_archivo=$this->input->post('id_post').'_'.$total.'_'. limpiar_caracteres($_FILES['userdocs']['name'][$i]);
				$total = 0;
				$file_ext = pathinfo($_FILES['userdocs']['name'][$i], PATHINFO_EXTENSION);
				$nombre_archivo = str_replace($file_ext,'',$nombre_archivo);
				
				$_FILES['userdocs']['name'][$i] = $nombre_archivo.'.'.$file_ext;
				$_FILES['userdocs']['name'] = $_FILES['userdocs']['name'][$i];
				$_FILES['userdocs']['type'] = $_FILES['userdocs']['type'][$i];
				$_FILES['userdocs']['tmp_name'] = $_FILES['userdocs']['tmp_name'][$i];
				$_FILES['userdocs']['error'] = $_FILES['userdocs']['error'][$i];
				$_FILES['userdocs']['size'] = $_FILES['userdocs']['size'][$i];

		    $uploadPath = 'static/web/uploads/adjuntos';
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = '*';

				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('userdocs')){
					
echo 'si';
				$fileData = $this->upload->data();

				$uploadData[$i]['url'] = $uploadPath .'/'.$nombre_archivo.'.'.$file_ext;
				// $uploadData[$i]['modified'] = date("Y-m-d H:i:s");
				$uploadData[$i]['id_post'] = $this->input->post('id_post');
				}else{
					
					var_dump($error = array('error' => $this->upload->display_errors()));
				}
			}
				//echo '<br>cantidad->'.$total; //die();

			if(!empty($uploadData)){
				//Insert file information into the database
				$insert = $this->Post_model->insert_file($uploadData);
			
				switch ($this->input->post('editar_post')) {
					case 1:
						redirect(base_url('Manager/Post/edit_post/'.$this->input->post('id_post')));
        	break;
    			
					default:
						redirect(base_url().'Manager/Post/add_media');
					break;
				}

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
				$this->form_validation->set_rules('password', 'Contraseña', 'required|min_length[3]');
				$this->form_validation->set_rules('re-password', 'Repetir', 'required|min_length[3]|callback_psw_check');
				
				if($this->form_validation->run() === true){
					$username = $this->input->post('usuario'); 
					$password = $this->input->post('password'); 
					$email = $this->input->post('email'); 
					$user = $this->ion_auth->user()->row();
					$additional_data = array(
											'first_name' => $this->input->post('first_name'),
											'last_name' => $this->input->post('last_name'),
											'id_legislatura' => $this->input->post('legislatura'),
											'user_ins' =>$user->id,
											);
					$group = array($this->input->post('grupo')); // Sets user to admin.

					if($this->ion_auth->register($username, $password, $email, $additional_data, $group))
					{
						redirect('Manager/Usuarios', 'refresh');
					}
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
		
				$seccion = $this->load->view('manager/secciones/usuarios',$datos, TRUE);
		
				$panel = $this->load_panel();
				$data = array(
					'content' => $seccion,
					'header' => $panel['header'],
					'panel' => $panel['panel'],
					'script' => 'static/manager/scripts/usuarios.js'
					);

				$this->load->view('manager/head');
				$this->load->view('manager/index',$data);
				$this->load->view('manager/footer',$data);
			}

		}else{
			redirect('auth/login');
		}
		
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
	/// fin funciones call back de form_validation
	
	public function get_usuarios(){
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
		if($this->input->is_ajax_request())
		{
			$usuarios = $this->Subcategorias_model->get_subcategorias('');
			return $usuarios ;
		}
	}
	
	
	public function get_subcategorias_id(){
	
		if($this->input->is_ajax_request()){
			
			$data_select = $this->Categorias_model->obtener_listados_id('sub_categorias',$this->input->post('id') );
		
      $select_data = array(
            'elementos' => $data_select,
            'value'     => 'id',
            'option'    => 'nombre'
          );
       
				$select = $this->load->view('/manager/plantillas/select', $select_data, TRUE);
			
			echo $select ;
		}
	}
	
	public function grabar(){

		if(!$this->input->post() && !$this->ion_auth->logged_in() && !$this->input->post("botonSubmit")){
			redirect('auth/login');
		}
		
		if($this->input->post("botonSubmit")){

				$this->form_validation->set_rules('legislatura', 'Legislatura', 'required');
				$this->form_validation->set_rules('grupo', 'Tipo de Usuario', 'required');
				$this->form_validation->set_rules('first_name', 'Nombre', 'required|min_length[3]');
				$this->form_validation->set_rules('last_name', 'Apellido', 'required|min_length[3]');
				$this->form_validation->set_rules('email', 'Email', 'required|min_length[3]|callback_email_check');
				$this->form_validation->set_rules('usuario', 'Nombre de usuario', 'required|min_length[5]|callback_user_check');
				$this->form_validation->set_rules('password', 'Contraseña', 'required|min_length[3]');
				$this->form_validation->set_rules('re-password', 'Repetir', 'required|min_length[3]|callback_psw_check');
		}else{
			echo ' no'; die();
		}

	}
	
	
	public function eliminar_imagen(){
		
		if($this->input->is_ajax_request() )
		{
			
		
			if($this->Post_model->eliminar_imagen($this->input->post())){
				$id_post = $this->input->post('post');
				$cantidad = $this->Post_model->contar_fotos($id_post);
				$result = array(
					'estado'=>true,
					'cantidad'=>$cantidad
				);
				
			}
			
		}else{
			
			$result = array(
				'cantidad'=>'$cantidad',
				'estado'=>false
			);
		}
		
			echo  json_encode($result);
		
	}
}

?>
