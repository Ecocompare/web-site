<?php

header("Access-Control-Allow-Origin: *");              // Tous les domaines
//header("Access-Control-Allow-Origin: monsite.com");
header("Access-Control-Allow-Headers: Content-Type, *");

header('Content-Type: application/json');

include('../models/Db.php');
$db = new db();

if(isset($_GET['id_pdt'])&&isset($_GET['code'])&&isset($_GET['chemin_client'])&&isset($_GET['domaine'])){

	$valide = $db->verificationBadge($_GET['domaine'],$_GET['code']);
$valide=True;

	if($valide){
		$params = array(
				  'id_pdt' => $_GET['id_pdt'], 
				  'code' => $_GET['code'],
				  'domaine' => $_GET['domaine'],
				  'chemin_page' => $_GET['chemin_client'],
				  'date_vue' => date("Y-m-d H:i:s"),
				);
		$db->insertVueBadge($params);
		
		echo json_encode("valide");	
	}else{
		echo json_encode("invalide");	
	}
}


?>

