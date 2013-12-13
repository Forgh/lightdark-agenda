<div id="header">
<div id="connexion">
<div id="logo">
<a  href="../index.php"><img src="../images/logo.png" alt="Logo Agenda"/></a>
</div>

<!--[MODULE DE CONNEXION]-->
<module_connexion>
	<fieldset>
    	<legend>Mon compte</legend>

			<?php
				if(isset($_SESSION['prenom'])){
					echo('<div class="center">Bonjour '.$_SESSION['prenom'].' &nbsp;!</div>');
					//echo('<a href="espaceperso.php">Espace personnel</a> | ');
					echo('<a href="../controleurs/logout.php">Se déconnecter</a>');
				}
				else 
					echo('<a href="../controleurs/connecter.php">Se connecter</a>');
			?>
	</fieldset>
</module_connexion>
<!--[FIN MODULE DE CONNEXION]-->
</div>
<div align="center" id="barre_navigation">
<!--Les whitespace permettent de coller les boutons les uns à la suite des autres-->
<div class="boutonbegin"><a href="../vues/accueil.php">Accueil</a></div><!-- whitespace
--><div class="bouton"><a href="../controleurs/organiser_dispo.php">Mes disponibilités</a></div><!-- whitespace
--><div class="bouton"><a href="../controleurs/liste_reunion.php">Mes réunions</a></div><!-- whitespace
--><div class="boutonend"><a href="../vues/organigramme.php">Voir l'organigramme</a></div><!-- whitespace
--></div><!--Fin barrenav-->

</div><!--Fin header-->
