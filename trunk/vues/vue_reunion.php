<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="../css/style.css" content="html/css">
		<META charset="utf-8"> 
		<title> Afficher une réunion </title>
	</head>

	<body>
  
		<?php include("../include/header.php"); header("HTTP/1.0 404 Not Found"); ?>
		
		
		<div id="bodycentered">
			
            <h2>Récapitulatif de réunion</h2>
            
            <fieldset>
            <legend>Compte-rendu</legend>
            <?php 	if(isset($rapport))
						echo($rapport); ?>
            
            </fieldset>
             
            
            <table>
            
            <th>Participants</th><th>Décommandés</th>
            <tr>
            <td><?php if(isset($presents)) Utilisateur::afficherListeMembres($presents); ?></td>
            <td><?php if(isset($absents)) Utilisateur::afficherListeMembres($absents); ?></td>
            </tr>
            </table>
            
            <fieldset>
            <legend>Mon statut</legend>
            <?php
			if(isset($etat)) echo('<p>'.$etat.'</p>');
			if(isset($addRapport)) echo($addRapport);
			if(isset($cancel)) echo($cancel);
			if(isset($validate)) echo($validate);
			?>
            </fieldset>
			
		</div>

	</body>
</html>
