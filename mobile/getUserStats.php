<?php

/*
* getUserStats.php
* Get the stats for the user_id
*/

header('Content-Type: application/json');

include('../models/Db.php');

$db = new db();

if(isset($_GET['id'])){
	echo json_encode($db->getStatUser($_GET['id']));
}

?>