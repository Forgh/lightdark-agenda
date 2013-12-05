<?php 
//connexion à la BD
class Reunion{
	private $numReunion;
	private $chefReunion;
	private $sujet;
	private $listeParticipants;//liste d'utilisateurs
	private $listeAbsents;//liste des personnes absentes à la réunion [TODO](signalées ou en général ?)
	private $plage;
	private $salle;
	private $statut;//A venir, passée, annulée etc.
	
	/*********** Getters  **********/
	public function getNumReunion() {
	return $this->numReunion;
	}
	
	public function getChefReunion() {
	return $this->chefReunion;
	}
	
	public function getSujet() { 
	return $this->sujet;
	}
	
	public function getListeParticipants() {
	return $this->listePparticipants;
	}
	
	public function getPlage() { 
	return $this->plage;
	}
	
	public function getSalle() { 
	return $this->salle;
	}
	
	public function getStatut() {
	return $this->statut;
	}
	/***********  Fin Getters  ***********/
	
	
	
	
	public static function ajouterParticipant(){}
	public static function retirerParticipant(){};
	public static function estCreateur(){};
	public static function afficher(){};//retourne un moyen d'afficher la réunion, ses infos, son rapport si terminée
	public static function notifierCreation(){};//"Eh, on a programmé une réunion et t'es invité"
	public static function notifierAnnulation(){};
	
	

}//end class

?>