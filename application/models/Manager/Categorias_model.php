<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Categorias_model extends CI_Model
{
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
	
		public function update_categoria($tabla,$data){
			
	
			if (!$this->ion_auth->is_super() ){
				redirect('auth/logout');
			}	
			
			$this->db->where('id',$data['id']);
			return $this->db->update('categorias',$data);
			
			
			
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
     
		public function buscar_item($id){
		$query= 	$this->db->select('categorias.*, users.first_name, users.last_name')
				->where('categorias.id',$id)
				->join('users', 'users.id = categorias.user_upd')
				->get('categorias');
			
			
			$this->db->last_query();
				if ($query->result() > 0)
    {
      return $query->row();
    }
			
		}
		
    public function get_categorias()
    {
			$acciones = '';
			$draw = intval(2);
      $start = intval(0);
      $length = intval(0);
			$editar ='';

      $query = $this->db->where('es_borrado','0')->get("categorias");

      $data = [];

      foreach($query->result() as $r) {
				$estado = '<span class="badge badge-danger">Sin Publicar</span>';
				$publicar = '<a href="#" data-tabla="categorias" data-estado="1" data-id="'.$r->id.'" class="acciones btn btn-success btn-xs">Publicar </a> ';
				
				if($r->estado == 1){
					
					$estado 	= '<span class="badge badge-success">Publicado</span>';
					$publicar = '<a href="#" data-tabla="categorias" data-estado="0" data-id="'.$r->id.'" class="acciones btn btn-danger btn-xs">Suspender </a> ';
				}
			 	if ($this->ion_auth->is_super() || $this->ion_auth->is_admin())
				{	
					$acciones = '<a href="'.base_url('Manager/Categorias/buscar_item/'.$r->id).'" data-toggle="tooltip" data-placement="top" title="" data-original-title="Update"><i class="text-warning mdi mdi-grease-pencil"></i></a>';
					$editar = '<a href="'.base_url('Manager/Categorias/buscar_item/'.$r->id).'" data-tabla="publicaciones" data-estado="0" data-id="'.$r->id.'" class=" btn btn-info btn-xs"><i class="fas fa-pencil-alt" title="editar"></i> </a> ';
					$borrar = '<a href="#" data-tabla="publicaciones" data-estado="1" data-id="'.$r->id.'" class="borrar_pub btn btn-danger btn-xs"><i class="fas fa-trash-alt" title="Borrar"></i> </a> ';
			 	}
           $data[] = array(
                $r->id,
                $r->nombre,
                $r->detalle,
                $r->estado = $estado,
                $r->acciones = $publicar.$editar.$borrar
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
       
    }
	
		public function get_sub_categorias()
    {
			
			$draw = intval(2);
      $start = intval(0);
      $length = intval(1);


      $query = $this->db->select("sub_categorias.*, categorias.nombre as nombre_categoria")
												->join('categorias', 'categorias.id = sub_categorias.id_categoria')
												->get("sub_categorias");


      $data = [];


      foreach($query->result() as $r) {
				$estado = '<span class="badge badge-danger">Sin Publicar</span>';
				$publicar = '<button type="button" class="btn btn-success btn-sm">Publicar</button>';
				
				if($r->estado == 1){
					
					$estado = '<span class="badge badge-success">Publicado</span>';
					$publicar = '<button type="button" class="btn btn-danger btn-sm">Suspender</button>';
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
	
		public function get_tipo_publicacion()
    {
			
			$draw = intval(2);
      $start = intval(0);
      $length = intval(1);


      $query = $this->db->select("*")
												->get("tipo_publicacion");


      $data = [];


      foreach($query->result() as $r) {
				$estado = '<span class=" badge-danger">Sin Publicar</span>';
				$publicar = '<button type="button" class="btn btn-success btn-sm">Publicar</button>';
				
				if($r->estado == 1){
					
					$estado = '<span class="badge badge-success">Publicado</span>';
					$publicar = '<button type="button" class="btn btn-danger btn-sm">Suspender</button>';
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

       
    }


		public function obtener_listados($tabla,$orden = 'id DESC')
    {
 
      $query = $this->db->select('*')
                        ->order_by($orden)
												->where('estado',1)
                        ->get($tabla);
 
      if ($query->result() > 0)
      {
          return $query->result_array();
      }
       
      return FALSE;
       
    }
    
		public function obtener_contenido_select($tabla,$orden = 'id DESC')
    {
 
      $query = $this->db->select('id,nombre')
                        ->order_by($orden)
												->where('estado',1)
                        ->get($tabla);
			
 		
      if ($query->result() > 0)
      {
				
				$my_array = array();
				$my_array[0] = '-SELECCIONAR-';
				foreach($query->result() as $data){
					$my_array[$data->id] = $data->nombre;
				}
          return $my_array;
      }
       
      return FALSE;
       
    }
    
 		public function obtener_listados_id($tabla,$id=null,$orden = 'id DESC')
    {
 	
      $query = $this->db->select('*')
                        ->order_by($orden)
												->where('id_categoria',$id)
												->where('estado',1)
                        ->get($tabla);
 
      if ($query->result() > 0)
      {
          return $query->result_array();
      }
       
      return FALSE;
       
    }


    public function borrar($id_categoria){
  
    if($this->db->where('id', $id_categoria)->delete('categorias')){
      return TRUE;
    }else{
      return FALSE;
    }
    
  }
         
 
}
