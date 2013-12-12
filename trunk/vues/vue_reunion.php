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
            <td><?php if(isset($listePresents)) echo($listePresents); ?></td>
            <td><?php if(isset($listeAbsents)) echo($listeAbsents); ?></td>
            </tr>
            </table>
			
		</div>

	</body>
</html>
