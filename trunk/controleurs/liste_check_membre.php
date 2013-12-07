<?php
	require('modeles/Equipe.php');
	require('modeles/Service.php');
	require('modeles/Utilisateur.php');
	
	$services = Service::getAllServices();
	$liste_all_membres= Utilisateur::getListeMembres();
?>

<div id="listes">
	<ul>
		<li><input type="checkbox" class="cat_check"><a>Tous les membres</a>
			<ul>
				<?php	
				Utilisateur::listerMembre($liste_all_membres);
				?>
			</ul>
		</li>
		<?php 
			foreach($services as $services_values){
				?>	<li><input type="checkbox" class="cat_check"><a><?php echo $services_values['NOM']; ?></a>
						<ul class="liste_equipes">
							<?php
								$equipes = Equipe::getEquipesFromService($services_values['ID_SERVICE']);
							 	foreach ($equipes as $equipes_values) { ?>
									 <li><input type="checkbox" class="cat_check"><a><?php echo $equipes_values['NOM']; ?></a>
									 		<ul class="liste_membres">
									 			<?php
									 				$membres = Equipe::getMembresEquipe($equipes_values['ID_EQUIPE']);
													foreach ($membres as $membres_values) { ?>
														<li><input type="checkbox" class="cat_check" name ="membres[]" value="<?php echo $membres_values['ID_PARTICIPANT']; ?>"><a><?php echo $membres_values['NOM'];?> <?php echo $membres_values['PRENOM']; ?></a></li>
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
</div>