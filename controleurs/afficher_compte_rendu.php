<?php
	require("modeles/Reunion.php");
							
	////////Récupération et affichage du texte actuel ///////////////////////////////////////////////
	$reunion = Reunion::getReunionById($_POST['reunion']);
	$affichage_texte = $reunion->getCompteRendu();
	echo $affichage_texte;
?>