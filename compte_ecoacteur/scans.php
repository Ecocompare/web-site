<?php
//session_start ();  
?>		

<html>
	<head>
		<link rel="stylesheet" href="<?php dirname(__FILE__)?> compte_ecoacteur/css/account.css">	
		<link rel="stylesheet" href="<?php dirname(__FILE__)?> compte_ecoacteur/css/scans.css">	

		<script type="text/javascript" src="<?php dirname(__FILE__)?> js/jquery-1.8.2.min.js"></script>
		<script type="text/javascript" src="<?php dirname(__FILE__)?> compte_ecoacteur/account.js"></script>
	</head>
<?php	echo '<body>';


		/*NON CONNECTE*/
		if(!isset($_SESSION['id']) || !isset($_SESSION['email'])|| !isset($_SESSION['typecnx']) || !isset($_SESSION['isValid']) ){
				?>	<script> window.top.location.href="http://www.ecocompare.com/"; </script>   <?php 

		}
		/*CONNECTE*/
		else{
		
			echo '<div class="box">
		
			<h1>Mes 15 derniers scans</h1>
			<div style="border-top : 0.5px solid #91dd0b; margin-top : -15px;height : 1px; width : 100%; background : #c5dd0b;"></div>

			<div class="box-notif information"></div>
			<form id="account"></form>';	

			/*connecté et email non validé*/
			if($_SESSION['isValid']==0){ //TODO : TESTER LA FONCTION RESEND
				echo "Afin d'utiliser les fonctionnalités éco-acteur, vous devez valider votre adresse email. Si vous n'avez pas reçu d'email, vous pouvez toujours vous en renvoyer un depuis le bouton ci-dessous.
						<input type='button' value='Renvoyez-moi un mail' onClick='resendValidationMail(".$_SESSION['id'].");' />";
			}
			/*connecté et email validé*/
			else{
			
			
/*				if($_SESSION['typecnx']==0){ //connecté de manière classique
					$boutonDeconnexion= '<a href="compte_ecoacteur/destructionSession.php">D&eacute;connexion</a>';
				}else{ //connecté avec facebook
					//$boutonDeconnexion= '<fb:login-button autologoutlink="true"></fb:login-button>';
					$boutonDeconnexion= '<input type="button" onClick="fbLogout();" value="Se déconnecter" />';
				}
				echo $boutonDeconnexion;
*/

				echo '</br><div class="scroll"><div class="list_scans"></div></div></br>';
	
			}  
			echo "</div>";
		}	
		?> 
	

	</body>
</html>

