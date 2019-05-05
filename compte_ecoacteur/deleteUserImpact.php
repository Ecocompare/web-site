<?php	
header('Content-Type: application/json');

require_once('../models/Db.php');

$db = new Db();


if(isset($_GET['id'])&&isset($_GET['id_impact'])){


	$db->deleteEcoacImpact($_GET['id'],$_GET['id_impact']);
	echo json_encode("true");

}
				
?>	