<?php

/*
* setUserPassword.php
* Set the new user password in database
*/

header('Content-Type: application/json');

include('../models/Db.php');

$db = new db();

if(isset($_GET['id'])&&isset($_GET['pwd'])){

	$params = array(
		'pwd' => sha1($_GET['pwd']),
  	);
	
	$db->updateMobileUser($_GET['id'],$params);
	
	echo json_encode(true);
}
else{
	echo json_encode(false);
}
?>