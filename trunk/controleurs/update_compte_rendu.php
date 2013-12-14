<?php
	////////////////////////////////Update du texte/////////////////////////////

	if (isset($_POST['compte_rendu'])) 
	{ 			
		require('../modeles/Reunion.php');
		$reunion = Reunion::getReunionByNum($_POST['reunion']);
		$reunion->setCompteRendu($_POST['compte_rendu']);
		Reunion::update($reunion);
		
		header("Location: ../controleurs/afficher_reunion.php?id=".$_POST['reunion']);
	}
?>	