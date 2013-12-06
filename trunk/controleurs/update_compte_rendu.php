<?php
	////////////////////////////////Update du texte/////////////////////////////

	if (isset($_POST['compte_rendu'])) 
	{ 			
		require('../modeles/Reunion.php');
		$reunion = Reunion::getReunionById($_POST['reunion']);
		$reunion->setCompteRendu($_POST['compte_rendu']);
		$reunion->update();
		
		header('Location : http://projets-lightdark.fr/agenda/index.php');
	}
?>	