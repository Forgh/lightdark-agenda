<?php
	require('../modeles/Salle.php');
	$radio_salles = '<ul id="liste_salle">';
	
	if((isset($_POST['plage'])) && (!isset($_POST['salle']))){ 
		$newdate=date("Y-m-d",strtotime($_POST['date']));
		$listes_salles = Salle::getListeSalleDispo($newdate,$_POST['plage']);
	
		foreach ($listes_salles as $value) {
			$radio_salles .= '<li><input type="radio" name="salle" value="'.$value['SALLE'].'">'.$value['SALLE'].'</li>';
		}
	}
	$radio_salles .= '</ul>';
?>