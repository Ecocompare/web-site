<!-- SECTION 6 SANTE -->		
		<h3>Santé (score idéal : <? global $db; echo $db->getTypeMax($this->type_id,2,0); ?>) </h3>
			
			
		<div class="fieldlabel">
				Critères :
			</div>
			<div class="fieldcontent">
			<? if ($this->type_id >0)  $this->displaySubratings($this->type_id, 2,0 ); 
				else echo 'Sélectionnez le type du produit sur l\'onglet GENERAL';
				?>
				
			</div>
			

			
				<div>	
			<input type="hidden" name="rating2" id="rating2" value="<?= $this->getFormValue('rating2') ?>"  style="width: 32px"/>
			</div>
			
			<div class="fieldlabel<?=$this->hasChanged('rating1comment') ?>">
				Commentaire :
			</div>
			<div class="fieldcontent">
				<textarea name="rating1comment"><? echo stripSlashes($this->getFormValue('rating1comment')) ?></textarea>
			</div>
