<?php 
//connexion à la BD
include('include/connect.php');

class Jour{
	private $dispoMatin;
	private $dispoAprem;
	
	
	
	/***********  Getters  ***********/
	public function getDispoMatin() {
	return $this->dispoMatin;
	}
	
	public function getDispoAprem() { 
	return $this->dispoAprem;
	}
	
	/***********  Fin Getters **********/


}//end class


?>