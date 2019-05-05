<?php
header('Content-Type: application/json');
include_once('../models/Db.php');

$db = new db();

if(isset($_GET['id'])&&isset($_GET['nompreference'])&&isset($_GET['souhait'])){
	
	$params = array(
		$_GET['nompreference'] => $_GET['souhait'],
  	);
	
	$db->updateEcoacSuivreNewsletter($params, $_GET['id']);
	
	echo json_encode(true);
}


?> 