<html>
	<head>
	    <script type="text/javascript" src="../js/jquery-1.8.2.min.js"></script>
	    <script type="text/javascript" src="connexion.js"></script>
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
				channelUrl : 'http://www.ecocompare.com/compte_ecoacteur/forminscription.php', // Channel file for x-domain comms
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
	
	
	    <div class="titre">Inscription</div>
	   	<div style="color : #83a725;">En créant un compte vous devenez éco-acteur. Ce mode vous permet de contribuer à notre démarche et de gagner des cadeaux.</div>			
		
		<div class="formulairecnx" >   
	
	
			<span id="msgerreur" style="text-align :left;color : red;"></span></br>
			<div>Inscrivez vous avec vos identifiants Ecocompare : </div></br>
			<input placeholder='Adresse email' type="text" id="mail" /> </br>
			<input placeholder="Mot de passe" type="password" id="pwd" />
</br>
			<input type="button" class="classique" value="Inscription" onClick="inscriptionClassique();" />

			<div class="line"></div>
			
			<div>Ou avec vos identifiants Facebook : </div></br>
					
			<a id='fconnect' class="btn btn-block btn-large btn-facebook" href="javascript:void(0)" onclick="">Inscription avec Facebook</a>
			</br></br></br>					
	</div>
		
	
			</body>
</html>



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
			
		
		</script>
	
		
		