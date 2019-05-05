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
		
	<div class="formsection" id="section1">
	<form action="labels?action=<? echo $this->targetAction; ?>" method="post" >
	
		<input type="hidden" name="id" value="<? echo $this->getFormValue('id') ?>"/>

			<div class="fieldlabel">
				Image 16x16:
			</div>
			<div class="fieldcontent">
				<img alt="<?=$this->getFormValue('name')?>" src="<?=$GLOBALS['base']?>images/labels_16/<?=$this->getFormValue('image')?>">
			</div>
			
			<div class="fieldlabel">
				Image 100x100:
			</div>
			<div class="fieldcontent">
				<img alt="<?=$this->getFormValue('name')?>" src="<?=$GLOBALS['base']?>images/labels_100/<?=$this->getFormValue('image')?>">
			</div>
			
			<div class="fieldlabel">
				Fichier image :
			</div>
			<div class="fieldcontent">
					<input type="text" name="image" value="<? echo htmlspecialchars(stripSlashes($this->getFormValue('image'))) ?>"/>
			</div>
			
			<div class="fieldlabel">
				Nom :
			</div>
			<div class="fieldcontent">
					<input type="text" name="name" value="<? echo htmlspecialchars(stripSlashes($this->getFormValue('name'))) ?>"/>
			</div>
			
				<div class="fieldlabel">
				Référentiel :
			</div>
			<div class="fieldcontent">
					<input type="text" name="referentiel" value="<? echo htmlspecialchars(stripSlashes($this->getFormValue('referentiel'))) ?>"/>
			</div>
			<div class="fieldlabel">
				Version :
			</div>
			<div class="fieldcontent">
				<textarea name="version" style="height:40px;"><? echo htmlspecialchars(stripSlashes($this->getFormValue('version'))) ?></textarea>
			</div>
			
			<div class="fieldlabel">
				Description :
			</div>
			<div class="fieldcontent">
				<textarea name="description" style="height:80px;"><? echo htmlspecialchars(stripSlashes($this->getFormValue('description'))) ?></textarea>
			</div>
			
		<?php if (count($this->formValues['types'])  > 0 ) { ?>
		<div class="fieldlabel">
				Types de produits :
			</div>
			<div class="fieldcontent">
				
				<?php foreach ($this->formValues['types'] as $key=>$type) {	?>
				<?=$type['name']?> <? if ($key < count($this->formValues['types']) -1){ echo ', ';} ?>
			<?php } ?>
	
			</div>
		<?php } ?>
		
	<?php if (count($this->formValues['criterias'])  > 0 ) { ?>
		<div class="fieldlabel">
				Critères impactés :
			</div>
			<div class="fieldcontent">
					<table border="0" style="	border: 1px solid #c4c4c4;border-style: solid;vertical-align: top;">
				<?php foreach ($this->formValues['criterias'] as $key=>$critere) {	?>
			<tr style="	border: 1px solid #c4c4c4;border-style: solid;vertical-align: top;"><td> <?=$critere['theme']?> </td><td>  <?=$critere['lifecycle']?> </td><td>  <?=$critere['name']?> </td>
				<td><?=$critere['value']?></td>
				<td>
				<a href="javascript: deleteSubratingLabel(<? echo $critere['id'] ?>,<? echo $this->getFormValue('id') ?>)" alt="Supprimer"><img src="<?=$GLOBALS['base']?>style/delete.gif" alt="Supprimer"/></a>
				</td>
				</tr>
			<?php } ?>
		</table>
			</div>
		<?php } ?>
			
		
		<div class="formbuttons">
			<input type="submit" value="Enregistrer"/> ou <a href="labels?action=admin">Annuler</a>
		</div>
	</form>
	
</div>

<!-- AJOUT CRITERE -->
	<div class="formsection" id="section1">
	<form action="labels?action=addLabelCriteria" method="post" >
	
	<input type="hidden" name="labelId" value="<? echo $this->getFormValue('id') ?>"/>

			<script type="text/javascript">
				
			$(document).ready(function(){ 

			$("#lien").click(function () {
      $("#cat").slideToggle("slow");
   		 });
  		});
      </script>
     	<div class="fieldlabel">
      	<a class="cursor" id='lien'><img border="0" src="<?=$GLOBALS['base']?>style/expand.png"/><strong> Ajouter critère</strong></a>
      	<br/>&nbsp;
    	</div>
    	
			<div  style="display:none;margin-left:-30px;" id="cat" class="opendetail">
						
				<div class="fieldlabel">
					Critère :
				</div>		
				<div class="fieldcontent">
				<select name="criteriaid">
					<? foreach ($this->subratings as $key=>$subrating) { 
						$tailleMax=92-8-strlen($subrating['lifecycle']);
						?>
					
					<option value="<?=$subrating['id']?>"><?=substr($subrating['theme'],0,8);?>-<?=substr($subrating['lifecycle'],0,25);?>-<?=substr($subrating['name'],0,$tailleMax);?></option>
				
			<? } ?>
		</select>		
		</div>
			<div class="fieldlabel">
				Valeur :
			</div>		
			<div class="fieldcontent">
			<input type="text" name="value" value=""/>
			</div>

			<div class="formbuttons" style="margin-left:20px;">
			<input type="submit" value="Ajouter"/> 
			</div>	
			</div>	
			
			
		
		
			</div>
			
					
			
				
			
</form>
</div>

