<!-- SECTION 4 ETHIQUE -->		
		
		
		<? global $db; if ($this->equitable_sud=='true') { ?>
		
			<h3>Equitable pays NORD/SUD (score idéal :  <? echo $db->getTypeMax($this->type_id,6,0); ?>) </h3>
		<?} else { ?>
					<h3>Equitable pays NORD/NORD (score idéal :  <? echo $db->getTypeMax($this->type_id,7,0); ?>) </h3>
		<? }
						
			if ($this->type_id >0) {	?>
				
			<div class="fieldlabel">
				Critères :
			</div>
			<div class="fieldcontent">
			
			
			<? // on affiche liste NN ou NS selon si coché
				if ($this->equitable_sud=='true') $this->displaySubratings(0, 6,0 );	else  $this->displaySubratings($this->type_id, 7,0 ); ?>
			
			</div>
			
			
			<div>	
			<input type="hidden" name="rating6" id="rating6" value="<?= $this->getFormValue('rating6') ?>"  style="width: 32px"/>
			</div>
			
			<div class="fieldlabel<?=$this->hasChanged('rating6comment') ?>">
				Commentaire :
			</div>
			<div class="fieldcontent">
			<textarea name="rating6comment"><? echo stripSlashes($this->getFormValue('rating6comment')) ?></textarea>

			</div>
			<div>
			<? }	else { 	if (!$this->type_id >0)  echo 'Sélectionnez le type du produit sur l\'onglet GENERAL <br/>';
							
				}
				?>
				<br/>&nbsp;
			</div>	