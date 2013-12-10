<?php
	require('../modeles/Equipe.php');
	require('../modeles/Service.php');
	require('../modeles/Utilisateur.php');
	require('../modeles/Reunion.php');
	
	
	if(isset($_GET['numReunion']))
		$numReunion = $_GET['numReunion'];
	else header('Location : denied.php');/*[TODO] Implémenter denied : "Accès non autorisé ou 404"*/
	
	$reunion = Reunion::getReunionByNum($numReunion);
	$sujet = $reunion->getSujet();
	
	$absents = Reunion::getListeAbsents($numReunion);
	$listeAbsents = Utilisateur::afficherListeMembres($absents);
	
	$presents = Reunion::getListePresents($numReunion);
	$listePresents = Utilisateur::afficherListeMembres($presents);
	
	if(isset($reunion->getCompteRendu()) && !empty($reunion->getCompteRendu()))
		$rapport = $reunion->getCompteRendu();
	



?>