<?php

/*
* checkUserFacebook.php
* If user not exist, user is created (isValid=1)
* else we update the user (isValid=1, FB_ID)
*/

//header('Content-Type: application/json');

include('../models/Db.php');

$db = new db();

if(isset($_GET['id'])&&isset($_GET['name'])&&isset($_GET['email'])&&isset($_GET['gender'])){
	
	$email = $_GET['email'];
	$name = $_GET['name'];
	$FB_id = $_GET['id'];
	
	if($_GET['gender']==='male'){
		$gender='Homme';
	}else{
		$gender='Femme';
	}

	$user = $db->getMobileUserByEmail($email);
	if($user==null){	
		$params = array(
			'email' => $email, 
			'name' => $name,
			'gender' => $gender,
			'FB_id'=> $FB_id,
			'isValid' => 1,
			'inscription' => date("Y-m-d H:i:s"),
			'useragent' => $_SERVER['HTTP_USER_AGENT'],
	  	);

		$db->createMobileUser($params);
		
		$user = $db->getMobileUserByEmail($email); //Renvoi les infos de l'utilisateur
			
		//Ajout dans iphone_users_stat pour initialiser une ligne à vide
		$params2 = array(
		    'user_id' => $user['id'], 
		    'total_scan' => null,
		    'total_resp_scan' => null,
		    'month_scan' => null,
		    'month_resp_scan' => null,
		    'nbwin' => null,
  		);

		$db->createUserStats($params2);

	}else{
		$params = array(
			'FB_id'=> $FB_id,
			'isValid' => 1,
		);
		$db->updateMobileUser($user['id'], $params);
	}
	echo json_encode($db->getMobileUserByEmail($email));
}else{
	echo "rien";
}
 
?>