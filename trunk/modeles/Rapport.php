<?php 
//connexion à la BD
include('include/connect.php');

class Rapport{
	private $titre;
	private $contenu;
	private $numReunion;
	
	
	/***********  Getters  ***********/
	public function getTitre() { //attention à la MAJ
	return $this->titre;
	}
	
	public function getContenu() { 
	return $this->contenu;
	}
	
	public function getNumReunion() { 
	return $this->numReunion;
	}
	
	/***********  Fin Getters **********/


}//end class


?>