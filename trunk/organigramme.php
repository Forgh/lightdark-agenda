<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="css/style.css" content="html/css">
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html"; charset="utf-8"> 
		<script type="text/javascript" src="scripts/jquery.js"></script>
		<link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css" >
		<script type="text/javascript" src="scripts/jquery-ui.min.js"></script>
		<script type="text/javascript" src="jstree/jquery.jstree.js"></script>	
		<script>
			$(document).ready(function()
			{
				$("#listes").jstree();
			});
		</script>
		<title> Accueil </title>
	</head>

	<body>
  
		<?php include("include/header.php"); ?>
		
		
		<div id="bodycentered">
			
            <h1>Organigramme</h1>
            
			<?php include('controleurs/seek_organigramme.php'); ?>
			
		</div>

	</body>
</html>
