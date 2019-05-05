<?php	
header('Content-Type: application/json');

require_once('../models/Db.php');

$db = new Db();


if(isset($_GET['id'])&&isset($_GET['idcriteria'])){

	$db->deleteEcoacSubratings($_GET['id'], $_GET['idcriteria']);
	echo json_encode("true");

}
				
?>	