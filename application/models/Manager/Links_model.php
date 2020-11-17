<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Links_model extends CI_Model
{
	
		public function get_links_ajax_dt(){
		 $draw = intval(0);
		 $start = intval(0);
		 $length = intval(0);
		 $query = $this->db->select('*')->order_by('orden_link','DESC')->get('links');
		

		 if ($query->result() > 0){
				 $data = [];
			 

		 foreach($query->result() as $r) {
			
			$clase_estado = 'success';
			$icono_estado = 'fa-arrow-circle-up';
			$texto_estado = 'Publicado';
			 
			$publicar = '<a href="#" data-mensaje="modificación" data-accion="cambiar_estado" data-tabla="links" data-estado="0" data-id="'.$r->id_link.'" class="accion_link btn btn-danger btn-xs"><i class="fas fa-arrow-circle-down" title="Suspender"></i> </a>';
			
			
			if($r->estado_link == 0){
			 $clase_estado = 'danger';
			 $icono_estado = 'fa-arrow-circle-down';
			 $texto_estado = 'Suspendido';
			 $publicar = '<a href="#" data-mensaje="modificación" data-tabla="links" data-accion="cambiar_estado" data-estado="1" data-id="'.$r->id_link.'" class="accion_link btn btn-success btn-xs"><i class="fas fa-arrow-circle-up" title="Publicar"></i> </a>';
			}
		 $estado = '<a href="#" data-tabla="links" data-estado="1" data-id="'.$r->id_link.'" class=" btn btn-'.$clase_estado.' btn-xs"><i class="fas '.$icono_estado.'" title="'.$texto_estado.'"></i> </a>';
			 
		 $editar = '<a href="#" data-id="'.$r->id_link.'" class="editar_link btn btn-info btn-xs"><i class="fas fa-pencil-alt" title="Editar"></i> </a>';
//			 
//		 $despublicar = '<a href="#" data-tabla="links" data-estado="1" data-id="'.$r->id_link.'" class="accion_link btn btn-danger btn-xs"><i class="fas fa-trash-alt" title="Borrar"></i> </a>';

			 $borrar = '<a href="#" data-mensaje="eliminación" data-accion="borrar" data-tabla="links" data-estado="1" data-id="'.$r->id_link.'" class="accion_link btn btn-danger btn-xs"><i class="fas fa-trash-alt" title="Borrar"></i> </a>';

			 $data[] = array(
						 $r->orden_link,
						 $r->id_link,
						 $r->titulo_link,
						 $r->detalle_link,
						 $r->url_link,
						 $estado,
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

			}
		} 

}
