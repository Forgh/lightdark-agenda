<?php
	
	$res .= '<form method="post" action="../controleurs/afficher_future_salle.php">';
	$listSalle = Salle::getListeSalle();
	foreach($listSalle as $p){
		$res .= '<p><input type="radio" name="salle" value="' . $p->getNomSalle() . '">';
	}
	$res .= '<input type="submit" value="Valider"></form>';
?>