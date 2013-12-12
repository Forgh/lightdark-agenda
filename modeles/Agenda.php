<?php 
//connexion à la BD
include('../include/connect.php');

class Agenda{//un agenda affecté à une personne ou une salle
	private $listeJours;//un moyen de structurer des heures et des disponibilites
	
	
	//public abstract function estLibre(){}
	//public abstract function estPris(){}//Les deux sont-ils utiles ?
	//public abstract function afficher(){}//Afficher l'agenda --> rendu
	//public abstract function ajouterPlage(){}//ajout d'une plage d'occupation
	//public abstract function enleverPlage(){}
	
	/***********  Getters  ***********/
	
	
	public function getlisteJours() {
	return $this->listeJours;
	}
	
	//!?
	public function getlisteCours() {
	return $this->listeCours;
	}
	
	/***********  Fin Getters **********/
	
	
}//end class

?>