<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Home extends MY_Controller {


	public $per_page = 100;
	
 	function __construct(){
		
		 parent::__construct();
			$this->load->helper('form','url');
			$this->load->library('form_validation');
			$this->load->library('pagination');
			$this->load->model('/Manager/Contenidos_model');
			$this->load->model('/Manager/Legislaturas_model');
			$this->load->model('/Manager/Tipos_camaras_model');

	}


	public function enviar_contacto(){
		
		$captcha_answer = $this->input->post('g-recaptcha-response');

// Verify user's answer
		$response = $this->recaptcha->verifyResponse($captcha_answer);
		
			$this->form_validation->set_rules('nombre', 'nombre', 'required');	
			$this->form_validation->set_rules('apellido', 'Apellido', 'required');	
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');	
			$this->form_validation->set_rules('legislatura', 'Legislatura', 'required');	
			$this->form_validation->set_rules('mensaje', 'Mensaje', 'required|min_length[10]');	
			$this->form_validation->set_rules('g-recaptcha-response', 'Captcha', 'callback_recaptcha');	
		
			$this->form_validation->set_error_delimiters('<label  class="error" >', '</label>');
		
//			$this->form_validation->set_message('Legislatura', 'Seleccione un Organismo a contactar');
		//seteo mensaje 
			
			if($this->form_validation->run() === true){

				$data = array(
				 'nombre'     => $this->input->post('nombre'),
				 'apellido'   => $this->input->post('apellido'),
				 'email'      => $this->input->post('email'),
				 'legilstura' => $this->input->post('legislatura'),
				 'mensaje'    => $this->input->post('mensaje'),
					'subject' 			=> 'Contacto Legislaturas Conectadas '
				);

			 $email_data = array(
			 'datos' => $data,
			 'subject' => 'Contacto formulario web'
			 );

				
				$html =  $this->load->view('emails/consultas', $email_data, TRUE);				

				
				$emailTo = array(
				'carlos.tutino@legislatura.gov.ar' => 'Carlos',
				'silvana.conte@legislatura.gov.ar' => 'Silvana',
				'dirivero@legislatura.gov.ar' => 'Diego',
				);
		
				$emailTo = 'carlos.tutino@legislatura.gov.ar';
				$emailCC = 'carlos.tutino@legislatura.gov.ar';
				$envio = sendMail($emailTo,$emailCC,$emailCCO='',$email_data['subject'], $html,$attach=FALSE );

						$response = array(
      		'success' => true,
						// 'mensaje' => 'Mensaje enviado -> '.$envio['metodo'],
						// 'email' => $suscriptor->email,
						// 'enviados' => $this->Breves_model->contar_suscriptores($this->input->post('id_news'), TRUE)
      	);
				
				
// // unset($email_data["datos"]["uri"]);
//
// /* function enviar_email */
// if ( $this->_enviar_email( $email_data ) )
// {
// $response = array(
// 'success' => true
// );
//
// }else{
// $response = array(
// 'error_envio'=> true,
// );
// }
			
		//echo json_encode($response);
				
				
			}else{
				
				$response = array(
					'error'   					=> true,
					'nombre_error' 			=> form_error('nombre'),
					'apellido_error'		=> form_error('apellido'),
					'email_error'		 		=> form_error('email'),
					'legislatura_error' => form_error('legislatura'),
					'mensaje_error' 		=> form_error('mensaje'),
					'captcha_error' 		=> form_error('g-recaptcha-response'),
				);
				
			}
			
		echo json_encode($response);


	}
	
	public function recaptcha($str){
		
		 if(!isset($str) || $str == '')
    {

      $this->form_validation->set_message('recaptcha', 'The {field} field is telling me that you are a robot. Shall we give it another try?');
      return FALSE;
    }
    else
    {
      return TRUE;
    }
		
	}
	
	public function get_data_provincias($code, $texto_provincia){
		
		
		$provincia = '';
		
		
		$datos = array(
				'legislaturas' => $this->Contenidos_model->buscar_provincia($code),
				'titulo_seccion' => str_replace('-',' ',$texto_provincia)
		);

		$seccion  = $this->load->view('web/secciones/provincia',$datos, TRUE);



		$scripts =  array(
		//				base_url().'static/web/scripts/legislaturas.js', 
		);

		$data = array(
				'nav' => $this->nav,
				'fecha' => $this->fecha,
				'content' => $seccion,
				'script' => $scripts
		);

		$this->load->view('web/head', $data);
		$this->load->view('web/index',$data);
		$this->load->view('web/footer',$data);
		
		
		
	}
	
	public function categorias($nombre_legis,$id_legis,$nombre_cate, $id_cate){
		
//		echo $nombre_legis .'-'. $id_legis .'-'.  $nombre_cate .'-'. $id_cate;

		
		// datos legislatura
		$legislatura =  $this->Legislaturas_model->get_legislatura($id_legis);
		$noticias =  $this->Contenidos_model->list_noticias_by_legis($id_legis,$id_cate );
		// datos para la barra lateral de categorias
		$datos_barra_lateral = $this->Contenidos_model->buscar_categorias_por_legis($id_legis);
		
//		var_dump($noticias);
		
		$data = array(
			'noticias' => $noticias,
			'datos_barra_lateral' => $datos_barra_lateral,
			'legislatura' => $legislatura,

		);
		$seccion = $this->load->view('web/secciones/listado_categorias_legis',$data, TRUE);

		$scripts =  array(
			base_url().'static/web/scripts/noticia.js', 
		);
		
		$data = array(
			'nav' => $this->nav,
			'fecha' => $this->fecha,
			'content' => $seccion,
			'script' => $scripts
		);

		$this->load->view('web/head',$data);
		$this->load->view('web/index',$data);
		$this->load->view('web/footer',$data);
		
	}
     
	public function index()
	{

		$categorias = $this->Contenidos_model->categorias_html_filter();

		$legislaturas =  $this->Legislaturas_model->list_legislaturas();
		$sliders =  $this->Legislaturas_model->get_sliders();
	
		$x = 1;
		foreach($categorias as $cat){
				if($cat->id_publicaciones != NULL){
						$x++;
						$cat_filter[$x]['id']= $cat->id_cat;
						$cat_filter[$x]['nombre']= $cat->nombre_cat;
				}
		}

		$post = $this->Contenidos_model->html_filter();
		
		
		
		foreach($post as $data){
				
			if($foto = $this->Contenidos_model->buscar_foto($data->id_publicaciones)){
				$data->publicaciones_foto = $foto[0]->url;
			}
		}
		
		
		$post = array(
			'categorias' => $categorias,
			'post'			 => $post,
		);
		$html_filter = $this->load->view('web/secciones/templates/html_filtros',$post, TRUE); 

		//paginacion noticias
		$config['base_url'] = base_url('home/get_paginador');
		$config['attributes'] = array('class' => 'page-link');
		$config['per_page'] = $this->per_page;
//			$config["uri_segment"] = 4;
//			$config["num_links"] =2;
		$config["cur_tag_open"] = '<li class="page-item active"><a class="page-link">';
		$config["cur_tag_close"] = '</a></li>';
//			$config["first_link"] ='Prinera';
//			$config["last_link"] ='Última';
//			$config["first_tag_open"] ='<li class=""><span aria-hidden="true">';
//			$config["first_tag_close"] ='</span></li>';
//			$config["last_tag_open"] ='<li class=""><span aria-hidden="true">';
//			$config["last_tag_close"] ='</span></li>';
		$config["full_tag_open"] ='<ul class="pagination justify-content-center pagination-lg">';
		$config["full_tag_close"] = '</ul>';
		$config["num_tag_open"] = '<li class="page-item">';
		$config["num_tag_close"] = '</li>';
// $config["next_link"] = FALSE;
// $config["prev_link"] = FALSE;


		$count_publicaciones = $this->Contenidos_model->func_count('publicaciones');
		$config['total_rows'] = $count_publicaciones; 
		$this->pagination->initialize($config);

		$publicaciones 						= $this->Contenidos_model->get_paginador_noticias('publicaciones',$config['per_page'],$offset = 0);
		$publicaciones_destacadas = $this->Contenidos_model->get_publicaciones_destacadas('publicaciones', 3);
		

	/* OBTENGO PRIMER FOTO DE LA PUBLICACION*/
		foreach($publicaciones as $data){
				
			if($foto = $this->Contenidos_model->buscar_foto($data->id)){
				$data->foto = $foto[0]->url;
			}
		}		
		
		foreach($publicaciones_destacadas as $data){
				
			if($foto = $this->Contenidos_model->buscar_foto($data->id)){
				$data->foto = $foto[0]->url;
			}
		}
	/* OBTENGO PRIMER FOTO DE LA PUBLICACION*/

		$data = array(
		'noticias' =>$publicaciones,
		'noticias_destacadas' =>$publicaciones_destacadas
		);

		$render = $this->load->view('web/secciones/templates/list_noticias',$data, TRUE); 

		$faqs = $this->Contenidos_model->obtener_listados('faqs', 'id ASC');

		$colores_mapa = $this->Contenidos_model->obtener_colores();
		
		$data = array(
			'faqs'=> $faqs
		);
		$faqs = $this->load->view('web/secciones/faqs',$data, TRUE); 

		$datos = array(
//			'legis_conetadas' => $this->Legislaturas_model->get_legislatura(91),
			'fecha' => $this->fecha,
			'legislaturas' => $legislaturas,
			'post' =>$html_filter,
			'noticias' =>$render,
			'faqs' =>$faqs,
			'colores_mapa' =>$colores_mapa,
			'slider' =>$sliders,

		);

		$seccion = $this->load->view('web/secciones/index',$datos, TRUE);
		
		$csss =  array(
			base_url().'static/manager/assets/libs/revolution/css/revolution/layers.css?ver='.time(), 
			base_url().'static/manager/assets/libs/revolution/css/revolution/navigation.css?ver='.time(), 
			base_url().'static/manager/assets/libs/revolution/css/revolution/settings.css?ver='.time(), 
		);

		$scripts =  array(
				base_url().'static/web/scripts/home.js?ver='.time(), 
				base_url().'static/manager/assets/libs/revolution/jquery.themepunch.revolution.min.js?ver='.time(), 
				base_url().'static/manager/assets/libs/revolution/jquery.themepunch.tools.min.js?ver='.time(), 
				base_url().'static/manager/assets/libs/revolution/extensions/revolution.extension.actions.min.js?ver='.time(), 
				base_url().'static/manager/assets/libs/revolution/extensions/revolution.extension.carousel.min.js?ver='.time(), 
				base_url().'static/manager/assets/libs/revolution/extensions/revolution.extension.kenburn.min.js?ver='.time(), 
				base_url().'static/manager/assets/libs/revolution/extensions/revolution.extension.layeranimation.min.js?ver='.time(), 
				base_url().'static/manager/assets/libs/revolution/extensions/revolution.extension.migration.min.js?ver='.time(), 
				base_url().'static/manager/assets/libs/revolution/extensions/revolution.extension.navigation.min.js?ver='.time(), 
				base_url().'static/manager/assets/libs/revolution/extensions/revolution.extension.parallax.min.js?ver='.time(), 
				base_url().'static/manager/assets/libs/revolution/extensions/revolution.extension.slideanims.min.js?ver='.time(), 
				base_url().'static/manager/assets/libs/revolution/extensions/revolution.extension.video.min.js?ver='.time()
			);
		
		$data = array(
			'nav' => $this->nav,
			'content' => $seccion,
			'script' => $scripts,
			'csss' => $csss
		);

		$this->load->view('web/head',$data);
		$this->load->view('web/index',$data);
		$this->load->view('web/footer',$data);
	}
	public function legislaturas()
	{

			$legislaturas =  $this->Legislaturas_model->list_legislaturas();
		
			$tipos_camaras = $this->Tipos_camaras_model->get_tipos_camaras();

			//$representantes = $this->Legislaturas_model->contar_representantes();


			foreach($legislaturas as $key=>$value){

				$legislaturas[$key]->representantes = $this->Legislaturas_model->contar_representantes($legislaturas[$key]->id_legis);
				
			}

			$datos = array(
				'provincias' 		 => $this->provincias, // llega desde el MY_Controller
				'tipos_camaras'  => $tipos_camaras,
				'legislaturas' 	 => $legislaturas,
				'titulo_seccion' => 'Poderes Legislativos'
			);

			$seccion        = $this->load->view('web/secciones/list_legislaturas',$datos, TRUE);
			$scripts =  array(
				base_url().'static/web/scripts/legislaturas.js?ver='.time(), 
			);
		
			$data = array(
					'nav' => $this->nav,
					'fecha' => $this->fecha,
					'content' => $seccion,
					'script' => $scripts
			);

			$this->load->view('web/head', $data);
			$this->load->view('web/index',$data);

			$this->load->view('web/footer',$data);
	}
	public function get_noticias($offset = 0, $per_page = 0)
	{
		$noticias =  $this->Contenidos_model->get_noticias();
		$seccion = $this->load->view('web/secciones/templates/list_noticias',$noticias, TRUE);
	}
	public function noticias($offset = 0)
	{
			$noticias =  $this->Contenidos_model->list_noticias();
		//paginacion noticias
			$config['base_url'] = base_url('Noticias');
			$config['attributes'] = array('class' => 'page-link');
			$config['per_page'] = $this->per_page;
			$config['total_rows'] = count($noticias); 
//			$config["uri_segment"] = 4;
//			$config["num_links"] =2;
			$config["cur_tag_open"] = '<li class="page-item active"><a class="page-link">';
			$config["cur_tag_close"] = '</a></li>';
//			$config["first_tag_open"] ='<li class=""><a class="page-link">';
		// $config["first_tag_close"] ='</a></li>';
// $config["last_tag_open"] ='<li class=""><a class="page-link">';
		// $config["last_tag_close"] ='</a></li>';
			$config["full_tag_open"] ='<ul class="pagination justify-content-center pagination-lg">';
			$config["full_tag_close"] = '</ul>';
			$config["num_tag_open"] = '<li class="page-item">';
			$config["num_tag_close"] = '</li>';
			$config["first_link"] ='Primera';
			$config["last_link"] ='Última';
 			$config["next_link"] = FALSE;
 			$config["prev_link"] = FALSE;
		
    	$this->pagination->initialize($config);
			$noticias = $this->Contenidos_model->get_paginador_noticias('publicaciones',$config['per_page'], $offset );
		

		
			foreach($noticias as $data){
				if($foto = $this->Contenidos_model->buscar_foto($data->id)){
					$data->foto = $foto[0]->url;
				}
			}

			$datos = array(
				'titulo_seccion' => 'Noticias',
				'noticias' => $noticias,
			);

			$seccion = $this->load->view('web/secciones/noticias',$datos, TRUE);
		
			$scripts =  array(
				base_url().'static/web/scripts/noticia.js', 
			);
			$data = array(
					'nav' => $this->nav,
					'fecha' => $this->fecha,
					'content' => $seccion,
					'script' => $scripts,
			);

			$this->load->view('web/head', $data);
			$this->load->view('web/index',$data);

			$this->load->view('web/footer',$data);
	}

	public function get_legislatura_id($id, $nombre_legis){

		$legislatura 		=  $this->Legislaturas_model->get_legislatura($id);
		$publicaciones 	= $this->Legislaturas_model->get_publicaciones($id); //paso id legislatura
		$normativas 		= $this->Legislaturas_model->get_normativas($id); //paso id legislatura
		
//		
//					foreach($noticias as $data){
//				
//			if($foto = $this->Contenidos_model->buscar_foto($data->id)){
//				$data->foto = $foto[0]->url;
//			}
//		}

		foreach($publicaciones as $data){
			if($foto = $this->Contenidos_model->buscar_foto($data->id)){
				$data->foto = $foto[0]->url;
			}
		}
		
//		var_dump($publicaciones); die();
		
		
		$datos = array(
		
			'legislatura'=>$legislatura,
			'normativas'=>$normativas,
			'publicaciones'=>$publicaciones,
			'videos'=>$this->Legislaturas_model->get_videos_legis($id),
			'imagenes'=>$this->Legislaturas_model->get_imagenes_legis($id),
		);
		$seccion        = $this->load->view('web/secciones/legislatura',$datos, TRUE);

		$scripts =  array(
			base_url().'static/manager/assets/extra-libs/DataTables/datatables.js?ver='.time(),  
			base_url(). 'static/web/scripts/legislatura.js?ver='.time(), 
			base_url().'static/manager/assets/extra-libs/DataTables/pdfmake.min.js?ver='.time(), 
			base_url().'static/manager/assets/extra-libs/DataTables/jszip.min.js?ver='.time(), 
			base_url().'static/manager/assets/extra-libs/DataTables/dataTables.buttons.min.js?ver='.time(), 
			base_url().'static/manager/assets/extra-libs/DataTables/vfs_fonts.js?ver='.time(), 
			base_url().'static/manager/assets/extra-libs/DataTables/buttons.html5.min.js?ver='.time(), 
		);

		$data = array(
				'nav' => $this->nav,
				'content' => $seccion,
				'fecha' => $this->fecha,
				'script' => $scripts,
		);

		$this->load->view('web/head', $data);
		$this->load->view('web/index',$data);
		$this->load->view('web/footer',$data);
	}
	
	public function get_representantes_legislatura($id_legis){
	
//		die('legis'.$id_legis);
			
			$representantes =  $this->Legislaturas_model->get_representsantes_legislatura($id_legis);
			return $representantes ;
		
	}   
	
	public function get_listado_publicaciones_ajax(){
		
		if($this->input->is_ajax_request()){
		
			$listado_publicaciones =  $this->Contenidos_model->get_listado_normativas_ajax();
			return $listado_publicaciones;
				
		}
	}
	
		/* LISTADO DE NORMATIVAS DEL FRONTEND id de tipo de publicacion y nombre  */	
	public function publicaciones($id_tipo, $nombre_tipo){
		
		$tipo = $this->Contenidos_model->_obtener_tipo($id_tipo);
		
		$filtro = $this->Contenidos_model->publicaciones_cat_html_filter($id_tipo);
		
		$html = $this->Contenidos_model->publicaciones_html_filter($id_tipo);
		
		$tematicas = $this->Contenidos_model->get_all_data('categorias');
		$tipo_normativa = $this->Contenidos_model->get_all_data('tipo_normativa');
		$ambito = $this->Contenidos_model->get_all_data('ambito');
		$provincias = $this->Contenidos_model->get_all_data('provincias');

		foreach($html as $data){
			if($foto = $this->Contenidos_model->buscar_foto($data->id_publicaciones)){
				$data->publicaciones_foto = $foto[0]->url;
			}
		}
		
		$scripts = '';
		
		if(count($html) > 1){
			$scripts =  array(
				base_url().'static/web/scripts/publicaciones.js?ver='.time(), 
				base_url().'static/manager/assets/extra-libs/DataTables/datatables.js?ver='.time(), 
				base_url().'static/manager/assets/extra-libs/DataTables/pdfmake.min.js?ver='.time(), 
				base_url().'static/manager/assets/extra-libs/DataTables/jszip.min.js?ver='.time(), 
				base_url().'static/manager/assets/extra-libs/DataTables/dataTables.buttons.min.js?ver='.time(), 
				base_url().'static/manager/assets/extra-libs/DataTables/vfs_fonts.js?ver='.time(), 
				base_url().'static/manager/assets/extra-libs/DataTables/buttons.html5.min.js?ver='.time(), 
			);
//			die(''.$tipo[0]->detalle);
			$tipo[0]->nombre = $tipo[0]->detalle;
		}

		$data = array(
			'tematicas' 			=> $tematicas,
			'tipo_normativas' => $tipo_normativa,
			'ambitos' 				=> $ambito,
			'provincias' 			=> $provincias,
			'filtro' 					=> $filtro,
			'html'						=> $html,
			'titulo' 					=> $tipo,
			'titulo_seccion' 	=> 'Normativas',
		);
		
		$seccion = $this->load->view('web/secciones/publicaciones',$data, TRUE);
		$data = array(
			'nav' 		=> $this->nav,
			'fecha' 	=> $this->fecha,
			'content' => $seccion,
			'script' 	=> $scripts
		);

		$this->load->view('web/head',$data);
		$this->load->view('web/index',$data);
		$this->load->view('web/footer',$data);
		
	}
	
	public function publicacion($title,$id){
		
		$publicacion = $this->Contenidos_model->buscar_item('publicaciones',$id);
		$fotos = $this->Contenidos_model->buscar_fotos($id);
		
		$prev_item = $this->Contenidos_model->buscar_item_prev('publicaciones',$id, $publicacion->leg_id);
		$netx_item = $this->Contenidos_model->buscar_item_next('publicaciones',$id, $publicacion->leg_id);

		$data = array(
			'prev_item' => $prev_item,
			'netx_item' => $netx_item,
			'publicacion' => $publicacion,
			'titulo_seccion' => 'Normativas',
			'fotos' => $fotos,
		);
		
		$seccion = $this->load->view('web/secciones/publicacion',$data, TRUE);
		
		$scripts =  array(
					base_url().'static/web/scripts/publicacion.js', 
				);
		
		$data = array(
				'nav' => $this->nav,
				'fecha' => $this->fecha,
				'content' => $seccion,
				'script' => $scripts
		);

		$this->load->view('web/head',$data);
		$this->load->view('web/index',$data);
		$this->load->view('web/footer',$data);
		
	}
	
		// mostrar noticia 
	/*
	$title = titulo de la publicacion
	$id = id legislatura
	*/
	public function noticia($title,$id){

		
		$publicacion = $this->Contenidos_model->buscar_item('publicaciones',$id);


		$mas_noticas = $this->Contenidos_model->buscar_mas_noticias('publicaciones',$id, $publicacion->leg_id);
		
		// agrego una foto a la noticia
		foreach($mas_noticas as $data){
				if($foto = $this->Contenidos_model->buscar_foto($data->id_pub)){
					$data->foto = $foto[0]->url;
				}
			}

		$tags = $this->Contenidos_model->buscar_tags('tags',$publicacion->pub_id);
		
		// datos para la barra lateral de categorias
		$datos_barra_lateral = $this->Contenidos_model->buscar_categorias_por_legis($publicacion->leg_id);

//		echo $publicacion->leg_id; die();

		$fotos = $this->Contenidos_model->buscar_fotos($id);
		$noticias =  $this->Contenidos_model->list_noticias_by_legis($publicacion->leg_id);



		$data = array(
			'fotos' => $fotos,
			'tags' => $tags,
			'publicacion' => $publicacion,
			'datos_barra_lateral' => $datos_barra_lateral,
			'mas_noticias' => $mas_noticas,
		);

		$seccion = $this->load->view('web/secciones/noticia',$data, TRUE);

		$scripts =  array(
			base_url().'static/web/scripts/noticia.js?ver='.time(), 
		);
		$data = array(
			'nav' => $this->nav,
			'fecha' => $this->fecha,
			'content' => $seccion,
			'script' => $scripts
		);

		$this->load->view('web/head',$data);
		$this->load->view('web/index',$data);
		$this->load->view('web/footer',$data);
		
	}
	
	public function contacto(){
		
		if($this->input->is_ajax_request()){
		
			$listado_legislaturas =  $this->Contenidos_model->get_listado_legislaturas_contacto_ajax();
			return $listado_legislaturas;
				
		}

		$legislaturas =  $this->Legislaturas_model->list_legislaturas();
		$datos = array(
			'data'=>'data',
			'titulo_seccion'=>'Contacto',
			'legislaturas'=>$legislaturas,
			'legis_conectadas'=>$this->Legislaturas_model->get_legislatura(91),
			
		);
		$seccion = $this->load->view('web/secciones/contacto',$datos, TRUE);

		$scripts =  array(
			base_url().'static/manager/assets/libs/jquery-validation/dist/jquery.validate.min.js?ver='.time(), 
			base_url().'static/manager/assets/libs/jquery-validation/dist/localization/messages_es.js?ver='.time(), 
			base_url().'static/manager/assets/extra-libs/DataTables/datatables.js?ver='.time(),  
			base_url().'static/web/scripts/contacto.js?ver='.time(), 
			base_url().'static/manager/assets/extra-libs/DataTables/pdfmake.min.js?ver='.time(), 
			base_url().'static/manager/assets/extra-libs/DataTables/jszip.min.js?ver='.time(), 
			base_url().'static/manager/assets/extra-libs/DataTables/dataTables.buttons.min.js?ver='.time(), 
			base_url().'static/manager/assets/extra-libs/DataTables/vfs_fonts.js?ver='.time(), 
			base_url().'static/manager/assets/extra-libs/DataTables/buttons.html5.min.js?ver='.time(), 
		);
		$data = array(
				'nav' => $this->nav,
				'fecha' => $this->fecha,
				'content' => $seccion,
				'script' => $scripts
		);

		$this->load->view('web/head',$data);
		$this->load->view('web/index',$data);
		$this->load->view('web/footer',$data);

		
		
	}
	
	public function get_paginador(){
	
		$offset = $this->input->post('offset');
		$tabla = $this->input->post('tabla');
					//paginacion noticias
			$config['base_url'] = base_url('Noticias');
			$config['attributes'] = array('class' => 'page-link');
			$config['per_page'] = $this->per_page;
//			$config["uri_segment"] = 4;
//			$config["num_links"] =2;
			$config["cur_tag_open"] = '<li class="page-item active"><a class="page-link">';
			$config["cur_tag_close"] = '</a></li>';
			$config["first_tag_open"] ='<li class=""><a class="page-link">';
			$config["first_tag_close"] ='</a></li>';
			$config["last_tag_open"] ='<li class=""><a class="page-link">';
			$config["last_tag_close"] ='</a></li>';
			$config["full_tag_open"] ='<ul class="pagination justify-content-center pagination-lg">';
			$config["full_tag_close"] = '</ul>';
			$config["num_tag_open"] = '<li class="page-item">';
			$config["num_tag_close"] = '</li>';
//			$config["first_link"] ='Prinera';
//			$config["last_link"] ='Última';
			// $config["next_link"] = FALSE;
			// $config["prev_link"] = FALSE;
		
		
			$count_publicaciones = $this->Contenidos_model->func_count($tabla);
			$config['total_rows'] = $count_publicaciones; 
    	$this->pagination->initialize($config);
		
			$publicaciones = $this->Contenidos_model->get_paginador($tabla,$this->per_page,$offset);
	
			$data = array(
			'noticias' =>$publicaciones
			);
		
			$this->load->view('web/secciones/templates/list_noticias',$data, TRUE); 
//			$data = array(
//				'render' => $render
//			);
//			echo  $render; 
		
	}
	
	public function buscador_ajax(){
			
	 	$cadena = $this->input->post('search'); 



		$normativas = $this->Contenidos_model->home_buscador_normativas($cadena);
		$noticias = $this->Contenidos_model->home_buscador_noticias($cadena);
		$legislaturas = $this->Contenidos_model->home_buscador_legislaturas($cadena);
	 		foreach($noticias as $data){
				if($foto = $this->Contenidos_model->buscar_foto($data->id)){
					$data->foto = $foto[0]->url;
				}
			}
		$datos = array(
			'cadena'=> $cadena,
			'noticias' => $noticias,
			'normativas' => $normativas,
			'legislaturas' => $legislaturas
			
		);



		$seccion = $this->load->view('web/secciones/resultados',$datos, TRUE);

		$scripts =  array(
			
		);
		$data = array(
				'nav' => $this->nav,
				'fecha' => $this->fecha,
				'content' => $seccion,
				'script' => $scripts
		);

		$this->load->view('web/head',$data);
		$this->load->view('web/index',$data);
		$this->load->view('web/footer',$data);
		
	// 	$datos = $this->Contenidos_model->buscador_ajax($cadena);

	// 	$result = array(
	// 		'estado' => true,
	// 		'data' => $datos
	// 	);
		
 // echo  json_encode($result);
	}
	
	
	function cambiar_pwd(){
		
		$message = '';
		$set_pass['status'] =false;
		$password = '';
		
		if (!$this->ion_auth->email_check($this->input->post('email'))){
			$message = "El usuario no se encuentra registrado";
			$status = false;
			
			
		}else{
			$query = $this->db->select("*")->where("email",$this->input->post('email'))->get("users");
			if ($query->result() > 0){
				
				$user =  $query->row();

				$password = randon_password(5);
				
				$usuario = $this->ion_auth->user($user->id)->row();

				$data = array(
						're_password' =>0,
						'password' =>$password,
				);
			
				if ($this->ion_auth->update($usuario->id, $data)){
						
						$messages = $this->ion_auth->messages_array();
						$message = "Se ha enviado un correo electrónico para el reseteo de la contraseña<br>Revise su correo";
						$data = array(
							"nombre" => $usuario->first_name,
							"apellido" => $usuario->last_name,
							"identity" => $usuario->email,
							"temporal" => $password,
							'datoss'=> ' continuar'
						);

						$html = $this->load->view($this->config->item('email_templates', 'ion_auth').$this->config->item('reset_pwd', 'ion_auth'), $data, true);

						$subject = 'Cambio de contraseña - Legislaturas Conectadas';

						$set_pass = semdMailGmail($usuario->email,$subject, $html,$attach=FALSE );

						}
						else
						{
								$errors = $this->ion_auth->errors_array();
								foreach ($errors as $error)
								{
										$message .= $error;
								}
								$message = "Ocurrió un error al intentar recuperar la contraseña";
						}
			}
			
		}
		
		$response = array(
				'estado'=>$set_pass['status'],
				'password'=>$password,
				'message'=>$message,
//				'html'=>$html
			);
		echo json_encode($response);
	}
	
}
