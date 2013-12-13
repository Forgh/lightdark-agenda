
<?php  session_start(); 
 
 if(isset($_SESSION['id'])) {
		include('../modeles/Reunion.php');

		$liste = Reunion::afficher_les_reunions($_SESSION['id']);
		
		include('../vues/afficher_liste_reunions.php');
	}else{
		include('../vues/denied.php');
	}

?>

