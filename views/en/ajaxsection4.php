<!-- SECTION 5 ENVIRONNEMENT -->		
		
			
		<?php global $db;
		foreach ($this->lifeCycles as $key=>$lifeCycle) { ?>
		
		<h3><?=$lifeCycle['name']?> (ideal score : <?echo $db->getTypeMax($this->type_id,1,$lifeCycle['id']); ?>) </h3>
		
		<div class="fieldlabel">
				Criteria :
			</div>
			<div class="fieldcontent">
				<? if ($this->type_id >0)  $this->displaySubratings($this->type_id, 1,$lifeCycle['id'],$this->lang); 
				else echo 'Select the kind of product on the general tab';
				?>
				
			</div>
			
	
	<? } ?>
		?>
			
			
	<div>	
			<input type="hidden" name="rating1" id="rating1" value="<?= $this->getFormValue('rating1') ?>"  style="width: 32px"/>
	</div>
			
			<div class="fieldlabel<?=$this->hasChanged('rating1comment') ?>">
				Comment :
			</div>
			<div class="fieldcontent">
				<textarea name="rating1comment"><? echo stripSlashes($this->getFormValue('rating1comment')) ?></textarea>

			</div>

			</div>


	