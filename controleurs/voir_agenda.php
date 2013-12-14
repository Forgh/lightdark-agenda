<?php
	if(!isset($_SESSION['id'])) {
		session_start();
		include('../modeles/Reunion.php');
		
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
		echo 'Veuillez vous connecter';
	}
?>	