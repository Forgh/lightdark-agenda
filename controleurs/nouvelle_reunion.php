<?php
	$listID=$_POST[""];
	$sal = $_POST[""];
	$jou = $_POST[""];
	$mom = $_POST[""];
	$num; //?
	$chef = Utilisateur::getParNom($_POST[""]); //retourne null si inexistant
	$sujet= $_POST[""];
	$statut=$_POST[""];
	
	
	

	if (Salle::estDispo($jou, $mom) and $cher != null){
		$reunion = new Reunion($num, $chef, $sujet, $listID, $moment, $statut, "");
		foreach($listID as $liste){
			$u = Utilisateur::getParID($liste);
			mail_nouvelle_reunion($u->getNom(), $u->getMail());
		}
		

	}else{
		//la salles n'est pas libre
	}
?>
