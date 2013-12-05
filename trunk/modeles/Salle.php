<?php 
//connexion à la BD			
class Salle{
	private $numeroSalle;
	private $nomSalle;
	private $agendaSalle;//planning des disponibilites de la salle
	
	public static function estDispo(/*heure et jour/date*/);

	
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
	
	
}//end class

?>