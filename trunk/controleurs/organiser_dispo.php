<?php session_start();
if(isset($_SESSION['id'])) {
	include('../vues/vue_organiser_dispo.php');
}
else{
	include('../vues/denied.php');
}
?>