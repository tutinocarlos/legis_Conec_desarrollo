<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Contenidos_model extends CI_Model
{
	function insert_log(){

		//echo get_ip_address();
		$this->load->library('user_agent');
		$referrer = '';
		if ($this->agent->is_referral())
		{
			$referrer = $this->agent->referrer();
		}

		if(!$this->user){
			$user_id = 0;
		}else{
			$user_id = $this->user->id;
		};

		$data=array(
		'log_ip'=>get_ip_address(),
		'log_user'=>$user_id,
		'log_url_1'=>$referrer,
		'log_url'=>current_url(),
		);

		$tabla ='db_logs';

		$this->db->insert($tabla,$data);
		$this->db->last_query();

//		die();
}

		/*Nuevo listado de normativas del home 01/07/2020*/
	public function get_listado_normativas_ajax2(){
		
			$draw = intval(2);
      $start = intval(0);
      $length = intval(1);
		
//		comento para desabilitar la fucionalidad de aplicar filtros

//			$draw   =  intval($this->input->post("draw"));
//			$start  =  intval($this->input->post("start"));
//			$length =  intval($this->input->post("length"));
			$data = array();
		
		/*
		SELECT `legislaturas`.`id` as `id_legis`, `legislaturas`.`nombre` as `nombre_legis`, `legislaturas`.`lema` as `lema_legis`, `legislaturas`.`logo` as `logo_legis`, `legislaturas`.`facebook` as `facebook_legis`, `legislaturas`.`twitter` as `twitter_legis`, `legislaturas`.`instagram` as `instagram_legis`, `legislaturas`.`linkedin` as `linkedin_legis`, `legislaturas`.`youtube` as `youtube_legis`, `provincias`.`nombre` as `provincia`, `provincias`.`zona` as `zona`, `provincias`.`color` as `provincia_color`, `provincias`.`camara` as `camara`, `tipo_camara`.`nombre` as `tipo_camara`, `tipo_camara`.`color` as `color_camara`, `tipo_organismo`.`nombre` as `organismo` FROM `legislaturas` JOIN `provincias` ON `provincias`.`id` = `legislaturas`.`id_provincia` JOIN `tipo_organismo` ON `tipo_organismo`.`id` = `legislaturas`.`id_organismo` JOIN `tipo_camara` ON `tipo_camara`.`id` = `provincias`.`camara` WHERE `legislaturas`.`estado` = 1 ORDER BY `provincias`.`nombre` asc, `tipo_organismo`.`nombre` desc
		
		*/
		
	$query1 = "SELECT * FROM legislaturas WHERE legislaturas.estado = 1  AND legislaturas.borrado = 0 AND legislaturas.url_normativas != ''";
	$resultados1 = $this->db->query($query1);

		//$query = '	SELECT *';

		//$query .= " FROM legislaturas ";
	
	//	$query .= " WHERE legislaturas.estado = 1  AND legislaturas.borrado = 0 AND legislaturas.url_normativas != ''" ;
		
	$query = "SELECT `legislaturas`.`url_normativas`,`legislaturas`.`id` as `id_legis`, `legislaturas`.`nombre` as `nombre`, `legislaturas`.`lema` as `lema_legis`, `legislaturas`.`logo` as `logo`, `legislaturas`.`facebook` as `facebook_legis`, `legislaturas`.`twitter` as `twitter_legis`, `legislaturas`.`instagram` as `instagram_legis`, `legislaturas`.`linkedin` as `linkedin_legis`, `legislaturas`.`youtube` as `youtube_legis`, `provincias`.`nombre` as `provincia`, `provincias`.`zona` as `zona`, `provincias`.`color` as `provincia_color`, `provincias`.`camara` as `camara`, `tipo_camara`.`nombre` as `tipo_camara`, `tipo_camara`.`color` as `color_camara`, `tipo_organismo`.`nombre` as `organismo` FROM `legislaturas` JOIN `provincias` ON `provincias`.`id` = `legislaturas`.`id_provincia` JOIN `tipo_organismo` ON `tipo_organismo`.`id` = `legislaturas`.`id_organismo` JOIN `tipo_camara` ON `tipo_camara`.`id` = `provincias`.`camara` WHERE legislaturas.estado = 1  AND legislaturas.borrado = 0 AND legislaturas.url_normativas != '' ORDER BY `provincias`.`nombre` asc, `tipo_organismo`.`nombre` desc ";
		
//				$query .=' LIMIT '.$start.','.$length;

				$resultados = $this->db->query($query);

//		var_dump($resultados->result());
			foreach($resultados->result() as $r) {

			$data[] = array(
				$r->id_legis,
				$r->logo_legis = '<img src="'.base_url($r->logo).'" class="img-fluid img-thumbnail" alt="'.$r->nombre.'">',
				$r->nombre,
				'<a href="'.$r->url_normativas.' " target="_blank">Ver normativas Publicadas</a>',
			);

			}
		
//		var_dump($data);
      $result = array(
					"draw" => $draw,
					"recordsTotal" => $resultados1->num_rows(),
					"recordsFiltered" => $resultados1->num_rows(),
					"data" => $data
			);

      echo json_encode($result);
		 exit();
	}
	/*listado de normativas del home*/
	public function get_listado_normativas_ajax(){
		

		
			$draw   =  intval($this->input->post("draw"));
			$start  =  intval($this->input->post("start"));
			$length =  intval($this->input->post("length"));
			$data = array();
		
		$query1 = "SELECT * FROM publicaciones WHERE publicaciones.estado = 1  AND publicaciones.borrado = 0 AND publicaciones.id_tipo = 1";
		$resultados1 = $this->db->query($query1);
		$query = '	SELECT publicaciones.id as id_publicacion, publicaciones.titulo as titulo_publicacion,publicaciones.resumen as resumen_publicacion,ambito.nombre as ambito,tipo_normativa.nombre as tipo_normativa,legislaturas.nombre as nombre_legis,legislaturas.id as id_legis,legislaturas.logo as logo_legis,provincias.id as provincia,
		categorias.nombre as nombre_tematica';

		$query .= " FROM publicaciones ";
			
	
		$query .= '  INNER JOIN legislaturas ON legislaturas.id = publicaciones.id_legislatura';
		$query .= '  INNER JOIN ambito ON ambito.id = publicaciones.id_ambito';
		$query .= '  INNER JOIN provincias ON provincias.id = legislaturas.id_provincia';
		$query .= '  INNER JOIN tipo_normativa ON tipo_normativa.id = publicaciones.id_tipo_normativa';
		$query .= '  INNER JOIN categorias ON categorias.id = publicaciones.id_categoria';
//			$this->db->select("publicaciones.id as id_publicacion,
//												publicaciones.titulo as titulo_publicacion,
//												publicaciones.resumen as resumen_publicacion,
//												ambito.nombre as ambito,
//												tipo_normativa.nombre as tipo_normativa,
//												legislaturas.nombre as nombre_legis,
//												legislaturas.logo as logo_legis,
//												provincias.id as provincia
//												");
//			$this->db->where("publicaciones.estado", 1);
//			$this->db->where("publicaciones.borrado", 0);
//			$this->db->where("publicaciones.is_legis_conectadas", 0);	
//			$this->db->where("publicaciones.id_tipo", 1)	;
							
		$query .= ' WHERE  ( publicaciones.estado = 1  AND publicaciones.borrado = 0 AND publicaciones.estado = 1 AND publicaciones.id_tipo = 1 )' ;
		
			if(isset($_POST['tematica'])){
				$query .= ' AND (';
				for($x=0; $x < count($_POST['tematica']);$x++){
				if($x > 0){	$query .= ' OR ' ;}
					$query .= ' publicaciones.id_categoria = '.$_POST["tematica"][$x] ;
				}
				
				$query .= ')';
			}

				
			if(isset($_POST['provincias'])){
				$query .= ' AND (';
				for($x=0; $x < count($_POST['provincias']);$x++){
				if($x > 0){	$query .= ' OR ' ;}
					$query .= ' legislaturas.id_provincia = '.$_POST["provincias"][$x] ;
				}
				
				$query .= ')';
			}

							
			if(isset($_POST['ambito'])){
				$query .= ' AND (';
				for($x=0; $x < count($_POST['ambito']);$x++){
				if($x > 0){	$query .= ' OR ' ;}
					$query .= ' publicaciones.id_ambito = '.$_POST["ambito"][$x] ;
				}
				
				$query .= ')';
			}

										
			if(isset($_POST['tipo_normativa'])){
				$query .= ' AND (';
				for($x=0; $x < count($_POST['tipo_normativa']);$x++){
				if($x > 0){	$query .= ' OR ' ;}
					$query .= ' publicaciones.id_tipo_normativa = '.$_POST["tipo_normativa"][$x] ;
				}
				$query .= ')';
			}

//			$this->db->join('legislaturas', 'legislaturas.id = publicaciones.id_legislatura');
//			$this->db->join('ambito', 'ambito.id = publicaciones.id_ambito');
//			$this->db->join('tipo_normativa', 'tipo_normativa.id = publicaciones.id_ambito');
//			$this->db->join('provincias', 'provincias.id = legislaturas.id_provincia');
//			$this->db->get("publicaciones");

//		
//		
				$query .=' LIMIT '.$start.','.$length;

				$resultados = $this->db->query($query);

//		var_dump($resultados->result());
			foreach($resultados->result() as $r) {
				
			
			$segments = array('Publicacion',convert_accented_characters(url_title($r->titulo_publicacion), 'underscore', TRUE),$r->id_publicacion);
				

			$data[] = array(
				
				$r->logo_legis = '<img src="'.base_url($r->logo_legis).'" class="img-fluid img-thumbnail" alt="'.$r->nombre_legis.'">',
				$r->titulo_publicacion = '<a href="' .base_url($segments).'">'.$r->titulo_publicacion.'</a>	',
				$r->nombre_tematica,
				$r->nombre_legis,
				$r->tipo_normativa,
				$r->ambito,
//				$r->resumen =  word_limiter($r->resumen_publicacion, 30,' ver más'),
			);

			}
      $result = array(
					"draw" => $draw,
					"recordsTotal" => $resultados1->num_rows(),
					"recordsFiltered" => $resultados1->num_rows(),
					"data" => $data
			);

      echo json_encode($result);
		 exit();
	}
	
	
	/*LISTADO LEGISLATURAS DATA TABLE CONTACTO*/
	
	public function get_listado_legislaturas_contacto_ajax(){
		
			$draw = intval(2);
			$start = intval(2);
			$length = intval(2);


			$query = $this->db->select("legislaturas.nombre as nombre_legis,
			legislaturas.logo as logo_legis,
			legislaturas.direccion as direccion_legis,
			legislaturas.telefono as telefono_legis,
			legislaturas.email as email_legis,
				legislaturas.url_normativas as url_normativas,
																provincias.nombre as nombre_provincia,
																tipo_camara.color as color_camara,
																tipo_organismo.nombre as organismo")
												->where("legislaturas.estado", 1)
												->where("legislaturas.id !=", 91)
												->join('provincias', 'provincias.id = legislaturas.id_provincia')
												->join('tipo_organismo','tipo_organismo.id = legislaturas.id_organismo')
												->join('tipo_camara','tipo_camara.id = provincias.camara')
//												->join('ambito', 'ambito.id = publicaciones.id_ambito')
//												->join('tipo_normativa', 'tipo_normativa.id = publicaciones.id_ambito')
				->order_by('provincias.nombre asc, tipo_organismo.nombre desc')
												->get("legislaturas");

//			
//			var_dump($query->result());
			foreach($query->result() as $r) {
				
			
//							$segments = array('Publicacion',convert_accented_characters(url_title($r->titulo_publicacion), 'underscore', TRUE),$r->id_publicacion);
			$normativas = '';
				
			if (!empty($r->url_normativas)) {
			$normativas = '<a href="'.$r->url_normativas.' " target="_blank">Ver normativas Publicadas</a>';	
			}

			$data[] = array(
				$r->logo_legis = '<img src="'.base_url($r->logo_legis).'" class="img-fluid img-thumbnail" alt="'.$r->nombre_legis.'">',
				$r->nombre_legis	,
				$r->nombre_provincia,
				$r->direccion_legis,
//				$r->titulo_publicacion = '<a href="' .base_url($segments).'">'.$r->titulo_publicacion.'</a>	',
				$r->telefono_legis,
				$r->email_legis,
				$normativas
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
	
	public function buscar_categorias_por_legis($id){

		$query = $this->db->select('

			publicaciones.id as id_publicacion, 
			publicaciones.titulo as tutilo_publicacion , 
			publicaciones.id_categoria as id_cat,
			legislaturas.nombre as nombre_legis,
			legislaturas.id as id_legis,
			categorias.nombre as nombre_cat ')
			->where('publicaciones.id_legislatura',$id)
			->where('publicaciones.estado',1)
			->where('publicaciones.borrado',0)
			->join('categorias', 'categorias.id = publicaciones.id_categoria')
			->join('legislaturas', 'legislaturas.id = publicaciones.id_legislatura')
			->group_by('publicaciones.id_categoria')
			->get('publicaciones');
		
		if ($query->result() > 0){
			return $query->result();
		}else{
			return FALSE;
		}
		
	}
	
	public function home_buscador_noticias($cadena){
		//$this->output->enable_profiler(TRUE);
		$query = $this->db->select('publicaciones.*, legislaturas.nombre as legislatura')
		 									->or_group_start()
											->or_like('	LOWER(publicaciones.titulo)', strtolower($cadena))
											->or_like('	LOWER(publicaciones.cuerpo)', strtolower($cadena))
											->or_like('	LOWER(publicaciones.resumen)', strtolower($cadena))
											->or_like('	LOWER(publicaciones.extra)', strtolower($cadena))
											->group_end()
											->where('publicaciones.estado', 1)
											->where('publicaciones.borrado', 0)
											->where('publicaciones.id_tipo', 2)
											->join('legislaturas', 'legislaturas.id = publicaciones.id_legislatura')
											->get('publicaciones');

		if($query->result() > 0){
			return $query->result();
		}

	}	

	public function home_buscador_normativas($cadena){
		//$this->output->enable_profiler(TRUE);
		$query = $this->db->select('publicaciones.*, legislaturas.nombre as legislatura')
		 									->or_group_start()
											->or_like('LOWER(publicaciones.titulo)', strtolower($cadena))
											->or_like('LOWER(publicaciones.cuerpo)', strtolower($cadena))
											->or_like('LOWER(publicaciones.resumen)', strtolower($cadena))
											->or_like('LOWER(publicaciones.extra)', strtolower($cadena))
											->group_end()
											->where('publicaciones.estado', 1)
											->where('publicaciones.borrado', 0)
											->where('publicaciones.id_tipo', 1)
											->join('legislaturas', 'legislaturas.id = publicaciones.id_legislatura')
											->get('publicaciones');

		if($query->result() > 0){
			return $query->result();
		}

	}

	public function home_buscador_legislaturas($cadena){
		//$this->output->enable_profiler(TRUE);
		$query = $this->db->select('legislaturas.*')
		 									->or_group_start()
											->or_like('LOWER(legislaturas.nombre)', mb_strtolower ($cadena))
											->or_like('LOWER(legislaturas.lema)', mb_strtolower($cadena))
											->or_like('LOWER(legislaturas.comentario)', mb_strtolower($cadena))
										
											->group_end()
											->where('legislaturas.estado', 1)
											->where('legislaturas.borrado', 0)
											->get('legislaturas');

		if($query->result() > 0){
			return $query->result();
		}

	}

	public function obtener_colores(){
		
		$query = $this->db->select('provincias.zona, provincias.color')
											->where('provincias.estado',1)
											->get('provincias');
		
		if ($query->result() > 0){
			return json_encode($query->result());
		}else{
			return FALSE;
		}
	}
	
	/*mapa interactivo*/
	public function buscar_provincia($code){
		$query= 	$this->db->select('
																provincias.id as id_provincia,
																provincias.nombre as nombre_provincia,
																legislaturas.id as id_legis,
																legislaturas.nombre as nombre_legis,
																legislaturas.direccion as legis_direccion,
																legislaturas.telefono as legis_telefono,
																legislaturas.comentario as legis_comentario,
																legislaturas.lema as legis_lema,
																legislaturas.email as legis_email,
																legislaturas.url as legis_url,
																legislaturas.logo as legis_logo,
																legislaturas.facebook as legis_facebook,
																legislaturas.instagram as legis_instagram,
																legislaturas.twitter as legis_twitter,
																legislaturas.linkedin as legis_linkedin,
																legislaturas.youtube as legis_youtube,'
															 )
												->join('legislaturas','legislaturas.id_provincia = provincias.id')
												->where('provincias.zona',$code)
												->where('provincias.estado',1)
												->get('provincias');
		
		// creo un muevo array para cargar datos de provincia
		if ($query->result()){
	
			$provincia = array();

			foreach($query->result_array() as $data){
				
				$segments = array('Provincias',$code,convert_accented_characters(url_title($data['nombre_provincia']), 'underscore', TRUE));
				
				$provincia ['id'] = $data['id_provincia'] ;
				$provincia ['nonbre'] = $data['nombre_provincia'] ;
				$provincia ['url'] =base_url($segments) ;

				//quito el dato de provincia de array d eorganismo
				unset($data['id_provincia'],$data['nombre_provincia']);

				// PREPARO EL ENLACE 
				$segments = array('Legislatura',$data['id_legis'],convert_accented_characters(url_title($data['nombre_legis']), 'underscore', TRUE));
				$data['url'] = base_url($segments);

			}

			$resultado = array(
				'provincia' => $provincia,
				'organismo' => $data,
			);
				return $resultado;
		}else{
		
			return FALSE;
		}
		
	}
	
	public function buscar_tags($tabla,$id_post){
		$query= 	$this->db->select('*')
												->where('id_post',$id_post)
												->get($tabla);

		if ($query->result() > 0){
				return $query->result();
		}
	}
	public function buscar_item($tabla,$id){ // busca informacion sobre publicaciones

		$query= 	$this->db->select('
				publicaciones.id as pub_id,
				publicaciones.fecha_add as fecha,
				publicaciones.id_ambito as ambito,
				publicaciones.estado as estado,

				publicaciones.titulo as pub_titulo,
				publicaciones.resumen as resumen,
				publicaciones.cuerpo as cuerpo,
				publicaciones.autor as autor,
				publicaciones.extra as extra,
				publicaciones.foto as pub_foto,
				publicaciones.estado_art as pub_estado_articulo,
				legislaturas.nombre as leg_nombre,
				legislaturas.facebook as facebook,
				legislaturas.twitter as twitter,
				legislaturas.instagram as instagram,
				legislaturas.youtube as youtube,
				legislaturas.id as leg_id,
				legislaturas.url as leg_url,
				legislaturas.email as leg_email,
				legislaturas.telefono as leg_telefono,
				legislaturas.logo as 	leg_foto,
				legislaturas.comentario as 	leg_comentario,
				legislaturas.direccion as 	leg_direccion,
				categorias.nombre as cat_nombre,
				tipo_publicacion.nombre as tipo_nombre,
				ambito.nombre as ambito_nombre,
				')
				->join('categorias','categorias.id = publicaciones.id_categoria')
				->join('legislaturas','legislaturas.id = publicaciones.id_legislatura')
				->join('ambito','ambito.id = publicaciones.id_ambito')
				->join('tipo_publicacion','tipo_publicacion.id = publicaciones.id_tipo')
				->where($tabla.'.id',$id)
				->get($tabla);


				if ($query->result() > 0)
		{
			return $query->row();
		}

	}
	
	public function buscar_adjuntos($id_post){
		$query= 	$this->db->select('*')
												->where('id_post',$id_post)
												->get('post_adjuntos');

		if ($query->result() > 0){
				return $query->result();
		}
		
	}	
	
	public function buscar_foto($id_post){
		$query= 	$this->db->select('*')
												->where('id_post',$id_post)
												->limit(1)
												->get('post_media');

		if ($query->result() > 0){
				return $query->result();
		}
		
	}
	
	public function buscar_mas_noticias($tabla, $id, $id_legis){

				$query = $this->db->select('publicaciones.id as id_pub,
																publicaciones.titulo as titulo_pub,
																publicaciones.fecha_add ,
																tipo_publicacion.id as id_tipo_pub,
																tipo_publicacion.nombre as nom_tipo_pub,
																categorias.nombre as nombre_cate,
																ambito.nombre as nombre_ambito')
															->where('publicaciones.id !=',$id)
															->join('tipo_publicacion','tipo_publicacion.id = publicaciones.id_tipo','LEFT')
															->join('ambito','ambito.id = publicaciones.id_ambito','LEFT')
															->join('categorias','categorias.id = publicaciones.id_categoria','LEFT')
															->where('id_legislatura ',$id_legis)
															->where('publicaciones.borrado',0)
															->where('publicaciones.estado',1)
															->where('publicaciones.id_tipo',2)
															->limit(4)
															->get($tabla);
	
		if ($query->result() > 0){
				return $query->result();
		}else{
			return false;
		}
	}
	public function buscar_item_prev($tabla, $id, $id_legis){
		$query = $this->db->select('publicaciones.id as id_pub,
																publicaciones.titulo as titulo_pub,
																tipo_publicacion.id as id_tipo_pub,
																tipo_publicacion.nombre as nom_tipo_pub')
											->where('publicaciones.id <',$id)
											->join('tipo_publicacion','tipo_publicacion.id = publicaciones.id_tipo')
											->where('id_legislatura ',$id_legis)
											->where('publicaciones.borrado ',0)
											->where('publicaciones.estado ',1)
											->limit(1)
											->get($tabla);
     
		if ($query->result() > 0){
				return $query->result();
		}else{
			return false;
		}
	}	
	public function buscar_item_next($tabla, $id,$id_legis){
		$query = $this->db->select('publicaciones.id as id_pub,
																publicaciones.titulo as titulo_pub,
																tipo_publicacion.id as id_tipo_pub,
																tipo_publicacion.nombre as nom_tipo_pub')
											->join('tipo_publicacion','tipo_publicacion.id = publicaciones.id_tipo')
											->where('publicaciones.id >',$id)
											->where('id_legislatura ',$id_legis)
											->where('publicaciones.borrado ',0)
											->where('publicaciones.estado ',1)
											->limit(1)
											->get($tabla);
       
		if ($query->result() > 0){
				return $query->result();
		}else{
			return false;
		}
	}
	
	public function buscar_fotos($id_post){
		$query = $this->db->select('*')
                          ->where('id_post',$id_post)
                          ->get('post_media');
       
		if ($query->result() > 0){
				return $query->result();
		}
	}
	
	public function buscar_videos($id_post){
		$query = $this->db->select('*')
                          ->where('id_post',$id_post)
                          ->get('post_videos');
       
		if ($query->result() > 0){
				return $query->result();
		}
	}
	
	/*
	Envio $id_cate si estoy listando el filtro de las categorias de las lista de noticias de legis
	*/
	public function list_noticias_by_legis($id_legis, $id_cate=NULL){
		
		
		$mi_where = '1=1';
		if(isset($id_date)){
		
			$mi_where = 'id_categoria, '.$id_cate;
		}
		
		$query = $this->db->select('*')
											->where('id_legislatura',$id_legis)
											->where('estado',1)
											->where('borrado',0)
											->where($mi_where)
											->get('publicaciones');
       
		if ($query->result() > 0){
				return $query->result();
		}
		
	}
	
	public function Guardar_categoria($tabla, $data){
    
      $this->db->insert($tabla,$data);
 
      if( $id = $this->db->insert_id() )
      {
          return TRUE;
      }
 
      return FALSE;
     
	}
	
	public function get_categorias(){
			
			$draw = intval(2);
      $start = intval(0);
      $length = intval(1);

      $query = $this->db->get("categorias");

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
	
	public function Reemplazar_foraneas($array){
     
      $result = FALSE;
       
      foreach ( $array as $clave => $valores)
      {
         
        $query  = $this->db->select($valores["campo"])
                            ->where('id',$valores["id"])
                            ->get($valores["tabla"]);
 
        if ($query->result() > 0)
        {
            $return = $query->row_array();
 
            $result[$clave] = $return[$valores["campo"]];
        }     
 
      }
      return $result;
       
	}
	
	public function obtener_listados($tabla,$orden = 'id DESC'){
 
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
	
	public function list_noticias(){
		$query = $this->db->select('*')
									->order_by("fecha_add", "desc")
									->where('estado',1)
									->where('id_tipo',2)
									->get('publicaciones');


		foreach($query->result() as $data){
			$data->fecha_add = fecha_es($data->fecha_add,"L d F a");
		}

		if ($query->result() > 0)
		{
				return $query->result();
		}

		return FALSE;
       
	}
	
	public function obtener_publicaciones($tabla,$id_tipo, $orden='id ASC', $limit = ''){
 		 	$tipo = $this->_obtener_tipo($id_tipo);
	
      $query = $this->db->select('*')
                        ->order_by($orden)
												->where('estado',1)
												->where('id_tipo',$id_tipo)
												->limit($limit)
                        ->get($tabla);
 
//		echo $this->db->last_query();
      if ($query->result() > 0)
      {
				$data['tipo']=$tipo[0];
				$data['post']=$query->result();
          return $data ;
      }
       
      return FALSE;
       
	}
	
	public function _obtener_tipo($id_tipo){
		$query = $this->db->select('*')
												->where('id',$id_tipo)
												->where('estado',1)
                        ->get('tipo_publicacion');

      if ($query->result() > 0)
      {
          return $query->result();
      }else{
				return FALSE;
			}
		
	}
	
	public function _obtener_dato($tabla,$id_tipo){
		$query = $this->db->select('*')
											->where('id',$id_tipo)
											->where('estado',1)
											->get($tabla);

      if ($query->row() > 0)
      {
				return $query->row();
      }
		
	}
	
	public function html_filter($id_tipo=null){
//	 	$this->db->from('categorias');
         
		$query = $this->db->select(
						'categorias.id as id_cat,
						categorias.nombre as nombre_cat,
						publicaciones.id as id_publicaciones, 
						publicaciones.titulo as publicaciones_titulo, 
						publicaciones.estado as publicaciones_estado, 
						publicaciones.foto as publicaciones_foto, 
						publicaciones.id_categoria as cat_publicaciones'
						)
						->join('publicaciones', 'publicaciones.id_categoria = categorias.id', 'right ')
						->where('publicaciones.estado', 1 )
//              ->where('categorias.estado', 1 )
						->where('publicaciones.id_tipo !=', 2 )
						->where('publicaciones.borrado =',0)
						->order_by('categorias.id ASC')

						->get('categorias');
//         echo 'sads';
// var_dump($query->result() ); die();

    if ($query->result() > 0)
    {
      return $query->result();
    }
			
	}
	
	public function publicaciones_html_filter($id_tipo){

		$query = $this->db->select(
						'categorias.id as id_cat,
						categorias.nombre as nombre_cat,
						publicaciones.id as id_publicaciones, 
						publicaciones.titulo as publicaciones_titulo, 
						publicaciones.borrado as publicaciones_borrado, 
						publicaciones.foto as publicaciones_foto, 
						publicaciones.id_categoria as cat_publicaciones'
						)
						->join('publicaciones', 'publicaciones.id_categoria = categorias.id', 'right ')
						->where('publicaciones.borrado !=',1)
						->where('publicaciones.id_tipo =', $id_tipo )
						->where('publicaciones.estado', 1 )
						->order_by('categorias.id ASC')
						->get('categorias');
		
		// var_dump($query->result() ); die();

    if ($query->result() > 0)
    {
      return $query->result();
    }
			
	}
	
	public function categorias_html_filter(){
         
    $query = $this->db->select(
							'categorias.id as id_cat,
							categorias.nombre as nombre_cat,
							publicaciones.id as id_publicaciones,
							publicaciones.estado as publicaciones_estado, 
							publicaciones.titulo as publicaciones_titulo, 
							publicaciones.foto as publicaciones_foto, 
							publicaciones.id_categoria as cat_publicaciones'
							)
              ->join('categorias', 'categorias.id = publicaciones.id_categoria', ' inner  ')
							->where('id_tipo !=',2)
							->where('publicaciones.estado !=',0)
							->where('publicaciones.borrado !=',1)
							->group_by('categorias.id')
              ->order_by('publicaciones.id DESC')
							->get('publicaciones');
         
    if ($query->result() > 0)
    	{
      	return $query->result();
    	}
			
	}
	
	public function publicaciones_cat_html_filter($id_tipo){
				         
    $query = $this->db->select(
							'categorias.id as id_cat,
							categorias.nombre as nombre_cat,
							publicaciones.id as id_publicaciones, 
							publicaciones.estado as publicaciones_estado, 
							publicaciones.titulo as publicaciones_titulo, 
							publicaciones.foto as publicaciones_foto, 
							publicaciones.id_categoria as cat_publicaciones'
							)
              ->join('categorias', 'categorias.id = publicaciones.id_categoria')
//							->where('id_tipo ',$id_tipo)
							->group_by('categorias.id')
              ->order_by('publicaciones.id DESC')
//							->where('publicaciones.estado != ',0)
//							->where('publicaciones.borrado != ',1)
							->get('publicaciones');
//		echo 'casa';
//         var_dump($query->result()); die();
    if ($query->result() > 0)
    	{
      	return $query->result();
    	}
			
	}
	
	public function categorias_html_filter_id_tipo($id_tipo){
     
    $query = $this->db->select(
							'categorias.id as id_cat,
							categorias.nombre as nombre_cat,
							post.id as id_post, 
							post.titulo as post_titulo, 
							post.foto as post_foto, 
							post.id_categoria as cat_post'
							)
              ->join('categorias', 'categorias.id = post.id_categoria', ' inner  ')
							->group_by('categorias.id')
              ->order_by('post.id DESC')
              ->where('post.id_tipo', $id_tipo)
							->get('post');
         
    if ($query->result() > 0)
    	{
      	return $query->result();
    	}
			
	}
	
	public function nav_bar(){
		$query = $this->db->select('*')
						->where('estado',1)
						->where('id !=',2)
						->get('tipo_publicacion');
		
		foreach($query->result() as $data){
			$total = $this->count_reg('publicaciones',$data->id);
			if($this->count_reg('publicaciones',$data->id) > 1){
				$data->nombre = $data->detalle;
			}
		}
		return $query->result();
	}
	
	public function get_noticas($tabla){
			$query = $this->db->select('*')
                          ->where('estado',1)
                          ->where('id_tipo',2)
													->where('publicaciones.borrado !=',1)
                          ->get($tabla);
       
      if ($query->result() > 0){

          return count($query->result());
 
      }
		}
		
	public function get_paginador_noticias($tabla, $per_page, $offset){
			$query = $this->db->select('publicaciones.*,
													ambito.nombre as nombre_ambito,
													categorias.nombre as nombre_tematica,
													legislaturas.nombre as nombre_legis')
                          ->where('publicaciones.estado',1)
                          ->where('publicaciones.borrado',0)
				->group_start()
				->where('id_tipo',2)
				->or_where('id_tipo',3)
			 ->group_end()
				  								->join('ambito','ambito.id = publicaciones.id_ambito')
													->join('categorias','categorias.id = publicaciones.id_categoria')
													->join('legislaturas','legislaturas.id = publicaciones.id_legislatura')
                          ->order_by('fecha_add DESC')
                          ->get($tabla,$per_page,$offset);
			
//echo $this->db->last_query();
//       	echo count($query->result()); die();
      if ($query->result() > 0){

          return ($query->result());
 
      }
			
		}
	
	public function get_publicaciones_destacadas($tabla,$cantidad){
		$query = $this->db->select('publicaciones.*,
												ambito.nombre as nombre_ambito,
												categorias.nombre as nombre_tematica,
												legislaturas.nombre as nombre_legis')
												->where('publicaciones.estado',1)
												->where('publicaciones.borrado',0)
//												->where('publicaciones.is_destacado',1)
												->where('publicaciones.id_legislatura',91)
												->where('id_tipo',2)
												->limit($cantidad)
												->join('ambito','ambito.id = publicaciones.id_ambito')
												->join('categorias','categorias.id = publicaciones.id_categoria')
												->join('legislaturas','legislaturas.id = publicaciones.id_legislatura')
												->order_by('fecha_add DESC')
												->get($tabla);


//       	echo count($query->result()); die();
		if ($query->result() > 0){

				return ($query->result());

		}

	}
	
	public function func_count($tabla){
			$query = $this->db->select('*')
												->where('estado',1)
												->where('id_tipo',2)
												->get($tabla);

      if ($query->result() > 0){
          return count($query->result());
      }
			
		}	
	public function count_reg($tabla,$tipo){
			$query = $this->db->select('*')
												->where('estado',1)
												->where('id_tipo',$tipo)
												->get($tabla);

      if ($query->result() > 0){
          return count($query->result());
      }
			
		}
	
	/*recupero toda la data de la tabla */
	public function get_all_data($tabla, $estado=1){
/* MODIFICADO EL 30/05/2020 SEGUN PEDIDO ARCHIVO CAMBIO ORDEN DE CABA DPS DE CHUBUT */
		if($tabla == 'provincias'){
			$query = $this->db->select($tabla.'.*,'.$tabla.'.id as id_'.$tabla)
				->where('estado',$estado)
				->order_by('provincias.nombre asc')
				->get($tabla);
			
		}else{
			$query = $this->db->select($tabla.'.*,'.$tabla.'.id as id_'.$tabla)->where('estado',$estado)->get($tabla);
		}
 
		if ($query->result() > 0){
				return $query->result();
		}
		return FALSE;
	}
  
	
	/*listado de legoslaturas seccion links de interes*/
	
		public function get_listado_legislaturas_links(){

			$query = $this->db->select("links.id_link,legislaturas.id as id_legis,legislaturas.nombre as nombre_legis,
			legislaturas.logo as logo_legis,
			legislaturas.direccion as direccion_legis,
			legislaturas.telefono as telefono_legis,
			legislaturas.email as email_legis,
			legislaturas.url_normativas as url_normativas,
																provincias.nombre as nombre_provincia,
																tipo_camara.color as color_camara,
																tipo_organismo.nombre as organismo")
												->where("legislaturas.estado", 1)
												->where("legislaturas.id !=", 91)
												->join('provincias', 'provincias.id = legislaturas.id_provincia')
												->join('tipo_organismo','tipo_organismo.id = legislaturas.id_organismo')
												->join('tipo_camara','tipo_camara.id = provincias.camara')
												->join('links','links.id_legislatura = legislaturas.id', 'letf')
//												->join('ambito', 'ambito.id = publicaciones.id_ambito')
//												->join('tipo_normativa', 'tipo_normativa.id = publicaciones.id_ambito')
				->order_by('provincias.nombre asc, tipo_organismo.nombre desc')
												->get("legislaturas");
			
			
			if ($query->result() > 0){

				
				$resultado =$query->result(); 
				
				foreach($resultado as $data){
					$data->links = $this->buscar_links($data->id_legis);
				}	
				
				
				return $resultado;
//			echo '<pre>';
//				var_dump($resultado);
//			echo '</pre>';
			}
			
		}
	
	function buscar_links($id_legis){
		$query = $this->db->select("*")->where('id_legislatura',$id_legis)->get('links');
		if ($query->result() > 0){
			return $query->result();
		}
	}
	
	
	public function get_listado_links(){
			$query = $this->db->select('links.url_link, links.titulo_link, legislaturas.nombre as nombre_legis, provincias.nombre as provincia,tipo_organismo.nombre as organismo')
				->join('legislaturas','legislaturas.id = links.id_legislatura_link')
				->join('provincias','provincias.id = legislaturas.id_provincia')
				->join('tipo_organismo','tipo_organismo.id = legislaturas.id_organismo')
				->order_by('provincias.nombre asc, tipo_organismo.nombre desc')
				->get("links");
				if ($query->result() > 0){
					return $query->result();
				}
			
		}
	
	
	public function get_links_ajax(){
			$draw = intval(2);
			$start = intval(2);
			$length = intval(2);


			$query = $this->db->select("*")
				->where("estado_link", 1)
				->order_by('orden_link','DESC')
				->get("links");
		
			$this->db->last_query();

			foreach($query->result() as $r) {
		$titulo = '<a href="'.$r->url_link.'" target="_blank">'.$r->titulo_link.' </a>';
		$detalle = '<a href="'.$r->url_link.'" target="_blank">'.$r->detalle_link.' </a>';
		$url			= '<a href="'.$r->url_link.'" target="_blank">'.$r->url_link.' </a>';

			$data[] = array(
				$titulo,
				$detalle,
				$url,

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
	
}
