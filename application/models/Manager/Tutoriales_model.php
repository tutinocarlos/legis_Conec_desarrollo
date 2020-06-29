<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Tutoriales_model extends CI_Model
{

	
	public function Guardar_datos($tabla, $data){

		$this->db->insert($tabla,$data);

		if( $id = $this->db->insert_id() ){
				return TRUE;
		}
		return FALSE;
	}
	
		/*GET TUTORIALES*/
	public function get_tutoriales(){
		$query = $this->db->select('*')->get('tutoriales');

		if ($query->result() > 0){

			return $query->result();

		}
	}     
 
}
