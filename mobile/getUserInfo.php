<?php
/*
* getUserInfo.php
* get information from user_id in param
*/
header('Content-Type: application/json');

include('../models/Db.php');

$db = new db();
//error_log(Date("Y/m/d H:m:s")." getUserInfo, id= ".$_GET['id'], 3, "erreursiphone2.log");

if(isset($_GET['id'])){
	echo json_encode($db->getMobileUser($_GET['id']));
}


?>