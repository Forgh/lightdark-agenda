<?php 

include('../include/connect.php');

class UtilisateurLien{ // classe statique

	// @renvoie toutes les réunions auquel $num doit participer et qui sont pas passée
	// @params $num: id de l'utilisateur
	
	public static function getAllReunionWithUser($num){ 
			
		global $bdd;
		// SELECT ID_REUNION FROM participe WHERE ID_PARTICIPANT=(SELECT ID_PARTICIPANT FROM participant WHERE NOM='LeChat')
		$u = $bdd -> prepare('SELECT ID_REUNION FROM participe WHERE ID_PARTICIPANT=?;');
		$u-> execute(array($num));
		$tuple = $u -> fetchAll();/*tableau*/
		
		return $tuple; // ici on renvoie un array au controleur appellant
	}
	
	
}

?>

