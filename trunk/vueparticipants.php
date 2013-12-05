<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="./style.css" content="html/css">
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html"; charset="utf-8"> 
		<title> Produits </title>
	</head>

	<body>
		<div class="header">
		<?php include("header.php"); ?>
		</div>
		
		<div class="blank">
		</div>
		
		<div class="contenu">
			
            <h2>Produits</h2>
         
            <p>Les participants à la réunion sont :</p>
            <?php if(isset($tableau)) echo($tableau);?>
            
			
		</div>
		
		<div class="footer">
        
        <?php include("footer.php"); ?>
		</div>



	</body>
</html>
