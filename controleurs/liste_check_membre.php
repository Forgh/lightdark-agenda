<?php
	require('../modeles/Equipe.php');
	require('../modeles/Service.php');
	require('../modeles/Utilisateur.php');
	
	$services = Service::getAllServices();
	$liste_all_membres= Utilisateur::getListeMembres();
	$print_liste_all_membres = Utilisateur::listerMembre($liste_all_membres);
	$res = '<div id="listes">
	<ul>
		<li><input type="checkbox" class="cat_check"><a>Tous les membres</a>
			<ul>'.$print_liste_all_membres.'</ul>
		</li>';

			foreach($services as $services_values){
				$res.='<li><input type="checkbox" class="cat_check"><a>'.$services_values['NOM'].'</a>
						<ul class="liste_equipes">';
				
			$equipes = Equipe::getEquipesFromService($services_values['ID_SERVICE']);
							 	foreach ($equipes as $equipes_values) {
									$res.= '<li><input type="checkbox" class="cat_check"><a>'.$equipes_values['NOM'].'</a>
									 		<ul class="liste_membres">';
									 			
									 				$membres = Equipe::getMembresEquipe($equipes_values['ID_EQUIPE']);
													foreach ($membres as $membres_values) { 
														$res.='<li><input type="checkbox" class="cat_check" name ="membres[]" value="'.$membres_values['ID_PARTICIPANT'].'"><a>'.$membres_values['NOM'].' '.$membres_values['PRENOM'].'</a></li>';
												 }
									 		$res.='</ul>	
									 </li>';
								  }
						$res.='</ul>
					</li>';
		} 	
	$res.='</ul>
</div>';

var_dump($res);