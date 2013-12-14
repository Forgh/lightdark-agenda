<?php
	require("../modeles/Reunion.php");
							
	////////Récupération et affichage du texte actuel ///////////////////////////////////////////////
	$reunion = Reunion::getReunionByNum($_POST['reunion']);
	$affichage_texte = $reunion->getCompteRendu();
	
	include('../vues/compte_rendu.php');
?>