<?php
session_start();
/*	Je Pars du principe que l'user, identifié, arrive sur cette page après avoir séléctionné une réunion
	On va donc, en se servant de la table participe, gérer les infos depuis le modèle
	
	@param $_GET['numreunion']//le numero de la reunion à traiter
	[OPT]@param $_SESSION['id'] // l'identifiant de l'utilisateur courant
*/

include ('../modeles/Reunion.php'); //connait le modèle de Réunion et ses méthodes

if(!isset($_GET['num']))
	header("Location : ../vues/denied.php");
else $reunion = Reunion::getReunionByNum($_GET['num']);



if( Reunion::countParticipants()!==0)//on vérifie que la réunion existe ( au moins un mec dedan : le créateur)
	$tableau = Reunion::tableauparticipants();//Si elle existe, lister les participants
else
	$tableau = "Il n'y a actuellement aucun participant à cette réunion";

include ("vuelisteparticipants.php");//et afficher le résultat

?>
