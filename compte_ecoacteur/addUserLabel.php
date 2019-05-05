<?php	
header('Content-Type: application/json');

require_once('../models/Db.php');

$db = new Db();


if(isset($_GET['id'])&&isset($_GET['id_label'])&&isset($_GET['id_type'])){

	$params = array(
			  'id_ecoac' => $_GET['id'], 
			  'id_label' => $_GET['id_label'],
			  'id_type' => $_GET['id_type'],

			);
	$db->insertEcoacLabel($params);
	echo json_encode("true");

}
				
?>	