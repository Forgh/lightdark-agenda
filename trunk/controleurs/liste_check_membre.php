<?php
	require('modeles/Equipe.php');
	require('modeles/Service.php');
	require('modeles/Utilisateur.php');
	
	$services = Service::getAllServices();
	$liste_all_membres= Utilisateur::getListeMembres();
	
	Utilisateur::listerMembre($liste_all_membres);
	
?>

	<ul id="liste_services">
		<?php 
			foreach($services as $services_values){
				?>	<li><input type="checkbox" class="service"><?php echo $services_values['NOM']; ?> 
						<ul class="liste_equipes">
							<?php
								$equipes = Equipe::getEquipesFromService($services_values['ID_SERVICE']);
							 	foreach ($equipes as $equipes_values) { ?>
									 <li><input type="checkbox" class="equipe"><?php echo $equipes_values['NOM']; ?> 
									 		<ul class="liste_membres">
									 			<?php
									 				$membres = Equipe::getMembresEquipe($equipes_values['ID_EQUIPE']);
													foreach ($membres as $membres_values) { ?>
														<li><input type="checkbox" class="membre" name="<?php echo $membres_values['ID_PARTICIPANT']; ?>"><?php echo $membres_values['NOM'];?> <?php echo $membres_values['PRENOM']; ?></li>
												<?php	}
									 			?>
									 		</ul>	
									 </li>
								 <?php }
							?>
						</ul>
					</li>
		<?php	} ?>	
	</ul>
