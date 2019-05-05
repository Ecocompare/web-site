<h1>Modifier commentaire</h1>
<div>
	<form action="<?=$GLOBALS['base']?>/comments/update" method="post" enctype="multipart/form-data">
	
		<input type="hidden" name="id" value="<? echo $this->getFormValue('id') ?>"/>
		<input type="hidden" name="productid" value="<?=$this->getFormValue('productid')?>"/>
		<input type="hidden" name="returnurl" value="<?=req('returnurl')?>"/>
		
		<div class="formsection" id="section1">
			<div class="fieldlabel">
				Nom :
			</div>
			<div class="fieldcontent">
				<input type="text" name="name" value="<?=stripSlashes(encodeQuotes($this->getFormValue('name')))?>"/>
			</div>
			
			<div class="fieldlabel">
				Email :
			</div>
			<div class="fieldcontent">
				<input type="text" name="email" value="<?=stripSlashes(encodeQuotes($this->getFormValue('email')))?>"/>
			</div>
			
			<div class="fieldlabel">
				Commentaire :
			</div>
			<div class="fieldcontent">
				<textarea name="text"><? echo stripSlashes($this->getFormValue('text')) ?></textarea>
			</div>
				
		</div>
		<div class="formbuttons">
			<input type="submit" value="Enregistrer"/> ou <a href="<?=req('returnurl')?>#comment<?=$this->getFormValue('id')?>">Annuler</a>
		</div>
	</form>
</div>