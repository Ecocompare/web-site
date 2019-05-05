<?php
/*
* getProduct.php
* get information of the product_id param
*/


$adresseip=$_SERVER['REMOTE_ADDR'];
$http_user_agent=$_SERVER['HTTP_USER_AGENT'];


header('Content-Type: application/json');

function arrondir($valeur) {
	$entier=intval($valeur);
	$decimale=$valeur-$entier;
	if ($decimale>0.5) return round($entier+1,1);
	if ($decimale<0.5) return round($entier,1);
	if ($decimale==0.5) return round($valeur,1);
	
}

include('../models/Db.php');

$db = new db();

error_log(Date("Y/m/d H:m:s")." getProduct ".$_GET['id']."\n", 3, "/tmp/erreursiphone2.log");

if(isset($_GET['id'])){
	$db->logProductStat(intval($_GET['id']));
	echo json_encode($db->getProduct(intval($_GET['id'])));	
}


?>