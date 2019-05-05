<html>
	<head>
	    <script type="text/javascript" src="connexion.js"></script>
	    <script type="text/javascript" src="../js/jquery-1.8.2.min.js"></script>
	
	</head>
	<body>
	
		
		<?php
	/*	if(isset($_POST["mail"])&&isset($_POST["pwd"])){
			echo"Vous allez être d&eacute;connect&eacute;, un lien de confirmation va vous être envoy&eacute;.
				</br>Suivez ce lien pour valider votre compte.</br></br>
				Si vous n'avez pas reçu de mail, cliquez <a href='' > ici </a> pour l'envoi d'un nouveau mail.";
		}else{
	*/	?>
			
			<div id="msgerreur" style="color : red;"></div></br>
			<label>Devenir &eacute;co-acteur</label></br>
			<label>Adresse email : </label><input type="text" id="mail" /> </br>
			<label>Mot de passe : </label><input type="password" id="pwd" />

			</br></br>
			<input type="button" onClick="inscriptionClassique();" value="s'enregistrer" /></br>
			</br>
			
	</body>
</html>