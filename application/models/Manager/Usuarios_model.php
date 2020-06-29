<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Usuarios_model extends CI_Model
{


	function cambiar_estado(){ // los valores me llegan por $this->input->post() //

			// preparo el array para aplicar los cambios de estado al usuario 

			$data = array('active' => $this->input->post('estado') );


			$this->db->where('id', $this->input->post('id'));
			$this->db->update($this->input->post('tabla'), $data); 
			
			if($this->db->affected_rows() > 0){
				return true;
			}else{
				return false;
			}
		}		
	
	function borrar_usuario(){ // los valores me llegan por $this->input->post() //
		
			/*Busco al usuatio para poder modificar su username y email*/
		
				$user_select = $this->ion_auth->user($this->input->post('id_user'))->row();
   
				
				$nuevo_email = 'DEL-'.date('Y-m-d').'-'.$this->user->id.'-'.$user_select->email;
				$nuevo_username = 'DEL_'.date('Y-m-d').'_user_'.$this->user->id.'-'.$user_select->username;
			// preparo el array para aplicar los cambios de estado al usuario 
		
			$data = array('active' => 0,'es_borrado'=>1 ,'email'=>$nuevo_email,'username'=>$nuevo_username);

			$this->db->where('id', $this->input->post('id_user'));
			$this->db->update('users', $data); 
			
			if($this->db->affected_rows() > 0){
				return true;
			}else{
				return false;
			}
		}


		public function get_usuarios(){
			$draw = intval(2);
			$start = intval(0);
			$length = intval(0);
/* estoy acultando los usuarios que estan borrados */
			$query = $this->db->select("*");
			$query = $this->db->where("es_borrado",0);
			$query = $this->db->get("users");

			$data = [];

			foreach($query->result() as $r) {
				
				/*publicaicones por id_usuario*/
				$publicaicones = $this->contar_publicaciones($r->id);
				/*publicaicones por id_user_login*/
				$publicaicones2 = $this->contar_publicaciones2($r->id);
				
				$user_borrado = '';
				if($r->es_borrado == 1){
						$user_borrado = '<span class="badge badge-danger">Borrado</span>';
				}

				$nombre = $r->last_name.', '.$r->first_name;
				$borrar_usr = '';
				$msg = 'vacio';
				if ($this->ion_auth->logged_in() || $this->ion_auth->is_super()){
     $msg = 'login';
				};
				$pws_reset = '<button type="button" data-accion="reset_pw" class=" reset_pw  btn btn-cyan btn-sm" data-tabla="users" data-estado="0" data-id_user="'.$r->id.'" data-nombre="'.$nombre.'">Resetear Password</button>'; 
				
				
				$borrar_usr = '<button type="button" data-accion="delete_usr" class=" delete_usr  btn btn-danger btn-sm" data-nombre="'.$nombre.'" data-estado="0" data-id_user="'.$r->id.'" data-publicaciones="'.$publicaicones.'"><i class="fas fa-trash-alt" title="Borrar Usuario"></i></button>'; 
				

//				$editar = '<a href="'.base_url("Manager/Usuarios/editar/".$r->id).'" data-tabla="users" data-estado="0" data-id="'.$r->id.'" class=" btn btn-info btn-xs"><i class="fas fa-pencil-alt" title="editar"></i> </a>';

				$editar = '<button type="button" data-accion="edit_usr" class=" edit_usr  btn btn-info btn-sm" data-tabla="users" data-estado="0" data-id_user="'.$r->id.'"><i class="fas fa-pencil-alt" title="editar"></i></button>'; 

				$estado = '<span class="badge badge-danger">Desactivado</span>';
				
				$publicar = '<button type="button" data-accion="activar" class="acciones btn btn-success btn-sm" data-tabla="users" data-estado="1" data-id="'.$r->id.'">Activar</button>';

				if($r->active == 1){

					$estado 	= '<span class="badge badge-success">Activo</span>';
					$publicar = '<button type="button" data-accion="suspender" class="acciones btn btn-danger btn-sm" data-tabla="users" data-estado="0" data-id="'.$r->id.'">Desactivar</button>';
				}
								$data[] = array(
													$r->id,
													$r->username  ,
													$r->first_name = $nombre,
													$r->email ,
													$r->estado = $estado.$user_borrado ,
													$r->acciones = $publicar .$pws_reset.$editar.$borrar_usr
					);
			}

			$result = array(
												"draw" => $draw,
														"recordsTotal" => $query->num_rows(),
														"recordsFiltered" => $query->num_rows(),
														"data" => $data,
														"msj" => ''
									);


			echo json_encode($result);
			exit();
       
		}
	
		public function get_usuario_legisltatura($id_legislatura){

			$query = $this->db->select('*, CONCAT(last_name, \', \', first_name) AS name',FALSE)
													->where('id_legislatura',$id_legislatura)
													->get('users');
				
			if ($query->num_rows() > 0){
				return $query->result_array();
			}else{
				return false;
			}
		}
       

		public function actualizar_usuario($data){


			$id = $data['id_usuario'];

    	$datos = array(
    		'first_name'  => $data['first_name'],
    		'last_name'   => $data['last_name'],
     		'username'		 => $data['usuario'],
     		'email' 			 => $data['email'],
     		'id_legislatura' => $data['legislatura'],
	    );

		  if($this->ion_auth->update($id, $datos)){

		  	if($this->db->delete('users_groups', array('user_id' => $id))){
					
					$grupo_usuario = array();

					foreach ($data['grupo'] as $key => $grupo) {
						$grupo_usuario[$key]['user_id'] = $data['id_usuario'];
						$grupo_usuario[$key]['group_id'] = $grupo;
					}
		  		
		  		if($this->db->insert_batch('users_groups', $grupo_usuario)){
		  			return true;
		  		}else{
						return false;
		  		}

		  	}else{
		  		return false;
		  	} 
		  }else{
		  	return false;
		  }
		
		}


		public function check_username($data){

			$query = $this->db->select('*')
												->where('username', $data['username'])
												->where('id !=', $data['id_usuario'])
												->get('users');

			if ($query->num_rows() > 0){
				return true;
				// return $query->result_array();
			}else{
				return false;
			}

		} 

		public function check_email($data){

   		$query = $this->db->select('*')
   									->where('email', $data['email'])
   									->where('id !=', $data['id_usuario'])
   									->get('users');

			if ($query->num_rows() > 0){
				return true;
				// return $query->result_array();
			}else{
				return false;
			}

	} 
		
	function contar_publicaciones($id_user){
		$query = $this->db->select('*')
										->where('id_usuario',$id_user)
										->get('publicaciones');
		
		if ($query->result() > 0){
			$result =  count($query->result());
			return $result;
		}else{
			return false;
		}
		
	}
	function contar_publicaciones2($id_user){
		$query = $this->db->select('*')
										->where('id_user_login',$id_user)
										->get('publicaciones');
		
		if ($query->result() > 0){
			$result =  count($query->result());
			return $result;
		}else{
			return false;
		}
		
	}

   	
}
