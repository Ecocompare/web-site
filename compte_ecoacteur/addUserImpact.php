<?php	
header('Content-Type: application/json');

require_once('../models/Db.php');

$db = new Db();


if(isset($_GET['id'])&&isset($_GET['id_impact'])){

	$params = array(
			  'id_ecoac' => $_GET['id'], 
			  'id_impact' => $_GET['id_impact'],
			);
	$db->insertEcoacImpact($params);
	echo json_encode("true");

}
				
?>	