<?php
 session_start();
 
include('../modeles/Reunion.php');

	$liste = Reunion::afficher_les_reunions('1');
	
	include('../vues/afficher_liste_reunions.php');
?>

