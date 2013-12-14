<?php 
//connexion à la BD		
require_once('../include/connect.php');
	
class Salle{
	private $numeroSalle;
	private $nomSalle;
	
	//public abstract function estDispo(/*heure et jour/date*/);

	
	/***********  Getters  ***********/
	public function getNumeroSalle() {
	return $this->numeroSalle;
	}
	
	public function getNomSalle() { 
	return $this->nomSalle;
	}
	

	/***********  Fin Getters **********/
	
	public static function getSalleById($id){
		global $bdd;
		$req = $bdd->prepare('SELECT * FROM salle WHERE NUM_SALLE = ?;');
		$req -> execute(array($id));
		$tuple = $req -> fetchAll();
		$tuple = $tuple[0];
		

		return new Salle($tuple['NUM_SALLE'], $tuple['NOM_SALLE']);
		
	}
	
	public function __construct ($num, $nom){
		 $this->numeroSalle = $num;
		 $this->nomSalle = $nom;
	}
	
	public static function getListeSalleDispo($jour,$temps){
		global $bdd;
		$req = $bdd->prepare('	SELECT NOM_SALLE AS SALLE
								FROM SALLE 
								WHERE NOM_SALLE NOT IN (
										SELECT SALLE 
										FROM REUNION, MOMENT 
										WHERE REUNION.ID_DATE = MOMENT.ID_DATE 
										AND MOMENT.JOUR = ?
										AND MOMENT.TEMPS = ?)'
								);
		$req -> execute(array($jour,$temps));
		$salles = $req->fetchAll();
		return $salles;
	}
	
	public static function getListeSalle(){
		global $bdd;
		$req = $bdd->prepare('SELECT NUM_SALLE FROM salle;'
								);
		$req -> execute(array(null));
		$salles = $req->fetchAll();
		return $salles;
	}
	
}//end class

?>