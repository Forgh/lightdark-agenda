<?php if(!isset($_SESSION['id'])) session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="../css/style.css" content="html/css">
		<meta charset="utf-8"> 
		<title> Accueil </title>
	</head>

	<body>
  
		<?php include("../include/header.php"); ?>
		
		
		<div id="bodycentered">
			
            <h2>Accueil</h2>
<?php 
	if(isset($_SESSION['prenom'])) echo('<p> Bienvenue sur votre agenda, '.$_SESSION['prenom'].' ! </p>');
	else echo('<p> Veuillez utiliser le menu ci-dessus pour accéder à votre panel de gestion de réunions, au planning des salles, votre propre planning et autres...</p>');
?>

			
		</div>

	</body>
</html>
