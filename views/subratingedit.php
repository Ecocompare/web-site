<h1>
<?php
	if ($GLOBALS['action'] == "edit"){
		echo "Edit ".stripSlashes($this->getFormValue('name'));
	}else {
		echo "Add a criteria";
	}
?>
</h1>
<div>
	<form action="subratings?action=<? echo $this->targetAction; ?>" method="post" enctype="multipart/form-data">
	
		<input type="hidden" name="id" value="<? echo $this->getFormValue('id') ?>"/>
		<input type="hidden" name="lang" value="<? echo $this->getFormValue('lang') ?>"/>
		
		<div class="formsection" id="section1">

			<div class="fieldlabel">
				Thème  :
			</div>
			<div class="fieldcontent">
				<select name="themeid">
					<?php foreach ($this->themes as $key=>$theme) {	?>
					<option value="<?=$theme['id']?>" <? if ($this->getFormValue('theme_id') == $theme['id']){echo "selected=true";} ?>><?=$theme['name']?></option>
			<?php } ?>
				</select>
			</div>
		
		<?php if ( $this->getFormValue('lifecycle_id')!=0) { ?>
			<div class="fieldlabel">
			LifeCycle	  :
			</div>
			<div class="fieldcontent">
				<select name="lifecycleid">
					<?php foreach ($this->lifecycles as $key=>$lifecycle) {	?>
					<option value="<?=$lifecycle['id']?>" <? if ($this->getFormValue('lifecycle_id') == $lifecycle['id']){echo "selected=true";} ?>><?=$lifecycle['name']?></option>
			<?php } ?>
				</select>
			</div>
			<?php } else { ?>
			<input type="hidden" name="lifecycleid" value="0"/>
			<?php } ?>
			
			
			<div class="fieldlabel">
				Heading  :
			</div>
			<div class="fieldcontent">
				<select name="headingid" >
					<?php foreach ($this->headings as $key=>$heading) {	?>
					<option value="<?=$heading['id']?>" <? if ($this->getFormValue('heading_id') == $heading['id']){echo "selected=true";} ?>><?=substr($heading['name'],0,90);?></option>
			<?php } ?>
				</select>
			</div>
			
			<div class="fieldlabel">
				Name :
			</div>
			<div class="fieldcontent">
				<input type="text" name="name" value="<? echo htmlspecialchars(stripSlashes($this->getFormValue('name'))); ?>"/>
			</div>
			
			<div class="fieldlabel">
				Question :
			</div>
			<div class="fieldcontent">
				<textarea name="question" style="height:80px;"><? echo htmlspecialchars(stripSlashes($this->getFormValue('question'))) ?></textarea>
			</div>

			<div class="fieldlabel">
				Proof if existing product :
			</div>
			<div class="fieldcontent">
					<textarea name="proof_exist"  style="height:80px;"><? echo htmlspecialchars(stripSlashes($this->getFormValue('proof_exist'))) ?></textarea>
			</div>
			
			

			<div class="fieldlabel">
				Proof if new product :
			</div>
			<div class="fieldcontent">
					<textarea name="proof_new"  style="height:80px;"><? echo htmlspecialchars(stripSlashes($this->getFormValue('proof_new'))) ?></textarea>
			</div>
			
			<div class="fieldlabel">
				Example :
			</div>
			<div class="fieldcontent">
					<textarea name="example"  style="height:80px;"><? echo htmlspecialchars(stripSlashes($this->getFormValue('example'))) ?></textarea>
			</div>
			
			<div class="fieldlabel">
				Points :
			</div>
			<div class="fieldcontent">
					<input type="text" style="width:50px;" name="points" value="<? echo htmlspecialchars(stripSlashes($this->getFormValue('points'))) ?>"/>
			</div>
			
	
	<?php if (count($this->formValues['impact'])  > 0 ) { ?>
		<div class="fieldlabel">
				Impacts :
			</div>
			<div class="fieldcontent">
					
				<?php foreach ($this->formValues['impact'] as $key=>$impact) {	?>
				 <?=$impact['name']?><br/>
			<?php } ?>
		</select>
			</div>
		<?php } ?>
			
		
		<?php if (count($this->labels)  > 0 ) { ?>
		<div class="fieldlabel">
				Labels :
			</div>
			<div class="fieldcontent">
					
				<?php foreach ($this->labels as $key=>$label) {	?>
				<img src="images/labels_16/<?=$label['image']?>"/> <?=$label['name']?> <?=$label['referentiel']?> info, page n°<?=$label['value']?><br/>
			<?php } ?>
		</select>
			</div>
		<?php } ?>
		
		<div class="fieldlabel">
				Categories :
			</div>
			<div class="fieldcontent">
					
				<?php foreach ($this->types as $key=>$type) {	?>
				 <? if ($this->getFormValue('lang')==1) echo $type['name']; else echo $type['name_en']; ?><br/>
			<?php } ?>
		</select>
			</div>
	
			
			
				
		</div>
		<div class="formbuttons">
			<input type="submit" value="Save"/> or <a href="subratings?action=admin&lang=<? echo $this->getFormValue('lang') ?>">Cancel</a>
		</div>
	</form>
</div>