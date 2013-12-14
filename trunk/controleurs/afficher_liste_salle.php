<?php
	if(!isset($_SESSION['id'])) session_start();

	include('../modeles/Salle.php');
	$res = '<form method="post" action="../controleurs/afficher_reunion_future_salle.php">';
	$listSalle = Salle::getListeSalle();
	foreach($listSalle as $p){

		$s = Salle::getSalleById($p['NUM_SALLE']);
		$res .= '<p><input type="radio" name="salle" value="' . $s->getNomSalle() . '">'.$s->getNomSalle().'</p>';
	}
	$res .= '<input type="submit" value="Valider"></form>';
	
?>