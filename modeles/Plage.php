<?php
/*Demander au prof gestion du temps*/
require_once('../include/connect.php');
 
//connexion à la BD
class Plage{//une plage horaire
	private $type;//AM || PM
	private $date;//le XX/Y/ZZZZ
	
	//public abstract function getHeureDebut(){}
	//public abstract function getType(){}//le type --> Matin/Aprèm
	
	
	/***********  Getters  ***********/
	public function getType() { //attention à la MAJ
	return $this->type;
	}
	
	public function getDatePlage() { 
	return $this->date;
	}
	/***********  Fin Getters **********/
	
	

}//end class

?>