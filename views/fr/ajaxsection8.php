<!-- SECTION 4 ETHIQUE -->		
			<h3>Ethique (score idéal : <? global $db; echo $db->getTypeMax($this->type_id,5,0); ?>) </h3>
			
		<div class="fieldlabel">
				Critères :
			</div>
			<div class="fieldcontent">
			<? if ($this->type_id >0)  $this->displaySubratings($this->type_id, 5,0,$this->lang ); 
				else echo 'Sélectionnez le type du produit sur l\'onglet GENERAL';
				?>
				
			</div>
			
			
			
			<div>	
			<input type="hidden" name="rating5" id="rating5" value="<?= $this->getFormValue('rating5') ?>"  style="width: 32px"/>
			</div>
			
			<div class="fieldlabel<?=$this->hasChanged('rating1comment') ?>">
				Commentaire :
			</div>
			<div class="fieldcontent">
				<textarea name="rating1comment"><? echo stripSlashes($this->getFormValue('rating1comment')) ?></textarea>

			</div>

