<?php 
//connexion à la BD
include('../include/connect.php');

class Utilisateur{
	private $id;
	private $nom;
	private $prenom;
	private $statut;//chef d'équipe ?
	private $mail;//unique
	private $agenda;
	
	//public abstract function estDispo();/*Redondant avec celui de Agenda ?*/
	//public abstract function login();
	//public abstract function getListeReunions();//liste des réunions prévues pour lui
	//public abstract function creerReunion();
	//public abstract function AnnulerReunion();
	//public abstract function signalerAbsence();
	
	//public abstract function ajouterRapport();//rapport/compte-rendu de réunion, géré par un BLOB-like ou ajouter classe "Rapport"
	/*Redondant avec controleur séparé ?*/
	
	
	/***********  Getters  ***********/
	public function getNom() { 
	return $this->nom;
	}
	
	public function getId() {
	return $this->id;
	}
	
	public function getPrenom() { 
	return $this->prenom;
	}
	
	public function getStatut() { 
	return $this->statut;
	}
	
	public function getMail() { 
	return $this->mail;
	}
	
	public function getAgenga() { 
	return $this->agenda;
	}
	/***********  Fin Getters **********/
	
	public static function getAllUsers(){/*renvoie tous les utilisateurs de la table*/
			
		global $bdd;
		$membres = $bdd -> query('SELECT * FROM PARTICIPANT');
		$tuple = $membres -> fetchAll();/*tableau*/
		
		return $tuple;
	}
	
	public static function listerMembre($liste){
		echo '<ul class="liste_all_membres">';
		foreach($liste as $value){
			echo'<li><input type="checkbox" class="cat_check" name ="membres[]" value="'.$value['ID_PARTICIPANT'].'"><a> '.$value['PRENOM'].' '.$value['NOM'].'</a></li>';
		}
		echo '</ul>';
	}
	
	public static function afficherListeMembres($liste){/*affiche en liste les membres de la list*/
			echo '<ul class="liste_all_membres">';
			foreach($liste as $value){
				echo ('<li>'.$value['PRENOM'].' '.$value['NOM'].'</li>');
			}
			echo '</ul>';
	}
	
	

	public static function getListeMembres(){/*Retourne la liste des Id, prénoms et noms des membres de la table*/
		global $bdd;
		$membres = $bdd -> query('SELECT ID_PARTICIPANT, NOM, PRENOM FROM PARTICIPANT');
		$tuple = $membres -> fetchAll();/*tableau*/
		return $tuple;
	}	
	
		public function __construct ($id, $nom, $prenom, $mail, $statut, $agenda){
		$this ->id = $id;
		$this ->nom = $nom;
		$this ->prenom = $prenom;
		$this ->mail = $mail;
		$this ->statut = $statut;
		$this ->agenda = $agenda;
		
	}
	
	public static function getUserById($id){
		global $bdd;
		$u = $bdd -> prepare('SELECT * FROM PARTICIPANT WHERE ID_PARTICIPANT = ?');
		$u = $bdd -> execute(array($id));
		$u = $u -> fetchAll();
		return new Utilisateur($u['ID_PARTICIPANT'], $u['NOM'], $u['PRENOM'], $u['MAIL'], NULL, NULL);
	}


}//end class


?>