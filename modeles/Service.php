<?php 
//connexion à la BD
class Service{
	private $ListeEquipes;//les équipes dans le service
	private $nomService;
	private $chefService;
	
	public static function getListeEquipes(){}
	public static function getChef(){}
	public static function getNom(){}
	
	/***********  Getters  ***********/
	public function getListeEquipes() {
	return $this->listeEquipes;
	}
	
	public function getNomService() { 
	return $this->nomService;
	}
	
	public function getChefService() { 
	return $this->chefService;
	}
	/***********  Fin Getters **********/


}//end class

?>