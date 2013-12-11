<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="css/style.css" content="html/css">
		<META charset="utf-8"> 
		<script type="text/javascript" src="scripts/jquery.js"></script>
		<link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css" >
		<script type="text/javascript" src="scripts/jquery-ui.min.js"></script>
		<script type="text/javascript" src="jstree/jquery.jstree.js"></script>	
		
		<title> Suppression d'une réunion </title>
	</head>

	<body>
  
		<?php include("include/header.php"); ?>
		
		
		<div id="bodycentered">
			
            <h1>Suppression d'une réunion</h1>
            
			<form id="suppr" name="suppr" method="post" action="controleurs/suprimer_reunion.php">
				<label for="num"> ID de la réunion </label>
				<input type="text" name="num"/>
				
				<input type="submit" name="envoyer" id="envoyer" value="Supprimer" /> 
			</form>
			
		</div>

	</body>
</html>
