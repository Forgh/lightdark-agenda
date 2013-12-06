<?php 
//connexion à la BD
include('include/connect.php');

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

	public function getAllServices() {
		global $bdd;
		
		$services = $bdd->query('SELECT * FROM SERVICES');
		$tuples = $services->fetchAll();
		
		return $tuples;
	}
	
	public function listerServices($liste){
		echo '<ul class="liste_services">';
		foreach($liste as $value){
			echo '<li><input type="checkbox" class="service">'.$value['NOM_SERVICE'].'</li>';
		}
		echo'</ul>';
	}
		
}//end class

?>