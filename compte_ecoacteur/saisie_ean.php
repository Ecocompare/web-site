<?php
session_start ();  
include_once("setting.php");
?>		

<html>
	<head>
		<link rel="stylesheet" href="<?php dirname(__FILE__)?> /ecocompare/compte_ecoacteur/css/account.css">	

		<script type="text/javascript" src="<?php dirname(__FILE__)?> /ecocompare/js/jquery-1.8.2.min.js"></script>
		<script type="text/javascript" src="<?php dirname(__FILE__)?> /ecocompare/compte_ecoacteur/account.js"></script>
	</head>
<?php	echo '<body>';


		/*NON CONNECTE*/
		if(!isset($_SESSION['id']) || !isset($_SESSION['email'])|| !isset($_SESSION['typecnx']) || !isset($_SESSION['isValid']) ){
				?>	<script> window.top.location.href="http://www.ecocompare.com/"; </script>   <?php 

		}
		/*CONNECTE*/
		else{
		
			echo '<div class="box">
			<div class="box-notif information"></div>
			<form id="account"></form>';	

			/*connecté et email non validé*/
			if($_SESSION['isValid']==0){ //TODO : TESTER LA FONCTION RESEND
				echo "Afin d'utiliser les fonctionnalités éco-acteur, vous devez valider votre adresse email. Si vous n'avez pas reçu d'email, vous pouvez toujours vous en renvoyer un depuis le bouton ci-dessous.
						<input type='button' value='Renvoyez-moi un mail' onClick='resendValidationMail(".$_SESSION['id'].");' />";
			}
			/*connecté et email validé*/
			else{
				
	        echo "<h1 class='ecocompare' onClick='showEanForm()'>Saisir un code EAN</h1>
				<div id='msg'></div>
				<form id='formEan'>
					<input id='ean' type='text' placeholder='Code Ean' />
					<input value='Soumettre' type='submit' />
				</form>";
			}  
			echo "</div>";
		}	
		?> 

        <script type="text/javascript">
		
        	//afficher infos si email validée ou rappel
        		$(document).ready(function(){

            		//Send ean search
            		$('#formEan').submit(function(){
						var msg = document.getElementById("msg");
    	    		    var checkEan = new RegExp("^[0-9]{13}$","g");
    	    		    var ean = document.getElementById('ean').value;
    	    			if(!checkEan.test(ean)){
    	    				msg.innerHTML = 'Veuillez entrer un code à 13 chiffres';
    	    			}else{
    		    			if(checkDigitEan13(ean)){
    		    				window.location.href='product.html?ean='+ean+'';
    		    			}
    	    				else{
    	    					msg.innerHTML = 'Le code ne semble pas valide. Veuillez réessayer';
    	    				}		
    	    		   }
    		    	   return false;
    		   		});
        		});

        </script>
	</body>
</html>

