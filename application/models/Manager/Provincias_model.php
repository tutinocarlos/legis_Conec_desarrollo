<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Provincias_model extends CI_Model
{

		public function get_datatable($id_pais)
    {
			
			$draw = intval(2);
      $start = intval(0);
      $length = intval(1);

/*
$this->db->select('title, content, date');
$query = $this->db->get('mytable');
*/
      $this->db->select("_paises.nombre_pais as text_pais,provincias.*, tipo_camara.nombre as camara, tipo_camara.color as color_camara");
			$this->db->join('tipo_camara', 'tipo_camara.id = provincias.camara');
			$this->db->join('_paises', '_paises.id_pais = provincias.id_pais');
			if($id_pais >0){
			$this->db->where('id_pais', $id_pais);
			}
			$query = $this->db->get("provincias");


      $data = [];


      foreach($query->result() as $r) {
				$estado = '<span class="badge badge-danger">Sin Publicar</span>';
				$publicar = '<button type="button" class="acciones btn btn-success btn-sm" data-tabla="provincias" data-estado="1" data-id="'.$r->id.'">Publicar</button>';
				
				if($r->estado == 1){
					
					$estado = '<span class="badge badge-success">Publicado</span>';
					$publicar = '<button type="button" class="acciones btn btn-danger btn-sm" data-tabla="provincias" data-estado="0" data-id="'.$r->id.'">Suspender</button>';
				}
				
				$editar = '<a href="'.base_url().'Manager/Provincias/edit/'.$r->id.'" data-tabla="provincias" data-estado="0" data-id="'.$r->id.'" class=" acciones btn btn-info btn-sm"><i class="fas fa-pencil-alt" title="editar"></i> </a> ';
				
				$color_provincia = '<div class="minicolors minicolors-theme-bootstrap minicolors-position-top minicolors-position-right"><input readonly="" type="text" id="position-top-right" class="form-control demo minicolors-input" data-position="top right" value="'.$r->color.'" size="7"><span class="minicolors-swatch minicolors-sprite minicolors-input-swatch"><span class="minicolors-swatch-color" style="background-color: '.$r->color.'; opacity: 1;"></span></span><div class="minicolors-panel minicolors-slider-hue" style="display: none;"><div class="minicolors-slider minicolors-sprite"><div class="minicolors-picker" style="top: 66.6667px;"></div></div><div class="minicolors-opacity-slider minicolors-sprite"><div class="minicolors-picker"></div></div><div class="minicolors-grid minicolors-sprite" style="background-color:'.$r->color.';"><div class="minicolors-grid-inner"></div><div class="minicolors-picker" style="top: 30px; left: 150px;"><div></div></div></div></div></div>';
				
				$color_camara = '<div class="minicolors minicolors-theme-bootstrap minicolors-position-top minicolors-position-right"><input readonly type="text" id="position-top-right" class="form-control demo minicolors-input" data-position="top right" value="'.$r->color_camara.'" size="7"><span class="minicolors-swatch minicolors-sprite minicolors-input-swatch"><span class="minicolors-swatch-color" style="background-color: '.$r->color_camara.'; opacity: 1;"></span></span><div class="minicolors-panel minicolors-slider-hue" style="display: none;"><div class="minicolors-slider minicolors-sprite"><div class="minicolors-picker" style="top: 66.6667px;"></div></div><div class="minicolors-opacity-slider minicolors-sprite"><div class="minicolors-picker"></div></div><div class="minicolors-grid minicolors-sprite" style="background-color:'.$r->color_camara.';"><div class="minicolors-grid-inner"></div><div class="minicolors-picker" style="top: 30px; left: 150px;"><div></div></div></div></div></div>';
				
				
           $data[] = array(
                $r->id,
                $r->nombre,
                $r->color = $color_provincia,
                $r->zona,
                $r->camara,
                $r->text_pais,
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
	

	
		public function get_provincias(){
			$query = $this->db->select('provincias.nombre as nombre_provincia,
																	provincias.color as color_provincia,
																	provincias.zona as zona_provincia,
																	tipo_camara.nombre as nombre_camara,
																	tipo_camara.detalle as detalle_camara,
																	tipo_camara.color as color_camara')
                          ->where('provincias.estado', 1)
													->join('tipo_camara','tipo_camara.id = provincias.camara')
//                          ->order_by('tau_model')
                          ->get('provincias');

      if ($query->result() > 0){
 					
          return $query->result();
 
      }
			
			
		}
		public function get_provincia($id)
    {
			$query = $this->db->select('provincias.*,
																upd.first_name as nombre_upd ,
																upd.last_name as ape_upd,
																add.first_name as nombre_add, 
																add.last_name as ape_add,
																provincias.id as id_provincia,
																provincias.nombre as nom_provicia,
																tipo_camara.nombre as camara,
																tipo_camara.color as camara_color,
																tipo_camara.id as id_camara
																')
												->where('provincias.id',$id)
												->join('users add', 'add.id = provincias.user_add')
												->join('users upd', 'upd.id = provincias.user_upd', 'LEFT')
												->join('tipo_camara', 'tipo_camara.id = provincias.camara')
//			 									->join('provincias','provincias.id = legislaturas.id_provincia','LEFT')
//												->join('tipo_organismo','tipo_organismo.id = legislaturas.id_organismo','LEFT')
												->get('provincias');


//			var_dump($query->row());
			 if ($query->result() > 0){

          return $query->row();
 
      }
           
    }
	
		public function update_provincia($id_provincia,$data){
			
			$this->db->where('id', $id_provincia);
			if($this->db->update('provincias', $data)){
				return TRUE;
			}else{
				return FALSE;
			}
			
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
      

 
}
