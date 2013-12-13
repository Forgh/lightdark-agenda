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
			
            		<h2>Connexion</h2>
            		<form method="post" action="../controleurs/connecter.php">
				<p>
					<label for="login">Login :</label>
					<input type="text" id="login" required >
				</p>
				<p>
					<label for="mdp">Mot de passe :</label>
					<input type="password" id="mdp" required >
				</p>
				<p>
					<input type="submit" value="loguer">
				</p>
				<?php if(isset($errConnexion)) echo "erreur"; ?>
			</form>
		</div>

	</body>
</html>
