<?php
	$services = Service::getAllServices();
	$liste_all_membres= Utilisateur::getListeMembres();
	$print_all_membres = Utilisateur::listerMembre($liste_all_membres);
	$checklist = '<div id="listes">
	<ul>
		<li><input type="checkbox" class="cat_check"><a>Tous les membres</a>
			<ul>'.$print_all_membres.'</ul>
		</li>';
		
			foreach($services as $services_values){
			$checklist.='<li><input type="checkbox" class="cat_check"><a>'.$services_values['NOM'].'</a>
				<ul class="liste_equipes">';
				$equipes = Equipe::getEquipesFromService($services_values['ID_SERVICE']);
			 	foreach ($equipes as $equipes_values) { 
				$checklist.=' <li><input type="checkbox" class="cat_check"><a>'.$equipes_values['NOM'].'</a>
					 		<ul class="liste_membres">';
	 			$membres = Equipe::getMembresEquipe($equipes_values['ID_EQUIPE']);
				foreach ($membres as $membres_values) { 
				$checklist.='<li><input type="checkbox" class="cat_check" name ="membres[]" value="'.$membres_values['ID_PARTICIPANT'].'"><a>'.$membres_values['NOM'].' '.$membres_values['PRENOM'].'</a></li>';
												}
									 			
									 		$checklist.='</ul>	
									 </li>';
								 }
							
						$checklist.='</ul>
					</li>';
}
	$checklist.='</ul>
</div>';

?>