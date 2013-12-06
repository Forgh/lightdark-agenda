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


}//end class


?>