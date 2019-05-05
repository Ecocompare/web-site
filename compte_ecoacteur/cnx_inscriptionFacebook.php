<?php
header('Content-Type: application/json');
include('Session.php');
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
	if($user!=null){
		//email du compe facebook reconnu dans la base
		//MAJ de 'isValid' (au cas ou mail pas encore validé) et du 'FB_id' (au cas ou première cnx via facebook)
		$params = array(
			'FB_id'=> $FB_id,
			'isValid' => 1,
		);
		$db->updateMobileUser($user['id'], $params);
		
	//	echo json_encode($db->getMobileUserByEmail($email));
		$user2 = $db->getMobileUserByEmail($email);
		$userstat = $db->getStatUser($user2['id']);
		newsession($user2, $userstat, "0");
		echo json_encode("ok");
		
	} else { //email non reconnu dans la base
		$userFB = $db->getUserByIdFB($FB_id);
		if($userFB != null){
			//le fb_id est reconnu dans la base => l'utilisateur à changé l'adresse mail de son compte facebook
			//MAJ de 'isValid' (au cas ou mail pas encore validé) et de l'adresse 'mail'
			$params2 = array(
				'email'=> $email,
				'isValid' => 1,
			);
			$db->updateMobileUser($user['id'], $params2);

		}else{ //pas encore de compte
			//création d'un nouveau compte
			$params3 = array(
				'email' => $email, 
				'name' => $name,
				'gender' => $gender,
				'FB_id'=> $FB_id,
				'isValid' => 1,
				'inscription' => date("Y-m-d H:i:s"),
				'useragent' => $_SERVER['HTTP_USER_AGENT'],
			);
			$db->createMobileUser($params3);	
		}

		echo json_encode($db->getMobileUserByEmail($FB_id));
	}
	
}
?>