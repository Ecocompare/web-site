<h1>Connectez vous</h1>
<div>
	<form action="login?action=login" method="post" enctype="multipart/form-data">		
		<div class="formsection" id="section1">

			<div class="fieldlabel">
				Email :
			</div>
			<div class="fieldcontent">
				<input type="text" name="email"/>
			</div>

			<div class="fieldlabel">
				Mot de passe :
			</div>
			<div class="fieldcontent">
				<input type="password" name="password"/><br/>
				Mot de passe perdu ou oublié ? <a href="/login?action=lost">Cliquez ici</a>.
			</div>
				
		</div>
		<div class="formbuttons">
			<input type="submit" value="Connecter"/>
		</div>
	</form>
</div>