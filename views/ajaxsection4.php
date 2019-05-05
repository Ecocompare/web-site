<!-- SECTION 5 ENVIRONNEMENT -->		
		
			
		<?php global $db;
		foreach ($this->lifeCycles as $key=>$lifeCycle) { ?>
		
		<h3><?=$lifeCycle['name']?> (score idéal : <?echo $db->getTypeMax($this->type_id,1,$lifeCycle['id']); ?>) </h3>
		
		<div class="fieldlabel">
				Critères :
			</div>
			<div class="fieldcontent">
				<? if ($this->type_id >0)  $this->displaySubratings($this->type_id, 1,$lifeCycle['id'] ); 
				else echo 'Sélectionnez le type du produit sur l\'onglet GENERAL';
				?>
				
			</div>
			
	
	<? } ?>
		?>
			
			
	<div>	
			<input type="hidden" name="rating1" id="rating1" value="<?= $this->getFormValue('rating1') ?>"  style="width: 32px"/>
	</div>
			
			<div class="fieldlabel<?=$this->hasChanged('rating1comment') ?>">
				Commentaire :
			</div>
			<div class="fieldcontent">
				<textarea name="rating1comment"><? echo stripSlashes($this->getFormValue('rating1comment')) ?></textarea>

			</div>

			</div>


	