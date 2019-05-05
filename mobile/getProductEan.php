<?php
/*
* getProductEan.php
* get product information from param EAN
* Search in products -> if not found -> iphone_eans_desc
*/

header('Content-Type: application/json');


function arrondir($valeur) {
	$entier=intval($valeur);
	$decimale=$valeur-$entier;
	if ($decimale>0.5) return round($entier+1,1);
	if ($decimale<0.5) return round($entier,1);
	if ($decimale==0.5) return round($valeur,1);
	
}
require_once('../models/Db.php');

$db = new Db();

$ean = null;
error_log(Date("Y/m/d H:m:s")." getProductEan  \n", 3, "checkuser.log");
	
if(isset($_GET['ean'])) {
  $ean = mysql_escape_string($_GET['ean']);
}

if($ean == null) {
	error_log(Date("Y/m/d H:m:s")." getProductEan,ean null sortie  \n", 3, "checkuser.log");
  exit();
}  


//Si ean
if($ean != null){

  $query = "SELECT * FROM products where INSTR(EAN, '$ean')>0;";
  $results = mysql_query($query);

error_log(Date("Y/m/d H:m:s")." getProductEan, $query  \n", 3, "checkuser.log");

  //Si ean dans product
  if($product = mysql_fetch_assoc($results)){
  $id = $product['id'];
  $product['categories'] = $db->getProductCategories($id);
	$product['labels'] = $db->getProductLabels($id);
	$product['subratings'] = $db->getProductSubratings($id);
	$product['subratingsdetail'] = $db->getProductSubratings($id, true,false,false);
	$product['subratingsfeedback'] = $db->getProductSubratings($id, false,true,false);
	$product['subratingslabel'] = $db->getProductSubratingsComments($id);
	$product['indicators']=$db->getProductIndicator($id);
	error_log(Date("Y/m/d H:m:s")." getProductEan,ean trouvé dans ecocompare  \n", 3, "checkuser.log");
	//on logue dans la table productstat
	$db->logProductStat($id);
   	echo json_encode($product);
  }
  else
  {
  	$query = "SELECT * FROM `iphone_eans_desc` WHERE `description` != '' AND ean like '$ean'";
    $results = mysql_query($query);
    if($product = mysql_fetch_assoc($results)){
    	error_log(Date("Y/m/d H:m:s")." getProductEan trouvé dans eans_desc  \n", 3, "checkuser.log");
    	echo json_encode($product['description'].'-'.$product['marque']);
    }
    else{
    	error_log(Date("Y/m/d H:m:s")." getProductEan pas trouvé \n", 3, "checkuser.log");
    	echo json_encode(false);
    }
  }
}
?>