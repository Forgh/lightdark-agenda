<?php 
//connexion à la BD
require_once('../include/connect.php');

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
	/*
	public function getParticipants() {
	return $this->listePparticipants;
	}
	*/
	
	public function getPlage() { 
	return $this->plage;
	}
	
	public function getSalle() { 
	return $this->salle;
	}
	
	/*
	public function getStatut() {//"a venir", "en cours", "passée"
		if()
	return $this->statut;
	}
	*/
	
	public function getCompteRendu() {
		return $this->compteRendu; 
	}
	
	public function estPassee(){//[TODO] : implémenter avec une vraie vérification
	/*Renvoie faux si la réunion à lieu ce jour ou plus tard, vrai sinon*/
		return false;	
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
	
	
	public static function setPresent($id, $num){/*passe le participant à 'participera'*/
		global $bdd;
		$participera = $bdd -> prepare('UPDATE PARTICIPE SET ETAT = "Participera" WHERE ID_PARTICIPANT = ? AND ID_REUNION = ?');
		$participera -> execute (array($id, $num));
	}
	
	public static function setAbsent($id, $num){/*passe le participant à 'décommandé'*/
		global $bdd;
		$decommander = $bdd -> prepare('UPDATE PARTICIPE SET ETAT = "Décommandé" WHERE ID_PARTICIPANT = ? AND ID_REUNION = ?');
		$decommander -> execute (array($id, $num));
	}
	
	/********** Fin Setters ***************/
	
	
	public static function listerSallesDispo($jour, $plage){
		
		/*Prend une date au format JJ/MM/AAAA puis la convertie*/
		global $bdd;
		$r = $bdd -> prepare('	SELECT REUNION.`SALLE` FROM REUNION WHERE REUNION.`SALLE` NOT IN(

									SELECT REUNION.`SALLE`
									FROM REUNION, MOMENT
									WHERE (REUNION.`ID_DATE`=MOMENT.`ID_DATE` 
     									AND MOMENT.`JOUR`= :jour
    									AND MOMENT.`TEMPS`= :plage));'
		
		);
		$r -> execute(array(
				'jour' => $jour,
				'plage' => $plage
			));	
	}
	
	public static function ajouter_reunion($sujet, $salle, $createur, $idDate){
		global $bdd;
		$new = $bdd -> prepare ('INSERT INTO REUNION (ID_CHEF_REUNION, ID_DATE, SUJET, SALLE) VALUES (:chef, :Date, :sujet, :salle)');
		$new -> execute(array(
			'chef' => $createur,
			'Date' => $idDate,
			'sujet' => $sujet,
			'salle' => $salle
		));
		
		$id = $bdd->prepare('SELECT ID_REUNION FROM REUNION WHERE ID_DATE = ? AND SALLE = ?');
		$id -> execute(array($idDate, $salle));
		$tuple = $id->fetchAll()[0];
		return $tuple[0];
	}
	
	public static function getReunionByNum($num){
		global $bdd;
		$req = $bdd -> prepare('SELECT * FROM REUNION WHERE ID_REUNION = ?;');
		$req -> execute(array($num));
		
		$tuple = $req -> fetchAll()[0];/*retourne un tableau (une case) du tableau de valeurs -_-'*/
		
		return new Reunion($tuple['ID_REUNION'], $tuple['ID_CHEF_REUNION'], $tuple['SUJET'], NULL, NULL, NULL,$tuple['SALLE'], NULL, $tuple['compte_rendu']);
	}
	
	public static function update($new) {
		 
		global $bdd;
		$nouveau_membre = $bdd -> prepare('UPDATE REUNION SET ID_CHEF_REUNION = :ID_CHEF_REUNION, ID_DATE=:ID_DATE, SUJET=:SUJET, SALLE=:SALLE, compte_rendu=:compte_rendu WHERE ID_REUNION= :id_reunion');
		$nouveau_membre -> execute(array(
							'ID_CHEF_REUNION' => $new->chefReunion,
							'ID_DATE' => $new->plage,
							'SUJET' => $new->sujet,
							'SALLE' => $new->salle,
							'compte_rendu' => $new->compteRendu,
							'id_reunion' => $new->numReunion
		));
	}
	
	public static function getListeParticipants($num){
		/*Retourne la liste des Id des membres participant à la réunion, décommandés ou pas*/
		global $bdd;
		$membres = $bdd -> prepare('SELECT ID_PARTICIPANT FROM REUNION WHERE ID_REUNION = ?');
		$membres = $bdd -> execute(array($num));
		$tuple = $membres -> fetchAll();/*tableau*/
		
		return $tuple;
	}
	
	public static function getListePresents($num){
		/*Retourne la liste des Id des membres décommandés de la réunion*/
		global $bdd;
		$membres = $bdd -> prepare('SELECT ID_PARTICIPANT FROM PARTICIPE WHERE ID_REUNION = ? AND ETAT = ?');
		$membres -> execute(array($num,'Participera'));
		$tuple = $membres -> fetchAll(PDO::FETCH_COLUMN, 0);/*tableau*/
		return $tuple;
	}
	
	
	public static function getListeAbsents($num){
		/*Retourne la liste des Id des membres décommandés de la réunion*/
		global $bdd;
		$membres = $bdd -> prepare('SELECT ID_PARTICIPANT FROM PARTICIPE WHERE ID_REUNION = ? AND ETAT = ?');
		$membres -> execute(array($num,'Décommandé'));
		$tuple = $membres -> fetchAll(PDO::FETCH_COLUMN, 0);/*tableau*/
		return $tuple;
	}
	

	
	
	public static function supprimerReunion($num){
		global $bdd;
		$suppression = $bdd -> prepare('DELETE FROM REUNION WHERE ID_REUNION = ?');
		$suppression -> execute(array($num));
	}
	
	
	public static function ajouterParticipant($numReunion, $idParticipant){
		global $bdd;
		$ajout = $bdd -> prepare('INSERT INTO PARTICIPE (ID_REUNION, ID_PARTICIPANT) VALUES (?, ?);');
		$ajout = $bdd -> execute(array($numReunion, $idParticipant));
		}
	
	
	
	public static function estChef($numReunion, $idParticipant){
		/*Retourne vrai si l'id donné est celui du propriétaire de la réunion, faux sinon*/
	global $bdd;
	$chef = $bdd -> prepare('SELECT ID_CHEF_REUNION FROM REUNION WHERE ID_REUNION = ?');
	$chef -> execute(array($numReunion));
	$tuple = $chef -> fetchAll()[0];
	
	return ($idParticipant == $tuple['ID_CHEF_REUNION']);
		}
		
		
	
	
	
	public function __construct ($num, $chef, $sujet, $listeParticipants, $listeAbsents, $plage, $statut, $salle, $compteRendu) {
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
	
	public static function envoyer_mail($destinataire, $sujet, $msg){
		$headers = 'From: "Agenda interne" \r\n';
		mail($destinataire,$sujet,$msg,$headers);
	}


	public static function mail_nouvelle_reunion($num,$id){
		$p = Utilisateur::getUserById($id);
		if ($p != null){
			$msg = 'Bonjour, ' . $p->getPrenom() .', la réunion '. $num .' a été créée.';	
			envoyer_mail($p->getMail(), "AGENDA: ajout d'une réunion", $msg );
		}
	}

	public static function mail_annulation_reunion($num, $id){
		$p = Utilisateur::getUserById($id);
		if ($p != null){
			$msg = 'Bonjour, ' . $p->getPrenom() .', la réunion '. $num .' a été annulée.';	
			envoyer_mail($p->getMail(), "AGENDA: suppression d'une réunion", $msg );
		}
	}
	
	public static function mail_signaler_absence($idParticipant, $numReunion){
		/*Envoie au chef de réunion "Machin s'est décommandé de la réunion Truc"*/
		$reunion = Reunion::getReunionByNum($numReunion);
		$chef = $reunion->getChefReunion();/*Récupère l'id*/
		$chef = Utilisateur::getUserById($chef);/*Récupère l'User du chef de réunion*/
		$user = Utilisateur::getUserById($idParticipant);/*et celui du décommandé*/
		$msg = 'Bonjour '.$chef->getPrenom().', le participant '.$user->getPrenom().' '.$user->getNom().'s\'est décommandé de la réunion "'
				.$reunion->getSujet().'", numéro '.$reunion->getNumReunion().'.';
		envoyer_mail($chef->getMail(), 'AGENDA : un participant s\'est décommandé', $msg);
		
	}
	
	public static function signalerAbsence($idParticipant, $numReunion){
		/*Action à la sortie de signaler_absence.php*/
		global $bdd;
		$reunion = Reunion::getReunionByNum($numReunion);
		$decommander = $bdd->prepare('UPDATE PARTICIPE SET ETAT = :ETAT WHERE ID_REUNION= :ID_REUNION AND ID_PARTICIPANT = :ID_PARTICIPANT');
		$decommander -> execute(array(
							'ID_REUNION' => $numreunion,
							'ETAT' => 'Décommandé',
							'ID_PARTICIPANT' => $idParticipant
		));
		Reunion::mail_signaler_absence($idParticipant, $numReunion);
	}
	
	public static function afficher_les_reunions($id){
		$tab = Reunion::getAllReunionWithUser($id);
		$res = '';
		
		foreach ($tab as $valeur) {
			$reunion = Reunion::getReunionByNum($valeur[0]);
			$res .= '<p><a href="./afficher_reunion.php?id=' . $reunion->getNumReunion() . '">'. $reunion->getSujet(). '</a></p>';
		}
		return $res;
	}
	
	public static function getAllReunionWithUser($num){ 
			
		global $bdd;
		// SELECT ID_REUNION FROM participe WHERE ID_PARTICIPANT=(SELECT ID_PARTICIPANT FROM participant WHERE NOM='LeChat')
		$u = $bdd -> prepare('SELECT ID_REUNION FROM participe WHERE ID_PARTICIPANT= ?;');
		$u -> execute(array($num));
		$tuple = $u -> fetchAll(PDO::FETCH_COLUMN, 0);/*tableau*/
		
		return $tuple; // ici on renvoie un array au controleur appellant
	}
	

}//end class

?>