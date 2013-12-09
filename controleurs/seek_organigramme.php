<?php
	require('modeles/Equipe.php');
	require('modeles/Service.php');
	require('modeles/Utilisateur.php');
	
	$services = Service::getAllServices();
	$liste_all_membres= Utilisateur::getListeMembres();
?>

<div id="listes">
	<ul>
		<li><a>Directeur</a>
			<ul>
				<li><a>M. Dupont André</a></li>
			</ul>
		</li>
		<li><a>Services</a>
			<ul>
				<?php 
					foreach($services as $services_values){
						?>	<li><a><?php echo $services_values['NOM']; ?></a>
								<ul class="liste_equipes">
									<?php
										$equipes = Equipe::getEquipesFromService($services_values['ID_SERVICE']);
										foreach ($equipes as $equipes_values) { ?>
											 <li><a><?php echo $equipes_values['NOM']; ?></a>
													<ul class="liste_membres">
														<?php
															$membres = Equipe::getMembresEquipe($equipes_values['ID_EQUIPE']);
															foreach ($membres as $membres_values) { ?>
																<li><a><?php echo $membres_values['NOM'];?> <?php echo $membres_values['PRENOM']; ?></a></li>
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
		</li>
	</ul>
</div>