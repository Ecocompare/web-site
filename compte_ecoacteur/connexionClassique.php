<?php
//session_start(); 
header('Content-Type: application/json');
include('Session.php');
include('../models/Db.php');


$db = new db();

//From connect page
if(isset($_GET['email'])&&isset($_GET['pwd'])){

	$email = $_GET['email'];
	$pwd = $_GET['pwd'];

	if($db->checkMobileUser($email, $pwd)!= null){
		$user = $db->getMobileUserByEmail($email);
		$userstat = $db->getStatUser($user['id']);
		newsession($user, $userstat, "0");
		echo json_encode("ok");
	}
	else{
		if($db->getMobileUserByEmail($email)==null){	//adresse mail non reconnue
			echo json_encode("inconnu");
		}
		else{	//mot de passe erroné
			echo json_encode("errone");
		}
	}
}

?>