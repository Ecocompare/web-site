<?php
/*
* getGeneralRating.php
* get the current month rating
*/

header('Content-Type: application/json');

include('../models/Db.php');

$db = new db();

echo json_encode($db->getGeneralRating());

?>