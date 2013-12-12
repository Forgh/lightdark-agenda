<?php session_start(); 
include('controleurs/afficher_liste_reunion.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/style.css" >
		<script type="text/javascript" src="tinymce/tinymce.min.js"></script>
		
		
		<title> Agenda - Liste des réunions</title>
	</head>
	
	<body>
		<?php include("include/header.php"); ?>
		<div id="bodycentered" >
			<h1>Editer un compte-rendu</h1>

			<?php //on a déjà l'id de l'utilisateur
				//afficher_les_reunions($id);
			?>
			
		</div>
		
	</body>
</html>
