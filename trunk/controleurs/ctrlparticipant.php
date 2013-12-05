<?php
session_start(); /*Je Part du principe que l'user, identifié, arrive sur cette page après avoir séléctionné une réunion
On va donc, en se servant de la table participe,  
*/
include ('participe.php'); //connait le modèle


if( participe::countverifexiste()!==0)//on vérifie que la réunion existe ( au moins un mec dedant : le créateur)
	$tableau = produit::tableauparticipants();//Si elle existe, lister les participants
else
	$tableau = "Il n'y a actuellement aucun participant à cette réunion";

include ("vuelisteparticipants.php");//et afficher le résultat

?>
