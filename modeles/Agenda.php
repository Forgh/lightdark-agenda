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
	
	public static function estIndisponible ($date, $moment, $idPerso){
		$timestamp=strtotime($date);
		$date = date("Y-m-d",$timestamp);
		
		global $bdd;
		$req = $bdd->prepare('SELECT ID_DATE FROM  MOMENT WHERE JOUR = ? AND TEMPS = ?');
		$req->execute(array($date,$moment));
	
		while($idDate= $req->fetch()){
			$indispo = $bdd->prepare('SELECT * FROM EST_INDISPONIBLE WHERE ID_DATE = ? AND ID_PARTICIPANT = ?');
			$indispo->execute(array($idDate['ID_DATE'], $idPerso));
			
			if(!empty($indispo)) {
				return true;
			}
		}
		return false;
	}
}//end class

?>