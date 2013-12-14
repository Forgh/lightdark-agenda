<?php if(!isset($_SESSION['id'])) session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="../css/style.css" >
		<script type="text/javascript" src="../tinymce/tinymce.min.js"></script>
        <script type="text/javascript" src="../scripts/jquery.js"></script>
		<link rel="stylesheet" href="../css/jquery-ui.min.css" type="text/css" >
		<script type="text/javascript" src="../scripts/jquery-ui.min.js"></script>
		<script type="text/javascript" src="../scripts/checking.js"></script>
		<script type="text/javascript" src="../jstree/jquery.jstree.js"></script>	
		<script>
			$(document).ready(function()
			{
				$("#listes").jstree();
			});
		</script>
        
		<title>Créer une réunion</title>
	</head>
	
	<body>
		<?php include("../include/header.php"); ?>
		<div id="bodycentered" >
			
		<h2>Création de réunion</h2>
    	        
        <?php 	if(isset($contenu)) 
					echo($contenu);
				var_dump($_POST);
		
				?>

			
	</div>

</body>
</html>