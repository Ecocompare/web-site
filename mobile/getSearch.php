<?php
/*
* getSearch.php
* get products matched with keywords param
*/
header('Content-Type: application/json');

require_once('../models/Db.php');

$db = new Db();
  
$keywords = (isset($_GET['keywords'])) ? mysql_real_escape_string($_GET['keywords']) : null;
  
if($keywords == null) {
  exit();
}

echo json_encode($db->searchProducts2($keywords));