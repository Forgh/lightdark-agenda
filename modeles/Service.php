<?php 
//connexion à la BD
require_once('../include/connect.php');

class Service{
	private $ListeEquipes;//les équipes dans le service
	private $nomService;
	private $chefService;
	

	
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

	public static function getAllServices() {
		global $bdd;
		
		$services = $bdd->query('SELECT * FROM SERVICE');
		$tuples = $services->fetchAll();
		
		return $tuples;
	}
	
	public static function listerServices($liste){/*Fait une liste ordonnée des services de la base*/
		echo '<ul class="liste_services">';
		foreach($liste as $value){
			echo '<li><input type="checkbox" class="service">'.$value['NOM'].'</li>';
		}
		echo'</ul>';
	}
		
}//end class

?>