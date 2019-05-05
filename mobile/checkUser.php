<?php

/*
* checkUser.php
* check if user exist
* Case 1 : ok
* Case 2 : Creation
*/

header('Content-Type: application/json');

include('../models/Db.php');

include('mail.php');

$db = new db();
error_log(Date("Y/m/d H:m:s")." checkuser\n", 3, "checkuser.log");

if(isset($_GET['email'])&&isset($_GET['pwd'])){

	$email = urldecode($_GET['email']);
	$pwd = $_GET['pwd'];

	//Exist
	if($db->checkMobileUser($email, $pwd)!= null){
		error_log(Date("Y/m/d H:m:s")." exist $email \n", 3, "checkuser.log");
		echo json_encode($db->getMobileUserByEmail($email));
	}
	else{
		//Creation
			error_log(Date("Y/m/d H:m:s")." create new user \n", 3, "checkuser.log");
		if($db->getMobileUserByEmail($email)==null){
			error_log(Date("Y/m/d H:m:s")." create new user $email \n", 3, "checkuser.log");
			$token = uniqid(); 
			$token.= uniqid(); //26 chars token

			$params = array(
		      'email' => $email, 
		      'pwd' => sha1($pwd),
		      'token' => $token,
		      'isValid' => false,
		      'inscription' => date("Y-m-d H:i:s"),
		      'useragent' => $_SERVER['HTTP_USER_AGENT'],
  			);

				error_log(Date("Y/m/d H:m:s")." before create $email $token \n", 3, "checkuser.log");
			$db->createMobileUser($params);
			error_log(Date("Y/m/d H:m:s")." after new user $email \n", 3, "checkuser.log");
			mailValidation($email, $token); //Send validation mail
			error_log(Date("Y/m/d H:m:s")." mailValidation $email $token \n", 3, "checkuser.log");
			$user = $db->getMobileUserByEmail($email);
			error_log(Date("Y/m/d H:m:s")." getMobileUser". $user['id']." \n", 3, "checkuser.log");
			//Create a new row in iphone_users_stat
			$params = array(
		      'user_id' => $user['id'], 
		      'total_scan' => null,
		      'total_resp_scan' => null,
		      'month_scan' => null,
		      'month_resp_scan' => null,
		      'nbwin' => null,
  			);
			error_log(Date("Y/m/d H:m:s")." before createuserstats \n", 3, "checkuser.log");
			$db->createUserStats($params);
			error_log(Date("Y/m/d H:m:s")." after createuserstats \n", 3, "checkuser.log");
			echo json_encode($user);
		}
		else{
			error_log(Date("Y/m/d H:m:s")." else \n", 3, "checkuser.log");
			echo json_encode(false);
		}
	}
}
else if(isset($_GET['id'])&&isset($_GET['resend'])){ //Resend Email process

	error_log(Date("Y/m/d H:m:s")." ReSend email process for ID ".$_GET['id']."\n", 3, "checkuser.log");
	$results = $db->getMobileUser($_GET['id']);
	
	if($results != null && !empty($results['token'])){
	
		mailValidation($results['email'], $results['token']);
			error_log(Date("Y/m/d H:m:s")." Envoi à : ".$results['email']. " \n", 3, "checkuser.log");
			
		echo json_encode(true);
		
	}
}

?>