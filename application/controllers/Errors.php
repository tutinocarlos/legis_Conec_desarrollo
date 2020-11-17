<?php
if (!defined('BASEPATH'))
 exit('No direct script access allowed');
/**
 * Description of errors
 *
 * @author Ing. Marcel M. Piña Parma
 * @name errors
 * @version 1.0
 * @date 04 Jul 2013
 *
 * 
 * Description:
 * Clase para poder customizar el error 404 y asi colocarle CSS
 * 
 * */

class Errors extends MY_Controller
{
 private $data = array();

 function __construct()
 {
 parent::__construct();
 $this->load->helper('html');
 }

 function error_404()
 {
 //llamamos a la vista que muestra el error 404 personalizado
 	
		$seccion = $this->load->view('errors/html/error_404', 'dada',TRUE);
 
		
		$data = array(
				'nav' => $this->nav,
				'fecha' => $this->fecha,
				'content' => $seccion,
				'script' => 'static/web/scripts/error.js'
		);

		$this->load->view('web/head',$data);
		$this->load->view('web/index',$data);
		$this->load->view('web/footer',$data);
} 
	
	function forbidden()
 {
 //llamamos a la vista que muestra el error 404 personalizado
 	
		$seccion = $this->load->view('errors/html/error_403', 'dada',TRUE);
 
		
		$data = array(
				'nav' => $this->nav,
				'fecha' => $this->fecha,
				'content' => $seccion,
				'script' => 'static/web/scripts/error.js'
		);

		$this->load->view('web/head',$data);
		$this->load->view('web/index',$data);
		$this->load->view('web/footer',$data);
}
}
?>