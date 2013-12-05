<?php 
//connexion à la BD
class Jour{
	private $dispoMatin;
	private $dispoAprem;
	
	
	/***********  Getters  ***********/
	public function getDispoMatin() { //attention à la MAJ
	return $this->dispoMatin;
	}
	
	public function getDispoAprem() { 
	return $this->dispoAprem;
	}
	
	/***********  Fin Getters **********/


}//end class


?>