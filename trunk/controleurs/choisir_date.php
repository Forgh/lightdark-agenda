<?php session_start();
if(isset($_SESSION['id'])){	
	include('../vues/vue_choisir_date.php');
}
else{
	include('../vues/denied.php');
}
?>