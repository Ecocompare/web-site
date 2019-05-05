<?php
//session_start ();  
?>		

<html>
	<head>
		<link rel="stylesheet" href="<?php dirname(__FILE__)?> /compte_ecoacteur/upload/css/jquery.fileupload-ui.css">	
		<link rel="stylesheet" href="<?php dirname(__FILE__)?> /compte_ecoacteur/css/infos.css">	
		<script type="text/javascript" src="<?php dirname(__FILE__)?> /compte_ecoacteur/account.js"></script>
		<script type="text/javascript" src="<?php dirname(__FILE__)?> /js/jquery-1.8.2.min.js"></script>
		<script type="text/javascript" src="<?php dirname(__FILE__)?> /js/jquery-1.8.2.min.js"></script>
		
		
	</head>
<?php	echo '<body>';
?>		
		
		<?php

		/*NON CONNECTE*/
		if(!isset($_SESSION['id']) || !isset($_SESSION['email'])|| !isset($_SESSION['typecnx']) || !isset($_SESSION['isValid']) ){
				?>	<script> window.top.location.href="http://www.ecocompare.com/"; </script>   <?php 

		}
		/*CONNECTE*/
		else{
		
			echo '<div class="box">
		
			<h1>Mes informations personnelles</h1>
			<!--<div style="border-top : 0.5px solid #91dd0b; margin-top : -15px;height : 1px; width : 100%; background : #c5dd0b;"></div></br>-->
			<div class="box-notif information"></div>
			<form id="account"></form>';	

				if($_SESSION['typecnx']==0){ //connecté de manière classique
					$boutonDeconnexion= '<a href="compte_ecoacteur/destructionSession.php">D&eacute;connexion</a>';
				}else{ //connecté avec facebook
					$boutonDeconnexion= '<input type="button" onClick="fbLogout();" value="Se déconnecter" />';
				}
				
				echo '<input type="hidden" value="'.$_SESSION['haspwd'].'" id="haspwd">';
				echo '<input type="hidden" value="'.$_SESSION['id'].'" id="iduser">';
				if(!$_SESSION["haspwd"]){
					echo 'Vous n\'avez pas encore d&eacute;fini de mot de passe.</br>';
					echo '<label>Mot de passe</label><input id="pwdnew" type="password" required >&nbsp;*' ; 
					echo '<label>Confirmer mot de passe</label><input id="pwdbis" type="password" required >&nbsp;*';
					echo '<input type="button" onClick="setUserPassword('.$_SESSION['id'].' )" />' ; 
				}
				

				echo'<div class="box1 container">';
				
				
				$repertoire="/var/www/vhosts/ecocompare.com/httpdocs/iphone/usersImages/";
				$fichier=$_SESSION["id"].".png";;

				if (file_exists($repertoire.$fichier)){
					echo '<image alt="photo éco-acteur" id="userimage" style="margin-left:4px;width : 130px;height : 130px;" src="/iphone/usersImages/'.$_SESSION["id"].'.png" >';
				}else{
					echo '<image alt="photo éco-acteur" id="userimage" style="margin-left:4px;width : 130px;height : 130px;" src="/images/ecoacteurs/noimage.jpg" >';	
				}

			//	echo '	<image id="userimage" style="margin-left:4px;width : 130px;height : 130px;"  src="/ecocompare/iphone/usersImages/'.$_SESSION["id"].'.png" >';
				
						echo '<!-- The fileinput-button span is used to style the file input field as button -->
						</br><span class="btnupload btn fileinput-button">
											<span>Changer d\'image</span>
							<!-- The file input field used as target for the file upload widget -->
							<input title="changer l\'image de profil" id="fileupload" type="file" name="files[]" multiple>
						</span>
						<br>
						<br>
						<!-- The global progress bar -->
						<div style="width:100%;">
						<div id="progress" class="progress progress-success progress-striped">
							<div class="bar"></div>
						</div>
						</div>
						<!-- The container for the uploaded files -->
						<div id="files" class="files"></div>
					</div>';
					
				echo '<div class="box1" ><span style="float  : center;"><strong>Les champs indiqués par une <span style="color : red;">*</span> sont obligatoires</strong></span></br>';
				echo '<table style="margin-left : auto; margin-right : auto;"> ';
				echo '<tr><td>Nom et prénom<span style="color : red;">*</span></td><td><input style="width : 100%;" id="name" type="text" value="'.$_SESSION["name"].'" ></td></tr>'; 
					echo '<tr><td>Genre<span style="color : red;">*</span></td><td>
							<select id="gender">';
								echo '<option '; if($_SESSION['gender'] == "Homme" ) echo "selected"; echo '>Homme</option>';
								echo '<option '; if($_SESSION['gender'] == "Femme") echo "selected"; echo '>Femme</option>';
							echo '</select></td></tr>'; 
					echo '<tr><td>Ann&eacute;e de naissance<span style="color : red;">*</span></td><td><input style="width : 100%;" id="birthyear" type="text" value="'.$_SESSION["birthyear"].'" ></td></tr>'; 
					echo '<tr><td>Code postal<span style="color : red;">*</span></td><td><input style="width : 100%;" id="postalcode" type="text" value="'.$_SESSION["postalcode"].'" ></td></tr>'; 
					echo '<tr><td>Ville</td><td><input style="width : 100%;" id="ville" type="text" value="'.$_SESSION["ville"].'" ></td></tr>'; 
					echo '<tr><td>Adresse</td><td><input style="width : 100%;" id="address" type="text" value="'.$_SESSION["address"].'" ></td></tr>'; 
					echo '<tr><td>N° téléphone</td><td><input style="width : 100%;" id="tel" type="tel" value="'.$_SESSION["tel"].'" ></td></tr>'; 
					echo '<tr><td>Activit&eacute;</td><td>
							<select style="width : 100%;" id="job">';
								echo '<option '; if($_SESSION['activite'] == "Agriculteur" ) echo "selected"; echo '>Agriculteur</option>';
								echo '<option '; if($_SESSION['activite'] == "Artisan") echo "selected"; echo '>Artisan</option>';
								echo '<option '; if($_SESSION['activite'] == "Cadre") echo "selected"; echo '>Cadre</option>';
								echo '<option '; if($_SESSION['activite'] == "Chef d\'entreprise") echo "selected"; echo '>Chef d\'entreprise</option>';
								echo '<option '; if($_SESSION['activite'] == "Enseignant / Santé / Social") echo "selected"; echo '>Enseignant / Santé / Social</option>';
								echo '<option '; if($_SESSION['activite'] == "Employé") echo "selected"; echo '>Employé</option>';
								echo '<option '; if($_SESSION['activite'] == "Etudiant") echo "selected"; echo '>Etudiant</option>';
								echo '<option '; if($_SESSION['activite'] == "Ouvrier") echo "selected"; echo '>Ouvrier</option>';
								echo '<option '; if($_SESSION['activite'] == "Profession libérale") echo "selected"; echo '>Profession libérale</option>';
								echo '<option '; if($_SESSION['activite'] == "Retraité") echo "selected"; echo '>Retraité</option>';
								echo '<option '; if($_SESSION['activite'] == "Sans emploi") echo "selected"; echo '>Sans emploi</option>';
								echo '<option '; if($_SESSION['activite'] == "Autre") echo "selected"; echo '>Autre</option>';
							echo '</select></td></tr>';
					echo '<tr><td>Nombre d\'enfants</td><td>
							<select id="child">';
								echo '<option '; if($_SESSION['nbchild'] == 0) echo "selected"; echo '>0</option>';
								echo '<option '; if($_SESSION['nbchild'] == 1) echo "selected"; echo '>1</option>';
								echo '<option '; if($_SESSION['nbchild'] == 2) echo "selected"; echo '>2</option>';
								echo '<option '; if($_SESSION['nbchild'] == 3) echo "selected"; echo '>3</option>';
								echo '<option '; if($_SESSION['nbchild'] == 4) echo "selected"; echo '>4</option>';
								echo '<option '; if($_SESSION['nbchild'] == 5) echo "selected"; echo '>5</option>';
							echo'</select></td></tr>';
				echo '</table>';
				echo '</br>'; 
				echo '<div style="margin-bottom : -10px;"><strong>Description de votre profil :</strong></div></br>';
				echo '<textarea id="description"> '.$_SESSION["description"].'</textarea>';
				echo '</br></br><div style="text-align : center;margin-left: auto;margin-right : auto;width : 90%;"><input type="button" class="btn confirmer" onClick="setUserInfo('.$_SESSION['id'].');" value="Confirmer" ></div>'; 	
				echo '</div>';
			
			echo "</div>";
		}	
		?> 
		
		<!--SCRIPTS-->
		<script src="<?php dirname(__FILE__)?> /compte_ecoacteur/upload/js/vendor/jquery.ui.widget.js"></script>
		<script src="<?php dirname(__FILE__)?> /compte_ecoacteur/upload/js/jquery.iframe-transport.js"></script>
		<script src="<?php dirname(__FILE__)?> /compte_ecoacteur/upload/js/jquery.fileupload.js"></script>
		<script type="text/javascript">

	/*		function fbLogout() {
				FB.logout(function (response) {
					//when logged out
					window.location="compte_ecoacteur/destructionSession.php";
				});
			}
		*/	
			$(function () {
				'use strict';
				var url = 'compte_ecoacteur/upload/server/php/';
				$('#fileupload').fileupload({
					url: url,
					dataType: 'json',
					done: function (e, data) {
						$.each(data.result.files, function (index, file) {
							$('<p/>').text(file.name).appendTo('#files');
						});
					},
					progressall: function (e, data) {
						var progress = parseInt(data.loaded / data.total * 100, 10);
						$('#progress .bar').css(
							'width',
							progress + '%'
						);
					},
					complete: function(){
						//location.reload(); 
						$("#userimage").attr('src',"iphone/usersImages/"+document.getElementById("iduser").value +".png");
					}
				});
			});


		</script>
		<style>	
			
		td{
			font-weight : bold;
		}
		.error{
			color : red;
		}	

		</style>
	</body>
</html>

