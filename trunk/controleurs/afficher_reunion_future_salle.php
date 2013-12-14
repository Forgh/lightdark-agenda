<?php
	require('../modeles/Reunion.php');
	$nom_salle=$_POST['salle'];
	
	$liste_reunions=Reunion::getReunionFromToday($salle);
	$str='<ul>';
	foreach($liste_reunions as $value) {
		$newdate=date("d-m-Y",strtotime($value['JOUR']));
		if($value['TEMPS']=='AM'){
			$str.='<li> Réunion "'.$value['SUJET'].'" le '.$newdate.' au matin </li>';
		}
		else {
			$str.='<li> Réunion "'.$value['SUJET'].'" le '.$newdate.' en après-midi </li>';
		}
	}
	
	$str.='</ul>';
	
	include('../vues/vue_afficher_reunion_future_salle.php');
?>