<?php if(!isset($_SESSION['id'])) session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/style.css" >
        <script type="text/javascript" src="tinymce/tinymce.min.js"></script>
        
        
        <title> Agenda - Liste des Salles</title>
    </head>
    
    <body>
        <?php include("../include/header.php"); ?>
        <div id="bodycentered" >
            <h1>Les salles</h1>


            <?php include("../controleurs/afficher_liste_salle.php");
            ?>
         
            
        </div>
        
    </body>
</html>