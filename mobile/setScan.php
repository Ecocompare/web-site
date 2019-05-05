<?php

/*
* setScan.php
* Set a new scan in iphone_query
* If ean match with a product : product_id is stored
* If the ean is not in iphone_eans_desc : a new row is created with hit=0
* If ean is in iphone_eans_desc : hit++
*/

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

include('../models/Db.php');

$db = new db();
error_log(Date("Y/m/d H:m:s")." set scan \n", 3, "checkuser.log");

if(isset($_GET['ean'])){

	$ean = $_GET['ean'];
	error_log(Date("Y/m/d H:m:s")." set scan, ean=$ean \n", 3, "checkuser.log");

	$query = "SELECT * FROM products where INSTR(EAN, '$ean')>0;";

  	$results = mysql_query($query);

  	$product_id = null;
	//Si EAN est dans la table product, on recupere l'id du produit
	if($product = mysql_fetch_assoc($results)){	
	  $product_id = $product['id'];
	}
	
	$params = array(
		'iphone_id' => null,
		'product_id' => $product_id,
		'user_id' => $_GET['id'], 
		'ean' => $_GET['ean'],
		'longitude' => $_GET['longitude'],
		'latitude' => $_GET['latitude'],
		'altitude' => $_GET['altitude'],
		'date' => date("Y-m-d H:i:s"),
		'useragent' => $_SERVER['HTTP_USER_AGENT'],
  	);
	
	
	//error_log(Date("Y/m/d H:m:s")." setScan, userid=".$params['user_id']."\n", 3, "/tmp/erreursiphone2.log");
	error_log(Date("Y/m/d H:m:s")." avant insert ".var_export($params)." \n", 3, "checkuser.log");
	//Insert into iphone_query
	$db->createMobileUserScan($params);
	error_log(Date("Y/m/d H:m:s")." apres insert ".var_export($params)." \n", 3, "checkuser.log");

	//check if exist in iphone_eans_desc
 	$query = "SELECT * FROM `iphone_eans_desc` WHERE ean like '$ean'";
  	mysql_query($query);
    $results = mysql_query($query);

	//New row : hit=0
    if (!$product = mysql_fetch_assoc($results)) {
      	$query2="insert into iphone_eans_desc (ean,date_request,hit) values ('".$ean."',now(),0)";
      	mysql_query($query2);
    }
    else{ 	
	//Update hit : ++
 		$query2="UPDATE iphone_eans_desc  SET hit=hit+1 where ean like '".$ean."'";
    	mysql_query($query2);
    }
  	
	echo json_encode($params);
}
?>