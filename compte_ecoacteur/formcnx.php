<html>
	<head>
	    <script type="text/javascript" src="../js/jquery-1.8.2.min.js"></script>
	    <script type="text/javascript" src="connexion.js"></script>
	    <script type="text/javascript" src="account.js"></script>
		<link rel="stylesheet" href="css/formulairecx.css">		
		
	</head>
	<body>
	
		<!-- DEBUT FACEBOOK SDK -->
		<div id="fb-root"></div>
		<script>
			window.fbAsyncInit = function() {
			// init the FB JS SDK
			FB.init({
				appId      : '599412283425840',                        // App ID from the app dashboard
				channelUrl : 'http://www.ecocompare.com/compte_ecoacteur/formcnx.php', // Channel file for x-domain comms
				status     : true,                                 // Check Facebook Login status
				xfbml      : true                                  // Look for social plugins on the page
			});

			// Additional initialization code such as adding Event Listeners goes here
			};

			// Load the SDK asynchronously
			(function(d, s, id){
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) {return;}
				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.net/fr_FR/all.js";
				//window.open("//connect.facebook.net/fr_FR/all.js","nom_popup","menubar=no, status=no, scrollbars=no, menubar=no, width=200, height=100");
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		</script>
		<!-- FIN FACEBOOK SDK -->

	<div id="contenu_page">
	    <div class="titre">Connexion</div>
	   
		<div class="formulairecnx" >   
	
			
			<span id="msgerreur" style="color : red;"></span></br>
			<div>Connectez vous avec vos identifiants Ecocompare : </div></br>
			<input placeholder='Adresse email' type="text" id="mail" /> </br>
			<input placeholder="Mot de passe" type="password" id="pwd" />
			
			</br><a href="#" onClick="mdp_oublie();" style="margin-right:-80px;text-align : right;">Mot de passe oubli&eacute; ? </a></br></br>
			
			<?

			if (isset($_GET['url'])){
				$url = explode("/", $_GET['url']);
			?>
				<input type="button" class="classique" value="Connexion" onClick="checkUser('<?=$url[2]?>');" />
			<?
			}
			else{
			?>
				<input type="button" class="classique" value="Connexion" onClick="checkUser();" />
			<?
			}
			?>
			

			<div class="line"></div>
			
			<div>Ou avec vos identifiants Facebook : </div></br>
					
			<a id='fconnect' class="btn btn-block btn-large btn-facebook" href="javascript:void(0)" onclick="">Connexion avec Facebook</a>
			</br></br></br>					
	
			<a class="lieninscription" href="forminscription.php" style="font-size : 16px;text-align : left;margin-left:-110px;">Pas encore de compte &eacute;co-acteur ? </a>	
	</br>
		</div>
	</div>	
	
	<div id="mail_mdp" style="display : none;">
		<div class="titre">Mot de passe oublié</div>
		<div class="formulairecnx" >   	
			<div class="error"></div><div class="ok"></div>
			</br></br><div>Veuillez renseigner votre adresse email afin que nous puissions vous envoyer un nouveau mot de passe.</div></br></br>
			<div><input id='email'  placeholder='Adresse email' type="email" style="width : 300px;"/></div>
			<div><input class="envoimdp" type='button' value='Valider'/></div>
		</div>
	</div>

		<script type="text/javascript">
		
			$("#fconnect").click(function() {
				FB.login(function(response) {
					if (response.authResponse){
					  //L'utilisateur a autorisé l'application
						FB.api('/me', function(me){
							console.log(me);
							checkUserFacebook(me);
						});	

					} else {
						//L'utilisateur n'a pas autorisé l'application
					};
				}, {scope: 'email'});
			});
			
			$('.envoimdp').click(function(){
				resetUserPassword();
				//	return false;
			});
			
			function mdp_oublie(){
				var conteneur = document.getElementById("contenu_page");
				var conteneur2 = document.getElementById("mail_mdp");
				conteneur.style.display = "none";
				conteneur2.style.display = "block";
			}

		</script>
	
		
		
	</body>
</html>