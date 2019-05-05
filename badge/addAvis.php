<?php
header("Access-Control-Allow-Origin: *");              // Tous les domaines
//header("Access-Control-Allow-Origin: monsite.com");
header("Access-Control-Allow-Headers: Content-Type, *");

header('Content-Type: application/json');

include('../models/Db.php');
$db = new db();

if(isset($_GET['id'])){
	$db->insertAvisBadge($_GET['id'], $_GET['avis'], $_GET['numquestion']);	
}

?>