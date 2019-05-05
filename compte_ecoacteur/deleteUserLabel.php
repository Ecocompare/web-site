<?php	
header('Content-Type: application/json');

require_once('../models/Db.php');

$db = new Db();


if(isset($_GET['id'])&&isset($_GET['id_label'])&&isset($_GET['id_type'])){

	$db->deleteEcoacLabel($_GET['id'], $_GET['id_type'],$_GET['id_label']);
	echo json_encode("true");

}
				
?>	