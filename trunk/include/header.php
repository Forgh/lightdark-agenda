<div id="header">
<div id="connexion">
<div id="logo">
<a  href="index.php"><img src="images/logo.png" alt="Logo Agenda"/></a>
</div>

<!--[MODULE DE CONNEXION]-->
<module_connexion>
	<fieldset>
    	<legend>Mon compte</legend>

			<?php
				if(isset($_SESSION['prenom'])){/*[TODO] A adapter si besoin aux variables du site agenda*/
					echo('<div class="center">Bonjour '.$_SESSION['prenom'].' &nbsp;!</div>');
					echo('<a href="espaceperso.php">Espace personnel</a> | ');
					echo('<a href="logout.php">Se déconnecter</a>');
				}
				else 
					echo('<a href="connecter.php">Se connecter</a>');
			?>
	</fieldset>
</module_connexion>
<!--[FIN MODULE DE CONNEXION]-->

<div id="barre_navigation">
<!--Les whitespace permettent de coller les boutons les uns à la suite des autres-->
<div class="boutonbegin"><a href="index.php">Accueil</a></div><!-- whitespace
--><div class="bouton"><a href="ctrlproduits.php">Mes disponibilités</a></div><!-- whitespace
--><div class="boutonend"><a href="contact.php">Voir l'organigramme</a></div><!-- whitespace
--></div><!--Fin barrenav-->

</div><!--Fin header-->
