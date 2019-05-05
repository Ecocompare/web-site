	<html>
	<head>
	<script type="text/javascript" src="../js/jquery-1.8.2.min.js"></script>
	    <!--<script type="text/javascript" src="function.js"></script>-->
	    <script type="text/javascript" src="connexion.js"></script>

	</head>
	<body>
	
		<!-- DEBUT FACEBOOK SDK -->
		<div id="fb-root"></div>
		<script>
			window.fbAsyncInit = function() {
			// init the FB JS SDK
			FB.init({
				appId      : '599412283425840',                        // App ID from the app dashboard
				channelUrl : 'http://www.ecocompare.com/compte_ecoacteur/connexion.php', // Channel file for x-domain comms
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

		</br></br>
		
		<a href="formConnexionClassique.php">Connexion classique</a></br>
		<div id='fconnect'>Connexion Facebook</div>
		<div onCLick="fbLogout();"> deconnexion Facebook </div></br></br>
		
		<a href="formInscriptionClassique.php">Inscription classique</a></br>
		<div id='finscription'>Inscription Facebook</div>
<!--		<div onCLick="fbLogout();"> deconnexion Facebook </div>-->
		
		
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

			
			$("#finscription").click(function() {
				FB.login(function(response) {
					if (response.authResponse){
					  //L'utilisateur a autorisé l'application
						FB.api('/me', function(me){
						//	console.log(me);
							checkUserFacebook(me);
						});	
					} else {
						//L'utilisateur n'a pas autorisé l'application
					};
				}, {scope: 'email'});
			});		
			

			
			function fbLogout() {
				FB.logout(function (response) {
					//Do what ever you want here when logged out like reloading the page
					window.location.reload();
				});
			}
			
		</script>

	</body>
</html>


