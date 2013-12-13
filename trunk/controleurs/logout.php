<?php /*Cette page déconnecte proprement l'utilisateur et l'envoie à l'accueil*/
session_start(); //lire la session
$_SESSION = array(); //byebye les données session
session_destroy();
include("../vues/accueil.php");
?>