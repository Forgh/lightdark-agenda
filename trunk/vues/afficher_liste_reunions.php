<?php if(!isset($_SESSION['id'])) session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="../css/style.css" >
		<script type="text/javascript" src="tinymce/tinymce.min.js"></script>
		
		
		<title> Agenda - Liste des réunions</title>
	</head>
	
	<body>
		<?php include("../include/header.php"); ?>
		<div id="bodycentered" >
			<h2>Mes réunions</h2>

			<?php //on a déjà l'id de l'utilisateur
				if(isset($liste)) echo $liste;
				else echo('<em>Vous n\'avez pas de réunions de prévues</em>');
			?>
            
            <form method="post" enctype="multipart/form-data" action="../controleurs/nouvelle_reunion.php">
            <input type="hidden" name="etape" value="date">
            <input type="submit" value="Créer une réunion">
            
            </form>
			
		</div>
		
	</body>
</html>
