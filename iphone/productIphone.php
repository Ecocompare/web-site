<?php

require_once('../models/Db.php');
$db = new Db();


/* permet de rechercher un produit existant scanné 
   On insert un enregistrement dans la table iphone_scan
   Si ean ET product_id renseignés alors c'est que le scan a pu trouver un produit dans la base
   Si que que alors scan n'a pas trouvé le produit dans ecocompare
   si que id alors recherche via l'application ecocompare
   
   Version 1.1
   
*/
$pid="NULL";

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

error_log(Date("Y/m/d H:m:s")." id:$id, ean:$ean\n", 3, "erreursiphone.log");
//echo "ok";
if($id == null and $ean == null) {
  echo "id=0"; 
  exit();
}  

if($ean != null)   
 // $query = "SELECT * FROM products_old where $ean in (EAN)";
  $query = "SELECT * FROM products_old where INSTR(EAN, '$ean')>0 and published='true';";

if($id != null)
  $query = "SELECT * FROM products_old where id = $id and published='true'";
  
 // print_r($query);
  $results = mysql_query($query);
  if($product = mysql_fetch_assoc($results)) {
   $product['categories'] = $db->getProductCategories($product['id']);
   $product['labels'] = $db->getProductLabels($product['id']);
    	
   // print_r($product);
    
    echo "id=".$product['id'].";image=".$product['image'].";name=".$product['name'].";brand=".$product['brand'].";ean=".$product['EAN'].";";
    echo "description=".strip_tags($product['description']).";rating1=".round($product['rating1'],1).";rating1comment=".strip_tags($product['rating1comment']).";";
    echo "rating2=".round($product['rating2'],1).";rating2comment=".strip_tags($product['rating2comment']).";rating3=".round($product['rating3'],1).";rating3comment=".strip_tags($product['rating3comment']).";rating4=".round($product['rating4'],1).";";
    echo "rating4comment=".strip_tags($product['rating4comment']).";findit=".strip_tags($product['findit']).";facts=".strip_tags($product['facts']).";created=".$product['created'].";";
    echo "labels=".count($product['labels']).";";
    
    
    
    $i = 0;
    foreach($product['labels'] as $subtable) {
      
        echo "label$i=".$subtable['id'].";";
        $i++;
    }
    
			// on recherche l'id du produit pour indiquer dans l'insert qu'on la bien trouvé
			$pid=$product['id'];
     
  }
  else
  {
  	if($ean != null) {
      $query = "SELECT * FROM `iphone_eans_desc` WHERE `description` != '' AND ean like '$ean'";
      $results = mysql_query($query);
      if($product = mysql_fetch_assoc($results)) {
    	 echo "id=0;name=".$product['description']." - ".$product['marque'].";";
      } 
      else echo  "id=0;name=;";
    }
    else echo  "id=0;name=;";
  }
  
   //si passé en GET uniquement et que pas trouvé auparavant
    if (isset($_GET['id']) && $pid=="") $pid=mysql_escape_string($_GET['id']);
    
    $ean         = (isset($_GET['ean'])) ? mysql_escape_string($_GET['ean']) : "NULL";
   // $pid         = (isset($_GET['id'])) ? mysql_escape_string($_GET['id']) : "NULL";
    $iphone_id   = (isset($_GET['iphone_id'])) ? mysql_escape_string($_GET['iphone_id']) : "NULL";
    $email       = (isset($_GET['email'])) ? mysql_escape_string($_GET['email']) : "NULL";
    $name        = (isset($_GET['name'])) ? mysql_escape_string($_GET['name']) : "NULL";
    $tel         = (isset($_GET['tel'])) ? mysql_escape_string($_GET['tel']) : "NULL";
    $lon         = (isset($_GET['lon'])) ? mysql_escape_string($_GET['lon']) : "NULL";
    $lat         = (isset($_GET['lat'])) ? mysql_escape_string($_GET['lat']) : "NULL";
    $alt         = (isset($_GET['alt'])) ? mysql_escape_string($_GET['alt']) : "NULL";
   
    
   if ($iphone_id!='NULL') {
   //opérations BDD
   $query = "SELECT * FROM iphone_users where iphone_id = '".$iphone_id."'";
   $result= mysql_query($query);
   $rows=mysql_num_rows($result);
 
   
			   if ($rows==0) {
			   	 $query2="INSERT INTO iphone_users (iphone_id,email,name,tel,inscription,useragent) VALUES( '$iphone_id', '$email', '$name', '$tel', NOW(),'$userAgent')";
			   	 mysql_query($query2);
			   	 if (mysql_errno()) { 
			  	error_log(Date("Y/m/d H:m:s")." MySQL error ".mysql_errno().": ".mysql_error()."\n<br>When executing:<br>\n$query2\n<br>",3, "erreursiphone.log"); }
			
			  } else
			  
			  {
			  	 	 $query2="update iphone_users set email='".$email."', name='".$name."',tel='".$tel."', useragent='".$userAgent."' where iphone_id='".$iphone_id."' ";
			  	 	  mysql_query($query2);
			  	 	
			   		 if (mysql_errno()) { 
			  		error_log(Date("Y/m/d H:m:s")." MySQL error ".mysql_errno().": ".mysql_error()."\n<br>When executing:<br>\n$query2\n<br>",3, "erreursiphone.log"); }
			  }
  

 // recherche temporaire user_id
  $query = "SELECT id FROM `iphone_users` WHERE  iphone_id='".$iphone_id."' ";
  $results=mysql_query($query);
  $user = mysql_fetch_assoc($results);
  $user_id=$user['id'];
  
  
  
  $query="INSERT INTO iphone_query (iphone_id, user_id,product_id,ean,longitude,latitude,altitude,date,useragent) VALUES ( '$iphone_id', $user_id, $pid, '$ean', $lon, $lat, $alt, NOW(),'$userAgent')";
   error_log(Date("Y/m/d H:m:s")." $query\n", 3, "erreursiphone.log");
    mysql_query($query);
    if (mysql_errno()) { 
  	error_log("MySQL error ".mysql_errno().": ".mysql_error()."\n<br>When executing:<br>\n$query\n<br>",3, "erreursiphone.log"); }

//check si déja inséré dans table description
 $query = "SELECT * FROM `iphone_eans_desc` WHERE ean like '$ean'";
  	mysql_query($query);
  
      $results = mysql_query($query);
      if (!$product = mysql_fetch_assoc($results)) {
      	$query2="insert into iphone_eans_desc (ean,date_request,hit) values ('".$ean."',now(),0)";
      	mysql_query($query2);
      	error_log(Date("Y/m/d H:m:s")." $query2\n", 3, "erreursiphone.log");
      }

  
  	
// MAJ compteur HIT
 $query="UPDATE iphone_eans_desc  SET hit=hit+1 where ean like '".$ean."'";
  error_log(Date("Y/m/d H:m:s")." $query\n", 3, "erreursiphone.log");
    mysql_query($query);
    if (mysql_errno()) { 
  	error_log("MySQL error ".mysql_errno().": ".mysql_error()."\n<br>When executing:<br>\n$query\n<br>",3, "erreursiphone.log"); }
  	

}
