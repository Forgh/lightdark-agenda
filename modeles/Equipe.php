<?php 
//connexion à la BD
include('include/connect.php');

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
	
	public function getEquipesFromService($service){
		global $bdd;
		
		$equipes = $bdd->prepare('	SELECT EQUIPE.ID_EQUIPE, EQUIPE.NOM
									FROM EQUIPE, FAIRE_PARTIE_DE, SERVICE
									WHERE EQUIPE.ID_EQUIPE=FAIRE_PARTIE_DE.ID_EQUIPE
										AND SERVICE.ID_SERVICE=FAIRE_PARTIE_DE.ID_SERVICE
										AND SERVICE.ID_SERVICE= ? ');
		$equipes->execute(array($service));
		$tuples = $equipes->fetchAll();
		
		return $tuples;
	}
	
	public function listerEquipes($liste){
		echo '<ul class="liste_equipes">';
		foreach($liste as $value){
			echo '<li><input type="checkbox" class="equipe">'.$value['NOM'].'</li>';
		}
		echo'</ul>';
	}
}//end class

?>