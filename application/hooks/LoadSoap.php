<?php

class LoadSoap{
	
	public function __construct(){
		
	}
	
	public function loadSoap(){
		ini_set("soap.wsdl_cache_enabled", 1);
	}
}


?>