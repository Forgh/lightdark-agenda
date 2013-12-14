<?php
	session_start();
	if(isset($_SESSION['id'])){
		require('../modeles/Equipe.php');
		require('../modeles/Service.php');
		require('../modeles/Utilisateur.php');
		require('../controleurs/liste_check_membre.php');//fournit $checklist



	if(!isset($_POST['etape']))
		var_dump($_POST);
		//header('Location: denied.php');
	else
		$etape = $_POST['etape'];//{date, salle, membres, final}

	if(isset($_POST['date']))
		$date = $_POST['date'];
		
	if(isset($_POST['date']))
		$plage = $_POST['plage'];
	 
	if(isset($_POST['salle']))
		$salle = $_POST['salle'];
	 
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
					</fieldset>
					<input type="submit" value="Suivant">
					</form>';
					
	$formMembres = '<form enctype="multipart/form-data" method="post" action="../controleurs/nouvelle_reunion.php">
					<fieldset>
					<legend>Selection des membres</legend>
					'.$checklist.'
					<input type="hidden" name="etape" value="final">
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
			header('Location: ../controleurs/liste_reunion.php');
			//foreach $_POST['membres']
			break;
		
	}
		
		
		
}else{
	include('../vues/denied.php');
}
?>
