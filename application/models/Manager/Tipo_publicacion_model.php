<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Tipo_publicacion_model extends CI_Model
{
//      private $tabla_ws_au_localidades = 'WS_AU_LOCALIDADES';
     
    public function get_tipo($id){
			
			 $query = $this->db->select('tipo_publicacion.*')
                          ->where('id',$id)
                          ->where('estado',1)
                          ->get('tipo_publicacion');
			
			
       $result = $query->result_array();
			$datos = array();
			$datos = $result[0];
      if ($query->result() > 0){
					$resultado =  $query->result_array();

          return $datos;
 
      }
		} 
	
	
		public function get_edit_tipo($id){
			
			 $query = $this->db->select('tipo_publicacion.*,users.first_name, users.last_name')
                          ->where('tipo_publicacion.id',$id	)
                          ->where('estado',1)
                          ->order_by('id','desc')
													->join('users', 'users.id = tipo_publicacion.user_ins')
                          ->get('tipo_publicacion');
			
       
      if ($query->result() > 0){
					$result =  $query->result()[0];
          return $result;
 
      }
		} 
	
    public function Guardar_datos($tabla, $data)
//    public function Guardar_consultas($tabla, $data)
    {
    
      $this->db->insert($tabla,$data);
 
      if( $id = $this->db->insert_id() )
      {
					
          return TRUE;
      }
 
      return FALSE;
     
    }

		public function get_sub_categorias(){
			
			$draw = intval(2);
			$start = intval(0);
			$length = intval(1);

			$query = $this->db->select("sub_categorias.*, categorias.nombre as nombre_categoria")
									->join('categorias', 'categorias.id = sub_categorias.id_categoria')
									->get("sub_categorias");

			$data = [];

			foreach($query->result() as $r) {
				$publicar ='';
				$estado = '<span class="badge badge-danger">Sin Publicar</span>';

					$publicar = '<button type="button" class="acciones btn btn-success btn-sm" data-tabla="sub_categorias" data-estado="1" data-id="'.$r->id.'">Publicar</button>';

				
				if($r->estado == 1){
					$estado = '<span class="badge badge-success">Publicado</span>';
	
						$publicar = '<button type="button" class="acciones btn btn-danger btn-sm" data-tabla="sub_categorias" data-estado="0" data-id="'.$r->id.'">Suspender</button>';
	
				}
           $data[] = array(
                $r->id,
                $r->nombre,
                $r->nombre_categoria,
                $r->estado = $estado,
                $r->acciones = $publicar
           );
      }


      $result = array(
               "draw" => $draw,
                 "recordsTotal" => $query->num_rows(),
                 "recordsFiltered" => $query->num_rows(),
                 "data" => $data
            );


      echo json_encode($result);
      exit();
       
     $query = $this->db->select('*')
                          ->where('estado',1)
                          ->order_by('id','desc')
                          ->get('categorias');
			
			
       
      if ($query->result() > 0){

          return $query->result();
 
      }
       
    }
	
		public function get_tipo_publicacion(){
			
			$draw = intval(2);
      $start = intval(0);
      $length = intval(1);


      $query = $this->db->select("*")
												->get("tipo_publicacion");


      $data = [];


      foreach($query->result() as $r) {
				$estado = '<span class="badge badge-danger">Sin Publicar</span>';
					$publicar = '<button type="button" class="acciones btn btn-success btn-sm" data-tabla="sub_categorias" data-estado="1" data-id="'.$r->id.'">Publicar</button>';
				
				if($r->estado == 1){
					
					$estado = '<span class="badge badge-success">Publicado</span>';
						$publicar = '<button type="button" class="acciones btn btn-success btn-sm" data-tabla="sub_categorias" data-estado="0" data-id="'.$r->id.'">Suspender</button>';
				}
           $data[] = array(
                $r->id,
                $r->nombre_categoria,
                $r->nombre,
                $r->detalle,
                $r->estado = $estado,
                $r->acciones = $publicar
           );
      }


      $result = array(
               "draw" => $draw,
                 "recordsTotal" => $query->num_rows(),
                 "recordsFiltered" => $query->num_rows(),
                 "data" => $data
            );


      echo json_encode($result);
      exit();
       
     $query = $this->db->select('*')
                          ->where('estado',1)
                          ->order_by('id','desc')
                          ->get('categorias');
			
			
       
      if ($query->result() > 0){

          return $query->result();
 
      }
       
    }

		public function get_tipos(){
		$draw = intval(2);
		$start = intval(0);
		$length = intval(1);


		$query = $this->db->select("*")->get("tipo_publicacion");


		$data = [];

		$editar = '';
		foreach($query->result() as $r) {
			$publicar ='';
			$editar ='';
			$estado = '<a href="#" class="btn btn-danger btn-xs">Sin Publicar </a>';
			
			if(!$this->ion_auth->is_members()){
				$publicar = '<a href="#" data-tabla="tipo_publicacion" data-estado="1" data-id="'.$r->id.'" class="acciones btn btn-success btn-xs">Publicar </a> ';
				$editar = '<a href=" '.base_url().'Manager/Tipo_publicacion/editar_datos/'.$r->id.'" data-tabla="tipo_publicacion" data-estado="0" data-id="197" class=" btn btn-info btn-xs"><i class="fas fa-pencil-alt" title="editar"></i> </a>';
				
			}

			if($r->estado == 1){
				$estado = '<a href="#" class="btn btn-success btn-xs">Publicado </a>';
				if(!$this->ion_auth->is_members()){
					$publicar = '<a href="#" data-tabla="tipo_publicacion" data-estado="0" data-id="'.$r->id.'" class="acciones btn btn-danger btn-xs">Suspender </a> ';
				}
			}

			$data[] = array(
			$r->id,
			$r->nombre,
			$r->detalle,
			$r->estado = $estado,
			$r->acciones = $publicar.$editar
			);
		}


		$result = array(
		"draw" => $draw,
		"recordsTotal" => $query->num_rows(),
		"recordsFiltered" => $query->num_rows(),
		"data" => $data
		);


		echo json_encode($result);


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
      
		public function update_tipo_pub($tabla,$data){
	
			if (!$this->ion_auth->is_admin() ){
				redirect('auth/logout');
			}	
			
			$this->db->trans_begin(); 
			
			$this->db->where('id',$data['id']);
			
			$this->db->update($tabla,$data);
			if($this->db->affected_rows() > 0)
			{

				$this->db->trans_commit();    


				return TRUE;
			}

			$this->db->trans_rollback();

			return FALSE;
			
		}
	
 
}
