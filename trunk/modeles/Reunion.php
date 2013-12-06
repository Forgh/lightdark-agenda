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
	private $compteRendu; //Nouveau, contient le compte-rendu de la réunion 
	
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
	
	public function getCompteRendu() {
		return $this->compteRendu; 
	}
	/***********  Fin Getters  ***********/
	

	/*********** Début Setters ***********/
	public function setCompteRendu($cr) {
		$this->compteRendu=$cr;
	}
	
	public function setListeParticipants($lp) {
		$this->listeParticipants=$lp;
	}
	
	public function setListeAbsents($la) {
		$this->listeAbsents=$la;
	}
	
	public function setStatut($statut) {
		$this->statut=$statut;
	}
	
	public function setPlage($cr) {
		$this->plage=$cr;
	}
	/********** Fin Setter ***************/
	
	public function getReunionByNum($num){
		global $bdd;
		$reunion = $bdd->prepare('SELECT * FROM REUNION WHERE ID_REUNION = ?');
		$reunion = $bdd->execute(array($num));
		$tuple = $reunion -> fetchAll();
			
		return new Reunion($tuple['ID_REUNION'], $tuple['ID_CHEF_REUNION'], $tuple['SUJET'], NULL, NULL, NULL,$tuple['SALLE'], NULL, NULL);
	}
	
	public function update() {
		global $bdd;
		$nouveau_membre = $bdd -> prepare('UPDATE REUNION SET  WHERE ID_REUNION= :id_reunion');
		$nouveau_membre -> execute(array(/* les paramètres */));
	}
	
	public function getListeParticipants($num){/*Retourne la liste des Id des membres participant à la réunion donnée par $num*/
		global $bdd;
		$membres = $bdd -> prepare('SELECT ID_PARTICIPANT FROM REUNION WHERE ID_REUNION = ?');
		$membres = $bdd -> execute(array($num));
		$tuple = $membres -> fetchAll();/*tableau*/
		
		return $tuple;
	}
	
	public function supprimerReunion($num){
		global $bdd;
		$suppression = bdd -> prepare('DELETE FROM REUNION WHERE ID_REUNION = ?');
		$suppression = $bdd -> execute(array($num));
	}
	
	
	public static function ajouterParticipant($numReunion, $idParticipant){
		global $bdd;
		$ajout = $bdd -> prepare('INSERT INTO PARTICIPE VALUES (?, ?)');
		$ajout = $bdd -> execute(array($numReunion, $idParticipant));
		}
	
	public static function retirerParticipant(){}
	public static function estCreateur(){}
	public static function afficher(){}//retourne un moyen d'afficher la réunion, ses infos, son rapport si terminée
	public static function notifierCreation(){}//"Eh, on a programmé une réunion et t'es invité"
	public static function notifierAnnulation(){}
	
	public function __construct ($num, $chef, $sujet, $listeParticipants, $plage, $statut, $compteRendu) {
		$this->numReunion = $num;
		$this->chefReunion = $chef;
		$this->sujet = $sujet;
		$this->listeParticipants = $listeParticipants;
		$this->listeParticipants = $listeAbsents;
		$this->plage = $plage;
		$this->salle = $salle;
		$this->statut= $statut;
		$this->compteRendu = $compteRendu;
				
	}
	

}//end class

?>