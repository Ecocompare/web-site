<?php

/*
* getProduct.php
* get the new products
*/

header('Content-Type: application/json');

include('../models/Db.php');

$db = new db();
error_log(Date("Y/m/d H:m:s")." getProducts\n", 3, "/tmp/erreursiphone2.log");

echo json_encode($db->getProducts("","pubdate DESC"));

?>