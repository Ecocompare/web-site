<?php	
header('Content-Type: application/json');

require_once('../models/Db.php');

$db = new Db();

	

if(isset($_GET['id'])&&isset($_GET['pourcentsocietal'])&&isset($_GET['pourcentsanitaire'])&&isset($_GET['pourcentenvironnement'])){

	$params = array(
			  'pourcent_societal' => $_GET['pourcentsocietal'],
			  'pourcent_sanitaire' => $_GET['pourcentsanitaire'],
			  'pourcent_environnemental' => $_GET['pourcentenvironnement'],
			);
	$db->updateUserPriority($_GET['id'], $params);
	echo json_encode("true");

}
				
?>	
