<?php

require_once('../models/Db.php');
$db = new Db();

$userAgent = $_SERVER['HTTP_USER_AGENT'];
//Sécuriser le script Forbidden si pas ecocompare
//if (!preg_match('/ecocompare/',$userAgent)) {header('HTTP/1.1 403 Forbidden'); exit();}


$iphone_id = (isset($_GET['iphone_id'])) ? mysql_escape_string($_GET['iphone_id']) : null;

if($iphone_id != null) {

    $query = "SELECT * FROM iphone_query_month A,iphone_users B where A.user_id=B.id and B.iphone_id LIKE '$iphone_id' and A.month = month(now())";
    $results = mysql_query($query);
    if($infos = mysql_fetch_assoc($results)) {
    
      echo "total=".$infos['total'].";sort=".$infos['sort'].";";
    }
    else 
      echo "total=0;sort=0;";
}