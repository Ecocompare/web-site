<?php

/*
* validatePassword.php
* Called when the user clicks on the link in the email password restoration
* If token match with the user token in database a new password is generated and sent by email
*/

include('../models/Db.php');
include('mail.php');

$db = new db();

if(isset($_GET['code'])){

	$code = $_GET['code'];
	
	$results = $db->checkMobileUserToken($code);
	
	if($results!=null){
		
		$nb = 6; //Chars number
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$pwd='';
		for($i=0; $i<$nb;$i++){
			$index = mt_rand(0, strlen($chars));
			$pwd.= $chars{$index};
		}

		$params = array(
		      'pwd' => sha1($pwd),
		      'isValid' => 1, //If its an ancien user, his account is now valid
  		);

  		$id = $results['id'];

  		$results2 = $db->getMobileUser($id);

		$db->updateMobileUser($id, $params);

		mailPasswordForgot($results2['email'], $pwd);
		
		header('Location: ../maj_pwd.html');
	}
}


?>