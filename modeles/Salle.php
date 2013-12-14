<?php 
//connexion à la BD		
require_once('../include/connect.php');
	
class Salle{
	private $numeroSalle;
	private $nomSalle;
	private $agendaSalle;//planning des disponibilites de la salle
	
	//public abstract function estDispo(/*heure et jour/date*/);

	
	/***********  Getters  ***********/
	public function getNumeroSalle() {
	return $this->numeroSalle;
	}
	
	public function getNomSalle() { 
	return $this->nomSalle;
	}
	
	public function getAgendaSalle() { 
	return $this->agendaSalle;
	}
	/***********  Fin Getters **********/
	
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
	
}//end class

?>