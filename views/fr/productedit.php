<h1>
<?php
	if ($GLOBALS['action'] == "edit"){
		echo "Modifier ".stripSlashes($this->getFormValue('name'));
	}else if ($GLOBALS['action'] == "propose"){
		echo "Proposer un produit";
	}else {
		echo "Ajouter un produit";
	}
?>
</h1>
<div align="justify">
Cet écran vous permet d'enregistrer toutes les informations liées à un produit.
Pensez à bien renseigner TOUS les onglets et à enregistrer vos informations fréquemment (au moins toutes les 20mn).<br/><br/> 
</div>
<div>
	<form name="formulaire" action="<?=$GLOBALS['base']?>products/<?=$this->targetAction?>/" method="post" id="form" enctype="multipart/form-data">
	
		<input type="hidden" name="id" value="<? echo $this->getFormValue('id') ?>"/>
		<input type="hidden" name="returnurl" value="<?=reqOrDefault('returnurl', '/products/admin/') ?>"/>
		
		<ul class="formtabs">
			<?
				$tabs = array();
				$tabs[] = array("id"=>"1", "name"=>"Général");
				$tabs[] = array("id"=>"2", "name"=>"Catégories");
				$tabs[] = array("id"=>"3", "name"=>"Présentation");
				$tabs[] = array("id"=>"4", "name"=>"Environnement");
				$tabs[] = array("id"=>"5", "name"=>"Santé");
				$tabs[] = array("id"=>"6", "name"=>"Qualité");
				$tabs[] = array("id"=>"7", "name"=>"Social");
				$tabs[] = array("id"=>"8", "name"=>"Ethique");
				$tabs[] = array("id"=>"9", "name"=>"Equitable");
				foreach($tabs as $key=>$tab){ ?>
					<li id="tab<?=$tab['id']?>"><a onclick="switchFormSection('<?=$tab['id']?>')">
						<?=$tab['name']?>
					<? if ($this->getFormValue('id')>0 && $db->isfeedback($tab['id']-3,$this->getFormValue('id'))) {?> <img src="<?=$GLOBALS['base']?>images/warning.png" alt="remarque importante ecocompare"/>
						
					<?}?>
						</a></li>
					<?} ?>
			
		</ul>

<!-####################### GENERAL ######################### -->
		<div class="formsection" id="section1">
			<div class="fieldlabel<?=$this->hasChanged('contact') ?>">
				Votre email :
			</div>
			<div class="fieldcontent">
				<input type="text" id="useremail" name="contact" value="<? echo encodeQuotes(stripSlashes($this->getFormValue('contact'))) ?>"/>

			(obligatoire)
			</div>

				<!--input type="hidden" id="useremail" name="contact" value="<? echo encodeQuotes(stripSlashes($this->getFormValue('contact'))) ?>"/-->
			<div class="fieldlabel<?=$this->hasChanged('image') ?>">
				Image produit : <br/> (image carrée SVP, 200ko maxi)
			</div>
			<div class="fieldcontent">
				<input type="hidden" id="fileaction" name="fileaction" value="upload"/>
				<div id="fileinput">
					 <input type="hidden" name="MAX_FILE_SIZE" value="800000" />
					<input type="file" name="image">
					<? if (strlen($this->getFormValue('image')) > 0){ ?> | <a href="javascript:hideFileInput()">Annuler</a><? } ?>
				</div>
				<div id="filestatus">
					<img src="<?=$GLOBALS['base']?>products?action=showImage&size=thumb&id=<? echo $this->getFormValue('id'); ?>" />
					<? echo $this->getFormValue('image') ?> | <a href="javascript:showFileInput()">Modifier</a>
				</div>
				<script>
					<? if (strlen($this->getFormValue('image')) == 0){ ?>
						showFileInput();
					<? }else{ ?>
						hideFileInput();
					<? } ?>
				</script>
			</div>

			<div class="fieldlabel<?=$this->hasChanged('name') ?>">
				Nom produit :
			</div>
			<div class="fieldcontent">
				<input type="text" name="name" value="<? echo encodeQuotes(stripSlashes($this->getFormValue('name'))) ?>"/>
			</div>

			<div class="fieldlabel<?=$this->hasChanged('brand') ?>">
				Marque :
			</div>
			<div class="fieldcontent">
				<input type="text" name="brand" value="<? echo encodeQuotes(stripSlashes($this->getFormValue('brand'))) ?>"/>
			</div>

			<div class="fieldlabel">
				Type de produit :
			</div>
			<div class="fieldcontent">
				<select id="typeid" name="typeid" onChange="loadRules(<?=$this->getFormValueDefault('id', '0') ?>,this.options[this.options.selectedIndex].value, this.form.equitable_sud.checked)">
					<option value="0">Aucun</option>
					<? foreach($this->types as $key=>$type) { ?>
						<option value="<?=$type['id']?>" <? if($this->getFormValue('typeid') == $type['id']) echo "selected"?> /><?=$type['name']?></option>
					<? } ?>
				</select>
			</div>
			
				<div class="fieldlabel">
				Commerce équitable :
			</div>
			<div class="fieldcontent">
				<input type="checkbox" onChange="check_equitable(<?=$this->getFormValueDefault('id', '0') ?>,this.form.typeid.options[this.form.typeid.options.selectedIndex].value, this.form.equitable_sud.checked)" name="equitable_sud" <? if($this->getFormValue('equitable_sud') ==1) echo "checked"?> />  Faites vous appel à des fournisseurs des pays du Sud (non OCDE) dans le cadre de la fabrication de ce produit?
			</div>
			
			<? if (admin() && $this->targetAction != 'submit') { ?>

			<div class="fieldlabel">
				Compte utilisateur :
			</div>
			<div class="fieldcontent">
				<select name="userid">
					<option value="0">Aucun</option>
					<? foreach($this->users as $key=>$user) { ?>
						<option value="<?=$user['id']?>" <? if($this->getFormValue('userid') == $user['id']) echo "selected"?> /><?=$user['username']?></option>
					<? } ?>
				</select>
			</div>
			<? } ?>

			<div class="fieldlabel<?=$this->hasChanged('tags') ?>">
				Tags :
			</div>
			<div class="fieldcontent">
				<input type="text" name="tags" value="<? echo encodeQuotes(stripSlashes($this->getFormValue('tags'))) ?>"/>
			</div>
			
			
			<? if (admin() && $this->targetAction != 'submit' && $this->getFormValue('published') != 'submission') { ?>
			
			<div class="fieldlabel">
				Publication :
			</div>
			<div class="fieldcontent">
				<input type="radio" name="published" value="submission" <? if ($this->getFormValue('published') == "submission"){ echo 'checked'; } ?> /> Proposition
				
				<input type="radio" name="published" value="deactivated" <? if ($this->getFormValue('published') == "deactivated"){ echo 'checked'; } ?> /> Désactivée
				<input type="radio" name="published" value="saved" <? if ($this->getFormValue('published') == "saved"){ echo 'checked'; } ?> /> Brouillon


				<input type="radio" name="published" value="true" <? if ($this->getFormValue('published') == "true"){ echo 'checked'; } ?> /> Publiée

			</div>
			
			<? } ?>


			<div class="fieldlabel<?=$this->hasChanged('EAN') ?>">
				Codes EAN :
			</div>
			<div class="fieldcontent">
				<input type="text" name="EAN" value="<? echo encodeQuotes(stripSlashes($this->getFormValue('EAN'))) ?>"/><br/>
				Si plusieurs, séparer par des virgules
			</div>
			
			<!- ##################### LABEL -->
		
			
		
			<div class="fieldlabel<?=$this->hasChanged('labels') ?>"  >
				Label(s) :
			</div>
			<div class="fieldcontent" id="sectionlabel">
				<? $this->labelCtrl->showCheckboxesType($this->getFormValue('labels'),$this->getFormValue('typeid')); ?>
			</div>

		
		
			<div class="fieldlabel<?=$this->hasChanged('co2') ?>">
				Emissions CO2 :
			</div>
			<div class="fieldcontent">
				<input type="text" name="co2" value="<? echo encodeQuotes(stripSlashes($this->getFormValue('co2'))) ?>"/>
			</div>

			<div class="fieldlabel<?=$this->hasChanged('price') ?>">
				Prix :
			</div>
			<div class="fieldcontent">
				<input type="text" name="price" value="<? echo encodeQuotes(stripSlashes($this->getFormValue('price'))) ?>"/>
			</div>

			<div class="fieldlabel<?=$this->hasChanged('findit') ?>">
				Ou le trouver :
			</div>
			<div class="fieldcontent">
				<textarea name="findit"><? echo stripSlashes($this->getFormValue('findit')) ?></textarea>
				Exemple : Sur notre site (http://www.notresite.fr)
			</div>

			<!--div class="fieldlabel<?=$this->hasChanged('related') ?>">
				Dossier(s) conseil :
			</div>
			<div class="fieldcontent">
				<textarea name="related"><? echo stripSlashes($this->getFormValue('related')) ?></textarea>
				Lien : &lt;a href="http://www.ecocompare.com/adresse-dossier"&gt;Nom du dossier&lt;/a&gt;
			</div-->


	

		</div>

<!-####################### CATEGORIES ######################### -->
		<div class="formsection" id="section2">

			<div class="fieldlabel<?= $this->hasChanged('categories') ?>">
				Catégories :
			</div>
			<div class="fieldcontent">
				<?
					$this->categoryCtrl->showCheckboxes($this->getFormValue('categories'));
				?>
			</div>

			
		</div>

<!-####################### DESCRIPTION ######################### -->
		<div class="formsection" id="section3">
			<div class="fieldlabel<?=$this->hasChanged('description') ?>">
				Description :
			</div>
			<div class="fieldcontent">
				<textarea name="description"><? echo stripSlashes($this->getFormValue('description')) ?></textarea>
			</div>

			<div class="fieldlabel<?=$this->hasChanged('facts') ?>">
				Infos vérité :
			</div>
			<div class="fieldcontent">
				<textarea name="facts" class="ratingcomment"><? echo stripSlashes($this->getFormValue('facts')) ?></textarea>
			</div>
			
			<? if (admin()){ ?>
		
			<div class="fieldlabel<?=$this->hasChanged('globalcomment') ?>">
				Commentaire ecocompare :
			</div>
			<div class="fieldcontent">
				<textarea name="globalcomment"><? echo stripSlashes($this->getFormValue('globalcomment')) ?></textarea>
			</div>
			<? } else { ?>
			<input type="hidden" name="globalcomment" value="<? echo stripSlashes($this->getFormValue('globalcomment')) ?>" />
			<?}?>

		</div>


<!-####################### ENVIRONNEMENT ######################### -->
		<div class="formsection" id="section4">
		Score actuel : <?echo $this->getProductNote($this->getFormValue('id'),1,0); ?> / 5
		
	<?php if (!$this->getFormValue('typeid')>0) { echo 'Sélectionnez le type du produit sur l\'onglet GENERAL'; }
		else {
	   foreach ($this->lifeCycles as $key=>$lifeCycle) { ?>
		

		<? //on change de couleur si produit ou emballage 
		$titre=$lifeCycle['name'];
		$pos_pdt=strpos($lifeCycle['name'], 'produit');
		$pos_emb=strpos($lifeCycle['name'], 'emballage');
		
		if ($pos_pdt!=0) $titre=substr($lifeCycle['name'],0,$pos_pdt)." <font color='#ED6C0A'> produit </font>";
		if ($pos_emb!=0) $titre=substr($lifeCycle['name'],0,$pos_emb)." <font color='#61C930'> emballage</font>";
		
		?>
		<h3><?=$titre?> (score idéal : <?echo $db->getTypeMax($this->getFormValue('typeid'),1,$lifeCycle['id']); ?>) </h3>
	
		<div class="fieldlabel">
				Critères :
			</div>
			<div class="fieldcontent">
				<? if ($this->getFormValue('typeid')>0)  $this->displaySubratings($this->getFormValue('typeid'), 1,$lifeCycle['id'] ); 
				else echo 'Sélectionnez le type du produit sur l\'onglet GENERAL';
				?>
				
			</div>
	<? } ?>
				
			

			<div>	
			<input type="hidden" name="rating1" id="rating1" value="<?= $this->getFormValue('rating1') ?>"  style="width: 32px"/>
			</div>
			
			<? if (admin()){ ?>
			<div class="fieldlabel<?=$this->hasChanged('rating1comment') ?>">
				Commentaire :
			</div>
			<div class="fieldcontent">
				<textarea name="rating1comment"><? echo stripSlashes($this->getFormValue('rating1comment')) ?></textarea>
			</div>
			<? } ?>
			
<? } ?>
		</div>

<!-####################### SANTE ######################### -->
		<div class="formsection" id="section5">

		<?php if (!$this->getFormValue('typeid')>0) { echo 'Sélectionnez le type du produit sur l\'onglet GENERAL'; }
		else { ?>

	Score actuel : <?echo $this->getProductNote($this->getFormValue('id'),2,0); ?> / 5
			<h3>Santé (score idéal : <?echo $db->getTypeMax($this->getFormValue('typeid'),2,0); ?>) </h3>
				
						
		<div class="fieldlabel">
				Critères :
			</div>
			<div class="fieldcontent">
				<? if ($this->getFormValue('typeid')>0)  $this->displaySubratings($this->getFormValue('typeid'), 2,0 ); 
				else echo 'Sélectionnez le type du produit sur l\'onglet GENERAL';
				?>
				
			</div>
			

			
		<div>	
			<input type="hidden" name="rating2" id="rating2" value="<?= $this->getFormValue('rating2') ?>"  style="width: 32px"/>
			</div>
			
			<? if (admin()){ ?>
			<div class="fieldlabel<?=$this->hasChanged('rating1comment') ?>">
				Commentaire :
			</div>
			<div class="fieldcontent">
				<textarea name="rating2comment"><? echo stripSlashes($this->getFormValue('rating2comment')) ?></textarea>

			</div>
			<? } ?>
		<? } ?>

		</div>

<!-####################### QUALITE ######################### -->
		<div class="formsection" id="section6">
		<?php if (!$this->getFormValue('typeid')>0) { echo 'Sélectionnez le type du produit sur l\'onglet GENERAL'; }
		else { ?>

		Score actuel : <?echo $this->getProductNote($this->getFormValue('id'),3,0); ?> / 5
		<h3>Qualité (score idéal : <?echo $db->getTypeMax($this->getFormValue('typeid'),3,0); ?>) </h3>
			
		<div class="fieldlabel">
				Critères :
			</div>
			<div class="fieldcontent">
				<? if ($this->getFormValue('typeid')>0)  $this->displaySubratings($this->getFormValue('typeid'), 3,0 ); 
				else echo 'Sélectionnez le type du produit sur l\'onglet GENERAL';
				?>
				
			</div>
			
			
			
		<div>	
			<input type="hidden" name="rating3" id="rating3" value="<?= $this->getFormValue('rating3') ?>"  style="width: 32px"/>
			</div>
			
			<? if (admin()){ ?>
			<div class="fieldlabel<?=$this->hasChanged('rating1comment') ?>">
				Commentaire :
			</div>
			<div class="fieldcontent">
				<textarea name="rating3comment"><? echo stripSlashes($this->getFormValue('rating3comment')) ?></textarea>
			</div>
	<? } ?>

	<? } ?>
		</div>

<!-####################### SOCIAL ######################### -->
		<div class="formsection" id="section7" <? if ($this->targetAction == 'submit') { echo 'style="display:none"'; }?> >
		
		Score actuel : <?echo $this->getProductNote($this->getFormValue('id'),4,0); ?> / 5
		
		<?php if (!$this->getFormValue('typeid')>0) { echo 'Sélectionnez le type du produit sur l\'onglet GENERAL'; }
		else { ?>
			
			<h3>Social (score idéal : <?echo $db->getTypeMax($this->getFormValue('typeid'),4,0); ?>) </h3>
			
		<div class="fieldlabel">
				Critères :
			</div>
			<div class="fieldcontent">
				<? if ($this->getFormValue('typeid')>0)  $this->displaySubratings($this->getFormValue('typeid'), 4,0 ); 
				else echo 'Sélectionnez le type du produit sur l\'onglet GENERAL';
				?>
				
			</div>
			

			
			<div>	
			<input type="hidden" name="rating4" id="rating4" value="<?= $this->getFormValue('rating4') ?>"  style="width: 32px"/>
			</div>
			
			<? if (admin()){ ?>
			<div class="fieldlabel<?=$this->hasChanged('rating1comment') ?>">
				Commentaire :
			</div>
			<div class="fieldcontent">
				<textarea name="rating4comment"><? echo stripSlashes($this->getFormValue('rating4comment')) ?></textarea>
			</div>
			<? } ?>
			<? } ?>
		</div>
		
		
<!-####################### ETHIQUE ######################### -->
		<div class="formsection" id="section8">

	
	<?php if (!$this->getFormValue('typeid')>0) { echo 'Sélectionnez le type du produit sur l\'onglet GENERAL'; }
		else { ?>
		
		Score actuel : <?echo $this->getProductNote($this->getFormValue('id'),5,0); ?> / 5
		<h3>Ethique (score idéal : <?echo $db->getTypeMax($this->getFormValue('typeid'),5,0); ?>) </h3>
			
		<div class="fieldlabel">
				Critères :
			</div>
			<div class="fieldcontent">
				<?php $this->displaySubratings($this->getFormValue('typeid'), 5,0 ); ?>
				
			</div>
			
			
		<div>	
			<input type="hidden" name="rating5" id="rating5" value="<?= $this->getFormValue('rating5') ?>"  style="width: 32px"/>
			</div>
			
			<? if (admin()){ ?>
			<div class="fieldlabel<?=$this->hasChanged('rating1comment') ?>">
				Commentaire :
			</div>
			<div class="fieldcontent">
				<textarea name="rating5comment"><? echo stripSlashes($this->getFormValue('rating5comment')) ?></textarea>
			</div>
		<? } ?>
	<? } ?>
	
		</div>
		
		<!-####################### EQUITABLE NORD/NORD OU NORD/SUD ######################### -->
		<div class="formsection" id="section9" >

	
	<?php if (!$this->getFormValue('typeid')>0) { echo 'Sélectionnez le type du produit sur l\'onglet GENERAL'; }
		else { ?>
		
		Score actuel : <? if ($this->getFormValue('equitable_sud')==1) echo $this->getProductNote($this->getFormValue('id'),6,0);  else echo $this->getProductNote($this->getFormValue('id'),7,0);?> / 5

		<? if ($this->getFormValue('equitable_sud')==1) { ?>
		
		<h3>Equitable pays NORD/SUD (score idéal :  <? echo $db->getTypeMax($this->getFormValue('typeid'),6,0); ?>) </h3>
		<?} else { ?>
					<h3>Equitable pays NORD/NORD (score idéal :  <? echo $db->getTypeMax($this->getFormValue('typeid'),7,0); ?>) </h3>
		<? } ?>
		
			
		<div class="fieldlabel">
				Critères :
			</div>
			<div class="fieldcontent">
				<?php if ($this->getFormValue('equitable_sud')==1) $this->displaySubratings(0, 6,0 ); else $this->displaySubratings($this->getFormValue('typeid'), 7,0 ); ?>
				
			</div>
			
			
		<div>	
			<input type="hidden" name="rating6" id="rating6" value="<?= $this->getFormValue('rating6') ?>"  style="width: 32px"/>
			</div>
			
			<? if (admin()){ ?>
			<div class="fieldlabel<?=$this->hasChanged('rating1comment') ?>">
				Commentaire :
			</div>
			<div class="fieldcontent">
				<textarea name="rating6comment"><? echo stripSlashes($this->getFormValue('rating6comment')) ?></textarea>
			</div>
		<? } ?>
	<? } ?>
		</div>
		<script>switchFormSection(1);</script>

		<input type="hidden" id="subaction" name="subaction" value=''/>
		<? if ($GLOBALS['action'] != "propose"){ ?>
		<div class="formbuttons">
			<input type="checkbox" id="accept" value="accepted"/> J'ai lu et accepté les <a href="<?=$GLOBALS['base']?>content/show/CGU" target=_blank>Conditions Générales d'Utilisation</a>
			<input type="hidden" name="published" value=""/>
			<br/><br/>
			<? if ($this->getFormValue('published') == 'submission' && admin()) {?>
				<input type="checkbox" name="sendmail"/> Envoyer un email au client lors de la publication<br/>
				<input type="button" onclick="checkCGUsAndSubmitForm()" value="Enregistrer"/>&nbsp;&nbsp;
				<? if (admin()){ ?>
				<input type="button" onclick="document.getElementById('subaction').value='saved'; checkCGUsAndSubmitForm();" value="Remettre en brouillon"/>&nbsp;
				
				<input type="button" onclick="document.getElementById('subaction').value='publish'; checkCGUsAndSubmitForm();" value="Enregistrer et publier"/>&nbsp;
		
				<? if ($this->nbFeedback >0) {?> <input type="button" onclick="sendFeedback(<?= $this->getFormValue('id')?>)" value="Demande de précisions"/>&nbsp; 
				
				<? }} ?>
				ou <a href="javascript:history.go(-1)">Annuler</a>
			<? } else { ?>
				<input type="button" onclick="this.form.published.value='saved';checkCGUsAndSubmitForm()" value="Enregistrer"/>		
				<? if (company() && $this->getFormValue('published') != 'true') { ?>
				<input type="button" onclick="this.form.published.value='submission';checkCGUsAndSubmitForm()" value="Soumettre"/>
				<? } ?>		
				
				
				ou <a href="javascript:history.go(-1)">Annuler</a>
			<? } ?>
		</div>
		<? }else{ ?>
		<div class="formbuttons">
			<input type="checkbox" id="accept" value="accepted"/> J'ai lu et accepté les <a href="/content/show/CGU" target=_blank>Conditions Générales d'Utilisation</a>
			
			<br/><br/>
		
			<input type="button" value="Envoyer" onclick="checkEmailAndSubmitForm()"/> ou <a href="javascript:history.go(-1)">Annuler</a>
		</div>
		<? } ?>
	</form>
</div>
