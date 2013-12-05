<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/style.css" >
		<title> Agenda </title>
	</head>
	
	<body>
		<?php include("include/header.php"); ?>
		<div id="bodycentered" >
		<h1>Bienvenue sur votre Agenda</h1>
		<?php include("controleurs/agenda.php"); ?>		
			
			
		</div>
				
	</body>
</html>

