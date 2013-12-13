<?php
if(!isset($_SESSION['id'])) session_start();

if(!isset($_POST['etape']))
	header('Location: denied.php');
else
	$etape = $_POST['etape'];//{date, salle, membres, final}

if(isset($_POST['date']))
	$date = $_POST['date'];
 
if(isset($_POST['salle']))
	$salle = $_POST['salle'];
 
if(isset($_POST['membres']))
	$membres = $_POST['membres'];




$formDate = '	<form enctype="multipart/form-data" method="post" action="../controleurs/nouvelle_reunion.php">
				<fieldset>
				<legend>Selection de la date</legend>
				<label for="date">Date :</label>
				<input required="required" type="date" name="date" placeholder="JJ/MM/AAAA">
				<input type="hidden" name="etape" value="salle">
				</fieldset>
				<input type="submit" value="Suivant">
				</form>';
				
$formSalle = '	<form enctype="multipart/form-data" method="post" action="../controleurs/nouvelle_reunion.php">
				<fieldset>
				<legend>Selection de la salle</legend>
				Insérer ici la liste des salles
				<input type="hidden" name="etape" value="membres">
				</fieldset>
				<input type="submit" value="Suivant">
				</form>';
				
$formMembres = '<form enctype="multipart/form-data" method="post" action="../controleurs/nouvelle_reunion.php">
				<fieldset>
				<legend>Selection des membres</legend>'.
				include("../vues/liste_check_membre.php").'
				<input type="hidden" name="etape" value="final">
				</fieldset>
				<input type="submit" value="Suivant">
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
		include('../controleurs/liste_reunion.php');
		break;
	
}











/*
	$listID=$_POST[""];
	$sal = $_POST[""];
	$jou = $_POST[""];
	$mom = $_POST[""];
	$num; //?
	$chef = Utilisateur::getParNom($_POST[""]); //retourne null si inexistant
	$sujet= $_POST[""];
	$statut=$_POST[""];
	
	
	

	if (Salle::estDispo($jou, $mom) and $chef != null){
		$reunion = new Reunion($num, $chef, $sujet, $listID, $moment, $statut, "");
		foreach($listID as $liste){
			$u = Utilisateur::getUserById($liste);
			mail_nouvelle_reunion($u->getNom(), $u->getMail());
		}
		

	}else{
		//la salles n'est pas libre
	}
	
	*/
	
	
	
	
?>
