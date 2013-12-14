<?php
/*Demander au prof gestion du temps*/
require_once('../include/connect.php');
 
//connexion à la BD
class Plage{//une plage horaire
	private $type;//AM || PM
	private $date;//le XX/Y/ZZZZ
	
	//public abstract function getHeureDebut(){}
	//public abstract function getType(){}//le type --> Matin/Aprèm
	
	
	/***********  Getters  ***********/
	public function getType() { //attention à la MAJ
	return $this->type;
	}
	
	public function getDatePlage() { 
	return $this->date;
	}
	/***********  Fin Getters **********/
	
	 public static function estDisponible($id, $date, $plage){

		global $bdd;
		//SELECT ID_PARTICIPANT FROM participant WHERE ID_PARTICIPANT NOT IN (SELECT ID_PARTICIPANT FROM est_indisponible WHERE ID_PARTICIPANT='2' AND ID_DATE IN (SELECT ID_DATE FROM moment WHERE JOUR='1970-01-01' AND TEMPS='AM'));
		//$r = $bdd -> prepare('SELECT ID_PARTICIPANT FROM PARTICIPE, REUNION, MOMENT WHERE MOMENT.`JOUR`= :date AND MOMENT.`TEMPS`=:plage AND PARTICIPE.`ID_PARTICIPANT`= :participant AND PARTICIPE.`ETAT`!= :etat  AND MOMENT.ID_DATE = REUNION.ID_DATE AND REUNION.ID_REUNION = PARTICIPE.ID_REUNION;)'
		$r = $bdd ->  prepare('SELECT ID_PARTICIPANT FROM participant WHERE ID_PARTICIPANT= :participant AND ID_PARTICIPANT NOT IN (SELECT ID_PARTICIPANT FROM est_indisponible WHERE ID_DATE IN (SELECT ID_DATE FROM moment WHERE JOUR= :date AND TEMPS= :plage));'
				);
				$r -> execute(array(
						'date' => $date,
						'plage' => $plage,
				'participant' => $id,         
					));
			$tuple = $r -> fetchAll();
			
			if (empty($tuple)){return false;}
			else return true;
	}

}//end class

?>