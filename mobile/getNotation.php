<?php
/*
* getNotation.php
* Get the specific asked notation
*/

header('Content-Type: application/json');

require_once('../models/Db.php');

$db = new Db();
  
$id = (isset($_GET['id'])) ? mysql_real_escape_string($_GET['id']) : null;
$typeNote = (isset($_GET['typeNote'])) ? mysql_real_escape_string($_GET['typeNote']) : null; 

//Environnement
if($typeNote == 0){
	$note=$db->getLifecycles($id);
	foreach($note as $key=>$lifeCycle){
		$comments = $db->getRatingProductDetail($id,1,$lifeCycle['lifecycle_id']);
		$note[$key]['subrating'] = $comments;
	}
	echo json_encode($note);
}

//Societal
if($typeNote==1){
	$note=$db->getThemeScore($id,'3,4,5,6,7');
	foreach($note as $key=>$v){
		$comments = $db->getRatingProductDetail($id,$v['theme_id'], 0);
		$note[$key]['subrating'] = $comments;
	}
	echo json_encode($note);
}

//Santé
if($typeNote==2){
	echo json_encode($note=$db->getRatingProductDetail($id,'2',0));
}
?>