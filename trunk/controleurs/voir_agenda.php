<?php session_start();
	if(isset($_SESSION['id'])) {
		
		include('../modeles/Reunion.php');
		include('../modeles/Utilisateur.php');
		$today = date("d-m-Y");

		for ($i=0;$i<7;$i++) {
			$jours[$i] = $today;
								
			$timestamp = strtotime($today);
			$timestamp = strtotime('+1 day', $timestamp);
			$today = date("d-m-Y", $timestamp);
		}
		
		foreach($jours as $key=>$value){
			$matin[$key]= Reunion::trouverReunion($_SESSION['id'],$value,'AM');
			$apresmidi[$key] = Reunion::trouverReunion($_SESSION['id'],$value,'PM');
		}
		
		include('../vues/vue_voir_agenda.php');
	}
	else{
		header('Location: ../vues/denied.php');
	}
?>	