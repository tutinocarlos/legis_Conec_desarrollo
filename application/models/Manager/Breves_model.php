<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Breves_model extends CI_Model
{

	public function addGacetilla(){

		try {
        $this->db->trans_start();
			// completamos el dato del newsletter
				$data_news =array(
					'subject' => $this->input->post('asunto'),
					'iduser_ins' => $this->user->id 
				);
        $this->db->insert('newsletters', $data_news);
    	// recupero el ultimo id ingresado
    		$last_id =  $this->db->insert_id();

  		// prepara los datos para insertar las  pu blicaciones que sera enviadas
				$data_post = array();
				$gacetillas = explode(",", $this->input->post('publicaciones'));
			

					foreach($gacetillas as $key=>$value){

						$data_post[]= array(
							'fk_idnl' => $last_id,
							'fk_idpost' => $value,
							'iduser_ins' => $this->user->id
						);
							
					}
				$this->db->insert_batch('newsletter_sent_posts', $data_post);

			// prepraro los remitentes que seran enviados por el newsletters

				$data_suscriptores = array();
				$suscriptores = explode(",", $this->input->post('suscriptores'));

				foreach ($suscriptores as $key => $value) {
					$data_suscriptores[] = array(
						'fk_idnl' => $last_id,
						'fk_idsuscriptor' => $value,
						'iduser_ins' =>  $this->user->id,
					);
				}

				$this->db->insert_batch('newsletter_sent_suscriptors', $data_suscriptores);
       	
       	$this->db->trans_complete();
    		
        $db_error = $this->db->error();


        if ($db_error['code'] == 0 ) {
        	//echo 'xxxxxxxxxxxxxxxxxxxxxxxxx'.$last_id;
            //throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
            return $last_id; // unreachable return statement !!!`enter code here`
        }
        return $last_id;


    } catch (Exception $e) {
        // this will not catch DB related `enter code here`errors. But it will include them, because this is more general. 
        // echo $e->getMessage();
        return 'sasassa'.$e->getMessage();
    }


	}
	public function Guardar_datos($tabla, $data)
	{

		$this->db->insert($tabla,$data);

		if( $id = $this->db->insert_id() )
		{

			return TRUE;
		}

		return FALSE;

	}

	public function Update_datos($tabla, $data)
	{
		$data['date_upd'] =$this->fecha_now;
		$data['iduser_upd'] = $this->user->id;
		$id = $data['id'];
		unset($data['id']);
		$this->db->where('id', $id);
		$this->db->update($tabla, $data);

		if($this->db->affected_rows()> 0 ){
			return TRUE;
		}else{
			return FALSE;
		}


	}
	
	public function get_suscriptores_ajax()
	{

		$draw = intval(2);
		$start = intval(0);
		$length = intval(0);
		
		$query = $this->db->select('*')
		->order_by('id DESC')
		->where('status ',1)
		->get("suscriptores");

		$data = [];

		foreach($query->result() as $r) {

			$data[] = array(

				'<td></td>',
				$r->lastname.','.$r->name,
				$r->email,
				$r->id,

			);
		};
		$result = array(
			"draw" => $draw,
			"recordsTotal" => $query->num_rows(),
			"recordsFiltered" => $query->num_rows(),
			"data" => $data
		);


		echo json_encode($result);
		exit();

	}

		public function get_newsletter_dt()
	{
		$draw = intval(0);
		$start = intval(0);
		$length = intval(0);
			
			
			/*
			SELECT users.id_legislatura as legis_user, newsletters.id as id_news, legislaturas.id as id_legis 
			FROM newsletters 
			JOIN users ON users.id = newsletters.iduser_ins 
			JOIN legislaturas ON legislaturas.id =users.id_legislatura 
			WHERE legislaturas.id = 103*/
			
			if($this->ion_auth->is_admin() || $this->ion_auth->is_members()){
		$query = $this->db->select('
						users.id_legislatura as legis_user,
						newsletters.id as id_news, 
						newsletters.id as iduser_ins, 
						newsletters.status as status, 
						newsletters.date_end as date_end, 
						newsletters.dt_ins as dt_ins, 
						newsletters.attachment as attachment, 
						newsletters.subject as subject, 
						legislaturas.id as id_legis'
			)
			->join('users','users.id = newsletters.iduser_ins ')
			->join('legislaturas','legislaturas.id = users.id_legislatura ')
			->where('legislaturas.id',$this->user->id_legislatura)
				->get("newsletters");
				
			}
			if($this->ion_auth->is_super()){
						$query = $this->db->select('
						users.id_legislatura as legis_user,
						newsletters.id as id_news, 
						newsletters.id as iduser_ins, 
						newsletters.status as status, 
						newsletters.date_end as date_end, 
						newsletters.dt_ins as dt_ins, 
						newsletters.attachment as attachment, 
						newsletters.subject as subject, 
						legislaturas.id as id_legis'
			)
			->join('users','users.id = newsletters.iduser_ins ')
			->join('legislaturas','legislaturas.id = users.id_legislatura ')

				->get("newsletters");
				
			}
		
			
//			print_r($this->db->last_query());  
// var_dump($query->result());	

		$data = [];

		foreach($query->result() as $r) {

			$usuario_alta = $this->ion_auth->user($r->iduser_ins)->row();

			$cant_suscriptores 	= $this->contar_suscriptores($r->id_news, FALSE);
			$cant_enviados					 =  $this->contar_suscriptores($r->id_news, TRUE);
			$cant_publicaciones = $this->contar_publicaciones($r->id_news);


			$status = '<a href="#" class="btn btn-danger btn-xs">Sin enviar</a>';

			$enviar = '<a href="#" data-publicaciones="'.$cant_publicaciones.'" data-suscriptores="'.$cant_suscriptores.'" data-subject="'.$r->subject.'" data-estado="0" data-id_news="'.$r->id_news.'" class="acciones_abrir_modal btn btn-success btn-xs" id="acciones_abrir_modal">Enviar </a>';
			$borrar = ' <a href="#" id="borrar_news" data-tabla="newsletters" data-estado="1" data-id="'.$r->id_news.'" class="borrar_news btn btn-danger btn-xs"><i class="fas fa-trash-alt" title="Borrar"></i> </a>';

			if($r->status == 1){
				$acciones = '';
				$status = '<a href="#" id="link_enviado" class="btn btn-success btn-xs">Enviado</a>';
					$enviar = '<a href="#" data-publicaciones="'.$cant_publicaciones.'" data-suscriptores="'.$cant_suscriptores.'" data-subject="'.$r->subject.'" data-estado="re-enviar" data-id_news="'.$r->id_news.'" class="acciones_abrir_modal btn btn-info btn-xs" id="acciones_abrir_modal">Re enviar </a>';
			}

			// fecha de envio
			$fecha_envio = '-';
			if($r->date_end !=''){
				$fecha_envio = fecha_es($r->date_end, "d/m/a", FALSE); 
			}
			
			if(file_exists(base_url($r->attachment))) {
			$attachment = explode('/', $r->attachment);
				$adjunto = 'pdf';
				$adjunto = $attachment[4];
			}else{
				$adjunto = 'no genero pdf';
			}
			
			

			
			$data[] = array(
				$r->id_news,
				$r->subject,
				$r->attachment,
				$cant_suscriptores,
				$cant_enviados,
				fecha_es($r->dt_ins, "d/m/a", FALSE), 
				$fecha_envio,
				$status,
				$r->iduser_ins = $usuario_alta->last_name.', '.$usuario_alta->first_name ,
				$enviar.$borrar
			);
		}	

			
		$result = array(
			"draw" => $draw,
			"recordsTotal" => $query->num_rows(),
			"recordsFiltered" => $query->num_rows(),
			"data" =>$data
		);


		echo json_encode($result );
		exit();

	}

	function contar_suscriptores($id_newsletter, $enviado){

		if($enviado){
			$query = $this->db->select('*')
			->where('status_sent !=',0)
			->where('fk_idnl',$id_newsletter)
			->get('newsletter_sent_suscriptors');
		}else{
			$query = $this->db->select('*')
			
			->where('fk_idnl',$id_newsletter)
			->get('newsletter_sent_suscriptors');
		}
		
		if ($query->result() > 0){
			$result =  count($query->result());
			return $result;
		}
	}

	function contar_publicaciones($id_newsletter){

			$query = $this->db->select('*')
			->where('fk_idnl',$id_newsletter)
			->get('newsletter_sent_posts');
	
			return $numero_filas=$query->num_rows();
		
	}

	
	public function get_suscriptores_dt(){
echo $_POST['search']['value']; die();
		$select_column = array('id', 'name', 'lastname', 'email', 'status', 'origen');
		$order_column = array('id', 'name', 'lastname', 'email');

		$this->db->select($select_column);
		$this->db->from('suscriptores');
//		$this->db->where('status',1);
		$this->db->where('origen',$this->user->id_legislatura);

		if(isset($_POST['search']['value']) !=''){
			echo 'aca';

			$this->db->like('name',$_POST['search']['value']);
			$this->db->or_like('lastname',$_POST['search']['value']);
			$this->db->or_like('email',$_POST['search']['value']);
		}else{
			echo 'otra';
		}

		if(isset($_POST['order'])){
			$this->db->order_by($order_column[$_POST['order']['0']['column']],$_POST['order']['0']['dir']);
		}else{
			$this->db->order_by('id ASC');
		}
	}
	
	function make_datatables(){

		$this->get_suscriptores_dt();
		if($_POST['length'] != -1){
			$this->db->limit($_POST['length'],$_POST['start']);
		}

		$query = $this->db->get();
		echo $sql = $this->db->last_query();
		return $query->result();
	}

	function get_filtered_data(){
		
		$this->get_suscriptores_dt();
		$query = $this->db->get();

		return $query->num_rows();

	}

	function get_all_data(){
		$this->db->select('*');
		$this->db->from('suscriptores');
		$this->db->where('status',1);
		$this->db->where('origen',$this->user->id_legislatura);
//		echo $sql = $this->db->last_query();
		return $this->db->count_all_results();
	}

	public function borrar_suscriptor($data){


		if($this->db->delete('suscriptores', array('id' =>  $data['id'])) ){
			return true;
		}else{
			return false;
		}

	}

	public function buscar_adjunto($id){

		$query = $this->db->select('attachment')
						->where('id', $id)
		->get('newsletters');

		if ($query->row()){
			
			return $query->row();
		}

	}
	public function borrar_newsletters($id){

		if($this->db->delete('newsletters', array('id' =>  $id)) ){
			return true;
		}else{
			return false;
		}

	}

	public function get_suscriptor($id_suscriptor){
		$query = $this->db->select('*')
		->where('id', $id_suscriptor)
		->get('suscriptores');

		if ($query->row()){
			$query->row()->estado=true;
			return $query->row();
		}

	}

	function get_newsletter($id_newsletter){

		$data = array();
		// titulo del newsletter
		$news = $this->db->select('newsletters.*')
		->where('id',$id_newsletter)
		->get('newsletters');
				

		if ($news->result() > 0){
			$data['titulo'] = $news->row('subject');
			$data['adjunto'] = $news->row('attachment');
		}

		// publicaciones incluidas en el newsletter
		/*	->join('provincias','provincias.id = legislaturas.id_provincia')
												->join('tipo_organismo','tipo_organismo.id = legislaturas.id_organismo')*/

		$publicaciones = $this->db->select('newsletter_sent_posts.*,
																				publicaciones.id as id_publicacion,
																				publicaciones.titulo,
																				publicaciones.id_tipo,
																				publicaciones.cuerpo, 
																				post_media.url as imagen')
		->join('publicaciones', 'publicaciones.id = newsletter_sent_posts.fk_idpost')
		->join('post_media', 'post_media.id_post = newsletter_sent_posts.fk_idpost')
		->where('fk_idnl', $id_newsletter)
		->get('newsletter_sent_posts');

		if ($publicaciones->result() > 0){
			$data['publicaciones'] = $publicaciones->result();
		}

		return ($data);

	}

	function actualizar_newsletter_db($id,$data){

		$this->db->where('id', $id);
		$this->db->update('newsletters', $data );
				
			if($this->db->affected_rows() > 0){
				return true;
			}else{
				return false;
			}

	}
	function actualizar_suscriptor_db($id,$data){

		$this->db->where('id', $id);
		$this->db->update('newsletter_sent_suscriptors', $data );
				
			if($this->db->affected_rows() > 0){
				return true;
			}else{
				return false;
			}

	}

	function get_send_suscriptor($id_newsletter){
		
		$query = $this->db->select('newsletter_sent_suscriptors.*, suscriptores.email, suscriptores.name as nombre,suscriptores.lastname as apellido')
		->where('fk_idnl', $id_newsletter)
		->where('newsletter_sent_suscriptors.status_sent  !=',1)
		->join('suscriptores', 'suscriptores.id = newsletter_sent_suscriptors.fk_idsuscriptor')
		->get('newsletter_sent_suscriptors');
  
		if ($query->result() > 0){
			return $query->result();
		}else{
			return false;
		}


	}
}
