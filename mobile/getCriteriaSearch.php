<?php

/*
* getCriteriaSearch.php
* get the products from personnal user taste
* personnal format : 'env_societal_sante'
*/

header('Content-Type: application/json');

require_once('../models/Db.php');

$db = new Db();
  
$personnal= (isset($_GET['personnal'])) ? mysql_real_escape_string($_GET['personnal']) : null;
  
if($personnal == null) {
  exit();
}

echo json_encode($db->searchProducts2(null, 'personnal' , null, null, null, null, null, null, $personnal));