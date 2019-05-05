<h1>
<?php
	if ($GLOBALS['action'] == "edit"){
		echo "Modifier ".stripSlashes($this->getFormValue('username'));
	}else {
		echo "Ajouter un utilisateur";
	}
?>
</h1>
<div>
	<form action="<?=$GLOBALS['base']?>users/<? echo $this->targetAction; ?>" method="post" enctype="multipart/form-data">
	
		<input type="hidden" name="id" value="<? echo $this->getFormValue('id') ?>"/>
		
		<div class="formsection" id="section1">

			<div class="fieldlabel">
				Type :
			</div>
			<div class="fieldcontent">
				<? $items = array(); //$items[] = array('id'=>'admin', 'name'=>'Administrateur');
				 $items[] = array('id'=>'company', 'name'=>'Pro'); ?>
				
				<? $this->showSelect("type", $items, $this->getFormValue('type'), ''); ?>
			</div>

			<div class="fieldlabel">
				Nom :
			</div>
			<div class="fieldcontent">
				<input type="text" name="username" value="<? echo stripSlashes($this->getFormValue('username')) ?>"/>
			</div>

			<div class="fieldlabel">
				Entreprise :
			</div>
			<div class="fieldcontent">
				<select name="companyid">
					<option value="0">Aucune</option>
					<? foreach($this->companies as $key=>$company) { ?>
						<option value="<?=$company['id']?>" <? if($this->getFormValue('companyid') == $company['id']) echo "selected"?> /><?=$company['title']?></option>
					<? } ?>
				</select>
			</div>

			<div class="fieldlabel">
				Email :
			</div>
			<div class="fieldcontent">
				<input type="text" name="email" value="<? echo stripSlashes($this->getFormValue('email')) ?>"/>
			</div>

			<div class="fieldlabel">
				Mot de passe :
			</div>
			<div class="fieldcontent">
				<input type="password" name="password" value=""/>
			</div>
			
			<div class="fieldlabel">
				Langue :
			</div>
			<div class="fieldcontent">
				<select name="langid">
					<option value="1" <? if ($this->getFormValue('lang')==1) echo "selected"; ?> >Française</option>
					<option value="2" <? if ($this->getFormValue('lang')==2) echo "selected"; ?> >Anglaise</option>
				</select>
			</div>
			
			<div class="fieldlabel">
				Envoi information de compte par mail :
			</div>
			<div class="fieldcontent">
				<input type="checkbox" name="sendmail"/>
			</div>
			
		</div>
		<div class="formbuttons">
			<input type="submit" value="Enregistrer"/> 	 ou <a href="categories?action=admin">Annuler</a>
		</div>
	</form>
</div>