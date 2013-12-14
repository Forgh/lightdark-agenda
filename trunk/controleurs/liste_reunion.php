
<?php 
if(!isset($_SESSION['id'])) session_start();
 
include('../modeles/Reunion.php');

	$liste = Reunion::afficher_les_reunions($_SESSION['id']);
	
	include('../vues/afficher_liste_reunions.php');
?>

