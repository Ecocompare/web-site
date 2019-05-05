<h1>
<?php
	if ($GLOBALS['action'] == "edit"){
		echo "Modifier ".stripSlashes($this->getFormValue('title'));
	}else {
		echo "Ajouter une entreprise";
	}
?>
</h1>
<div>
		
	<div class="formsection">

		<form id="form" action=companies" method="post" enctype="multipart/form-data">

			<input type="hidden" name="action" value="<? echo $this->getFormValue('action') ?>"/>	
			<input type="hidden" name="id" value="<? echo $this->getFormValue('id') ?>"/>

			<div class="fieldlabel">
				Nom :
			</div>
			<div class="fieldcontent">
				<input type="text" name="title" value="<?=encodeQuotes(stripSlashes($this->getFormValue('title')))?>"/>
			</div>

			<div class="fieldlabel">
				Site web :
			</div>
			<div class="fieldcontent">
				<input type="text" name="site" value="<?=encodeQuotes(stripSlashes($this->getFormValue('site')))?>"/>
			</div>
			
			<div class="fieldlabel">
				Logo :
			</div>
			<div class="fieldcontent">
				<input type="hidden" id="fileaction" name="fileaction" value="upload"/>
				<div id="fileinput">
					<input type="file" name="image">
					<? if (strlen($this->getFormValue('image')) > 0){ ?> | <a href="javascript:hideFileInput()">Annuler</a><? } ?>
				</div>
				<div id="filestatus">
					<img src="<?=$GLOBALS['base']?>companies?action=showImage&size=thumb&id=<? echo $this->getFormValue('id'); ?>" />
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
			<? if (admin()) { ?>
				<div class="fieldlabel">
				Visible :
			</div>
			<div class="fieldcontent">
				<input type="checkbox" name="enable" <? if ($this->getFormValue('enable')==1) echo "checked=''"; ?>"/>
			</div>
			<? } ?>
		
			<div id="htmleditor" class="editor">
				<div class="editortoolbar">
					<a href="javascript:switchEditorView('wysiwyg')"><img src="<?=$GLOBALS['base']?>style/switchtowysiwyg.gif"/></a>
				</div>
				<textarea id="html" name="text"><?=stripSlashes($this->getFormValue('text'))?></textarea>
			</div>
		</form>
			
		<div id="wysiwygeditor" class="editor">
			<script src="js/wysiwyg.js"></script>
			<div class="editortoolbar">
				<a href="javascript:switchEditorView('html')" id="switchtohtml"><img src="<?=$GLOBALS['base']?>style/switchtohtml.gif"/></a>
				<select id="blockformat" onChange="formatBlock();">
					<option value="">Style</option>
					<option value="<p>">Normal</option>
					<option value="<h1>"><h1>Titre 1</h1></option>
					<option value="<h2>">Titre 2</option>
					<option value="<h3>">Titre 3</option>
				</select>
				<a href="javascript:doRichEditCommand('bold')"><img src="<?=$GLOBALS['base']?>style/bold.gif"/></a>
				<a href="javascript:doRichEditCommand('italic')"><img src="<?=$GLOBALS['base']?>style/italic.gif"/></a>
				<a href="javascript:insertLink()"><img src="<?=$GLOBALS['base']?>style/link.gif"/></a>

				<a href="javascript:doRichEditCommand('justifyleft')"><img src="<?=$GLOBALS['base']?>style/alignleft.gif"/></a><a href="javascript:doRichEditCommand('justifycenter')"><img src="<?=$GLOBALS['base']?>style/aligncenter.gif"/></a><a href="javascript:doRichEditCommand('justifyright')"><img src="<?=$GLOBALS['base']?>style/alignright.gif"/></a>
				<a href="javascript:doRichEditCommand('insertunorderedlist')"><img src="<?=$GLOBALS['base']?>style/list.gif"/></a>
			</div>
			<iframe name="wysiwyg" id="wysiwyg" src="blank.php" onload="initWysiwygArea();" frameborder="0">
			</iframe>


		</div>
		

			
		</div>
		

	<div class="formbuttons">
		<input type="button" onClick="prepareToSubmit(); document.getElementById('form').submit();" value="Enregistrer"/> ou <a href="companies?action=admin">Annuler</a>
	</div>
</div>