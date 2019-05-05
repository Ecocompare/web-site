<?php
header('Content-Type: application/json');

include('../models/Db.php');

include('../mobile/mail.php'); //Fonctions mobile user mail

$db = new db();

//Can check if user exist, register and send/resend validation mail

//From connect page
if(isset($_GET['email'])&&isset($_GET['pwd'])){

	$email = $_GET['email'];
	$pwd = $_GET['pwd'];

	if($db->getMobileUserByEmail($email)==null){	
		$token = uniqid(); //jeton validation mail4521111
		$token.= uniqid(); //26 caractères afin d'éviter les collisions


 
		$params = array(
		  'email' => $email, 
		  'pwd' => sha1($pwd),
		  'token' => $token,
		  'isValid' => false,
		  'inscription' => date("Y-m-d H:i:s"),
		  'useragent' => $_SERVER['HTTP_USER_AGENT'],
		);

			error_log(date("h:i:s")." creation BDD \n",3, "patrick.log"); 
		$db->createMobileUser($params);
		
		
		mailValidation($email, $token); //Envoi un mail de validation

	
	
		$user = $db->getMobileUserByEmail($email);
		
		//Create a new row in iphone_users_stat
		$params = array(
		  'user_id' => $user['id'], 
		  'total_scan' => null,
		  'total_resp_scan' => null,
		  'month_scan' => null,
		  'month_resp_scan' => null,
		  'nbwin' => null,
		);


		$db->createUserStats($params);
	 error_log(date("h:i:s")." OK  \n",3, "patrick.log"); 
		echo json_encode($user);		
	}
	else{
	
		echo json_encode(0);	//adresse email déjà utilisé
	}
}
else if(isset($_GET['id'])&&isset($_GET['resend'])){ //From resend email button
	$results = $db->getMobileUser($_GET['id']);
	if($results != null && !empty($results['token'])){
		mailValidation($results['email'], $results['token']);


		echo json_encode(1); //On renvoi une valeur afin de capter l'etat ajax success sur phonegap
	}
}

?>