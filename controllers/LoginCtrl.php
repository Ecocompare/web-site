<?php
require_once('Controller.php');

class LoginCtrl extends Controller{
	

	function show(){
		$this->currentTab = 'none';
		$this->title = "Identification back office";
		$this->render('loginshow.php');
	}
	
	function login(){
		global $db;
		
		$user = $db->checkUser(req('email'), req('password'));
		if ($user != null){
			$_SESSION['user'] = $user;

			$_SESSION['admin'] = true;
			$_SESSION['company'] = true;
			header('Location: '.$GLOBALS['base'].'products/admin');
			$db->saveHistory($_SESSION['user']['id'],0,"login OK");
				
		}else{
			$db->saveHistory(0,0,"login HS pour ".req('email'));
			header('Location: '.$GLOBALS['base'].'login');
		}
	}

	function logout(){
		global $db;
		$db->saveHistory($_SESSION['user']['id'],0,"logout");
		session_destroy();
		header('Location: '.$GLOBALS['base']);
	}
	
	function lost(){
		global $db;
		$db->saveHistory($_SESSION['user']['id'],0,"Session lost");
		$this->currentTab = 'none';
		$this->render('loginlost.php');
	}
	
	function restorePw(){
		global $db;
		$user = $db->getUserByEmail(req('email'));
		
	
			
		if ($user == null){
			header('Location: /content/show/Mot-de-passe-erreur');			
		}else{
			$newPass = $this->createPassword(8);
			$params = array('password' => sha1($newPass));
			$db->updateUser($user['id'], $params);
			$db->saveHistory($user['id'],0,"Password recovery sent");
			
			$to      = $user['email'];
			$subject = 'Votre mot de passe Ecocompare '.$productName;
			$headers = 
				'From: Ecocompare <noreply@ecocompare.com>'."\n".
	 		$headers.= "Content-Type: text/plain; charset=UTF-8;";
	   		$message = "Votre nouveau mot de passe est $newPass";
	
			mail($to, $subject, $message, $headers);
			
			header('Location: /content/show/Mot-de-passe-envoye');			

		}
	}
	
	function createPassword($length) {
		$chars = "234567890abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$i = 0;
		$password = "";
		while ($i <= $length) {
			$password .= $chars{mt_rand(0,strlen($chars))};
			$i++;
		}
		return $password;
	}



}