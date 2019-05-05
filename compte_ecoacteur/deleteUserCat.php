<?php	
header('Content-Type: application/json');

require_once('../models/Db.php');

$db = new Db();


if(isset($_GET['id'])&&isset($_GET['id_categorie'])&&isset($_GET['id_parent'])){


	$db->deleteEcoacCategorie($_GET['id'],$_GET['id_categorie'],$_GET['id_parent']);
	echo json_encode("true");

}
				
?>	