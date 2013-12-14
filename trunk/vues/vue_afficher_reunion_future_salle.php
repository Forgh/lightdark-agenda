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
			
            <h2>Reunions futures pour la salle <?php echo $_POST['salle'] ?></h2>
			
			<?php echo $str; ?>
		</div>
	</body>
</html>