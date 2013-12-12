<?php

//[TODO] : virer les reuire inutiles
	require('../modeles/Equipe.php');
	require('../modeles/Service.php');
	require('../modeles/Utilisateur.php');
	require('../modeles/Reunion.php');
	
	
	if(isset($_GET['numReunion']))
		$numReunion = $_GET['numReunion'];
	else header('Location: ../vues/denied.php');/*[TODO] Implémenter denied : "Accès non autorisé ou 404"*/
	
	$reunion = Reunion::getReunionByNum($numReunion);
	if ($reunion==NULL)
		header('Location: ../vues/denied.php');
		
	
	$sujet = $reunion->getSujet();
	
	$absents = Reunion::getListeAbsents($numReunion);
	$listeAbsents = Utilisateur::afficherListeMembres($absents);
	
	$presents = Reunion::getListePresents($numReunion);
	$listePresents = Utilisateur::afficherListeMembres($presents);
	
	
	$rapport = $reunion->getCompteRendu();
	if(!isset($rapport) || empty($rapport))
		$rapport = '<em>Aucun compte-rendu n\'a été déposé</em> ';
	
	/*A ce stade, on dispose de $rapport, $listePresents, $listeAbsents, $sujet*/

	include('../vues/vue_reunion.php');
?>