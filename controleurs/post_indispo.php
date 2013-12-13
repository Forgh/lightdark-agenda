<?php
if(!isset($_SESSION['id'])) session_start();
	include('../include/connect.php');
	
	
	if (isset($_POST['AM'])){
	
		foreach($_POST['AM'] as $value){
			$new_moment=$bdd->prepare('INSERT INTO MOMENT (JOUR, TEMPS) VALUES (FROM_UNIXTIME(:JOUR),:TEMPS)');
			$new_moment->execute(array('JOUR'=>$value,
										'TEMPS'=>'AM'));
										
			$moment = $bdd->query('SELECT LAST_INSERT_ID() FROM MOMENT');
			$id_moment = $moment->fetch();
			$moment->closeCursor();
			$new_indispo = $bdd->prepare('INSERT INTO EST_INDISPONIBLE(ID_PARTICIPANT,ID_DATE) VALUES(:ID_PARTICIPANT, :ID_DATE)');
			$new_indispo -> execute(array(
										'ID_PARTICIPANT' => $_SESSION['id'],
										'ID_DATE' => $id_moment[0]));
			
			
		}
	}
	
	if(isset($_POST['PM'])){
		foreach($_POST['PM'] as $value){
			$new_moment=$bdd->prepare('INSERT INTO MOMENT (JOUR, TEMPS) VALUES (FROM_UNIXTIME(:JOUR),:TEMPS)');
			$new_moment->execute(array('JOUR'=>$value,
										'TEMPS'=>'PM'));
										
			$moment = $bdd->query('SELECT LAST_INSERT_ID() FROM MOMENT');
			$id_moment = $moment->fetch();
			$moment->closeCursor();

			$new_indispo = $bdd->prepare('INSERT INTO EST_INDISPONIBLE(ID_PARTICIPANT,ID_DATE) VALUES(:ID_PARTICIPANT, :ID_DATE)');
			$new_indispo -> execute(array(
										'ID_PARTICIPANT' => $_SESSION['id'],
										'ID_DATE' => $id_moment[0]));
			
		}
	}
	
	include('../vues/vue_post_indispo.php');
?>