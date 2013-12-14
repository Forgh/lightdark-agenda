<?php
	if(!isset($_SESSION['id']))session_start();
	require('../modeles/Reunion.php');
	$salle=$_POST['salle'];
	
	$liste_reunions=Reunion::getReunionFromToday($salle);
	$str='<ul>';
	foreach($liste_reunions as $value) {
		$newdate=date("d-m-Y",strtotime($value['JOUR']));
		if($value['TEMPS']=='AM'){
			$str.='<li><a href="afficher_reunion.php?id='.$value['ID_REUNION'].'">Réunion "'.$value['SUJET'].'" </a>le '.$newdate.' au matin </li>';
		}
		else {
			$str.='<li><a href="afficher_reunion.php?id='.$value['ID_REUNION'].'">Réunion "'.$value['SUJET'].'" </a>le '.$newdate.' en après-midi </li>';
		}
	}
	
	$str.='</ul>';
	
	include('../vues/vue_afficher_reunion_future_salle.php');
	
?>