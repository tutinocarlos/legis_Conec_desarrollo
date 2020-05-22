<?php
//application/controllers/usuarios.php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Legislaturas extends MY_Controller {
 
	function __construct(){
        parent::__construct();

			$user = $this->ion_auth->user()->row();

			$this->load->helper('html');
			$this->load->helper('form','url');
			$this->load->library('form_validation');
		 	$this->load->model('/Manager/Legislaturas_model');
		 	$this->load->model('/Manager/Categorias_model');
			$this->load->helper('file');
			$this->image_properties = array(
				'src'   => '/static/web/images/logos/logoconectadas.jpg',
				'alt'   => $this->config->item('titulo_sitio_web'),
				'class' => 'img-fluid',

				'title' =>$user->nombre_legislatura,
				'rel'   => 'lightbox'
				);

			$this->imagen = img( $this->image_properties,  TRUE );
  
		}
	
	
	public function subir_imagenes(){
	
	
		if(!empty($_FILES['file']['name'])){
					$path = $_FILES['file']['name']; 
					$extension = "".".".pathinfo($path, PATHINFO_EXTENSION); 
					
					$nombre = limpiar_caracteres($this->input->get('nombre'));
					$nombre_archivo = url_title($nombre, 'underscore', TRUE).$extension;
					
				
					$config['file_name']         	 = $nombre_archivo;
					$config['upload_path']          	= 'static/web/uploads/legislaturas/imagenes';
					$config['allowed_types']        = 'jpg|jpeg|png|gif';
					$config['max_size'] = "50000";
					$config['max_width'] = "2000";
					$config['max_height'] = "2000";

					$this->load->library('upload', $config);

					if ( !$this->upload->do_upload('file')){
						$error = array('error' => $this->upload->display_errors());
						var_dump($error);
						
						echo 'si';
						
					}else{
						
						var_dump( $this->upload->data());
					}
			
			
		}

		
	}
	
	public function upload_file_2(){
		
      $data = array();
        if($this->input->post('fileSubmit') && !empty($_FILES['userFiles']['name'])){
            $filesCount = count($_FILES['userFiles']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['userFile']['name'] = $_FILES['userFiles']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['userFiles']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['userFiles']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['userFiles']['size'][$i];

                $uploadPath = 'uploads/files/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png';
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['file_name'] = $fileData['file_name'];
                    $uploadData[$i]['created'] = date("Y-m-d H:i:s");
                    $uploadData[$i]['modified'] = date("Y-m-d H:i:s");
                }
            }
            
            if(!empty($uploadData)){
                //Insert file information into the database
                $insert = $this->file->insert($uploadData);
                $statusMsg = $insert?'Files uploaded successfully.':'Some problem occurred, please try again.';
                $this->session->set_flashdata('statusMsg',$statusMsg);
            }
		
	}}

	public function borrar_registro(){
		if($this->input->is_ajax_request()){
		
			if($this->Legislaturas_model->borrar_registro($this->input->post('id'))){
				$result = array(
					'estado' => true
				);
			}else{
				$result = array(
					'estado' => false
			);
				
			}
			
			echo json_encode($result);
			
		}
		
	}
	
	public function borrar_video(){
		

		
		if($this->Legislaturas_model->borrar_video($this->input->post('id_video'))){
		$result = array(
					'estado'=>true
				);
		
		}else{
			
		$result = array(
					'estado'=>false
				);	
		}
		echo  json_encode($result);
	}
	
	public function chequear_misma_imagen($id,$imagen){
		if($this->Legislaturas_model->chequear_misma_imagen($id, $imagen)){
			return TRUE;
		}else{
			return FALSE;
		}
		
	}	
	
	public function edit($id){
		
		if($this->input->post('botonSubmit')){	
			
			$this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]');
				//			$this->form_validation->set_rules('lema', 'Lema', 'required|min_length[3]');
			
			if(!$id == 91){ // cuando la legislatura no es legis conectadas
			
				$this->form_validation->set_rules('direccion', 'Dirección', 'required|min_length[3]');
				$this->form_validation->set_rules('telefono', 'Teléfono', 'required|min_length[3]');
				$this->form_validation->set_rules('provincia', 'Provincia', 'greater_than[0]');
				$this->form_validation->set_rules('organismo', 'Tipo de Organismo', 'greater_than[0]');
			
		}
				$this->form_validation->set_rules('url', 'URL', 'required|min_length[3]');

				$this->form_validation->set_rules('email', 'email', 'required|min_length[3]');
			
			
				if($this->input->post('mi_logo') != $this->input->post('nuevo_logo') OR $_FILES['logo']['name'] != ''){
					if(file_exists($_SERVER ['DOCUMENT_ROOT'].'/'.$this->input->post('mi_logo'))){
						
//						echo 'entonces puedo borrar';
					
						if(unlink($_SERVER ['DOCUMENT_ROOT'].'/'.$this->input->post('mi_logo'))){
//							echo 'si borro';
						} else{
//							echo 'no borro';
						}
					
				}else{
//						echo 'no existe no puedo borrar';
					}

					$this->form_validation->set_rules('logo', 'Logo', 'callback_file_check');
					
					
						$mi_archivo = 'logo';
						
						$nombre = explode('.',$_FILES['logo']['name']);
						
						$archivo = limpiar_caracteres($nombre[0]);
						$file_ext = pathinfo($_FILES["logo"]["name"], PATHINFO_EXTENSION);
						$config['upload_path'] = "static/web/images/logos_/";
						$config['file_name'] =trim($this->input->post('id'))."_".$archivo;
						$config['allowed_types'] = "jpg|jpeg|png|gif|bmp";
						$config['max_size'] = "50000";
						$config['max_width'] = "2000";
						$config['max_height'] = "2000";
						
						$this->load->library('upload', $config);
						
						if (!$this->upload->do_upload($mi_archivo)) {
						//*** ocurrio un error
						$data['uploadError'] = $this->upload->display_errors();
							
						echo $this->upload->display_errors();
							
						//return;
						}else{
							$config['file_name'].'.'.$file_ext; 
							$data_upd = array(
								'logo' => 'static/web/images/logos_/'.$config['file_name'].'.'.$file_ext
							);

							$this->Legislaturas_model->update_legislatura($this->input->post('id'), $data_upd);
						}
//					}else{
//						echo 'es otra';
//					}
				}
//				die;
			
			/*UPLOAD IMAGEN SLIDER*/
				$estado = '';
				$mensaje = '';
						if($_FILES['slider']['name'] != ''){
							
							/**/
							$slider_legislatura = $this->Legislaturas_model->get_slider_legislatura($id);
							
							 var_dump($slider_legislatura);
							
							if(file_exists($_SERVER ['DOCUMENT_ROOT'].'/'.$slider_legislatura->slider)){
						
//						echo 'entonces puedo borrar';
					
								if(unlink($_SERVER ['DOCUMENT_ROOT'].'/'.$slider_legislatura->slider)){
												echo 'si borro';
								} else{
												echo 'no borro';
								}
							}
							
							echo 'si llego<br>';
							var_dump($_FILES['slider']);
							
							$mi_archivo = 'slider';
							$config['upload_path'] = '';

							$nombre = explode('.',$_FILES['slider']['name']);
							$archivo = limpiar_caracteres($nombre[0]);

							$file_ext = pathinfo($_FILES["slider"]["name"], PATHINFO_EXTENSION);
							$config['upload_path'] = "static/web/images/slider/";
							$config['file_name']= $archivo.'.'.$file_ext; 
							$config['allowed_types'] = "jpg|jpeg|png|gif|bmp";
							$config['max_size'] = "50000";
							$config['max_width'] = "2000";
							$config['max_height'] = "2000";

							$this->load->library('upload', $config);

							$this->upload->initialize($config);


							if (!$this->upload->do_upload($mi_archivo)) {
								echo 'no sube';


							//*** ocurrio un error
								$data['uploadError'] = $this->upload->display_errors();
								var_dump($data['uploadError']);
		//					var_dump($this->upload->display_errors());
							//return;

							}else{

	//							var_dump( $this->upload->data());

							$data_upd = array(
								'slider' => '/static/web/images/slider/'.$config['file_name']
							);

	//							$config['file_name'].'.'.$file_ext; 
	//							$data_upd = array(
	//								'slider' => '/static/web/images/logos_/'.$config['file_name'].'.'.$file_ext
	//							);

								$this->Legislaturas_model->update_legislatura($id, $data_upd);

						}
						
					}else{
//							echo 'no llega';
					}
			

			
			/*UPLOAD IMAGEN PRONCIPAL*/

			 $data = array();
        if(!empty($_FILES['userFiles']['name'])){
					
						$uploadPath = trim('static/web/uploads/legislaturas/'.$this->input->post('id'));
						if (!file_exists($uploadPath)) {
						mkdir($uploadPath, 0777, true);
						}
					
					
            $filesCount = count($_FILES['userFiles']['name']);
					
						$data_db = array();
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['userFile']['name'] = $_FILES['userFiles']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['userFiles']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['userFiles']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['userFiles']['size'][$i];

                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png';
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile')){
									$fileData = $this->upload->data();
									
									$mensaje .= '<br> Se han Subido correctamente las imágenes';
									
									
									$data_db[$i]['id_legis'] = $this->input->post('id');
									$data_db[$i]['url'] = trim($uploadPath).'/'.$fileData['file_name'];
									
                }else{
									
										$data['uploadError'] = $this->upload->display_errors();

									$mensaje .= '<br> '.$this->upload->display_errors();
									
								}
            }
            
							if(!empty($data_db)){
							
							if($this->Legislaturas_model->Guardar_batch('legis_imagenes', $data_db)){
								
								$mensaje .= '<br> Se ha Agregado correctamente la ruta de las imagenes en la Tabla';
							
							}else{
								
								$mensaje .= '<br> Ocurrió un error al cargar imágenes';
								
							}
								$grabar_datos_array = array(
									'seccion' => 'Actualizar datos Legislaturas',
									'mensaje' => $mensaje,
									'estado' => $estado,
								);
							}
							}
			
				if($this->form_validation->run()){
					
					if($this->input->post('url_video') != ''){
						
						$array_url_video = explode('v=', $this->input->post('url_video'));
						
						$data_video = array(
							'url_video'     => $array_url_video[1],
							'titulo_video'  => $this->input->post('titulo_video'),
							'detalle_video' => $this->input->post('detalle_video'),
							'id_legis'      => $this->input->post('id'),
							'fecha_add' => $this->fecha_now ,
							'user_add' => $this->user->id,
						);
							
							// cequear que se complete la cccion de grabas
							$this->Legislaturas_model->Guardar_datos('legis_videos', $data_video);
					}
					
					$data_upd = array(
						'nombre'=> $this->input->post('nombre') ,
						'lema' => $this->input->post('lema') ,
						'direccion' => $this->input->post('direccion') ,
						'telefono' => $this->input->post('telefono') ,
						'url' => $this->input->post('url') ,
						'email' => $this->input->post('email') ,
						'facebook' => $this->input->post('facebook') ,
						'twitter' => $this->input->post('twitter') ,
						'instagram' => $this->input->post('instagram') ,
						'youtube' => $this->input->post('youtube') ,
						'fecha_upd' => $this->fecha_now ,
						'user_upd' => $this->user->id,
						'id_provincia' => $this->input->post('provincia'),
						'id_organismo' => $this->input->post('organismo'),
					);
					
					
					if($this->Legislaturas_model->update_legislatura($this->input->post('id'), $data_upd)){
						
						$mensaje .= '<br>El registro se actualizó Correctamente';
						$estado = 'success';
							
					}else{
						
						$mensaje .= 'Ocurrió un error al intentar actualizar el Registro ->Legislatura->edit';
						$estado = 'error';
					}
					/* MENSAJES DE ACCIONES (los tomo en el footer)*/
						
					$grabar_datos_array = array(
                'seccion' => 'Actualizar datos Legislaturas',
                'mensaje' => $mensaje,
                'estado' => $estado,
            );
					
						$this->session->set_userdata('save_data', $grabar_datos_array);
						
						redirect(base_url('Manager/Legislaturas/listado'));
				}
				$this->session->set_userdata('save_data', $grabar_datos_array);
			
		}

			if(!$legislatura = $this->Legislaturas_model->get_legislatura($id)){
				
				 redirect(base_url('Manager/Legislaturas/listado'));
			
			};
		
			$videos = $this->Legislaturas_model->get_videos_legis($id);
		
			$imagenes = $this->Legislaturas_model->get_imagenes_legis($id);
		
			$data_select_provincia = $this->Categorias_model->obtener_contenido_select('provincias', 'id ASC');
			$data_select_tipo_organismo = $this->Categorias_model->obtener_contenido_select('tipo_organismo', 'id ASC');
		
			$data = array(
				'data_select_tipo_organismo' => $data_select_tipo_organismo,
				'data_select_provincia' => $data_select_provincia,
				'legislatura' => $legislatura,
				'videos' 			=> $videos,
				'imagenes' 			=> $imagenes
			);
					
			$seccion = $this->load->view('manager/secciones/legislaturas/edit',$data, TRUE);
		
			$panel = $this->load_panel();
		
			$script = array(
	//				base_url().'static/manager/dropzone/dropzone.js?ver='.time(),
	//				base_url().'static/manager/scripts/common_dropzone.js?ver='.time(),
					base_url().'static/manager/scripts/legislaturas.js?ver='.time(),
					base_url().'static/manager/scripts/borrar_imagen.js?ver='.time(),
			);
	
			$data = array(
				'page_title'	=> 'Editar legislatura: '. $legislatura->nombre,
				'content' 		=> $seccion,
				'header'	 		=> $panel['header'],
				'panel'	 			=> $panel['panel'],
				'script'			=> $script
			);
		

		
			$this->load->view('manager/head');
			$this->load->view('manager/index',$data);
			$this->load->view('manager/footer',$data);
		
		
		}
	
	function cargar_archivo() {
		//grabar_datos();
	//		var_dump($_FILES);
		if($_FILES){
		echo $_FILES['mi_archivo']['name'];
		
		echo strtolower(trim($_FILES['mi_archivo']['name']));
		
		echo 'swwww';
	}else{
		echo 'no';
	}

        $mi_archivo = 'mi_archivo';
        $config['upload_path'] = "static/web/images/uploads/";
        $config['file_name'] = "nombre_archivo";
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

        $data['uploadSuccess'] = $this->upload->data();
    }

	public function index(){
		
		if (!$this->ion_auth->logged_in())
    {
      redirect('auth/login');
    }else{
			if($this->input->is_ajax_request())
    {
//			return $data_select = $this->Tipo_publicacion_model->get_tipos();
		} 
			
			$user = $this->ion_auth->user()->row();
			$image_properties = array(
        'src'   => '/static/web/images/logos/logoconectadas.jpg',
        'alt'   => 'Me, demonstrating how to eat 4 slices of pizza at one time',
        'class' => 'img-fluid',
    
        'title' => 'That was quite a night',
        'rel'   => 'lightbox'
);
			$imagen = img( $this->image_properties,  TRUE );
			$datos = array(
				'user' => $user,
				'imagen' => $imagen
				
			);
			
			
			

			$seccion 		= $this->load->view('manager/secciones/legislaturas',$datos, TRUE);
			
			$panel = $this->load_panel();
			$scripts =  array(
					base_url().'static/manager/scripts/legislaturas.js', 
				);
			$data = array(
				'content' => $seccion,
				'header' => $panel['header'],
				'panel' => $panel['panel'],
				'script' => $scripts,
				'page_title' => 'Legislaturas',
				);
			 
			$this->load->view('manager/head');
			$this->load->view('manager/indexds',$data);
			$this->load->view('manager/footer',$data);
		 }
	}
		
	public function listado(){
		
		if (!$this->ion_auth->logged_in())
    {
      redirect('auth/login');
    }else{
			if($this->input->is_ajax_request())
    {
//			return $data_select = $this->Tipo_publicacion_model->get_tipos();
		} 
			
			$user = $this->ion_auth->user()->row();
			$image_properties = array(
        'src'   => '/static/web/images/logos/logoconectadas.jpg',
        'alt'   => 'Legislaturas Conectadas',
        'class' => 'img-fluid',
    
        'title' => 'Legislaturas Conectadas',
        'rel'   => 'lightbox'
);
			$imagen = img( $this->image_properties,  TRUE );
			$datos = array(
				'user' => $user,
				'imagen' => $imagen
				
			);
			

			$seccion 		= $this->load->view('manager/secciones/legislaturas/list_legislatura',$datos, TRUE);
			
			$panel = $this->load_panel();
			

			$scripts =  array(
					base_url().'static/manager/scripts/legislaturas.js?ver='.time(), 
					base_url().'static/manager/assets/libs/moment/moment.js?ver='.time(), 
					base_url().'static/manager/assets/papaparse.min.js?ver='.time(), 
//					base_url().'static/manager/assets/libs/datatables/media/js/jquery.dataTables.min.js', 
//					base_url().'static/manager/assets/libs/datatables/media/js/datatable_select.js', 
//					base_url().'static/manager/assets/libs/datatables/media/js/dataTables.editor.js', 
//					base_url().'static/manager/assets/libs/datatables/media/js/datatable_bottons.js', 
//					base_url().'static/manager/assets/libs/datatables/media/js/datatable_html5.js', 
//					base_url().'static/manager/assets/libs/datatables/media/js/jszip.min.js', 
//					base_url().'static/manager/assets/libs/datatables/media/js/pdfmake.min.js', 
//					base_url().'static/manager/assets/libs/datatables/media/js/vfs_fonts.min.js', 
				);
			$data = array(
				'content' => $seccion,
				'header' => $panel['header'],
				'panel' => $panel['panel'],
				'script' => $scripts,
				'page_title' => 'Legislaturas',
				);
			 
			$this->load->view('manager/head');
			$this->load->view('manager/index',$data);
			$this->load->view('manager/footer',$data);
		 }
	}
	
	public function get_legislaturas(){
		

		
		if (!$this->ion_auth->logged_in())
    {
      redirect('auth/login');
    }else{
			
			$legislaturas =  $this->Legislaturas_model->get_legislaturas();
			return $legislaturas ;
		}
	} 	
	
 
	
	public function update(){

//		var_dump($_POST);die();
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()){
      redirect('auth/login');
		};
		
		$this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]');
		//			$this->form_validation->set_rules('lema', 'Lema', 'required|min_length[3]');
		$this->form_validation->set_rules('direccion', 'Dirección', 'required|min_length[3]');
		$this->form_validation->set_rules('telefono', 'Teléfono', 'required|min_length[3]');
		$this->form_validation->set_rules('url', 'URL', 'required|min_length[3]');
		$this->form_validation->set_rules('email', 'email', 'required|min_length[3]');
		$this->form_validation->set_rules('logo', 'Logo', 'callback_file_check');
		
		if($this->form_validation->run()){
			
			
		}else{
			
			$user = $this->ion_auth->user()->row();

			$datos = array(
				'user' => $user,
				'imagen' => $this->imagen,
			);

			$seccion 		= $this->load->view('manager/secciones/legislaturas/legislaturas',$datos, TRUE);

			$panel = $this->load_panel();

			$data = array(
				'page_title' => 'Legislaturas',
				'content' => $seccion,
				'header' => $panel['header'],
				'panel' => $panel['panel'],
			);

			$this->load->view('manager/head');

			$this->load->view('manager/index',$data);

				$scripts =  array(
				base_url().'static/manager/scripts/legislaturas.js', 
			);

				$data = array(
				'script' => $scripts
			);

			$this->load->view('manager/footer', $data);

			}
		}
	
	public function grabar_datos($id=NULL){

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
    {
      redirect('auth/login');
    }else{

			
			$this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]');
//			$this->form_validation->set_rules('lema', 'Lema', 'required|min_length[3]');
			$this->form_validation->set_rules('url', 'URL', 'required|min_length[3]');
//			$this->form_validation->set_rules('email', 'email', 'required|min_length[3]');
			$this->form_validation->set_rules('logo', 'Logo', 'callback_file_check');
			
			// ORGANISMO TIPO LEGISLATURAS CONECTADAS
			if($this->input->post('organismo') != '5'){ // id de tipo_organismo = 5 (legislaturas conectadas)
				
				$this->form_validation->set_rules('direccion', 'Dirección', 'required|min_length[3]');
//				$this->form_validation->set_rules('telefono', 'Teléfono', 'required|min_length[3]');
				$this->form_validation->set_rules('provincia', 'Provincia:', 'greater_than[0]');
				
			}
			
			$this->form_validation->set_rules('organismo', 'Tipo de Organismo:', 'greater_than[0]');

			if($this->form_validation->run() === true ){

				$datos = array(
					'nombre'=> $this->input->post('nombre') ,
					'lema' => $this->input->post('lema') ,
					'direccion' => $this->input->post('direccion') ,
					'telefono' => $this->input->post('telefono') ,
					'url' => $this->input->post('url') ,
					'email' => $this->input->post('email') ,
					'facebook' => $this->input->post('facebook') ,
					'twitter' => $this->input->post('twitter') ,
					'instagram	' => $this->input->post('instagram') ,
					'linkedin	' => $this->input->post('linkedin') ,
					'iduser_ad	' => $this->user->id ,
					'youtube	' => $this->input->post('youtube') ,
					'fecha_ins' => $this->fecha_now ,
					'id_provincia' => $this->input->post('provincia') ,
					'id_organismo' => $this->input->post('organismo') ,
					
				);


				if($this->Legislaturas_model->Guardar_datos('legislaturas',$datos )){
					
					$ultimoId = $this->db->insert_id();
					
											/* subida de imagen slider*/
					if(isset($_FILES['slider'])){
						$mi_archivo = 'slider';
						$config['upload_path'] = '';
					
					 	$nombre = explode('.',$_FILES['slider']['name']);
						$archivo = limpiar_caracteres($nombre[0]);
						
						$file_ext = pathinfo($_FILES["slider"]["name"], PATHINFO_EXTENSION);
						$config['upload_path'] = "static/web/images/slider/";
						$config['file_name']= $archivo.'.'.$file_ext; 
						$config['allowed_types'] = "jpg|jpeg|png|gif|bmp";
						$config['max_size'] = "50000";
						$config['max_width'] = "2000";
						$config['max_height'] = "2000";
						$this->load->library('upload', $config);
						
					
							

						if (!$this->upload->do_upload($mi_archivo)) {
						echo 'no sube';
							$config['file_name'].'.'.$file_ext.'<br>';	

						//*** ocurrio un error
							$data['uploadError'] = $this->upload->display_errors();
						// var_dump($data['uploadError']);
	//					var_dump($this->upload->display_errors());
						//return;
			
						}else{
						$data_upd = array(
							'slider' => '/static/web/slider/'.$config['file_name'].'.'.$file_ext
						);
							// var_dump( $this->upload->data());
							
						echo 'sube';

							$config['file_name'].'.'.$file_ext; 
							$data_upd = array(
								'slider' => '/static/web/images/logos_/'.$config['file_name'].'.'.$file_ext
							);

							$this->Legislaturas_model->update_legislatura($ultimoId, $data_upd);

					}
						
					}

					$mi_archivo = 'logo';
						
					$nombre = explode('.',$_FILES['logo']['name']);
						
					$archivo = limpiar_caracteres($nombre[0]);
					$file_ext = pathinfo($_FILES["logo"]["name"], PATHINFO_EXTENSION);
					$config['upload_path'] = "static/web/images/logos_/";
					$config['file_name'] =$ultimoId. "_".$archivo;
					$config['allowed_types'] = "jpg|jpeg|png|gif|bmp";
					$config['max_size'] = "50000";
					$config['max_width'] = "2000";
					$config['max_height'] = "2000";
					
					$this->upload->initialize($config);

//					$this->load->library('upload', $config);
					

					if (!$this->upload->do_upload($mi_archivo)) {
						
		
					//*** ocurrio un error
						$data['uploadError'] = $this->upload->display_errors();
//					var_dump($data['uploadError']);
//					var_dump($this->upload->display_errors());
					//return;
					}else{
							// var_dump( $this->upload->data());
						$config['file_name'].'.'.$file_ext; 
						$data_upd = array(
							'logo' => '/static/web/images/logos_/'.$config['file_name'].'.'.$file_ext
						);

						$this->Legislaturas_model->update_legislatura($ultimoId, $data_upd);
		
					}
					

					$data['uploadSuccess'] = $this->upload->data();

					if (!$this->input->post('url_video') == null){

						$array_url_video = explode('v=', $this->input->post('url_video'));

						$data_video = array(
							'detalle_video' => $this->input->post('detalle_video'),
							'titulo_video'	=> $this->input->post('titulo_video'),
							'url_video' 		=> $array_url_video[1],
							'user_add' 			=> $this->user->id,
							'id_legis' 			=> $ultimoId
						);

						if($this->Legislaturas_model->Guardar_datos('legis_videos',$data_video )){
							echo 'grabo';
						}else{
							echo 'nooooo';
						}

					}
					
					
					$mensaje = 'El registro se ha grabado correctamente';
					$estado = 'success';

					}else{
					
					$mensaje = 'ERROR al intentar grabar el registro -> Grabar Datos';
					$estado = 'error';
//					redirect('/Manager/Legislaturas?status=error');

					}
				
					 $grabar_datos_array = array(
                'seccion' => 'Grabar Legislaturas',
                'mensaje' => $mensaje,
                'estado' => $estado,
            );
				
					$this->session->set_userdata('save_data', $grabar_datos_array);
					redirect('/Manager/Legislaturas');
			}	
//		var_dump($_POST);

		$user = $this->ion_auth->user()->row();
		$data_select_provincia = $this->Categorias_model->obtener_contenido_select('provincias', 'id ASC');
		$data_select_tipo_organismo = $this->Categorias_model->obtener_contenido_select('tipo_organismo', 'id ASC');	

		$datos = array(
			'data_select_provincia' => $data_select_provincia,
			'data_select_tipo_organismo' => $data_select_tipo_organismo,
			'user' => $user,
			'imagen' => $this->imagen,

			
		);

		$seccion 		= $this->load->view('manager/secciones/legislaturas/legislaturas',$datos, TRUE);

		$panel = $this->load_panel();

		$data = array(
			'page_title' => 'Legislaturas',
			'content' => $seccion,
			'header' => $panel['header'],
			'panel' => $panel['panel'],
		);

		$this->load->view('manager/head');

		$this->load->view('manager/index',$data);
		
			$scripts =  array(
			base_url().'static/manager/scripts/legislaturas.js?ver='.time(), 
		);
		
			$data = array(
			'script' => $scripts
		);

		$this->load->view('manager/footer', $data);
			
		}
	}
	//UPDATE DATA

	//chequeos function callbac de form validation
	public function file_check($str){
		if(!file_exists("static/web/images/logos_/")){
			$this->form_validation->set_message('file_check', 'No existe la ruta de destino en servidor');
			return false;
		}
//        $allowed_mime_type_arr = array('application/pdf','image/gif','image/jpeg','image/pjpeg','image/png','image/x-png');
        $allowed_mime_type_arr = array('image/gif','image/jpeg','image/pjpeg','image/png','image/x-png');
        $mime = get_mime_by_extension($_FILES['logo']['name']);
        if(isset($_FILES['logo']['name']) && $_FILES['logo']['name']!=""){
            if(in_array($mime, $allowed_mime_type_arr)){
                return true;
            }else{
                $this->form_validation->set_message('file_check', 'Seleccione tipo de imagen permitido /gif/jpg/png.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check', 'Seleccione un archivo a incluir.');
            return false;
        }
    }
	
	
	public function eliminar_imagen(){
		

		$image_delete = $this->input->post('url');
		
		$response = array();
		if (file_exists($image_delete)) {
			if(unlink($image_delete)){
				$response['estado'] = true;
			}

			if($this->db->where('id'	, $this->input->post('id'))->delete('legis_imagenes')){
				
				
				$cantidad = $this->Legislaturas_model->contar_fotos($this->input->post('id_legis'));

				$response['estado'] = true;
				$response['mensaje'] = 'Se ha eliminado correctamente la imagen';
				$response['cantidad'] = $cantidad;
			}else{
				$response['estado'] = false;
				$response['mensaje'] = 'Ocurrió un error al borrar la imagen';
				$response['cantidad'] = false;
			}

		}
		
		echo json_encode($response);
	}
	

 	public function import_csv(){
		$this->form_validation->set_rules('file', 'file', 'callback_file_csv_checks');
		 
		if($this->form_validation->run() === true ){
			
			$fname = $_FILES['file']['name'];

			$chk_ext = explode(".",$fname);

			if(strtolower(end($chk_ext)) == "csv"){
					 //si es correcto, entonces damos permisos de lectura para subir
				$filename = $_FILES['file']['tmp_name'];
				

				$file = fopen($filename, 'r'); // create handler 

				fgets($file); // read one line for nothing (skip header) 
				$count = 0;
				$data_add = array();

				while (($row_file = fgetcsv($file, 10000, $this->input->post('delimitador'))) !== FALSE) {

					// echo utf8_encode($row_file[0]);
					if(!is_null($row_file[0])){

						$data_add[$count]['id_legislatura'] = $this->input->post('id_legislatura');
						$data_add[$count]['nombre'] 				= utf8_encode(trim($row_file[0]));
						$data_add[$count]['apellido'] 			= utf8_encode(trim($row_file[1]));
						$data_add[$count]['bloque'] 				= utf8_encode(trim($row_file[2]));
						$data_add[$count]['fecha_desde']		= trim($row_file[3]);
						$data_add[$count]['fecha_hasta'] 		= trim($row_file[4]);

						$count ++;

					}

				}

//				$data_add = array_values(array_filter($data_add, "trim"));
				
				if($this->Legislaturas_model->insertar_representantes('representantes',$data_add)){
					$legislatura = $this->Legislaturas_model->get_legislatura($this->input->post('id_legislatura'));
					$grabar_datos_array = array(
						'seccion' => $legislatura->nombre.'<br>Importacion de Representantes',
						'mensaje' => 'Se importaron '.$count.' registros a la base de datos',
						'estado' => 'success',
					);

					$this->session->set_userdata('save_data', $grabar_datos_array);

					redirect(base_url('Manager/Legislaturas/listado'), 'refresh');
				}else{
					$grabar_datos_array = array(
						'seccion' => 'Importacion de Representantes',
						'mensaje' => 'Ocurrió un error en la importación de los datos',
						'estado' => 'error',
					);

					$this->session->set_userdata('save_data', $grabar_datos_array);

					redirect(base_url('Manager/Legislaturas/listado'), 'refresh');
				}
//				$this->db->insert_batch('representantes', $data_add); 
					fclose($file);
					 //cerramos la lectura del archivo "abrir archivo" con un "cerrar archivo"
			}else{
					//si aparece esto es posible que el archivo no tenga el formato adecuado, inclusive cuando es cvs, revisarlo para ver si esta separado por " , "
				$grabar_datos_array = array(
						'seccion' => 'Importacion de Representantes',
						'mensaje' => 'Ocurrió un error en la lectura del archivo csv',
						'estado' => 'error',
					);

					$this->session->set_userdata('save_data', $grabar_datos_array);

					redirect(base_url('Manager/Legislaturas/listado'), 'refresh');
			}
		}

	}
    
    /*
     * Callback function to check file value and type during validation
     */
	public function file_csv_checks($str){
	
        $allowed_mime_types = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
        if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != ""){
            $mime = get_mime_by_extension($_FILES['file']['name']);
            $fileAr = explode('.', $_FILES['file']['name']);
            $ext = end($fileAr);
            if(($ext == 'csv') && in_array($mime, $allowed_mime_types)){
                return true;
            }else{
                $this->form_validation->set_message('file_csv_checks', 'Please select only CSV file to upload.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_csv_checks', 'Please select a CSV file to upload.');
            return false;
        }
    }

}
?>
