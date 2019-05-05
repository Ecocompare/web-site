<?php

/*
* validate.php
* Called when the user clicks on the link in the email account validation
* If token match with the user token in database, user is now valid
*/

include('../models/Db.php');

$db = new db();

if(isset($_GET['code'])){

	$code = $_GET['code'];
	
	$results = $db->checkMobileUserToken($code);
	
	if($results!=null){
	
		$id = $results['id'];
		
		$params = array(
		      'isValid' => 1,
		      'token' => null, //Token deleted
  		);
		
		$db->updateMobileUser($id, $params);
		
		header('Location: ../validation_mail.html');
	}
}


?>