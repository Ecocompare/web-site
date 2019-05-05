<h1>
Modifier mot de passe
</h1>
<div>
	<form action="<?=$GLOBALS['base']?>users/updatePassword" method="post" enctype="multipart/form-data">
	
		
		<div class="formsection" id="section1">
			<input type="hidden" name="returnurl" value="<?=$this->formValues['returnurl']?>">
			<div class="fieldlabel">
				Nouveau mdp :
			</div>
			<div class="fieldcontent">
				<input type="input" name="password" value=""/>
			</div>
			
		</div>
		<div class="formbuttons">
			<input type="submit" value="Enregistrer"/>
		</div>
	</form>
</div>