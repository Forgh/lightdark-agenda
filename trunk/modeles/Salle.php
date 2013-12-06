<?php 
//connexion à la BD		
include('include/connect.php');
	
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
	
	
}//end class

?>