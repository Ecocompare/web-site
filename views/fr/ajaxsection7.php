<!-- SECTION 8 SOCIAL -->		
				<h3>Social (score idéal : <? global $db; echo $db->getTypeMax($this->type_id,4,0); ?>) </h3>
			
			<div class="fieldlabel">
				Critères :
			</div>
			<div class="fieldcontent">
			<? if ($this->type_id >0)  $this->displaySubratings($this->type_id, 4,0,$this->lang ); 
				else echo 'Sélectionnez le type du produit sur l\'onglet GENERAL';
				?>
				
			</div>
			
			
			
			<div>	
			<input type="hidden" name="rating4" id="rating4" value="<?= $this->getFormValue('rating4') ?>"  style="width: 32px"/>
			</div>
			
			<div class="fieldlabel<?=$this->hasChanged('rating4comment') ?>">
				Commentaire :
			</div>
			<div class="fieldcontent">
				<textarea name="rating1comment"><? echo stripSlashes($this->getFormValue('rating4comment')) ?></textarea>

			</div>


