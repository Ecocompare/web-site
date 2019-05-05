<?php	
header('Content-Type: application/json');

require_once('../models/Db.php');

$db = new Db();


if(isset($_GET['id'])&&isset($_GET['id_marque'])){

	$params = array(
			  'id_ecoac' => $_GET['id'], 
			  'id_brand' => $_GET['id_marque'],
			);
	$db->insertEcoacCompanie($params);
	echo json_encode("true");

}
				
?>	