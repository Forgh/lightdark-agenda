<?php 
//connexion à la BD
class Agenda{//un agenda affecté à une personne ou une salle
	private $listeJours;//un moyen de structurer des heures et des disponibilites
	
	
	public static function estLibre(){};
	public static function estPris(){};//Les deux sont-ils utiles ?
	public static function afficher(){};//Afficher l'agenda --> rendu
	public static function ajouterPlage(){};//ajout d'une plage d'occupation
	public static function enleverPlage(){};
	
	/***********  Getters  ***********/
	public function getlisteJours() {
	return $this->listeJours;
	}
	
	public function getlisteJours() {
	return $this->listeCours;
	}
	
	/***********  Fin Getters **********/
	
	
}//end class

?>