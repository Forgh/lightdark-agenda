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
	
	
	public function getNomEquipe() {
	return $this->nomEquipe;
	}
	
		
	public function getMembresEquipe($id){/*renvoie tous les utilisateurs de la table*/
			
		global $bdd;
		$membres = $bdd -> prepare('SELECT PARTICIPANT.ID_PARTICIPANT, PARTICIPANT.NOM, PARTICIPANT.PRENOM, PARTICIPANT.MAIL
									FROM PARTICIPANT, APPARTENIR_A, EQUIPE 
									WHERE PARTICIPANT.ID_PARTICIPANT=APPARTENIR_A.ID_PARTICIPANT
									AND EQUIPE.ID_EQUIPE=APPARTENIR_A.ID_EQUIPE
									AND EQUIPE.ID_EQUIPE = ?');
		$membres -> execute(array($id));
		$tuple = $membres -> fetchAll();/*tableau*/
		
		return $tuple;
	}
	/*********** Fin Getters  ***********/
	

}//end class

?>