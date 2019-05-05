<?php

/*
* getUserScans.php
* get the 15 last scans for the user_id
*/

header('Content-Type: application/json');

include('../models/Db.php');

$db = new db();

if(isset($_GET['id'])){
	echo json_encode($db->getUserScans($_GET['id']));
}

?>