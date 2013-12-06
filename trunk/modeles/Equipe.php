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
	
	public function getEquipesFromService($service){
		global $bdd;
		
		$equipes = $bdd->prepare('	SELECT EQUIPE.ID_EQUIPE, EQUIPE.NOM_EQUIPE
									FROM EQUIPE, FAIRE_PARTIR_DE, SERVICE
									WHERE EQUIPE.ID_EQUIPE=FAIRE_PARTIR_DE.ID_EQUIPE
										AND SERVICE.ID_SERVICE=FAIRE_PARTIR_DE.ID_SERVICE
										AND SERVICE.ID_SERVICE= ? ');
		$equipes->execute(array($services));
		$tuples = $equipes->fetchAll();
		
		return $tuples;
	}
	
	public function listerEquipes($liste){
		echo '<ul class="liste_equipes">';
		foreach($liste as $value){
			echo '<li class="equipe"><input type="hidden" name="'.$value['ID_EQUIPE'].'">'.$value['NOM_EQUIPE'].'</li>';
		}
		echo'</ul>';
	}
}//end class

?>