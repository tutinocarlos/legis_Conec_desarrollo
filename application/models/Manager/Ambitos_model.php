<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Ambitos_model extends CI_Model
{
	
	
	
	public function buscar_item($id){
		$query= $this->db->select('ambito.*, users.first_name, users.last_name')
				->where('ambito.id',$id)
				->join('users', 'users.id = ambito.user_upd', 'left')
				->get('ambito');
			
		if ($query->result() > 0)
    {
      return $query->row();
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


	public function get_ambitos()
	{

		$draw = intval(2);
		$start = intval(0);
		$length = intval(1);


		$query = $this->db->select("ambito.*")
//											->join('categorias', 'categorias.id = ambito.id_categoria')
											->get("ambito");

		$data = [];


		foreach($query->result() as $r) {
			$publicar = '';
			$editar = '';
			$estado = '<span class="badge badge-danger">Sin Publicar</span>';
			if(!$this->ion_auth->is_members()){
				$publicar = '<a href="#" data-tabla="ambito" data-estado="1" data-id="'.$r->id.'" class="acciones btn btn-danger btn-xs">Publicar </a>';
				$editar = '<a href="'. base_url() .'Manager/Ambitos/buscar_item/3" data-tabla="ambito" data-estado="0" data-id="3" class=" btn btn-info btn-xs"><i class="fas fa-pencil-alt" title="editar"></i> </a>';
			}
			if($r->estado == 1){
				$estado = '<span class="badge badge-success">Publicado</span>';
				if(!$this->ion_auth->is_members()){
					$publicar = '<a href="#" data-tabla="ambito" data-estado="0" data-id="'.$r->id.'" class="invisible acciones btn btn-danger btn-xs">Suspender </a>';
				}
			}
				 $data[] = array(
							$r->id,
							$r->nombre,
//							$r->nombre_categoria,
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
		exit();

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
         
 
}
