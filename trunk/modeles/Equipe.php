<?php 
//connexion à la BD
class Equipe{
	private $chef;
	private $listeMembres;//liste d'utilisateurs
	private $nomEquipe;
	
	
	/***********  Getters  ***********/
	public function getChef() {
	return $this->chef;
	}
	
	public function getListeMembres() {
	return $this->listeMembres;
	}
	
	public function getNomEquipe() {
	return $this->nomEquipe;
	}
	/*********** Fin Getters  ***********/
	

}//end class

?>