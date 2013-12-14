<?php 
//connexion à la BD
require_once('../include/connect.php');

class Agenda{//un agenda affecté à une personne ou une salle
	private $listeJours;//un moyen de structurer des heures et des disponibilites
	
	
	//public abstract function estLibre(){}
	//public abstract function estPris(){}//Les deux sont-ils utiles ?
	//public abstract function afficher(){}//Afficher l'agenda --> rendu
	//public abstract function ajouterPlage(){}//ajout d'une plage d'occupation
	//public abstract function enleverPlage(){}
	
	/***********  Getters  ***********/
	
	
	public function getlisteJours() {
	return $this->listeJours;
	}
	
	//!?
	public function getlisteCours() {
	return $this->listeCours;
	}
	
	/***********  Fin Getters **********/
	
	public static function AjouteMomentSiNecessaire($date, $temps){
		//SELECT * FROM `moment` WHERE TEMPS='AM' AND JOUR='1970-01-03';
		//INSERT INTO `moment`(`TEMPS`, `JOUR` ) VALUES ('AM','2000-01-01')
		global $bdd;
		$moment = $bdd->prepare('SELECT ID_DATE FROM moment WHERE JOUR= :DATE AND TEMPS= :TEMPS;');
		$moment -> execute(array(
							'DATE' => $date,
							'TEMPS' => $temps
							));
							
		$tuple = $moment -> fetchAll(PDO::FETCH_COLUMN, 0);

		if (empty($tuple)){
			$moment = $bdd->prepare('INSERT INTO `moment`(`TEMPS`, `JOUR` ) VALUES (:TEMPS,:DATE)');
			$moment -> execute(array(
								'DATE' => $date,
								'TEMPS' => $temps
								));
			$tuple = $moment -> fetchAll(PDO::FETCH_COLUMN, 0);
			return Agenda::AjouteMomentSiNecessaire($date, $temps);
		}else{
			return $tuple[0];
		}
	}
	
	
}//end class

?>