<?php

	/*@param GET id : le numéro de la réunion*/
	
	session_start();
	///////////////////////////////////
	$_SESSION['id'] = '2'; /*[DEBUG]*/
	$_GET['id'] = '1'; /*[DEBUG]*////
	////////////////////////////////
	require('../modeles/Utilisateur.php');
	require('../modeles/Reunion.php');
	
	if(isset($_GET['action']) && isset($_GET['id']) && isset($_SESSION['id']))
		switch ($_GET['action']){
				case 'cancel':
					Reunion::setAbsent($_SESSION['id'], $_GET['id']);
					break;
				
				case 'validate':
					Reunion::setPresent($_SESSION['id'], $_GET['id']);
					break;
					
				case 'addRapport':
					/*[TODO]Insérer ici le truc a faire*/
					break;
		}
	
	
	if(isset($_GET['id']))
		$numReunion = $_GET['id'];
	else
		header("Location: ../vues/denied.php");
	
	
	$reunion = Reunion::getReunionByNum($numReunion);
	if ($reunion==NULL)
		header('Location: ../vues/denied.php');
		
	
	$sujet = $reunion->getSujet();
	
	$absents = Reunion::getListeAbsents($numReunion);
	
	
	$presents = Reunion::getListePresents($numReunion);
	
	
	$rapport = $reunion->getCompteRendu();
	if(!isset($rapport) || empty($rapport))
		$rapport = '<em>Aucun compte-rendu n\'a été déposé</em>';
		
	$statut = Utilisateur::getParticipation($_GET['id'], $numReunion);
	
	
	if(!$reunion->estPassee()){
	$annuler = '<form method="get" action="afficher_reunion.php">
				<input type="hidden" name="action" value="cancel">
				<input type="hidden" name="id" value="'.$numReunion.'">
				<input type="submit" value="Décommander">
				</form>';
				
	$confirmer = 	'<form method="get" action="afficher_reunion.php">
					<input type="hidden" name="action" value="validate">
					<input type="hidden" name="id" value="'.$numReunion.'">
					<input type="submit" value="Confirmer">
					</form>';
					
	}
	else{
		$confirmer = NULL;
		$annuler = NULL;
	}
		
					
	$ajouter=	'<form method="get" action="afficher_reunion.php">
				<input type="hidden" name="action" value="addRapport">
				<input type="hidden" name="id" value="'.$numReunion.'">
				<input type="submit" value="Ajouter un rapport">
				</form>';
		
		/*Si connecté, pas de rapport déclaré et est le chef de la réunion alors dépot de rapport possible*/		
	if(isset($_SESSION['id']) && ($rapport =='<em>Aucun compte-rendu n\'a été déposé</em>') && Reunion::estChef($numReunion, $_SESSION['id']))
		$addRapport = $ajouter;
					
	
	
	switch ($statut){
		case 'En attente':
			$etat = 'Veuillez confirmer votre présence ou votre absence à cette réunion.';
			$cancel = $annuler;
			$validate = $confirmer;
			break;
			
		case 'Participera':
			$etat = 'Vous avez confirmé votre présence à cette réunion.';
			$cancel = $annuler;
			break;
		
		case 'Décommandé':
			$etat = 'Vous vous êtes décommandé(e) de cette réunion.';
			$validate = $confirmer;
			break;
			
		case "Vous n'êtes pas convié(e) à cette réunion.":
			$etat ="Vous n'êtes pas convié(e) à cette réunion.";/*Vous êtes pas invité*/
			
			break;
	}//end switch
	
	
	
	

	include('../vues/vue_reunion.php');
?>