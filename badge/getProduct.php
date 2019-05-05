<?php
header("Access-Control-Allow-Origin: *");              // Tous les domaines
//header("Access-Control-Allow-Origin: monsite.com");
header("Access-Control-Allow-Headers: Content-Type, *");

header('Content-Type: application/json');

function arrondir($valeur) {
	$entier=intval($valeur);
	$decimale=$valeur-$entier;
	
	//echo "$entier : $decimale";
	
	if ($decimale >0.5) return round($entier+1,1);
	if ($decimale <0.5) return round($entier,1);
	if ($decimale ==0.5) return round($valeur,1);
	
}

include('../models/Db.php');
$db = new db();

if(isset($_GET['id'])){
	echo json_encode($db->getProductBadge(intval($_GET['id'])));	
}

?>