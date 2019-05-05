<?php

require_once('models/Db.php');
$db = new Db();

$ean = null; $id = null;
if(isset($_GET['ean'])) {
  $ean = mysql_escape_string($_GET['ean']);

if(isset($_GET['id'])) {  
  $id = intval($_GET['id']);

if($id == null and $ean == null) {
  echo "id=0"; 
  exit();
}  

if($ean != null)   
  $query = "SELECT * FROM products where EAN LIKE '$ean'";
  
if($id != null)
  $query = "SELECT * FROM products where id = $id";
  
  
$results = mysql_query($query);
if($results != null) {
 $product = mysql_fetch_assoc($results);
 $product['categories'] = $db->getProductCategories($product['id']);
 $product['labels'] = $db->getProductLabels($product['id']);
  	
  //print_r($product);
  
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
