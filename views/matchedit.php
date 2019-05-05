<h1>
<?php
	if ($GLOBALS['action'] == "edit"){
		echo "Modifier un match";
	}else {
		echo "Ajouter un match";
	}
?>
</h1>
<div>
	<form action="<?=$GLOBALS['base']?>matches/<? echo $this->targetAction; ?>" method="post" enctype="multipart/form-data">
	
		<input type="hidden" name="id" value="<? echo $this->getFormValue('id') ?>"/>
		
		<div class="formsection" id="section1">

			<div class="fieldlabel">
				Titre :
			</div>
			<div class="fieldcontent">
				<input type="text" name="title" value ="<?=$this->getFormValue('title')?>" />
			</div>

			<div class="fieldlabel">
				Into :
			</div>
			<div class="fieldcontent">
				<textarea name="intro"><? echo stripSlashes($this->getFormValue('intro')) ?></textarea>
			</div>

			<div class="fieldlabel">
				Conclusion :
			</div>
			<div class="fieldcontent">
				<textarea name="conclusion"><? echo stripSlashes($this->getFormValue('conclusion')) ?></textarea>
			</div>

			<div class="fieldlabel">
				Sélection :
			</div>
			<div class="fieldcontent">
				<div class="scrollpane">
				<? foreach($this->products as $key=>$product){ ?>
					<? 
						if (is_array($this->getFormValue('productids')) && in_array($product['id'], $this->getFormValue('productids'))){
							$checked = " checked";
						}else{
							$checked = '';
						}
					?>
					<input name="productids[]" value="<?=$product['id']?>" type="checkbox" <?=$checked?> /> <?=$product['name']?> <br/>
				<? } ?>
				</div>
			</div>

		</div>
		<div class="formbuttons">
			<input type="submit" value="Enregistrer"/> ou <a href="categories?action=admin">Annuler</a>
		</div>
	</form>
</div>