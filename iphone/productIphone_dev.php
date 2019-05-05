<?php

require_once('../models/Db.php');
$db = new Db();

$userAgent=$_SERVER['HTTP_USER_AGENT'];
//echo $userAgent;

//Sécuriser le script Forbidden si pas ecocompare
//if (!preg_match('/ecocompare/',$userAgent)) {header('HTTP/1.1 403 Forbidden'); exit();}

	
$ean = null; $id = null;
if(isset($_GET['ean'])) {
  $ean = mysql_escape_string($_GET['ean']);
}

if(isset($_GET['id'])) {  
  $id = intval($_GET['id']);
}

//error_log("id:$id, ean:$ean\n", 3, "/tmp/erreursiphone.log");

if($id == null and $ean == null) {
  echo "id=0"; 
  exit();
}  

if($ean != null)   
 // $query = "SELECT * FROM products where $ean in (EAN)";
  $query = "SELECT * FROM products where INSTR(EAN, '$ean')>0;";
if($id != null)
  $query = "SELECT * FROM products where id = $id";
  
  //print_r($query);
  $results = mysql_query($query);
  if($product = mysql_fetch_assoc($results)) {
   $product['categories'] = $db->getProductCategories($product['id']);
   $product['labels'] = $db->getProductLabels($product['id']);
    	
   // print_r($product);
    
    echo "id=".$product['id'].";image=".$product['image'].";name=".$product['name'].";brand=".$product['brand'].";ean=".$product['EAN'].";";
    echo "description=".strip_tags($product['description']).";rating1=".$product['rating1'].";rating1comment=".strip_tags($product['rating1comment']).";";
    echo "rating2=".$product['rating2'].";rating2comment=".strip_tags($product['rating2comment']).";rating3=".$product['rating3'].";rating3comment=".strip_tags($product['rating3comment']).";rating4=".$product['rating4'].";";
    echo "rating4comment=".strip_tags($product['rating4comment']).";findit=".strip_tags($product['findit']).";facts=".strip_tags($product['facts']).";created=".$product['created'].";";
    echo "labels=".count($product['labels']).";";
    
    
    
    $i = 0;
    foreach($product['labels'] as $subtable) {
      
        echo "label$i=".$subtable['id'].";";
        $i++;
    }
    

     
  }
  else
  {
    if($ean != null) {
      $query = "SELECT * FROM `iphone_eans_desc` WHERE `description` != '' AND ean like '$ean'";
      $results = mysql_query($query);
      if($product = mysql_fetch_assoc($results)) {
    	 echo utf8_encode("id=0;name=".$product['description']." - ".$product['marque'].";");
      } 
      else echo  "id=0;name=;";
    }
    else echo  "id=0;name=;";
  }
  
    $ean         = (isset($_GET['ean'])) ? mysql_escape_string($_GET['ean']) : "NULL";
    $pid         = (isset($_GET['id'])) ? mysql_escape_string($_GET['id']) : "NULL";
    $iphone_id   = (isset($_GET['iphone_id'])) ? mysql_escape_string($_GET['iphone_id']) : "NULL";
    $email       = (isset($_GET['email'])) ? mysql_escape_string($_GET['email']) : "NULL";
    $name        = (isset($_GET['name'])) ? mysql_escape_string($_GET['name']) : "NULL";
    $tel         = (isset($_GET['tel'])) ? mysql_escape_string($_GET['tel']) : "NULL";
    $lon         = (isset($_GET['lon'])) ? mysql_escape_string($_GET['lon']) : "NULL";
    $lat         = (isset($_GET['lat'])) ? mysql_escape_string($_GET['lat']) : "NULL";
    $alt         = (isset($_GET['alt'])) ? mysql_escape_string($_GET['alt']) : "NULL";
  /*  
   if ($iphone_id!='NULL') {
   //opérations BDD
   $query = "SELECT * FROM iphone_users where iphone_id = '".$iphone_id."'";
   $result= mysql_query($query);
   $rows=mysql_num_rows($result);
    // error_log("$query : $rows", 3, "/tmp/erreursiphone.log");
   
   if ($rows==0) {
   	 $query2="INSERT INTO iphone_users (iphone_id,email,name,tel,inscription) VALUES( '$iphone_id', '$email', '$name', '$tel', NOW())";
   	 mysql_query($query2);
   	 if (mysql_errno()) { 
  	error_log("MySQL error ".mysql_errno().": ".mysql_error()."\n<br>When executing:<br>\n$query2\n<br>",3, "/tmp/erreursiphone.log"); }

  } else
  
  {
  	 	 $query2="update iphone_users set email='".$email."', name='".$name."',tel='".$tel."' where iphone_id='".$iphone_id."' ";
  	 	  mysql_query($query2);
   		 if (mysql_errno()) { 
  		error_log("MySQL error ".mysql_errno().": ".mysql_error()."\n<br>When executing:<br>\n$query2\n<br>",3, "/tmp/erreursiphone.log"); }
  }
   
   $query="INSERT INTO iphone_query VALUES(NULL, '$iphone_id', $pid, '$ean', $lon, $lat, $alt, NOW())";
   error_log("$query\n", 3, "/tmp/erreursiphone.log");
    mysql_query($query);
    if (mysql_errno()) { 
  	error_log("MySQL error ".mysql_errno().": ".mysql_error()."\n<br>When executing:<br>\n$query\n<br>",3, "/tmp/erreursiphone.log"); }


}       */
