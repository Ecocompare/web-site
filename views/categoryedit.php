<h1>
<?php
	if ($GLOBALS['action'] == "edit"){
		echo "Modifier ".stripSlashes($this->getFormValue('name'));
	}else {
		echo "Ajouter une catégorie";
	}
?>
</h1>
<div>
	<form action="categories?action=<? echo $this->targetAction; ?>" method="post" enctype="multipart/form-data">
	
		<input type="hidden" name="id" value="<? echo $this->getFormValue('id') ?>"/>
		
		<div class="formsection" id="section1">

			<div class="fieldlabel">
				Nom :
			</div>
			<div class="fieldcontent">
				<input type="text" name="name" value="<? echo stripSlashes($this->getFormValue('name')) ?>"/>
			</div>
			
			<div class="fieldlabel">
				Catégorie parente :
			</div>
			<div class="fieldcontent">
				<select name="parentid">
					<option value="0" name="parentid">Racine</option>
					<? $this->showOptions($this->getFormValue('parentid'), 1); ?>
				</select>
			</div>
			
			<div class="fieldlabel">
				Texte d'intro :
			</div>
			<div class="fieldcontent">
				<textarea name="text"><? echo stripSlashes($this->getFormValue('text')) ?></textarea>
			</div>
				
		</div>
		<div class="formbuttons">
			<input type="submit" value="Enregistrer"/> ou <a href="categories?action=admin">Annuler</a>
		</div>
	</form>
</div>