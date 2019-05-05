<?php

/*
* mail.php
* Mail sender for mobile app
*/

$base = 'http://www.ecocompare.com/';

function mailValidation($email, $token){
	global $base;
	error_log(date("Y/m/d H:m:s")." mailValidation($email, $token) \n",3, "patrick.log"); 
	$headers = 'From: Ecocompare <contact@ecocompare.com>'."\r\n";
 	$headers.= "Content-Type: text/html; charset=UTF-8;";
	$subject = 'Confirmation email Ecocompare';
	$message = "Vous avez créé un compte Ecocompare avec l'email ".$email.".<br/><br/>";
	$message.= "Afin de vérifier que vous êtes bien à l'origine de la création de ce compte, merci de confirmer votre adresse email en cliquant sur le lien suivant :<br/>";
	$message.= "<a href='".$base."mobile/validate.php?code=".$token."'>".$base."mobile/validate.php?code=".$token."</a><br><br>";
	$message.= "Nous restons à votre diposition si vous avez des questions.<br><br>Cordialement<br><br>L'équipe ecocompare - contact@ecocompare.com - +33 4 75 70 18 11";
	mail($email, $subject, $message, $headers,"-f contact@ecocompare.com");
}

function mailValidationPasswordForgot($email, $token){
	global $base;
	$headers = 'From: Ecocompare <contact@ecocompare.com>'."\r\n";
 	$headers.= "Content-Type: text/html; charset=UTF-8;";
	$subject = 'Confirmation du changement de mot de passe Ecocompare';
	$message = "Une demande de réinitialisation de mot de passe a été demandée pour l'email ".$email.".<br/><br/>";
	$message.= "Afin de vérifier que vous êtes bien à l'origine de cette demande, merci de confirmer celle-ci en cliquant sur le lien suivant :<br/>";
	$message.= "<a href='".$base."mobile/validatePassword.php?code=".$token."'>".$base."mobile/validatePassword.php?code=".$token."</a><br><br>";
	$message.= "Nous restons à votre diposition si vous avez des questions.<br><br>Cordialement<br><br>L'équipe ecocompare - contact@ecocompare.com - +33 4 75 70 18 11";
	mail($email, $subject, $message, $headers,"-f contact@ecocompare.com");
}

function mailPasswordForgot($email, $pwd){
	global $base;
	$headers = 'From: Ecocompare <contact@ecocompare.com>'."\r\n";
 	$headers.= "Content-Type: text/html; charset=UTF-8;";
	$subject = 'Votre nouveau mot de passe Ecocompare';
	$message = "Voici votre nouveau mot de passe, nous vous invitons à le changer au plus vite via le menu Mot de passe de votre profil : <br/><br/>".$pwd."<br/><br/>";
	$message.= "Nous restons à votre diposition si vous avez des questions.<br><br>Cordialement<br><br>L'équipe ecocompare - contact@ecocompare.com - +33 4 75 70 18 11";
	mail($email, $subject, $message, $headers,"-f contact@ecocompare.com");
}

?>