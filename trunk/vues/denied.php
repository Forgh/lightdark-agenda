<?php if(!isset($_SESSION['id'])) session_start(); ?>

<!DOCTYPE html>
<html>
<head>
		<link rel="stylesheet" href="../css/style.css" content="html/css">
		<META charset="utf-8"> 
		<title>Acces impossible</title>
	</head>

<body>
  
<?php include("../include/header.php"); header("HTTP/1.0 404 Not Found"); ?>
		
		
		<div id="bodycentered">
			
            <h2>Accès impossible</h2>
            
<p>La ressource à laquelle vous avez tenté d'accéder n'existe pas !</p>

			
		</div>

</body>
</html>
