<?php 
//connexion à la BD
class Utilisateur{
	private $id;
	private $nom;
	private $prenom;
	private $statut;//chef d'équipe ?
	private $mail;//unique
	private $agenda;
	
	public static function estDispo();/*Redondant avec celui de Agenda ?*/
	public static function login();
	public static function getListeReunions();//liste des réunions prévues pour lui
	public static function creerReunion();
	public static function AnnulerReunion();
	public static function signalerAbsence();
	
	public static function ajouterRapport();//rapport/compte-rendu de réunion, géré par un BLOB-like ou ajouter classe "Rapport"
	/*Redondant avec controleur séparé ?*/
	
	
	/***********  Getters  ***********/
	public function getNom() { //attention à la MAJ
	return $this->nom;
	}
	
	public function getId() { //attention à la MAJ
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
	
	public function getAllUsers(){/*renvoie tous les utilisateurs de la table*/
			
		global $bdd;
		$membres = $bdd -> query('SELECT * FROM PARTICIPANT');
		$tuple = $membres -> fetchAll();/*tableau*/
		
		return $tuple;
	}
	
	public function listerMembre($liste){
		echo '<ul class="liste_membres">';
		
		foreach($liste as $value){
			echo'<li class="membre"><input type="checkbox" name="'.$value['ID_MEMBRE'].'">'.$value['NOM_MEMBRE'].'</li>';
		}
		
		echo '</ul>';
	}

	public function getListeMembres(){/*Retourne la liste des Id des membres de la table*/
		global $bdd;
		$membres = $bdd -> query('SELECT NOM FROM PARTICIPANT');
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
	
	public function getUserById($id){
		global $bdd;
		$u = $bdd -> prepare('SELECT * FROM PARTICIPANT WHERE ID = ?');
		$u = $bdd -> execute(array($id));
		$u = $u -> fetchAll();
		return new Utilisateur($u['ID_PARTICIPANT'], $u['NOM'], $u['PRENOM'], $u['MAIL'], NULL, NULL);
	}


}//end class


?>