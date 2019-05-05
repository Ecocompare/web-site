<!-- SECTION 6 SANTE -->		
		<h3>Health (ideal score : <? global $db; echo $db->getTypeMax($this->type_id,2,0); ?>) </h3>
			
			
		<div class="fieldlabel">
				Criteria :
			</div>
			<div class="fieldcontent">
			<? if ($this->type_id >0)  $this->displaySubratings($this->type_id, 2,0,$this->lang ); 
				else echo 'Select the kind of product on the general tab';
				?>
				
			</div>
			

			
				<div>	
			<input type="hidden" name="rating2" id="rating2" value="<?= $this->getFormValue('rating2') ?>"  style="width: 32px"/>
			</div>
			
			<div class="fieldlabel<?=$this->hasChanged('rating1comment') ?>">
				Comment :
			</div>
			<div class="fieldcontent">
				<textarea name="rating1comment"><? echo stripSlashes($this->getFormValue('rating1comment')) ?></textarea>
			</div>
