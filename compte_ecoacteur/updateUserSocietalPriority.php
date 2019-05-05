<?php	
header('Content-Type: application/json');

require_once('../models/Db.php');

$db = new Db();

	

if(isset($_GET['id'])&&isset($_GET['pourcentsocial'])&&isset($_GET['pourcentethique'])&&isset($_GET['pourcentfartradenn'])&&isset($_GET['pourcentfartradens'])&&isset($_GET['pourcentqualite'])){

	$params = array(
			  'pourcent_social' => $_GET['pourcentsocial'],
			  'pourcent_ethique' => $_GET['pourcentethique'],
			  'pourcent_fairtrade_n_s' => $_GET['pourcentfartradens'],
			  'pourcent_fairtrade_n_n' => $_GET['pourcentfartradenn'],
			  'pourcent_qualite' => $_GET['pourcentqualite'],
			);
	$db->updateUserSocietalPriority($_GET['id'], $params);
	echo json_encode("true");

}
				
?>	
