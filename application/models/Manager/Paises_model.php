<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Paises_model extends CI_Model
{
	
	
	public function get_idiomas($id){
		$query = $this->db->select('_idiomas.*')->where('_idiomas.idioma_pais',$id)
//		->join('_paises', '_paises.id_pais = _limitrofes.pais_limitrofe')
		->get('_idiomas');
//		echo $this->db->last_query();

		return $query->result();
		
	}	
	public function get_monedas($id){
		$query = $this->db->select('_monedas.*')->where('_monedas.moneda_pais',$id)
//		->join('_paises', '_paises.id_pais = _limitrofes.pais_limitrofe')
		->get('_monedas');
//		echo $this->db->last_query();

		return $query->result();
		
	}
	
	public function get_limitrofes($id){
		$query = $this->db->select('_limitrofes.*, _paises.id_pais as pais_id, _paises.nombre_pais')->where('_limitrofes.id_pais',$id)
			->join('_paises', '_paises.id_pais = _limitrofes.pais_limitrofe')
			->get('_limitrofes');
//		echo $this->db->last_query();

		return $query->result();
	}
	
	public function buscar_item($id){
		$query= $this->db->select('_paises.*')
				->where('_paises.id_pais',$id)
//				->join('users', 'users.id = ambito.user_upd', 'left')
				->get('_paises');
		
			
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


	public function get_paises()
	{

		$draw = intval(2);
		$start = intval(0);
		$length = intval(1);


		$query = $this->db->select("*")->order_by('estado_pais','DESC')
//											->join('categorias', 'categorias.id = ambito.id_categoria')
											->get("_paises");

		$data = [];


		foreach($query->result() as $r) {
			$color_pais = '<div class="minicolors minicolors-theme-bootstrap minicolors-position-top minicolors-position-right"><input readonly="" type="text" id="position-top-right" class="form-control demo minicolors-input" data-position="top right" value="'.$r->color_pais.'" size="7"><span class="minicolors-swatch minicolors-sprite minicolors-input-swatch"><span class="minicolors-swatch-color" style="background-color: '.$r->color_pais.'; opacity: 1;"></span></span><div class="minicolors-panel minicolors-slider-hue" style="display: none;"><div class="minicolors-slider minicolors-sprite"><div class="minicolors-picker" style="top: 66.6667px;"></div></div><div class="minicolors-opacity-slider minicolors-sprite"><div class="minicolors-picker"></div></div><div class="minicolors-grid minicolors-sprite" style="background-color:'.$r->color_pais.';"><div class="minicolors-grid-inner"></div><div class="minicolors-picker" style="top: 30px; left: 150px;"><div></div></div></div></div></div>';
			$publicar = '';
			$editar = '';
			$estado = '<span class="badge badge-danger">Inactivo</span>';
			$publicar = '<a href="#" data-tabla="_paises" data-estado="1" data-id="'.$r->id_pais.'" class="activar_pais btn btn-success btn-xs">Activar</a>';
				$editar = '<a href="'. base_url() .'Manager/Paises/buscar_item/'.$r->id_pais.'" data-tabla="_paises" data-estado="0" data-id="3" class=" btn btn-info btn-xs"><i class="fas fa-pencil-alt" title="editar"></i> </a>';
			if($r->estado_pais == 1){
				$estado = '<span class="badge badge-success">Activo</span>';
				$publicar = '<a href="#" data-tabla="_paises" data-estado="0" data-id="'.$r->id_pais.'" class=" activar_pais btn btn-danger btn-xs">Suspender </a>';
			}
				 $data[] = array(
							$r->id_pais,
							$r->nombre_pais,
//							$r->nombre_categoria,
					 		$color_pais,
							$r->estado_pais = $estado,
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
	
	public function update_pais($id_pais,$data, $tabla){
		$this->db->where('id_pais', $id_pais);
		$this->db->update($tabla, $data); 

//		echo $this->db->last_query();die();
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}

	}	
         
 
}
