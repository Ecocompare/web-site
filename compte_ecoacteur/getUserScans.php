<?php

header('Content-Type: application/json');

include('../models/Db.php');

$db = new db();

if(isset($_GET['id'])){
	echo json_encode($db->getUserScans2($_GET['id']));

	
}

?>