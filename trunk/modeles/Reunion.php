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
	
	
	/********** Fin Setters ***************/
	
	public static function ajouter_reunion($sujet, $salle, $createur, $idDate){
		
		global $bdd;
		$new = $bdd -> prepare ('INSERT INTO REUNION (ID_CHEF_REUNION, ID_DATE, SUJET, SALLE) VALUES (:chef, :Date, :sujet, :salle)');
		$new -> execute(array(
			'chef' => $createur,
			'Date' => $idDate,
			'sujet' => $sujet,
			'salle' => $salle
		));
		
		$id = $bdd ->prepare('SELECT * FROM REUNION WHERE SALLE = ? AND ID_DATE = ? ');
		$id -> execute(array($salle, $idDate));
		$tuple = $id -> fetchAll();
		
		$tuple = $tuple[0]['ID_REUNION'];
		return $tuple;
	}
	
	public static function getReunionByNum($num){
		global $bdd;
		$req = $bdd -> prepare('SELECT * FROM REUNION WHERE ID_REUNION = ?;');
		$req -> execute(array($num));
		
		$tuple = $req -> fetchAll();
		$tuple = $tuple[0];/*retourne un tableau (une case) du tableau de valeurs -_-'*/
		
		return new Reunion($tuple['ID_REUNION'], $tuple['ID_CHEF_REUNION'], $tuple['SUJET'], NULL, NULL, $tuple['ID_DATE'], NULL, $tuple['SALLE'], $tuple['compte_rendu']);
	}
	
	
	public static function update($new) {
		
		 
		global $bdd;
		$nouveau_membre = $bdd -> prepare('UPDATE REUNION SET ID_CHEF_REUNION = :ID_CHEF_REUNION, ID_DATE=:ID_DATE, SUJET=:SUJET, SALLE=:SALLE, compte_rendu=:compte_rendu WHERE ID_REUNION= :id_reunion');
		$nouveau_membre -> execute(array(
							'ID_CHEF_REUNION' => $new->getChefReunion(),
							'ID_DATE' => $new->getPlage(),
							'SUJET' => $new->getSujet(),
							'SALLE' => $new->getSalle(),
							'compte_rendu' => $new->getCompteRendu(),
							'id_reunion' => $new->getNumReunion()
		));
	}
	
	public static function getListeParticipants($num){
		/*Retourne la liste des Id des membres participant à la réunion, décommandés ou pas*/
		global $bdd;
		$membres = $bdd -> prepare('SELECT ID_PARTICIPANT FROM participe WHERE ID_REUNION = ?');
		$membres->execute(array($num));
		$tuple = $membres -> fetchAll(PDO::FETCH_COLUMN, 0);/*tableau*/
		
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
	
	
	public static function supprimerReunion($num){
		global $bdd;
		$suppression = $bdd -> prepare('DELETE FROM REUNION WHERE ID_REUNION = ?');
		$suppression -> execute(array($num));
	}
	
	
	public static function ajouterParticipant($numReunion, $idParticipant){
		global $bdd;
		$ajout = $bdd -> prepare('INSERT INTO PARTICIPE (ID_REUNION, ID_PARTICIPANT) VALUES (?, ?);');
		$ajout -> execute(array($numReunion, $idParticipant));
		}
	
	public static function retirerParticipant($numReunion, $idParticipant){
		/*utile si on considère qu'un décommandé est marqué comme tel mais toujours présent dans PARTICIPE ?*/
		global $bdd;
		$suppression = $bdd -> prepare('DELETE FROM PARTICIPE WHERE ID_PARTICIPANT = ? AND ID_REUNION = ?');
		$suppression -> execute(array($numReunion, $idParticipant));
		}
	
	public static function estChef($numReunion, $idParticipant){
		/*Retourne vrai si l'id donné est celui du propriétaire de la réunion, faux sinon*/
	global $bdd;
	$chef = $bdd -> prepare('SELECT ID_CHEF_REUNION FROM REUNION WHERE ID_REUNION = ?');
	$chef -> execute(array($numReunion));
	$tuple = $chef -> fetchAll();
	$tuple = $tuple[0];
	
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
		$expediteur = "postmaster@projets-lightdark.fr";
		$headers = "From: " . $expediteur . "\r\n" .
					"Reply-To: " . $expediteur . "\r\n" .
					"X-Mailer: PHP/" . phpversion();
		//mail($destinataire,$sujet,$msg,$headers);
		echo $msg, '<br>';
	}


	public static function mail_nouvelle_reunion($num,$id){
		$p = Utilisateur::getUserById($id);
		if ($p != null){
			$msg = 'Bonjour, ' . $p->getPrenom() .', la réunion '. $num .' a été créée.';	
			Reunion::envoyer_mail($p->getMail(), "AGENDA: ajout d'une réunion", $msg );
		}
	}

	public static function mail_annulation_reunion($num, $id){
		$p = Utilisateur::getUserById($id);
		if ($p != null){
			$msg = 'Bonjour, ' . $p->getPrenom() .', la réunion '. $num .' a été annulée.';	
			Reunion::envoyer_mail($p->getMail(), "AGENDA: suppression d'une réunion", $msg );
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
		Reunion::envoyer_mail($chef->getMail(), 'AGENDA : un participant s\'est décommandé', $msg);
		
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
		
		// equivalent de SELECT ID_REUNION FROM participe WHERE ID_PARTICIPANT= '2' UNION SELECT ID_REUNION FROM reunion WHERE ID_CHEF_REUNION= '2';

		
		foreach ($tab as $valeur) {
			$reunion = Reunion::getReunionByNum($valeur[0]);
			$res .= '<p><a href="./afficher_reunion.php?id=' . $reunion->getNumReunion() . '">'. $reunion->getSujet(). '</a></p>';
		}
		
		$tab = Reunion::getAllReunionCreatedByUser($id);
		
		$res .= '<h1>Réunion dont vous êtes chef : </h1>';
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
	
	public static function getAllReunionCreatedByUser($num){ 
			
		global $bdd;
		// SELECT ID_REUNION FROM participe WHERE ID_PARTICIPANT=(SELECT ID_PARTICIPANT FROM participant WHERE NOM='LeChat')
		$u = $bdd -> prepare('SELECT ID_REUNION FROM reunion WHERE ID_CHEF_REUNION= ?;');
		$u -> execute(array($num));
		$tuple = $u -> fetchAll(PDO::FETCH_COLUMN, 0);/*tableau*/
		
		return $tuple; // ici on renvoie un array au controleur appellant
	}
	
	public static function getReunionFromToday($salle){
		global $bdd;
		$req=$bdd->prepare('SELECT REUNION.SUJET AS SUJET, MOMENT.JOUR AS JOUR, MOMENT.TEMPS AS TEMPS, REUNION.ID_REUNION AS ID_REUNION
							FROM REUNION, MOMENT
							WHERE REUNION.ID_DATE = MOMENT.ID_DATE
							AND REUNION.SALLE = ?
							AND MOMENT.JOUR >= CURRENT_DATE()
							ORDER BY MOMENT.JOUR');
		$req->execute(array($salle));
		
		$tuples = $req->fetchAll();
		
		return $tuples;
	}
	
	public static function trouverReunion($id, $date, $plage){
		global $bdd;
		$newdate=date("Y-m-d",strtotime($date));
		$r = $bdd -> prepare('SELECT * FROM REUNION, PARTICIPE, MOMENT WHERE MOMENT.JOUR = :date AND MOMENT.TEMPS=:plage AND PARTICIPE.ID_PARTICIPANT= :participant AND MOMENT.ID_DATE = REUNION.ID_DATE AND REUNION.ID_REUNION = PARTICIPE.ID_REUNION' );
        $r -> execute(array(
							'date' => $newdate,
							'plage' => $plage,
							'participant' => $id
						));
		if($r->rowCount()>0){
			$tuple = $r -> fetchAll();
			$tuple = $tuple[0];/*retourne un tableau (une case) du tableau de valeurs -_-'*/
			return new Reunion($tuple['ID_REUNION'], $tuple['ID_CHEF_REUNION'], $tuple['SUJET'], NULL, NULL, $plage,$tuple['SALLE'], NULL, $tuple['compte_rendu']);
		}
		else {
			return null;
		}
	}

}//end class

?>