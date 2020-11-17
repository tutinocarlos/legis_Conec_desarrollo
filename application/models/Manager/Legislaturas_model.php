<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Legislaturas_model extends CI_Model
{
	
	public function borrar_registro($id){
		
				$this->db->where('id', $id);
				
				$datos['estado'] = 0;
				$datos['borrado'] = 1;
				$datos['fecha_upd'] =$this->fecha_now;
				$datos['user_upd'] = $this->user->id;
				
				$this->db->update('legislaturas', $datos); 
				
				if($this->db->affected_rows() > 0){
					return true;
				}else{
					return false;
				}
		
	}
	
	public function obtener_contenido_select($orden = 'id DESC')
    {
 
		
//			if ($this->ion_auth->is_members() ||  $this->ion_auth->is_admin()){
if($this->ion_auth->is_members() && ($this->user->id_legislatura != 1 && $this->user->id_legislatura != 91) || $this->ion_auth->is_admin() && ($this->user->id_legislatura != 1 && $this->user->id_legislatura != 91)){
				$query = $this->db->select('id,nombre')
									->order_by($orden)
									->where('id',$this->user->id_legislatura)
									->where('estado',1)
									->get('legislaturas');
				
			}else{
				
					$query = $this->db->select('id,nombre')
										->order_by($orden)
										->where('estado',1)
										->get('legislaturas');
			}

			
 		
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
	
	public function borrar_video($id_video){
	
		if($this->db->where('id', $id_video)->delete('legis_videos')){
			return TRUE;
		}else{
			return FALSE;
		}
		
	}
	
	public function update_legislatura($id,$data){

		$this->db->where('id', $id);
		if($this->db->update('legislaturas', $data)){
			return TRUE;
		}else{
			return FALSE;
		}
		
		
	}

	/*GET NOTICIAS LEGISLATURAS*/
	public function get_publicaciones($id){
		$query = $this->db->select('publicaciones.*, ambito.nombre as nombre_ambito, categorias.nombre as nombre_categoria')
                          ->where('id_legislatura', $id)
                          ->where('publicaciones.borrado != 1')
                          ->where('publicaciones.estado',1)
                          ->where('publicaciones.id_tipo',2)
													->join('categorias','categorias.id = publicaciones.id_categoria')
													->join('ambito','ambito.id = publicaciones.id_ambito')
//                          ->order_by('tau_model')
                          ->get('publicaciones');

      if ($query->result() > 0){
 					
          return $query->result();
 
      }
	}
	
	/*GET NORMATIVAS  LEGISLATURAS*/
	public function get_normativas($id){
		$query = $this->db->select('publicaciones.*, ambito.nombre as nombre_ambito, categorias.nombre as nombre_categoria')
                          ->where('id_legislatura', $id)
                          ->where('publicaciones.borrado != 1')
                          ->where('publicaciones.estado',1)
                          ->where('publicaciones.id_tipo',1)
													->join('categorias','categorias.id = publicaciones.id_categoria')
													->join('ambito','ambito.id = publicaciones.id_ambito')
//                          ->order_by('tau_model')
                          ->get('publicaciones');

      if ($query->result() > 0){
 					
          return $query->result();
 
      }
	}
	
	
	public function check($data)
	{
			
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
	
	public function list_legislaturas()
	{
		$query = $this->db->select("legislaturas.id as id_legis,
														 		legislaturas.nombre as nombre_legis,
																legislaturas.lema as lema_legis,
																legislaturas.logo as logo_legis,
																legislaturas.facebook as facebook_legis,
																legislaturas.twitter as twitter_legis,
																legislaturas.instagram as instagram_legis,
																legislaturas.linkedin as linkedin_legis,
																legislaturas.youtube as youtube_legis,
																provincias.nombre as provincia,
																provincias.zona as zona,
																provincias.color as provincia_color,
																provincias.camara as camara,
																tipo_camara.nombre as tipo_camara,
																tipo_camara.color as color_camara,
																tipo_organismo.nombre as organismo,
																_paises.nombre_pais as pais")
												->join('provincias','provincias.id = legislaturas.id_provincia')
												->join('tipo_organismo','tipo_organismo.id = legislaturas.id_organismo')
												->join('tipo_camara','tipo_camara.id = provincias.camara')
												->join('_paises','_paises.id_pais = provincias.id_pais')
												->order_by('_paises.nombre_pais asc, provincias.nombre asc, tipo_organismo.nombre desc')
												->where('legislaturas.estado',1)
												->get('legislaturas');
										

		return $query->result();
		
	}
	
	
	public function get_sliders(){
		
		$query = $this->db->select('legislaturas.slider as slider,
																legislaturas.id as id_legis,
																legislaturas.nombre as nombre_legis,
																legislaturas.id_provincia,
																legislaturas.id_organismo,
																legislaturas.estado,
																legislaturas.slider,
																provincias.nombre as nombre_prov,
																provincias.zona as zona_prov,
																tipo_camara.id as id_camara,
																tipo_organismo.*'
															)
												->join('provincias','provincias.id = legislaturas.id_provincia')
												->join('tipo_organismo','tipo_organismo.id = legislaturas.id_organismo')
												->join('tipo_camara','tipo_camara.id = provincias.camara')
												->where('legislaturas.estado', 1)
												->where('legislaturas.slider !=', '')
												// ordeno los banner con legislaturas conectadas en primer lugar
												->order_by('FIELD ( legislaturas.id,91) DESC')
												->order_by('provincias.nombre asc, tipo_organismo.nombre desc')

												->get('legislaturas');
		if ($query->result() > 0){
//			
//			echo '<pre>';
//			var_dump($query->result()); die();
//			echo '</pre>';
			return $query->result();
		}else{
			return false;
		}
		
	}
	
	
	public function get_slider_legislatura($id){
		$query = $this->db->select('legislaturas.slider as id,legislaturas.slider as slider, legislaturas.nombre as nombre')
												->where('id', $id)
												->get('legislaturas');
		if ($query->result() > 0){
			return $query->row();
		}else{
			return false;
		}
		
	}
	
	public function get_legislatura($id)
	{
		
		$query = $this->db->select('legislaturas.id,
																legislaturas.nombre,
																legislaturas.direccion,
																legislaturas.telefono,
																legislaturas.comentario,
																legislaturas.lema,
																legislaturas.email,
																legislaturas.url,
																legislaturas.url_normativas,
																legislaturas.logo,
																legislaturas.slider,
																legislaturas.fecha_ins,
																legislaturas.fecha_upd,
																legislaturas.zona,
																legislaturas.facebook,
																legislaturas.instagram,
																legislaturas.twitter,
																legislaturas.linkedin,
																legislaturas.iduser_ad as agrego,
																legislaturas.user_upd as modifico,
																legislaturas.youtube,
																upd.first_name as nombre_upd ,
																upd.last_name as ape_upd,
																add.first_name as nombre_add, 
																add.last_name as ape_add,
																provincias.id as id_provincia,
																provincias.nombre as nom_provicia,
																tipo_organismo.nombre as organismo,
																tipo_organismo.id as id_organismo
																')
												->where('legislaturas.id',$id)
												->join('users upd', 'upd.id = legislaturas.user_upd', 'LEFT')
												->join('users add', 'add.id = legislaturas.iduser_ad')
			 									->join('provincias','provincias.id = legislaturas.id_provincia','LEFT')
												->join('tipo_organismo','tipo_organismo.id = legislaturas.id_organismo','LEFT')
												->get('legislaturas');

//echo $this->db->last_query();
		if ($query->result() > 0){

				return $query->row();

		}
	}
	
	public function get_videos_legis($id_legislatura){
		
		$query = $this->db->select('*')
                          ->where('id_legis', $id_legislatura)
                          ->get('legis_videos	');
      if ($query->result() > 0){
				return $query->result();
      }else{
				return false;
			}
	}
	
	
	public function get_imagenes_legis($id_legislatura){
		$query = $this->db->select('*')
                          ->where('id_legis', $id_legislatura)
                          ->get('legis_imagenes	');
      if ($query->result() > 0){
				return $query->result();
      }else{
				return false;
			}
	}
	
	
	public function get_legislaturas(){

		$draw = intval(2);
		$start = intval(0);
		$length = intval(0);

		// add.last_name as ape_add,
		// ')
		// ->where('legislaturas.id',$id)
		// ->join('users upd', 'upd.id = legislaturas.user_upd', 'LEFT')
		// ->join('users add', 'add.id = legislaturas.iduser_ad')
		// ->get('legislaturas');

		$query = $this->db->select("legislaturas.*,
		tipo_organismo.nombre as organismo,
		provincias.nombre as nom_provincia")
		->join('provincias','provincias.id = legislaturas.id_provincia', 'LEFT')
		->join('tipo_organismo','tipo_organismo.id = legislaturas.id_organismo', 'LEFT')
		->where('legislaturas.borrado',0)
		->order_by('provincias.nombre asc, tipo_organismo.nombre desc')
		->get('legislaturas');

		$data = [];

		foreach($query->result() as $r) {

			$publicar = '';
			$editar = '';
			$this->db->from('publicaciones')->where('id_legislatura', $r->id)->where('estado',1);
			
			$total_publicaciones_legislatura = $this->db->count_all_results();
			$total_publicaciones = '<a class="">'.$total_publicaciones_legislatura.'</a>';

			$class = '';
			$estado = '<a href="#" class="btn btn-warning btn-xs">Sin Publicar </a>';
			$publicar = '<a href="#" data-tabla="legislaturas" data-estado="1" data-id="'.$r->id.'" class="acciones btn btn-success btn-xs">Publicar </a> ';

			if($r->estado == 1){
			// $estado = '<a href="#" class="btn btn-success btn-xs">Publicado</a>';
			$estado = '<a href="#" class="btn btn-success btn-xs"><i class="fas fa-check-circle"></i></a>';
			$publicar = '<a href="#" data-tabla="legislaturas" data-estado="0" data-id="'.$r->id.'" class="acciones btn btn-warning btn-xs">Suspender </a>';
			}
			$editar = '<a href="'.base_url().'Manager/Legislaturas/edit/'.$r->id.'" data-tabla="legislaturas" data-estado="0" data-id="'.$r->id.'" class=" btn btn-info btn-xs"><i class="fas fa-pencil-alt" title="editar"></i> </a> ';


			$nombre = '<a title="Editar datos: '.$r->nombre.'" href="'.base_url().'Manager/Legislaturas/edit/'.$r->id.'">'.$r->nombre.' </a>';


			$borrar = '<i data-legis="'.$r->nombre.'" data-total_publicaciones="'.$total_publicaciones_legislatura.'" data-id="'.$r->id.'" class="borrar btn btn-danger btn-xs"><i class="fas fa-trash-alt" title="borrar"></i> </i> ';

			$cantidad_representantes = $this->contar_representantes($r->id);

			$representantes = '<i data-legis="'.$r->nombre.'" data-id="'.$r->id.'" class="import_csv btn btn-info btn-xs">'.$cantidad_representantes.'</i> ';
			
			if($this->ion_auth->is_members()){
				$editar =''; 
				$borrar ='';
				$publicar ='';
					$representantes = '<i data-legis="'.$r->nombre.'" data-id="'.$r->id.'" class=" btn btn-info btn-xs">'.$cantidad_representantes.'</i> ';
				$nombre = $r->nombre;

			}

			$data[] = array(
			$r->id,
			$r->nombre = $nombre,
			$r->organismo,
			$r->nom_provincia,
			$r->direccion,
			$r->telefono,
			$representantes ,
			$r->estado = $estado,
			$total_publicaciones,
			$r->acciones = $publicar.$editar. $borrar
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
	
	
		
	public function get_representsantes_legislatura($id_legis){

		$draw = intval(2);
		$start = intval(0);
		$length = intval(0);

		$query = $this->db->select("*")
											->where('id_legislatura',$id_legis)
											->get('representantes');
		$data = [];

		foreach($query->result() as $r) {

			$periodo = $r->fecha_desde.'-'.$r->fecha_hasta;

			$data[] = array(
				$r->apellido,
				$r->nombre,
				$r->bloque,
				$periodo
			);
		}

		$result = array(
			"draw" => $draw,
			"recordsTotal" => $query->num_rows(),
			"recordsFiltered" => $query->num_rows(),
			"data" => $data
		);

//var_dump($data);
		echo json_encode($result);
		exit();
       
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

	public function Guardar_batch($tabla, $data){

  	$this->db->insert_batch($tabla,$data);
 
		if( $id = $this->db->insert_id() ){
		return TRUE;
		}
 
		return FALSE;
	}

	
	public function contar_fotos($id_legis){
		
		$query = $this->db->select('*')
										->where('id_legis',$id_legis)
										->get('legis_imagenes');
		
		if ($query->result() > 0){
			$result =  count($query->result());
			return $result;
		}else{
			return false;
		}
		
		
	}
	
  public function chequear_misma_imagen($id, $imagen){
		$query = $this->db->select('*')
                          ->where('id', $id)
                          ->where('logo', $imagen)
                          ->get('legislaturas	');

      if ($query->num_rows() > 0){
				return TRUE;
      }else{
				return FALSE;
			}
		
	}    
	
	
	public function contar_representantes($id_legis){

		$query = $this->db->select('*')
										->where('id_legislatura',$id_legis)
										->get('representantes');
			
		if ($query->result() > 0){
			$result =  count($query->result());
			return $result;
		}else{
			return false;
		}
		
		
	}
 
		public function insertar_representantes($tabla, $data){
			$this->borrar_representantes($data[0]['id_legislatura']);
//  		$this->db->insert_batch($tabla,$data);
 
			if( $this->db->insert_batch($tabla,$data)){
			return TRUE;
			}
			return FALSE;
		}
	
		public function borrar_representantes($id_legislatura){
	
		if($this->db->where('id_legislatura', $id_legislatura)->delete('representantes')){
			return TRUE;
		}else{
			return FALSE;
		}
		
	}
}
