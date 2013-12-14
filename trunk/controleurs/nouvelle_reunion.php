<?php
	if(!isset($_SESSION['id'])) session_start();
	
 	require('../modeles/Equipe.php');
	require('../modeles/Service.php');
	require('../modeles/Utilisateur.php');
	require('../modeles/Reunion.php');
	require('../controleurs/liste_check_membre.php');//fournit $checklist
	require('../modeles/Agenda.php');



if(!isset($_POST['etape'])){
	header('Location: denied.php');
}
else
	$etape = $_POST['etape'];//{date, salle, membres, final}

if(isset($_POST['date']))
	$date = $_POST['date'];
else $date = '';
	
if(isset($_POST['plage']))
	$plage = $_POST['plage'];
else $plage = '';
 
if(isset($_POST['salle']))
	$salle = $_POST['salle'];
else $salle = '';

if(isset($_POST['sujet']))
	$sujet = $_POST['sujet'];
else $sujet = '';
 
if(isset($_POST['membres']))
	$membres = $_POST['membres'];




$formDate = '	<form enctype="multipart/form-data" method="post" action="../controleurs/nouvelle_reunion.php">
				<fieldset>
				<legend>Selection de la date</legend>
				<label for="date">Date :</label>
				<input required="required" type="date" name="date" placeholder="JJ/MM/AAAA"> </br>
				<input type="radio" name="plage" value="AM" checked="checked"> Matin </br>
				<input type="radio" name="plage" value="PM"> Après-midi
				<input type="hidden" name="etape" value="salle">
				</fieldset>
				<input type="submit" value="Suivant">
				</form>';
				
				
				
$formSalle = '	<form enctype="multipart/form-data" method="post" action="../controleurs/nouvelle_reunion.php">
				<fieldset>
				<legend>Selection de la salle</legend>
				Insérer ici la liste des salles
				<input type="hidden" name="etape" value="membres">
				<input type="hidden" name="date" value="'.$date.'">
				<input type="hidden" name="plage" value="'.$plage.'">
				</fieldset>
				<input type="submit" value="Suivant">
				</form>';
				
$formMembres = '<form enctype="multipart/form-data" method="post" action="../controleurs/nouvelle_reunion.php">
				<fieldset>
				<legend>Selection des membres</legend>
				'.$checklist.'
				<input type="hidden" name="etape" value="final">
				<input type="hidden" name="date" value="'.$date.'">
				<input type="hidden" name="plage" value="'.$plage.'">
				</fieldset>
				<fieldset>
				<legend>Sujet</legend>
				<label for="sujet">Sujet de la réunion :</label>
				<input type="text" id="sujet" required="required" name="sujet">
				</fieldset>
				<input type="submit" value="Créer la réunion">
				</form>';




switch ($etape){
	

	case 'date':
		$contenu = $formDate;
		include('../vues/creation_reunion.php');
		break;
	
	case 'salle':
		$contenu = $formSalle;
		include('../vues/creation_reunion.php');
		break;
		
	case 'membres':
		$contenu = $formMembres;
		include('../vues/creation_reunion.php');
		break;
		
	case 'final':
		/*instruction d'entrée dans la base*/
		
		list($day, $month, $year) = explode('/', $date);
  		$timestamp = mktime(0, 0, 0, $month, $day, $year);
  		
		$date = date("Y-m-d", $timestamp);//conversion pour SQL
		
		$idDate = Agenda::AjouteMomentSiNecessaire($date, $plage);
		$salle = 'LaOne';//patch moche
		$idReunion = Reunion::ajouter_reunion($sujet, $salle, $_SESSION['id'], $idDate);
		foreach ($membres as $value) {
			Reunion::ajouterParticipant($idReunion,$value);
			}
		header('Location: ../controleurs/liste_reunion.php');
		
		break;
	
}
	
	
	
	
?>
