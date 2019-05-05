<h1>
<?php
	if ($GLOBALS['action'] == "edit"){
		echo "Modifier ".stripSlashes($this->getFormValue('title'));
	}else {
		echo "Ajouter un article";
	}
?>
</h1>
<div>
		
	<div class="formsection">

		<form id="form" action="articles?action=<? echo $this->targetAction; ?>" method="post" enctype="multipart/form-data">

			<input type="hidden" name="action" value="<? echo $this->getFormValue('action') ?>"/>	
			<input type="hidden" name="id" value="<? echo $this->getFormValue('id') ?>"/>

			<div class="fieldlabel">
				Titre :
			</div>
			<div class="fieldcontent">
				<input type="text" name="title" value="<?=encodeQuotes(stripSlashes($this->getFormValue('title')))?>"/>
			</div>
			
			<div class="fieldlabel">
				Image :
			</div>
			<div class="fieldcontent">
				<input type="hidden" id="fileaction" name="fileaction" value="upload"/>
				<div id="fileinput">
					<input type="file" name="image">
					<? if (strlen($this->getFormValue('image')) > 0){ ?> | <a href="javascript:hideFileInput()">Annuler</a><? } ?>
				</div>
				<div id="filestatus">
					<img src="<?=$GLOBALS['base']?>articles?action=showImage&size=thumb&id=<? echo $this->getFormValue('id'); ?>" />
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
			
			<div class="fieldlabel">
				Tags :
			</div>
			<div class="fieldcontent">
				<input type="text" name="tags" value="<?=encodeQuotes(stripSlashes($this->getFormValue('tags')))?>"/>
			</div>

				<div class="fieldlabel">
				Visible :
			</div>
			<div class="fieldcontent">
				<input type="checkbox" name="enable" <? if ($this->getFormValue('enable')==1) echo "checked=''"; ?>"/>
			</div>
			
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
		
			<form id="uploader" name="uploader" target="uploadiframe" action="articles?action=upload" method="post" enctype="multipart/form-data">
				<iframe id="uploadiframe" name="uploadiframe" src="blank.php">
				</iframe>
				<input type="hidden" name="action" value="upload"/>
				Importer une image : <input id="uploadinput" name="image" type="file" onchange="document.getElementById('uploader').submit(); insertImage();"/>
			</form>

			
		</div>
		

	<div class="formbuttons">
		<input type="button" onClick="prepareToSubmit(); document.getElementById('form').submit();" value="Enregistrer"/> ou <a href="articles?action=admin">Annuler</a>
	</div>
</div>