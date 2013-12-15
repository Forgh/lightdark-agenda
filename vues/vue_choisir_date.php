<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="../css/style.css" content="html/css">
		<meta charset="utf-8"> 
		<title> Gérer ses disponibilités </title>
	</head>

	<body>
  
		<?php include("../include/header.php"); ?>
		
		
		<div id="bodycentered">
			
            <h2>Veuillez choisir un jour de départ</h2>
            
			<form action="organiser_dispo.php" method="post" enctype="multipart/form-data">
				<input type="date" name="date">
				<input type="submit" value="Valider">
			</form>

			
		</div>

	</body>
</html>
