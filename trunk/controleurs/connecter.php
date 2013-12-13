<?php 
session_start();

require_once('../modeles/Utilisateur.php');

if(empty($_POST))
	include('../vues/connexion.php');
elseif(!isset($_POST['login']) || !isset($_POST['mdp'])){
	$errConnexion = 'Veuillez renseigner un identifiant et un mot de passe correctes';
	include('../vues/connexion.php');
}
elseif(!Utilisateur::correctPassword($_POST['login'], $_POST['mdp'])){
	$errConnexion = 'Le mot de passe ou l\'identifiant est incorrect';
	include('../vues/connexion.php');
}
else{
	$user = Utilisateur::getUserById($_POST['login']);
	$_SESSION['prenom'] = $user -> getPrenom();
	$_SESSION['nom'] = $user -> getNom();
	$_SESSION['id'] = $_POST['login'];	
	include('../vues/accueil.php');
	
}
?>