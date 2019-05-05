<?php


  require_once('../models/Db.php');
  $db = new Db();
  
  $keywords = (isset($_GET['keywords'])) ? mysql_real_escape_string($_GET['keywords']) : null;
  
  if($keywords == null) {
    echo "count=0;";
    exit();
  }
  
  $products = $db->searchProductsold($keywords);
  $count    = $db->searchProductsold($keywords, 'new', 'pubdate DESC', 0, '', 0, 0, true); // Considérablement optimisable ;-)
  
  $result = ""; $i = 0;
  foreach($products as $product) {
    
    $result .= "id$i=".$product['id'].";name$i=".$product['name'].";brand$i=".$product['brand'].";rating$i=".$product['rating4'].";";
    $i++;   
  
  }
  
  echo "count=$i;";
  echo $result;
		
	
	