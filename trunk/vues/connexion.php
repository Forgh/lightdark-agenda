<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="../css/style.css" content="html/css">
		<META charset="utf-8"> 
		<title> Afficher une réunion </title>
	</head>

	<body>
  
		<?php include("../include/header.php"); ?>
		
		
	<div id="bodycentered">
			
       	<h2>Connexion</h2>
           	
            <form method="POST" action="../controleurs/connecter.php" enctype="multipart/form-data">
				<p>
					<label for="login">Identifiant :</label>
					<input type="text" id="login" name="login" required />
				</p>
				<p>
					<label for="mdp">Mot de passe :</label>
					<input type="password" id="mdp" name="mdp" required />
				</p>
				<p>
					<input type="submit" value="Se connecter"/>
				</p>
				
			</form>
            <?php if(isset($errConnexion)) echo('<div class="erreur">'.$errConnexion.'</div>'); ?>
		</div>

	</body>
</html>
