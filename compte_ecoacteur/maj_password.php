<?php
//session_start ();  
?>		

<html>
	<head>
		<link rel="stylesheet" href="<?php dirname(__FILE__)?> /compte_ecoacteur/css/account.css">	
		<script type="text/javascript" src="<?php dirname(__FILE__)?> /compte_ecoacteur/account.js"></script>
	</head>
<?php	echo '<body>';

		/*NON CONNECTE*/
		if(!isset($_SESSION['id']) || !isset($_SESSION['email'])|| !isset($_SESSION['typecnx']) || !isset($_SESSION['isValid']) ){
				?>	<script> window.top.location.href="http://www.ecocompare.com/"; </script>   <?php 

		}
		/*CONNECTE*/
		else{
			echo '<div id="box">';
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
				echo $boutonDeconnexion;*/


				if(!isset($_SESSION['name'])||!isset($_SESSION['gender'])||!isset($_SESSION['birthyear'])||!isset($_SESSION['postalcode'])){
					?>	<script> window.top.location.href="http://www.ecocompare.com/espace-eco-acteur.html?section=informations_personnelles"; </script>   <?php 
				
				}else
				{
?>					<h1>Modifier mon mot de passe</h1>
					<div style="height : 0.5px; width : 100%;box-shadow: inset 0 3px 8px rgba(0,0,0,.24);  " ></div>	
					</br>

								
			<div class="box">
			<div class="error"></div>
			<div class="ok"></div>
					<div>Veuillez saisir votre nouveau mot de passe</div>
		        	<div><input id='pwdnew' type="password" required="required" /></div></br>
		        	<div>Veuillez confirmer votre nouveau mot de passe</div>
		        	<div><input id='pwdbis' type="password" required="required" /></div></br>
		        	<div><input id='modifier' type='button' value='Modifier'/></div>
			</div>	

			
<?php							
			echo '<input type="hidden" value="'.$_SESSION['id'].'" id="iduser">';
}
		}  
			echo '</div></br></br></br>';
		}	
		?> 

		
		<script>

			$('#modifier').click(function(){
				setUserPassword(document.getElementById("iduser").value);
				return false;
			});

					
		</script>		
		<style>
			.error{color : red;}
			.ok{color : #93cd12 ;}
		</style>
					
	</body>
</html>

