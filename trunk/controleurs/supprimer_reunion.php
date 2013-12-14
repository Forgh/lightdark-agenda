<?php
	//include('modeles/mail.php');
	include('../modeles/Reunion.php');
	include('../modeles/Utilisateur.php');
	
	$num = $_GET["num"]; //ici le chef a entre les infos permettant d'avoir accès à la réunion

	$reunion = Reunion::getReunionByNum($num);	
	if ($reunion != null){
		$participants = Reunion::getListeParticipants($num); // je suppose que c'est un array d'id d'utilisateur
		foreach($participants as $p){

			$u = Utilisateur::getUserById($p);
			Reunion::mail_annulation_reunion($u->getNumReunion() ,$u->getEmail());
		}
		
		//$reunion::supprimer($reunion); // cette fonction n'existe pas dans modeles/Reunion.php (elle est vide)

	}else{
		//erreur reunion inexistante

	}

?>
