	<?php
	//application/controllers/usuarios.php
	if (!defined('BASEPATH')) exit('No direct script access allowed');
			use PHPMailer\PHPMailer\PHPMailer ;
			use PHPMailer\PHPMailer\Exception ;
	class Breves extends MY_Controller {
	 
	  function __construct(){
	      parent::__construct();
			
			$this->load->helper('form','url');
			$this->load->library('form_validation');
		 	$this->load->model('/Manager/Breves_model');
//				$this->output->enable_profiler(TRUE);
		 	
			$this->user = $this->ion_auth->user()->row();
		}


		public function testpdf($id_newsletter = 116){
			/*
			  debe estar en true para poder renderizar imagenes
			  donfd/src/options.php     
			    private $isRemoteEnabled = true;
			 */

			$this->load->library('pdf');

			$create_pdf = $this->Breves_model->get_newsletter($id_newsletter);

			$titulo = $create_pdf['subject'];
			$publicaciones = $create_pdf['publicaciones'];

// 			echo '<pre>';
// 			var_dump($publicaciones[0]);die();
// 			echo '</pre>';



	$xx ='<table width="500" border="0" cellspacing="5">
  <tr>
    <td colspan="3"  height="50"><img width="690" src="'.base_url().'static/manager/breves/pdf/copete.png"></td>
  </tr> 
   <tr>
    <td colspan="3" align="center" height="10" style="font-size:20px" >'.$titulo.'</td>
  </tr>'
  ;
 	foreach($publicaciones as $data){
  $xx .='  <tr>
    <td width="138" rowspan="1" valign="top" align="center"><img src="'.base_url($data->imagen).'" width="200" height="154"  /></td>
    <td width="337" height="10" colspan="2" valign="top"><strong>'.$data->titulo.'</strong><br>
 '.word_limiter($data->cuerpo, 40).'<br> <a href="https://www.w3schools.com">Leer más</a></td>
  </tr>
  <tr>
    <td colspan="3"><hr></td>
  </tr>';
	};
	$xx .='
  <tr>
    <td colspan="3" style="background-color:#eee"><img width="690" src="'.base_url().'static/manager/breves/pdf/pie.jpg"></td>
  </tr>
  <tr ><td colspan="3" align="center"><a href="#">www.legislaturasconectadas.com.ar</a></td></tr>
	</table>';

echo $xx;die();
		$x = 11;

		$randomNum=substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, $x);

		$dompdf = new Pdf;
		$dompdf->load_html($xx);
		//$orientation = 'portrait';
		//$customPaper = array(0,0,950,950);
		// $dompdf->setPaper($customPaper, $orientation);

		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();
		$output = $dompdf->output();

		//$dompdf->stream("dompdf_out.pdf", array("Attachment" => false));

		$nombre_pdf = 'static/web/breves/pdf/NW_'.$randomNum.'_'.$id_newsletter.'.pdf';

		$data = array(
			'attachment'=>$nombre_pdf
		);

			if(!$this->Breves_model->actualizar_newsletter_db($id_newsletter, $data)){
				echo 'si';
			}else{
				$grabar_datos_array = array(
		        'seccion' => 'Legislaturas Conectadas<br> Breves en imágenes',
		        'mensaje' => ' Ocurrió un error',
		        'estado' => 'error',
		    );
			
				$this->session->set_userdata('save_data', $grabar_datos_array);
				
				redirect(base_url('Manager/Breves/Gacetillas'));

			}

			
			file_put_contents($nombre_pdf,$output);

			exit(0);
		// $dompdf->stream('data.pdf', array('Attachement'=>0));
		}
	
		public function newsletters(){

			if (!$this->ion_auth->logged_in())
	    {
	      redirect('auth/login');
	    }else{
				
		
				$user = $this->ion_auth->user()->row();
				
				$datos = array(
					'user' => $user,
				);

				$seccion 		= $this->load->view('manager/secciones/breves/newsletters',$datos, TRUE);

				$panel = $this->load_panel();
				$scripts =  array(
					base_url().'static/manager/scripts/breves.js?ver='.time(), 
					base_url().'static/manager/scripts/newsletters.js?ver='.time(), 
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
	

		public function gacetillas(){

			if (!$this->ion_auth->logged_in())
	    {
	      redirect('auth/login');
	    }else{
				
				if($this->input->post("botonSubmit")){

					if($this->form_validation->run() === true){

						$datos = array(
							'titulo'		=> $this->input->post('titulo') ,
							'user_add'	=> $this->user->id,
							
						);

						if($this->Breves_model->Guardar_datos('breves_en_imagenes',$datos )){
							redirect('Manager/Breves', 'refresh');
						}
					}
				}
				
				$user = $this->ion_auth->user()->row();
				
				$datos = array(
					'user' => $user,
				);

				$seccion 		= $this->load->view('manager/secciones/breves/gacetillas',$datos, TRUE);

				$panel = $this->load_panel();
				$scripts =  array(
					base_url().'static/manager/assets/extra-libs/DataTables/datatables_checkbox.min.js?ver='.time(), 
					base_url().'static/manager/scripts/breves.js?ver='.time(), 
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
		public function get_suscriptor(){

			$suscriptor = $this->Breves_model->get_suscriptor($this->input->post('id'));

			$user_add = $this->ion_auth->user($suscriptor->iduser_ins)->row(); // get users from group with id of '1'

			$suscriptor->iduser_ins = $user_add->last_name.', '.$user_add->first_name;
			echo json_encode($suscriptor);

		}
		
		public function cargar_suscriptor(){
			if($this->input->is_ajax_request()){
				$this->form_validation->set_rules('name', 'Nombre', 'required');
				$this->form_validation->set_rules('lastname', 'Apellido', 'required');

				if($this->input->post('id') == NULL ){
					$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[suscriptores.email]');

				}else{
					$this->form_validation->set_rules('email', 'Email', 'required');
				}
				
				if($this->form_validation->run() === true){

					// cheuqeo variable para saber si edito o agrego un registro nuevo
					if($this->input->post('id') == NULL ){

					 unset($_POST['id']);

						if($this->Breves_model->Guardar_datos('suscriptores',$this->input->post())){
							
							$response = array(
								'success' => true,
								'mensaje' => "<strong>Suscriptores</strong><br>Suscriptor Agregado correctamente"
								);
							
						}else{
							$response = array(
								'save_error' => true,
								'mensaje' => "<strong>Suscriptores</strong><br>Error al cargar el dato"
							);
						}
			
					}else{
						if($this->Breves_model->Update_datos('suscriptores',$this->input->post())){
							
							$response = array(
								'success' => true,
								'mensaje' => "<strong>Suscriptores</strong><br>Suscriptor Editado correctamente"
								);
							
						}else{
							$response = array(
								'save_error' => true,
								'mensaje' => "<strong>Suscriptores</strong><br>Error al actualizar los datos"
							);
						}

					}

				}else{
					$response = array(
						'error' => true,
						'nombre_error' => form_error('name'),
						'apellido_error' => form_error('lastname'),
						'email_error' => form_error('email'),
					);
					
				}
						
						echo json_encode($response);
			}
			
		}
		
		public function suscriptores(){

			if (!$this->ion_auth->logged_in())
	    {
	      redirect('auth/login');
	    }else{
				
				if($this->input->post("botonSubmit")){

					if($this->form_validation->run() === true){

						$datos = array(
							'titulo'		=> $this->input->post('titulo') ,
							'user_add'	=> $this->user->id,
						);

						if($this->Breves_model->Guardar_datos('breves_en_imagenes',$datos )){
							redirect('Manager/Breves', 'refresh');
						}
					}
				}
				
				$user = $this->ion_auth->user()->row();
				
				$datos = array(
					'user' => $user,
				);

				$seccion 		= $this->load->view('manager/secciones/breves/suscriptores',$datos, TRUE);

				$panel = $this->load_panel();
				$scripts =  array(
						base_url().'static/manager/scripts/breves.js?ver='.time(), 
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

		function get_suscriptores_ajax(){

		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}else{
			
			$listado_post =  $this->Breves_model->get_suscriptores_ajax();
			return $listado_post;
		}
		} 
		
		function get_suscriptores_dt(){
			if($this->input->is_ajax_request())
	    {
				$suscriptores =  $this->Breves_model->make_datatables();
				
				 $data = [];

				 foreach($suscriptores as $r) {
				 	$ver_dato = '<a href="#" data-tabla="suscriptores" data-estado="1" data-id="'.$r->id.'" class="ver_suscriptor btn btn-success btn-xs"><i class="fas fa-search" title="Ver suscriptor"></i> </a>';
				 	$edit_dato = '<a href="#" data-tabla="suscriptores" data-estado="1" data-id="'.$r->id.'" class="editar_suscriptor btn btn-warning btn-xs"><i class="fas fa-edit" title="Editar suscriptor"></i> </a>';
				 	$borrar_dato = '<a href="#" data-tabla="suscriptores" data-estado="1" data-id="'.$r->id.'" class="borrar_suscriptor btn btn-danger btn-xs"><i class="fas fa-trash-alt" title="Borrar"></i> </a>';			
				 	$data[] = array(

				 		$r->id,
				 		$r->name,
				 		$r->lastname,
				 		$r->email,
				 		$ver_dato.$edit_dato.$borrar_dato,
				 		$r->origen,
				 	);
				 }

	      $result = array(
	               "draw" => intval($_POST['draw']),
	                 "recordsTotal" => $this->Breves_model->get_all_data(),
	                 "recordsFiltered" => $this->Breves_model->get_filtered_data(),
	                 "data" => $data
	            );


	      echo json_encode($result);
	      exit();
			}
		}

		function get_newsletters_dt(){
			if($this->input->is_ajax_request())
	    {
				$newsletters =  $this->Breves_model->get_newsletter_dt();
	      echo json_encode($newsletters);
	      exit();
			}
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
		
	function borrar_suscriptor(){

			if($this->input->is_ajax_request())
			{

				if($this->Breves_model->borrar_suscriptor($this->input->post())){
					$result = array(
						'estado'=>true
					);

					echo  json_encode($result);
	
				}else{
					$result = array(
						'estado'=> false
					);
					echo  json_encode($result);
				}
			}

		}

	function borrar_newsletters(){

			if($this->input->is_ajax_request())
			{

				if(!$this->borrar_adjunto($this->input->post('id'))){
					$result = array(
						'estado'=>false
					);
				}
				if($this->Breves_model->borrar_newsletters($this->input->post('id'))){
					$result = array(
						'estado'=>true
					);

					echo  json_encode($result);
	
				}else{
					$result = array(
						'estado'=> false
					);
					echo  json_encode($result);
				}
			}

		}

	function addGacetilla(){

		$gacetillas = (array) $this->input->post('gacetillas');
		$suscriptores = (array) $this->input->post('suscriptores');

		$response = array();
		if($this->input->is_ajax_request()){

			$id_newsletter = $this->Breves_model->addGacetilla();

			$create_pdf = $this->Breves_model->get_newsletter($id_newsletter);

			$titulo = $create_pdf['titulo'];
			$publicaciones = $create_pdf['publicaciones'];
			

			foreach($publicaciones as $data){
// $imagen = img_base64($data->imagen);
// $data->imagen = $imagen;
			}

//			$x = 4;
//			
//			$randomNum=substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, $x);
//			
//			$nombre_pdf = 'static/web/breves/pdf/NS_L_C_'.$randomNum.'_'.$id_newsletter.'.pdf';
			
			$nombre_pdf = 'static/web/breves/pdf/'.$id_newsletter.'_Breves_en_Imagenes_'.date("d-m-Y").'.pdf';

			$data = array(
				'titulo' => $titulo,
				'publicaciones'=> $publicaciones,
				'adjunto'=> $nombre_pdf
			);
			
			

			$html = $this->load->view('manager/secciones/breves/template_pdf', $data, TRUE);


			$this->load->library('pdf');

			$dompdf = new Pdf;
			$dompdf->load_html($html);
			//$orientation = 'portrait';
			//$customPaper = array(0,0,950,950);
			//$dompdf->setPaper($customPaper, $orientation);

			$dompdf->setPaper('A4', 'portrait');
			$dompdf->render();
			$output = $dompdf->output();

			//$dompdf->stream("dompdf_out.pdf", array("Attachment" => false));


			$data = array(
				'attachment'=>$nombre_pdf, 
				'body'=>$html
			);

			if($this->Breves_model->actualizar_newsletter_db($id_newsletter, $data)){
				$grabar_datos_array = array(
			  	'error' => false,
						'response_ajax' => $html,
			    );
			}else{
				$grabar_datos_array = array(
		      'seccion' => 'Legislaturas Conectadas<br> Breves en imágenes',
		      'mensaje' => ' Ocurrió un error',
		      'estado' => 'error',
		      'error' => true,
		      'response_ajax' => $html,
		    );
			}

			file_put_contents($nombre_pdf,$output);

			echo json_encode($grabar_datos_array);

		}

	}

	function borrar_adjunto($id){

		$adjunto = $this->Breves_model->buscar_adjunto($id);
		
		if (file_exists(base_url($adjunto->attachment))) {
		if(unlink($adjunto->attachment) ){
			return true;
		}else{
			return false;
		}
			}else{
				$adjunto = 'no genero pdf';
			}


	}
		
		
		/*esta es la que estamos utilizando en este momento para envia los breves en imagenes*/
	
		function send_news(){
		
			$data_news = $this->Breves_model->get_newsletter($this->input->post('id_news'));

			if(!$suscriptor = $this->Breves_model->get_send_suscriptor($this->input->post('id_news'))){

				$result = array(
					'finalizado' => true,
					'status' => true,
					'mensaje' => 'Ha finalizado en envio',
					'enviados' => $this->Breves_model->contar_suscriptores($this->input->post('id_news'), TRUE)
				);
				echo json_encode($result);
			}
		
			$data = array(
				'titulo' => $data_news['titulo'],
				'publicaciones'=> $data_news['publicaciones'],
				'adjunto'=> $data_news['adjunto']
			);

			$html = $this->load->view('manager/secciones/breves/template_pdf', $data, TRUE);
		
			/*utiliza la function con los datos de gmail */
		$envios = $this->envio_gmail($suscriptor,$data_news['titulo'],  $html, $this->input->post('id_news'));
		
		$result = array(
      		'detalle' => $envios
      	);
		echo json_encode($envios); 

	}
		
		
	function enviar_newsletter($test=TRUE){
		
			$data_news = $this->Breves_model->get_newsletter($this->input->post('id_news'));
			
			$suscriptor = $this->Breves_model->get_send_suscriptor($this->input->post('id_news'));
		
			if(!$suscriptor = $this->Breves_model->get_send_suscriptor($this->input->post('id_news'))){

				$result = array(
					'status' => true,
					'mensaje' => 'Ha finalizado en envio',
					'enviados' => $this->Breves_model->contar_suscriptores($this->input->post('id_news'), TRUE)
				);
				echo json_encode($result);
			}

			$data = array(
				'titulo' => $data_news['titulo'],
				'publicaciones'=> $data_news['publicaciones'],
				'adjunto'=> $data_news['adjunto']
			);
				$html = $this->load->view('manager/secciones/breves/template_pdf', $data, TRUE);
		
			foreach($suscriptor as $row){
				
					$envio =  sendMail($row->email,$data_news['titulo'], $html,$attach=FALSE, $test = TRUE);
						
						
						var_dump($envio);
			
			}
		
die();
		
			
		}
		
		
		
		function envio_gmail($sucriptores,$asunto,$html, $id_newsletter){
			
		require_once  APPPATH .'third_party/PHPMailer/Exception.php';
		require_once  APPPATH .'third_party/PHPMailer/PHPMailer.php';
		require_once  APPPATH .'third_party/PHPMailer/SMTP.php';

		//Passing `true` enables PHPMailer exceptions
		$mail = new PHPMailer(true);

		$suscriptor = $this->Breves_model->get_send_suscriptor(10); // id de newsletter
//			var_dump($suscriptor); die();
		$data_news = $this->Breves_model->get_newsletter(10);// id de newsletter

//		$body = file_get_contents('contents.html');

		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->SMTPKeepAlive = true; // SMTP connection will not close after each email sent, reduces SMTP overhead
		$mail->Port = 25;
		$mail->Username = 'legisconectadas.test@gmail.com';
		$mail->Password = 'chapazapata2021';
		$mail->setFrom('legisconectadas.test@gmail.com', 'Legislaturas Conectadas');
		$mail->addReplyTo('legisconectadas.test@gmail.com', 'Legislaturas Conectadas');
		$mail->Subject = $asunto;
	
			
		$mail->msgHTML($html);
		//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
		$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';

		//Connect to the database and select the recipients from your mailing list that have not yet been sent to
		//You'll need to alter this to match your database
 
			$txtMail = '';
			$cant_ok = 0;
			$cant_error = 0;
			foreach ($sucriptores as $row) {
		
							try {
									$mail->addAddress($row->email, $row->nombre);
							} catch (Exception $e) {
									$txtMail .='<p>Invalid address skipped: ' . htmlspecialchars($row->email).'</p>';
							}

							try {
								$mail->send();

								$cant_ok ++;
								$txtMail .= '<p class="enviado">Manseje enviado a  :' . htmlspecialchars($row->nombre) . ' (' . htmlspecialchars($row->email) . ')</p>';
								$status = 1;
							} catch (Exception $e) {

								$cant_error ++;
								$status = 0;
								$txtMail .= '<p class="error">Mailer Error (' . htmlspecialchars($row->email) . ') ' . $mail->ErrorInfo . '</p>';
									
								$mail->getSMTPInstance()->reset();
							}
				
							//Clear all addresses and attachments for the next iteration
							$mail->clearAddresses();
	//						$mail->clearAttachmen();
				
				$data = array(
					"msg_sent" =>$txtMail,
					"status_sent" =>$status,
				);
							$this->Breves_model->actualizar_suscriptor_db($row->id, $data);
				
			}

			$data = array(
				"date_end"=>$this->fecha_now,
				"status" => 1,
				"iduser_send" => $this->user->id,
			);
			
			
			$this->Breves_model->actualizar_newsletter_db($id_newsletter,$data);

				$resultado = array(
					'txtMail'=>$txtMail,
					'cant_ok'=>$cant_ok,
					'cant_error'=>$cant_error
				);
			return $resultado;
		}
		
		
		
		/*reseteo los suscriptores para reenviarlos de neuvo */
		function reset_news(){
			$data = array(
				"status_sent" => 0
			);
			$this->db->where('fk_idnl', $this->input->post('id_news'));
			$this->db->update('newsletter_sent_suscriptors', $data );
				
			if($this->db->affected_rows() > 0){
				return true;
			}else{
				return false;
			}
			
		}
		
		function 	cccxc(){
			
					$suscriptor = $this->Breves_model->get_send_suscriptor(10); // id de newsletter
//			var_dump($suscriptor); die();
					$data_news = $this->Breves_model->get_newsletter(10);// id de newsletter
			
				$data = array(
				'titulo' => $data_news['titulo'],
				'publicaciones'=> $data_news['publicaciones'],
				'adjunto'=> $data_news['adjunto']
			);
			
				$html = $this->load->view('manager/secciones/breves/template_pdf', $data, TRUE);

			
				$respuesta = sendemails('carlos.tutino@legislatura.gov.ar',$data_news['titulo'],$html,$attach=FALSE);
			
				var_dump($respuesta);
			
			
		}

}
		

	?>
