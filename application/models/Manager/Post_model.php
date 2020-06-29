<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post_model extends CI_Model
{
	
	function __construct(){
		parent::__construct();

		$this->load->model('/Manager/Legislaturas_model');
		$this->load->model('/Manager/Tipo_publicacion_model');
		$this->load->model('/Manager/Provincias_model');

		
	}
	
	public function get_images($id){
		$query = $this->db->select('*')
		->where('id_post',$id)
		->get('post_media');
		if ($query->result() > 0){
			$result =  $query->result();
			return $result;
		}
	}
	
	
	/* esta funcion la creo para poder eliminar usuarios 07/05/2020 */
	public function update_usuarios_post($id_user,$data){
		$this->db->where('id_usuario', $id_user);
		$this->db->or_where('id_user_login', $id_user);
		$this->db->update('publicaciones', $data); 
		
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
		
	}
	
	
	/*chekque si un usuario que voy a eliminar tiene publicaciones */
	public function check_post_user($id_user){
		
		$this->db->where('id_usuario', $id_user);
		$this->db->or_where('id_user_login', $id_user);
		$this->db->get('publicaciones'); 
		
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
		
	}
	
	/*BORRAR ADJUNTO*/
	public function borrar_adjunto($id){

		$query = $this->db->select('*')
		->where('id',$this->input->post('id'))
		->get('post_adjuntos');

		if($query->result() > 0){
			$resultado = $query->row();
//			var_dump($resultado);
//			echo $resultado->url;
//			
//			die(base_url($resultado->url));

			if(unlink($resultado->url)){

				$this->db->trans_begin();

				$this->db->delete('post_adjuntos', array('id' => $resultado->id));

				if($this->db->affected_rows() > 0){

					$this->db->trans_commit();

					return TRUE;
				}

				$this->db->trans_rollback();


				return FALSE;

			}else{
				return FALSE;
			}

		}
	}
	/*AGREGAR ADJUNTOS*/
	
	
	public function insert_adjunto($datos){
		$insert = $this->db->insert('post_adjuntos',$datos);
		
		if($insert){
			return  $this->db->insert_id();
		}else{
			return false;
		}
		
	}

	
	/*LISTA ADJUNTOS POR PUBLICACION*/
	
	public function get_adjuntos($id){
		$query = $this->db->select('*')
		->where('id_post',$id)
		->get('post_adjuntos');
		if ($query->result() > 0){
			$result =  $query->result();
			return $result;
		}
	}	
	
	
	/*LISTA ADJUNTO INDIVIDUAL */
	
	public function get_adjunto($id){
		$query = $this->db->select('*')
		->where('id',$id)
		->get('post_adjuntos');
		if ($query->result() > 0){
			$result =  $query->row();
			return $result;
		}
	}

	public function get_videos($id){
		$query = $this->db->select('*')
		->where('id_post',$id)
		->get('post_videos');
		if ($query->result() > 0){
			$result =  $query->result();
			return $result;
		}
	}
	
	public function update_post($id_post,$data, $tabla){
		$this->db->where('id', $id_post);
		$this->db->update($tabla, $data); 
		
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
		
	}	
	
	
	public function insert_file($data = array()){
		
		$insert = $this->db->insert_batch('post_media',$data);
		return $insert?true:false;
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
	public function check($data){

		$query = $this->db->select('*')
		->where('id',$data['id'])
		->get($data['tabla']);

		if ($query->num_rows() > 0){
			$datos = array(
				'estado' =>$data['estado'],
			);

			$this->db->where('id', $data['id']);
			$this->db->update($data['tabla'], $datos); 

			if($this->db->affected_rows() > 0){
				return true;
			}else{
				return false;
			}

		}else{
			return false;
		}
	}
	
	public function borrar($data){
		$query = $this->db->select('*')
		->where('id',$data['id'])
		->get($data['tabla']);

		if ($query->num_rows() > 0){
			$datos = array(
				'borrado' =>1,
			);

			$this->db->where('id', $data['id']);
			$datos['estado'] = 0;

			$this->db->update($data['tabla'], $datos); 

			if($this->db->affected_rows() > 0){
				return true;
			}else{
				return false;
			}

		}else{
			return false;
		}
	}
	
	public function get_post_ajax(){

		$draw 		= intval(2);
		$start 	= intval(0);
		$length = intval(0);
		$grupo  = $this->ion_auth->get_users_groups($this->user->id)->result();

	if($this->ion_auth->is_members() && ($this->user->id_legislatura != 1 && $this->user->id_legislatura != 91) || $this->ion_auth->is_admin() && ($this->user->id_legislatura != 1 && $this->user->id_legislatura != 91)){

			$query = $this->db->select('publicaciones.*')
			->order_by('id DESC')
			->where('id_legislatura',$this->user->id_legislatura)
			->where('borrado !=',1)
			->get("publicaciones");
		
		}else{

			$query = $this->db->select('publicaciones.*')
			->order_by('id DESC')

			// ->join('provincias','provincias.id = legislaturas.id_provincia')
			->where('borrado !=',1)
			->get("publicaciones");
		}

		$data = [];

      // tipo tabla 
      // agrego un switch case para reutlizar el datatable segun el tipo_tabla que necesito

		switch ($this->input->post('tipo_tabla')) {
			case 'gacetillas':


			foreach($query->result() as $r) {
				$tipo								= $this->Tipo_publicacion_model->get_tipo($r->id_tipo);
				$legislatura = $this->Legislaturas_model->get_legislatura($r->id_legislatura);
				
			if($r->estado != 0){
					$data[] = array(
						'<td></td>',
						$r->id,
						$r->titulo,
						$r->id_tipo = $tipo['nombre'],
						$r->id,
					);
				
			}

			}
			break;
			case 1:
			echo "i=1";
			break;
			case 2:
			echo "i=2";
			break;

			default:
				
			foreach($query->result() as $r) {

				$class = '';
		//				$class = 'text-danger';// clase para el nro de ID publicado o no
				$estado 	= '<a href="#"  class="btn btn-danger btn-xs">Sin Publicar </a>';
				$publicar = '<a href="#" data-tabla="publicaciones" data-estado="1" data-id="'.$r->id.'" class="acciones btn btn-success btn-xs">Publicar </a> ';
		//					$estado 	= '<span class="badge badge-danger">Sin Publicar</span>';

				if($r->estado == 1){

					$estado 	= '<a href="#"  class="btn btn-success btn-xs">Publicado</a>';
					$publicar = '<a href="#" data-tabla="publicaciones" data-estado="0" data-id="'.$r->id.'" class="acciones btn btn-danger btn-xs">Suspender </a> ';
				}
				
				if ($this->ion_auth->is_members()){
					$publicar = '';
					$borrar = '';
					$editar = '';
				}else{

					$borrar = '<a href="#" data-tabla="publicaciones" data-estado="1" data-id="'.$r->id.'" class="borrar_pub btn btn-danger btn-xs"><i class="fas fa-trash-alt" title="Borrar"></i> </a> ';
				$editar = '<a href="'.base_url().'Manager/Post/edit_post/'.$r->id.'" data-tabla="publicaciones" data-estado="0" data-id="'.$r->id.'" class=" btn btn-info btn-xs"><i class="fas fa-pencil-alt" title="editar"></i> </a> ';
					
				}

				
				$legislatura  = $this->Legislaturas_model->get_legislatura($r->id_legislatura);
				$usuario = '';
				$usuario 					= $this->ion_auth->user($r->id_usuario)->row();
				
				$usuario_edit ='';
				$usuario_edit = $this->ion_auth->user($r->user_upd)->row();
//				var_dump($usuario_edit);
				$usuario_alta = $this->ion_auth->user($r->id_user_login)->row();
				
				$tipo									= $this->Tipo_publicacion_model->get_tipo($r->id_tipo);


				$controller = 'Noticias/';
				if($tipo['nombre'] != 'Noticia'){
					$controller = 'Publicacion/';
				}

				$segments = array($controller,url_title(limpiar_url($r->titulo), 'underscore', TRUE),$r->id);

				$ver = '<a href="'.base_url($segments).'" target="_blank" data-tabla="publicaciones" data-estado="0" data-id="'.$r->id.'" class=" btn btn-info btn-xs"><i class="fas fa-eye" title="ver"></i> </a> ';

//$ver ='';

				$data[] = array(
					$r->numero  								= '<span class="'.$class.'">'.$r->id.'</span>',
					$r->id_tipo								 = $tipo['nombre'],
					$r->titulo,
					$r->id_legislatura 	= $legislatura->nombre,
					$r->id_user_login 		= $usuario->last_name.', '.$usuario->first_name ,
//					$r->user_upd	,
					$r->usuario_edit				= $usuario_edit->last_name.', '.$usuario_edit->first_name ,
					$r->estado 			  				= $estado,
					$r->acciones 					  = $publicar.$editar.$ver.$borrar
				);
			}

		}

		$result = array(
			"draw" => $draw,
			"recordsTotal" => $query->num_rows(),
			"recordsFiltered" => $query->num_rows(),
			"data" => $data
		);


		echo json_encode($result);
		exit();

	}
	public function get_post($id){
		
		$query = $this->db->select('*')
		->where('id',$id)
		->get('publicaciones');
		
		if ($query->result() > 0){
			$result =  $query->result()[0];
			return $result;
		}
		
	}
	
	public function put_tag($tabla, $data){
		
		$this->db->insert_batch($tabla,$data);


		if($this->db->affected_rows() > 0)
		{

			$this->db->trans_commit();    


			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	public function eliminar_imagen(){

		$query = $this->db->select('*')
		->where('id',$this->input->post('id'))
		->where('url',$this->input->post('url'))
		->get('post_media');
		
		if ($query->result() > 0){

			if(unlink($this->input->post('url'))){

				$this->db->trans_begin();

				$this->db->delete('post_media', array('id' => $this->input->post('id')));

				if($this->db->affected_rows() > 0){

					$this->db->trans_commit();

					return TRUE;
				}

				$this->db->trans_rollback();

				return FALSE;

			}else{
				return FALSE;
			}


		}
	}
	
	public function contar_fotos($id_post){
		
		$query = $this->db->select('*')
		->where('id_post',$id_post)
		->get('post_media');
		
		if ($query->result() > 0){
			$result =  count($query->result());
			return $result;
		}else{
			return false;
		}
		
		
	}

}
