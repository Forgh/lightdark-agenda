<?php
	require('../modeles/UtilisateurLien.php');
	require('../modeles/Reunion.php');
							
	////////Récupération et affichage du texte actuel ///////////////////////////////////////////////
	
	
	function afficher_les_reunions($id){
		$tab = UtilisateurLien::getAllReunionWithUser($id);
		foreach ($tab as $valeur) {
			$reunion = Reunion::getReunionByNum($valeur);
			echo '<a href="../voir_reunion.php?id=' . $reunion->getNumReunion() . '">', $reunion->getSujet(), '</a>';
		}
	}
?>