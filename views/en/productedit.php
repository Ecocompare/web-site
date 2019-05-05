<h1>
<?php
	if ($GLOBALS['action'] == "edit"){
		echo "Modify ".stripSlashes($this->getFormValue('name'));
	}else if ($GLOBALS['action'] == "propose"){
		echo "Propose a product";
	}else {
		echo "Add a product";
	}
?>
</h1>
<div align="justify">
This page allows you to modify all related information to your product. Please remember to fill all tabs and to frequently save your form (20 min).<br/><br/> 
</div>
<div>
	<form name="formulaire" action="<?=$GLOBALS['base']?>products/<?=$this->targetAction?>/" method="post" id="form" enctype="multipart/form-data">
	
		<input type="hidden" name="id" value="<? echo $this->getFormValue('id') ?>"/>
		<input type="hidden" name="returnurl" value="<?=reqOrDefault('returnurl', '/products/admin/') ?>"/>
		
		<ul class="formtabs">
			<?
				$tabs = array();
				$tabs[] = array("id"=>"1", "name"=>"General");
				$tabs[] = array("id"=>"2", "name"=>"Categories");
				$tabs[] = array("id"=>"3", "name"=>"Presentation");
				$tabs[] = array("id"=>"4", "name"=>"Environment");
				$tabs[] = array("id"=>"5", "name"=>"Health");
				$tabs[] = array("id"=>"6", "name"=>"Quality");
				$tabs[] = array("id"=>"7", "name"=>"Social");
				$tabs[] = array("id"=>"8", "name"=>"Ethic");
				$tabs[] = array("id"=>"9", "name"=>"Fairtrade");
				foreach($tabs as $key=>$tab){ ?>
					<li id="tab<?=$tab['id']?>"><a onclick="switchFormSection('<?=$tab['id']?>')">
						<?=$tab['name']?>
					<? if ($this->getFormValue('id')>0 && $db->isfeedback($tab['id']-3,$this->getFormValue('id'))) {?> <img src="<?=$GLOBALS['base']?>images/warning.png" alt="Ecocompare important notice"/>
						
					<?}?>
						</a></li>
					<?} ?>
			
		</ul>

<!-####################### GENERAL ######################### -->
		<div class="formsection" id="section1">
			<div class="fieldlabel<?=$this->hasChanged('contact') ?>">
				Your email :
			</div>
			<div class="fieldcontent">
				<input type="text" id="useremail" name="contact" value="<? echo encodeQuotes(stripSlashes($this->getFormValue('contact'))) ?>"/>

			(mandatory)
			</div>

				<!--input type="hidden" id="useremail" name="contact" value="<? echo encodeQuotes(stripSlashes($this->getFormValue('contact'))) ?>"/-->
			<div class="fieldlabel<?=$this->hasChanged('image') ?>">
				Product picture : <br/> (square please, 200ko max)
			</div>
			<div class="fieldcontent">
				<input type="hidden" id="fileaction" name="fileaction" value="upload"/>
				<div id="fileinput">
					 <input type="hidden" name="MAX_FILE_SIZE" value="800000" />
					<input type="file" name="image">
					<? if (strlen($this->getFormValue('image')) > 0){ ?> | <a href="javascript:hideFileInput()">Cancel</a><? } ?>
				</div>
				<div id="filestatus">
					<img src="<?=$GLOBALS['base']?>products?action=showImage&size=thumb&id=<? echo $this->getFormValue('id'); ?>" />
					<? echo $this->getFormValue('image') ?> | <a href="javascript:showFileInput()">Modify</a>
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
				Product name :
			</div>
			<div class="fieldcontent">
				<input type="text" name="name" value="<? echo encodeQuotes(stripSlashes($this->getFormValue('name'))) ?>"/>
			</div>

			<div class="fieldlabel<?=$this->hasChanged('brand') ?>">
				Brand :
			</div>
			<div class="fieldcontent">
				<input type="text" name="brand" value="<? echo encodeQuotes(stripSlashes($this->getFormValue('brand'))) ?>"/>
			</div>

			<div class="fieldlabel">
				Kind of product :
			</div>
			<div class="fieldcontent">
				<select id="typeid" name="typeid" onChange="loadRules(<?=$this->getFormValueDefault('id', '0') ?>,this.options[this.options.selectedIndex].value, this.form.equitable_sud.checked)">
					<option value="0">Aucun/None</option>
					<? foreach($this->types as $key=>$type) { ?>
						<option value="<?=$type['id']?>" <? if($this->getFormValue('typeid') == $type['id']) echo "selected"?> /><? if ($this->lang==1) echo $type['name']; else echo $type['name_en'];?></option>
					<? } ?>
				</select>
			</div>
			
				<div class="fieldlabel">
				Fairtrade :
			</div>
			<div class="fieldcontent">
				<input type="checkbox" onChange="check_equitable(<?=$this->getFormValueDefault('id', '0') ?>,this.form.typeid.options[this.form.typeid.options.selectedIndex].value, this.form.equitable_sud.checked)" name="equitable_sud" <? if($this->getFormValue('equitable_sud') ==1) echo "checked"?> />Do you work with developing countries (non-OECD) during the manufacturing process of this product ?
			</div>
			
			<? if (admin() && $this->targetAction != 'submit') { ?>

			<div class="fieldlabel">
				User account :
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
				<input type="radio" name="published" value="submission" <? if ($this->getFormValue('published') == "submission"){ echo 'checked'; } ?> /> Submission
				<input type="radio" name="published" value="deactivated" <? if ($this->getFormValue('published') == "deactivated"){ echo 'checked'; } ?> /> Disabled
				<input type="radio" name="published" value="saved" <? if ($this->getFormValue('published') == "saved"){ echo 'checked'; } ?> /> Draft
				<input type="radio" name="published" value="true" <? if ($this->getFormValue('published') == "true"){ echo 'checked'; } ?> /> Published
			</div>
			
			<? } ?>


			<div class="fieldlabel<?=$this->hasChanged('EAN') ?>">
				EAN barcodes :
			</div>
			<div class="fieldcontent">
				<input type="text" name="EAN" value="<? echo encodeQuotes(stripSlashes($this->getFormValue('EAN'))) ?>"/><br/>
				If many separate with commas
			</div>
			
			<!- ##################### LABEL -->
		
			
		
			<div class="fieldlabel<?=$this->hasChanged('labels') ?>"  >
				Label(s) :
			</div>
			<div class="fieldcontent" id="sectionlabel">
				<? $this->labelCtrl->showCheckboxesType($this->getFormValue('labels'),$this->getFormValue('typeid')); ?>
			</div>

		
		
			<div class="fieldlabel<?=$this->hasChanged('co2') ?>">
				 CO2 Emissions:
			</div>
			<div class="fieldcontent">
				<input type="text" name="co2" value="<? echo encodeQuotes(stripSlashes($this->getFormValue('co2'))) ?>"/>
			</div>

			<div class="fieldlabel<?=$this->hasChanged('price') ?>">
				Average price :
			</div>
			<div class="fieldcontent">
				<input type="text" name="price" value="<? echo encodeQuotes(stripSlashes($this->getFormValue('price'))) ?>"/>
			</div>

			<div class="fieldlabel<?=$this->hasChanged('findit') ?>">
				Where to find it :
			</div>
			<div class="fieldcontent">
				<textarea name="findit"><? echo stripSlashes($this->getFormValue('findit')) ?></textarea>
				Example : on the website (http://www.ourbestsite.uk)
			</div>

		
		</div>

<!-####################### CATEGORIES ######################### -->
		<div class="formsection" id="section2">

			<div class="fieldlabel<?= $this->hasChanged('categories') ?>">
				Categories :
			</div>
			<div class="fieldcontent">
				<?
					$this->categoryCtrl->showCheckboxes($this->getFormValue('categories'),$this->lang);
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
				Important information :
			</div>
			<div class="fieldcontent">
				<textarea name="facts" class="ratingcomment"><? echo stripSlashes($this->getFormValue('facts')) ?></textarea>
			</div>
			
			<? if (admin()){ ?>
		
			<div class="fieldlabel<?=$this->hasChanged('globalcomment') ?>">
				Ecocompare comment:
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
	
		
	<?php if (!$this->getFormValue('typeid')>0) { echo 'Select the kind of product on the general tab'; }
		else { ?>
			
		Actual score : <?echo $this->getProductNote($this->getFormValue('id'),1,0); ?> / 5
		<?
	   foreach ($this->lifeCycles as $key=>$lifeCycle) { ?>
		

		<? //on change de couleur si produit ou emballage 
		$titre=$lifeCycle['name'];
		$pos_pdt=strpos($lifeCycle['name'], 'produit');
		$pos_emb=strpos($lifeCycle['name'], 'emballage');
		
		if ($pos_pdt!=0) $titre=substr($lifeCycle['name'],0,$pos_pdt)." <font color='#ED6C0A'> produit </font>";
		if ($pos_emb!=0) $titre=substr($lifeCycle['name'],0,$pos_emb)." <font color='#61C930'> emballage</font>";
		
		?>
		<h3><?=$titre?> (ideal score : <?echo $db->getTypeMax($this->getFormValue('typeid'),1,$lifeCycle['id']); ?>) </h3>
	
		<div class="fieldlabel">
				Criteria :
			</div>
			<div class="fieldcontent">
				<? if ($this->getFormValue('typeid')>0)  $this->displaySubratings($this->getFormValue('typeid'), 1,$lifeCycle['id'],$this->lang ); 
				else echo 'Select the kind of product on the general tab';
				?>
				
			</div>
	<? } ?>
				
			

			<div>	
			<input type="hidden" name="rating1" id="rating1" value="<?= $this->getFormValue('rating1') ?>"  style="width: 32px"/>
			</div>
			
			<? if (admin()){ ?>
			<div class="fieldlabel<?=$this->hasChanged('rating1comment') ?>">
				Comment :
			</div>
			<div class="fieldcontent">
				<textarea name="rating1comment"><? echo stripSlashes($this->getFormValue('rating1comment')) ?></textarea>
			</div>
			<? } ?>
			
<? } ?>
		</div>

<!-####################### SANTE ######################### -->
		<div class="formsection" id="section5">

		<?php if (!$this->getFormValue('typeid')>0) { echo 'Select the kind of product on the general tab'; }
		else { ?>

		Actual score : <?echo $this->getProductNote($this->getFormValue('id'),2,0); ?> / 5
			<h3>Health (ideal score : <?echo $db->getTypeMax($this->getFormValue('typeid'),2,0); ?>) </h3>
				
						
		<div class="fieldlabel">
				Criteria :
			</div>
			<div class="fieldcontent">
				<? if ($this->getFormValue('typeid')>0)  $this->displaySubratings($this->getFormValue('typeid'), 2,0,$this->lang ); 
				else echo 'Select the kind of product on the general tab';
				?>
				
			</div>
			

			
		<div>	
			<input type="hidden" name="rating2" id="rating2" value="<?= $this->getFormValue('rating2') ?>"  style="width: 32px"/>
			</div>
			
			<? if (admin()){ ?>
			<div class="fieldlabel<?=$this->hasChanged('rating1comment') ?>">
				Comment :
			</div>
			<div class="fieldcontent">
				<textarea name="rating2comment"><? echo stripSlashes($this->getFormValue('rating2comment')) ?></textarea>

			</div>
			<? } ?>
		<? } ?>

		</div>

<!-####################### QUALITE ######################### -->
		<div class="formsection" id="section6">
		<?php if (!$this->getFormValue('typeid')>0) { echo 'Select the kind of product on the general tab'; }
		else { ?>

		Actual score : <?echo $this->getProductNote($this->getFormValue('id'),3,0); ?> / 5
		<h3>Quality (ideal score : <?echo $db->getTypeMax($this->getFormValue('typeid'),3,0); ?>) </h3>
			
		<div class="fieldlabel">
				Criteria :
			</div>
			<div class="fieldcontent">
				<? if ($this->getFormValue('typeid')>0)  $this->displaySubratings($this->getFormValue('typeid'), 3,0,$this->lang ); 
				else echo 'Select the kind of product on the general tab';
				?>
				
			</div>
			
			
			
		<div>	
			<input type="hidden" name="rating3" id="rating3" value="<?= $this->getFormValue('rating3') ?>"  style="width: 32px"/>
			</div>
			
			<? if (admin()){ ?>
			<div class="fieldlabel<?=$this->hasChanged('rating1comment') ?>">
				Comment :
			</div>
			<div class="fieldcontent">
				<textarea name="rating3comment"><? echo stripSlashes($this->getFormValue('rating3comment')) ?></textarea>
			</div>
	<? } ?>

	<? } ?>
		</div>

<!-####################### SOCIAL ######################### -->
		<div class="formsection" id="section7" <? if ($this->targetAction == 'submit') { echo 'style="display:none"'; }?> >
		
	
		
		<?php if (!$this->getFormValue('typeid')>0) { echo 'Select the kind of product on the general tab'; }
		else { ?>
		Actual score : <?echo $this->getProductNote($this->getFormValue('id'),4,0); ?> / 5		
			<h3>Social (ideal score: <?echo $db->getTypeMax($this->getFormValue('typeid'),4,0); ?>) </h3>
			
		<div class="fieldlabel">
				Criteria :
			</div>
			<div class="fieldcontent">
				<? if ($this->getFormValue('typeid')>0)  $this->displaySubratings($this->getFormValue('typeid'), 4,0,$this->lang ); 
				else echo 'Select the kind of product on the general tab';
				?>
				
			</div>
			

			
			<div>	
			<input type="hidden" name="rating4" id="rating4" value="<?= $this->getFormValue('rating4') ?>"  style="width: 32px"/>
			</div>
			
			<? if (admin()){ ?>
			<div class="fieldlabel<?=$this->hasChanged('rating1comment') ?>">
				Comment :
			</div>
			<div class="fieldcontent">
				<textarea name="rating4comment"><? echo stripSlashes($this->getFormValue('rating4comment')) ?></textarea>
			</div>
			<? } ?>
			<? } ?>
		</div>
		
		
<!-####################### ETHIQUE ######################### -->
		<div class="formsection" id="section8">

	
	<?php if (!$this->getFormValue('typeid')>0) { echo 'Select the kind of product on the general tab'; }
		else { ?>
		
		Actual score : <?echo $this->getProductNote($this->getFormValue('id'),5,0); ?> / 5
		<h3>Ethic (ideal score: <?echo $db->getTypeMax($this->getFormValue('typeid'),5,0); ?>) </h3>
			
		<div class="fieldlabel">
				Criteria :
			</div>
			<div class="fieldcontent">
				<?php $this->displaySubratings($this->getFormValue('typeid'), 5,0,$this->lang ); ?>
			</div>
			
			
		<div>	
			<input type="hidden" name="rating5" id="rating5" value="<?= $this->getFormValue('rating5') ?>"  style="width: 32px"/>
			</div>
			
			<? if (admin()){ ?>
			<div class="fieldlabel<?=$this->hasChanged('rating1comment') ?>">
				Comment :
			</div>
			<div class="fieldcontent">
				<textarea name="rating5comment"><? echo stripSlashes($this->getFormValue('rating5comment')) ?></textarea>
			</div>
		<? } ?>
	<? } ?>
	
		</div>
		
		<!-####################### EQUITABLE NORD/NORD OU NORD/SUD ######################### -->
		<div class="formsection" id="section9" >

	
	<?php if (!$this->getFormValue('typeid')>0) { echo 'Select the kind of product on the general tab'; }
		else { ?>
		
		Actual score : <? if ($this->getFormValue('equitable_sud')==1) echo $this->getProductNote($this->getFormValue('id'),6,0);  else echo $this->getProductNote($this->getFormValue('id'),7,0);?> / 5

		<? if ($this->getFormValue('equitable_sud')==1) { ?>
		
		<h3>Fairtrade NORTH/SOUTH countries (ideal score :  <? echo $db->getTypeMax($this->getFormValue('typeid'),6,0); ?>) </h3>
		<?} else { ?>
					<h3>Fairtrade NORTH/NORTH countries (ideal score:  <? echo $db->getTypeMax($this->getFormValue('typeid'),7,0); ?>) </h3>
		<? } ?>
		
			
		<div class="fieldlabel">
				Criteria :
			</div>
			<div class="fieldcontent">
				<?php if ($this->getFormValue('equitable_sud')==1) $this->displaySubratings(0, 6,0,$this->lang ); else $this->displaySubratings($this->getFormValue('typeid'), 7,0,$this->lang ); ?>
				
			</div>
			
			
		<div>	
			<input type="hidden" name="rating6" id="rating6" value="<?= $this->getFormValue('rating6') ?>"  style="width: 32px"/>
			</div>
			
			<? if (admin()){ ?>
			<div class="fieldlabel<?=$this->hasChanged('rating1comment') ?>">
				Comment :
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
			<input type="checkbox" id="accept" value="accepted"/> I have read and agree to the <a href="<?=$GLOBALS['base']?>content/show/CGU" target=_blank>Terms of Use</a>
			<input type="hidden" name="published" value=""/>
			<br/><br/>
			<? if ($this->getFormValue('published') == 'submission') {?>
				<input type="checkbox" name="sendmail"/> Send an email to customer where publishing<br/>
				<input type="button" onclick="checkCGUsAndSubmitForm()" value="Save"/>&nbsp;&nbsp;
				<? if (admin()){ ?>
				<input type="button" onclick="document.getElementById('subaction').value='saved'; checkCGUsAndSubmitForm();" value="Draft mode"/>&nbsp;
				
				<input type="button" onclick="document.getElementById('subaction').value='publish'; checkCGUsAndSubmitForm();" value="Save and publish"/>&nbsp;
		
				<? if ($this->nbFeedback >0) {?> <input type="button" onclick="sendFeedback(<?= $this->getFormValue('id')?>)" value="Ask for details"/>&nbsp; 
				
				<? }} ?>
				or <a href="javascript:history.go(-1)">Cancel</a>
			<? } else { ?>
				<input type="button" onclick="this.form.published.value='saved';checkCGUsAndSubmitForm()" value="Save"/>		
				<? if (company() && $this->getFormValue('published') != 'true') { ?>
				<input type="button" onclick="this.form.published.value='submission';checkCGUsAndSubmitForm()" value="Submit"/>
				<? } ?>		
				
				
				ou <a href="javascript:history.go(-1)">Cancel</a>
			<? } ?>
		</div>
		<? }else{ ?>
		<div class="formbuttons">
			<input type="checkbox" id="accept" value="accepted"/> I have read and agree to the <a href="/content/show/CGU" target=_blank>Terms of Use</a>
			
			<br/><br/>
		
			<input type="button" value="Send" onclick="checkEmailAndSubmitForm()"/> or <a href="javascript:history.go(-1)">Cancel</a>
		</div>
		<? } ?>
	</form>
</div>
