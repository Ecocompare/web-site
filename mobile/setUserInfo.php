<?php

/*
* setUserInfo.php
* update the user info in database
*/

header('Content-Type: application/json');

include('../models/Db.php');

$db = new db();

if(isset($_GET['id'])&&isset($_GET['name'])/*&&isset($_GET['parrain'])*/&&isset($_GET['gender'])&&isset($_GET['tel'])&&isset($_GET['birthyear'])&&isset($_GET['postalcode'])&&isset($_GET['ville'])&&isset($_GET['address'])&&isset($_GET['job'])&&isset($_GET['child'])){
	
	$params = array(
		      'name' => urldecode($_GET['name']),
		      //'parrain' => $_GET['parrain'],
		      'gender' => $_GET['gender'],
		      'tel' => urldecode($_GET['tel']),
		      'birthyear' => urldecode($_GET['birthyear']),
		      'ville' => urldecode($_GET['ville']),
		      'postalcode' => urldecode($_GET['postalcode']),
		      'address' => urldecode($_GET['address']),
		      'job' => urldecode($_GET['job']),
		      'nb_child' => $_GET['child'],
  	);
	
	$db->updateMobileUser($_GET['id'], $params);
	
	echo json_encode(true);
}
else{
	echo json_encode(false);
}


?>