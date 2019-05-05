<?php
header('Content-Type: application/json');

include_once('../models/Db.php');


$db = new db();
//isset($_GET['id'])&&isset($_GET['name'])&&isset($_GET['gender'])
if(isset($_GET['email'])&&isset($_GET['id'])){
	
	$email = $_GET['email'];
	$FB_id = $_GET['id'];
/*	$name = $_GET['name'];

	if($_GET['gender']==='male'){
		$gender='Homme';
	}else{
		$gender='Femme';
	}
*/
	$user = $db->getMobileUserByEmail($email);
	if($user==null){	
/*		$params = array(
			'email' => $email, 
			'name' => $name,
			'gender' => $gender,
			'FB_id'=> $FB_id,
			'isValid' => 1,
			'inscription' => date("Y-m-d H:i:s"),
			'useragent' => $_SERVER['HTTP_USER_AGENT'],
	  	);
		$db->createMobileUser($params);	
*/	
		echo json_encode("inconnu");

	}else{
		$params2 = array(
			'FB_id'=> $FB_id,
			'isValid' => 1,
		);
		$db->updateMobileUser($user['id'], $params2);
		echo json_encode($db->getMobileUserByEmail($email));	
	}

}
?>