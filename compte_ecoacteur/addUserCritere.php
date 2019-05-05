<?php	
header('Content-Type: application/json');

require_once('../models/Db.php');

$db = new Db();


if(isset($_GET['id'])&&isset($_GET['idcriteria'])){

	$params = array(
			  'id_user' => $_GET['id'], 
			  'id_criteria' => $_GET['idcriteria'],
			);
	$db->insertEcoacSubratings($params);
	echo json_encode("true");

}
				
?>	